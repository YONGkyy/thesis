<script setup lang="ts">
import App from "@/Layouts/App.vue";
import { PaginateType } from "@/types/paginateType";
import { ThesisAdvisorType } from "@/types/thesisAdvisor";
import { router, useForm } from "@inertiajs/vue3";
import { pick, pickBy, throttle } from "lodash";
import Swal from "sweetalert2";
import { watch } from "vue";
import Modal from "@/Components/Modal.vue";
import { ref } from "vue";
import axios from "axios";

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
    id: null,
    Academic_Year: "",
    Advisor: "",
    College: "",
    Department: "",
});

const onOpenModal = ref(false);

const onSave = () => {
    form.post(route("thesisAdvisor.store", form.id ?? "update"), {
        onSuccess: () => {
            Swal.fire({
                icon: "success",
                title: "ThesisAdvisor has been saved.",
                timer: 1500,
                position: "top-end",
                toast: true,
            });
            onOpenModal.value = false;
            form.reset();
            form.clearErrors();
        },
    });
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
        icon: "warning",
        showDenyButton: false,
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Delete",
        denyButtonText: "Cancel",
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route("thesisAdvisor.destroy", id), {
                onSuccess: () => {
                    Swal.fire({
                        icon: "success",
                        text: "Deleted successfully!",
                        title: "The Advisor has been deleted.",
                        showConfirmButton: false,
                        toast: true,
                        timer: 1000,
                        position: "top-end",
                    });
                },
            });
        }
    });
};
const onEdit = async (id: number) => {
    const { data } = await axios.get(route("thesisAdvisor.edit", id));
    form.id = data.id;
    form.Academic_Year = data.Academic_Year;
    form.Advisor = data.Advisor;
    form.College = data.College;
    form.Department = data.Department;
    onOpenModal.value = true;
};

const oncloseModal = () => {
    if (form.isDirty) {
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to close this form?",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "Yes",
            denyButtonText: `No`,
        }).then((result) => {
            if (result.isConfirmed) {
                onOpenModal.value = false;
                form.reset();
                form.clearErrors();
            }
        });
    } else {
        onOpenModal.value = false;
        form.reset();
        form.clearErrors();
    }
};
</script>

<template>
    <Modal :show="onOpenModal" maxWidth="2xl" @close="oncloseModal">
        <div class="p-3 bg-base-200 rounded-xl">
            <div class="text-center mt-2">
                <h2 class="text-2xl font-bold">
                    {{
                        form.id
                            ? "Thesis Advisor Update"
                            : "Thesis Advisor Create"
                    }}
                </h2>
            </div>
            <div class="p-4 rounded-xl">
                <form @submit.prevent="onSave">
                    <div class="flex flex-col w-full">
                        <div>
                            <div class="flex flex-col w-full">
                                <label class="label">Academic year</label>
                                <input
                                    type="text"
                                    v-model="form.Academic_Year"
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
                    <div class="mt-3 flex justify-end gap-4">
                        <button
                            type="button"
                            class="btn btn-warning"
                            @click="oncloseModal"
                        >
                            Close
                        </button>
                        <button type="submit" class="btn btn-success">
                            {{ form.id ? "Update" : "Save" }}
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
                <div class="mt-2 bg-base-100 px-2 pb-2 rounded-xl flex gap-2">
                    <div class="mt-auto">
                        <button
                            class="btn btn-primary align-bottom"
                            @click="onOpenModal = true"
                        >
                            New
                        </button>
                    </div>

                    <div class="flex flex-col w-full">
                        <label class="label label-text">Academic Year</label>
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
                    </div>

                    <div class="flex flex-col w-full">
                        <label class="label label-text">Advisor Name</label>
                        <select
                            v-model="filterForm.advisor"
                            class="select select-info w-full"
                        >
                            <option value="">All Advisors</option>
                            <option
                                v-for="advisors in advisor_options"
                                :value="advisors"
                            >
                                {{ advisors }}
                            </option>
                        </select>
                    </div>

                    <div class="flex flex-col w-full">
                        <label class="label label-text">Department</label>
                        <select
                            v-model="filterForm.department"
                            class="select select-info w-full"
                        >
                            <option value="">All Departments</option>
                            <option
                                v-for="departments in department_options"
                                :value="departments"
                            >
                                {{ departments }}
                            </option>
                        </select>
                    </div>

                    <div class="mt-auto">
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
                    <Link
                        v-for="link in thesisAdvisors.links"
                        :href="link.url ?? '#'"
                        class="join-item btn"
                        :class="{ 'btn-info': link.active }"
                    >
                        <span v-html="link.label"></span>
                    </Link>
                </div>
            </div>
        </div>
    </App>
</template>
