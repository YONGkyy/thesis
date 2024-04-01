<script setup lang="ts">
import App from "@/Layouts/App.vue";
import { PaginateType } from "@/types/paginateType";
import { ThesisAdvisorType } from "@/types/thesisAdvisor";
import { router, useForm } from "@inertiajs/vue3";
import { pickBy, throttle, values } from "lodash";
import Swal from "sweetalert2";
import { watch } from "vue";
import Modal from "@/Components/Modal.vue";
import axios from "axios";
import { ref } from "vue";

const props = defineProps<{
    thesisAdvisor?: ThesisAdvisorType;
    thesisAdvisors: PaginateType<ThesisAdvisorType>;
    academic_options?: string[];
    advisor_options?: string[];
    department_options?: string[];
    filters?: {
        academic_Year?: string | null;
        advisor?: string | null;
        department?: string | null;
    };
}>();

const form = useForm({
    Academic_Year: props.thesisAdvisor?.Academic_Year ?? "",
    Advisor: props.thesisAdvisor?.Advisor ?? "",
    College: props.thesisAdvisor?.College ?? "",
    Department: props.thesisAdvisor?.Department ?? "",
});

const onModal = ref(false);

const onOpenModal = () => {
    onModal.value = true;
};

const onSave = () => {
    // console.log(form.data());
    form.post(route("thesisAdvisor.store"), {
        onSuccess: () => {
            Swal.fire({
                icon: "success",
                title: "ThesisAdvisor has been saved.",
                timer: 3000,
                position: "top-end",
                toast: true,
            });
        },
    });
    form.reset();
};

const filterForm = useForm({
    academic_year: props.filters?.academic_Year ?? "",
    advisor: props.filters?.advisor ?? "",
    department: props.filters?.department ?? "",
});

watch(
    () => filterForm.data(),
    throttle(() => {
        router.get(route("thesisAdvisor.index"), pickBy(filterForm.data()), {
            preserveState: true,
            only: ["thesisAdvisor"],
            replace: true,
        });
    }, 500),
);

const onClearFilter = () => {
    filterForm.reset();
};

const onDelete = (id: number) => {
    Swal.fire({
        title: "Do you want to delete?",
        showDenyButton: false,
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Delete",
        denyButtonText: "Cancel",
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route("thesisAdvisor.destroy", id), {
                onSuccess: () => {
                    Swal.fire({
                        icon: "success",
                        text: "Deleted successfully!",
                        title: "thesisAdvisor has been deleted.",
                        toast: true,
                        timer: 3000,
                    });
                },
            });
        }
    });
};
const onEdit = async (id: number) => {
    const { data } = await axios.get(route("thesisAdvisor.edit", id));
    form.Academic_Year = data.Academic_Year;
    form.Advisor = data.Advisor;
    form.College = data.College;
    form.Department = data.Department;
    onModal.value = true;
};

const oncloseModal = () => {
    onModal.value = false;
};
</script>

<template>
    <Modal :show="onModal" maxWidth="2xl">
        <div class="p-3">
            <h2 class="text-2xl font-bold">Create a ThesisAdvisor</h2>
            <div class="mt-4"></div>
            <div class="mt-4 p-4 bg-base-100 rounded-xl">
                <form @submit.prevent="onSave">
                    <div class="flex flex-col w-full">
                        <div>
                            <div class="flex flex-col w-full">
                                <label class="label">Academic year</label>
                                <input
                                    type="text"
                                    v-model="form.Academic_Year"
                                    placeholder="Academic Year"
                                    class="input input-primary w-full"
                                    :class="{
                                        'input-error':
                                            form.errors.Academic_Year,
                                    }"
                                />
                                <div
                                    v-if="form.errors.Academic_Year"
                                    class="text-error"
                                >
                                    {{ form.errors.Academic_Year }}
                                </div>
                            </div>

                            <div class="flex flex-col w-full">
                                <label class="label">Advisor</label>
                                <input
                                    type="text"
                                    v-model="form.Advisor"
                                    placeholder="Advisor"
                                    class="input input-primary w-full"
                                    :class="{
                                        'input-error': form.errors.Advisor,
                                    }"
                                />
                                <div
                                    v-if="form.errors.Advisor"
                                    class="text-error"
                                >
                                    {{ form.errors.Advisor }}
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="flex flex-col w-full">
                                <label class="label">College</label>
                                <input
                                    type="text"
                                    v-model="form.College"
                                    placeholder="College"
                                    class="input input-primary w-full"
                                    :class="{
                                        'input-error': form.errors.College,
                                    }"
                                />
                                <div
                                    v-if="form.errors.College"
                                    class="text-error"
                                >
                                    {{ form.errors.College }}
                                </div>
                            </div>
                            <div class="flex flex-col w-full">
                                <label class="label">Department</label>
                                <input
                                    type="text"
                                    v-model="form.Department"
                                    placeholder="Department"
                                    class="input input-primary w-full"
                                    :class="{
                                        'input-error': form.errors.Department,
                                    }"
                                />
                                <div
                                    v-if="form.errors.Department"
                                    class="text-error"
                                >
                                    {{ form.errors.Department }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 flex justify-end gap-3">
                        <button class="btn btn-warning" @click="oncloseModal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-success">
                            {{ form.isDirty ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </Modal>
    <App>
        <div class="p-3">
            <div class="mb-2">
                <h2 class="text-2xl font-bold">ThesisAdvisor Management</h2>
                <div class="mt-4">
                    <div
                        class="bg-base-100 p-2 rounded-xl flex gap-2 items-center"
                    >
                        <button class="btn btn-primary" @click="onOpenModal">
                            New
                        </button>

                        <select
                            v-model="filterForm.academic_year"
                            class="select select-info w-full"
                        >
                            <option value="">All Years</option>
                            <option
                                v-for="years in academic_options"
                                :value="years"
                            >
                                {{ years }}
                            </option>
                        </select>

                        <select
                            v-model="filterForm.advisor"
                            class="select select-info w-full"
                        >
                            <option value="">All Advisor Name</option>
                            <option
                                v-for="advisors in advisor_options"
                                :value="advisors"
                            >
                                {{ advisors }}
                            </option>
                        </select>

                        <select
                            v-model="filterForm.department"
                            class="select select-info w-full"
                        >
                            <option value="">All Department Name</option>
                            <option
                                v-for="departments in department_options"
                                :value="departments"
                            >
                                {{ departments }}
                            </option>
                        </select>

                        <button
                            class="btn btn-warning"
                            type="button"
                            @click="onClearFilter"
                        >
                            Clear
                        </button>
                    </div>
                </div>
            </div>
            <div class="bg-base-100 rounded-xl overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr class="text uppercase text-sm">
                            <th>Id</th>
                            <th>Academic</th>
                            <th>Advisor</th>
                            <th>College</th>
                            <th>Department</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody v-if="thesisAdvisors && thesisAdvisors.data">
                        <tr
                            v-for="(item, index) in thesisAdvisors.data"
                            :key="index"
                        >
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.Academic_Year }}</td>
                            <td>{{ item.Advisor }}</td>
                            <td>{{ item.College }}</td>
                            <td>{{ item.Department }}</td>
                            <td>
                                <button
                                    type="button"
                                    @click="onEdit(item.id)"
                                    class="btn btn-warning mr-2"
                                >
                                    Edit
                                </button>
                                <button
                                    type="button"
                                    @click="onDelete(item.id)"
                                    class="btn btn-error"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="bg-base-100 rounded-xl mt-2 flex justify-center p-2">
                <div class="join">
                    <b
                        v-for="link in thesisAdvisors.links"
                        :href="link.url ?? '#'"
                        class="join-item btn"
                        :class="{ 'btn-info': link.active }"
                    >
                        <span v-html="link.label"></span>
                    </b>
                </div>
            </div>
        </div>
    </App>
</template>
