<script setup lang="ts">
import App from "@/Layouts/App.vue";
import { PaginateType } from "@/types/paginateType";
import { ThesisAdvisorType } from "@/types/thesisAdvisor";
import { router, useForm } from "@inertiajs/vue3";
import { pickBy, throttle } from "lodash";
import Swal from "sweetalert2";
import { watch } from "vue";

const props = defineProps<{
    thesisAdvisor?: ThesisAdvisorType;
    thesisAdvisors: PaginateType<ThesisAdvisorType>;
    filters?: {
        keyword: string;
    };
}>();

const form = useForm({
    Academic_Year: props.thesisAdvisor?.Academic_Year ?? "",
    Advisor: props.thesisAdvisor?.Advisor ?? "",
    College: props.thesisAdvisor?.College ?? "",
    Department: props.thesisAdvisor?.Department ?? "",
});
const onSave = () => {
    // console.log(form.data());
    form.post(route("thesisAdvisor.store"), {
        onSuccess: () => {
            Swal.fire({
                icon: "success",
                title: "Advisor has been saved.",
                timer: 2000,
                position: "top-end",
                toast: true,
                showConfirmButton: false,
            });
        },
    });
};

const filterForm = useForm({
    keyword: props.filters?.keyword ?? "",
});

watch(
    () => filterForm.data(),
    throttle(() => {
        console.log("log data");
        router.get(route("thesisAdvisor.index"), pickBy(filterForm.data()), {
            preserveState: true,
            only: ["thesisAdvisors"],
            replace: true,
        });
    }, 500),
);

const onClearFilter = () => {
    filterForm.keyword = "";
};

const onDelete = async (id: number) => {
    await Swal.fire({
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
                        title: "Advisor has been deleted.",
                        toast: true,
                        position: "top-end",
                        timer: 2000,
                        showConfirmButton: false,
                    });
                },
            });
        }
    });
};

const onEdit = (id: number) => {
    router.get(route("thesisAdvisor.edit", id));
    form.Academic_Year = props.thesisAdvisor?.Academic_Year ?? "";
    form.Advisor = props.thesisAdvisor?.Advisor ?? "";
    form.Department = props.thesisAdvisor?.Department ?? "";
};
</script>

<template>
    <App>
        <div class="p-3">
            <h2 class="text-2xl font-bold">Create a ThesisAdvisor</h2>
            <div class="mt-4"></div>
            <div class="mt-4 p-4 bg-base-100 rounded-xl">
                <form @submit.prevent="onSave">
                    <div class="flex flex-col gap-2 lg:flex-row">
                        <div class="flex flex-col w-full">
                            <!-- <label class="label">Academic year</label> -->
                            <input
                                type="text"
                                v-model="form.Academic_Year"
                                placeholder="Academic Year"
                                className="input input-bordered input-info w-full max-w-xs"
                            />
                            <!-- <input v-model="form.Academic_Year" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Academic_Year }" /> -->
                            <div
                                v-if="form.errors.Academic_Year"
                                class="text-error"
                            >
                                {{ form.errors.Academic_Year }}
                            </div>
                        </div>

                        <div class="flex flex-col w-full">
                            <!-- <label class="label">Advisor</label> -->
                            <input
                                type="text"
                                v-model="form.Advisor"
                                placeholder="Advisor"
                                className="input input-bordered input-info w-full max-w-xs"
                            />
                            <!-- <input v-model="form.Advisor" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Advisor }" /> -->
                            <div v-if="form.errors.Advisor" class="text-error">
                                {{ form.errors.Advisor }}
                            </div>
                        </div>

                        <div class="flex flex-col w-full">
                            <!-- <label class="label">College</label> -->
                            <input
                                type="text"
                                v-model="form.College"
                                placeholder="College"
                                className="input input-bordered input-info w-full max-w-xs"
                            />
                            <!-- <input v-model="form.College" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.College }" /> -->
                            <div v-if="form.errors.College" class="text-error">
                                {{ form.errors.College }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <!-- <label class="label">Department</label> -->
                            <input
                                type="text"
                                v-model="form.Department"
                                placeholder="Department"
                                className="input input-bordered input-info w-full max-w-xs"
                            />
                            <!-- <input v-model="form.Department" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Department }" /> -->
                            <div
                                v-if="form.errors.Department"
                                class="text-error"
                            >
                                {{ form.errors.Department }}
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 flex justify-end">
                        <button type="submit" class="btn btn-success">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="p-3">
            <div class="mb-2">
                <h2 class="text-2xl font-bold">ThesisAdvisor Management</h2>
                <div class="mt-4">
                    <div
                        class="bg-base-100 p-2 rounded-xl flex gap-2 items-center"
                    >
                        <!-- <Link :href="route('thesisAdvisor.create')" class="btn btn-info">New</Link> -->
                        <input
                            v-model="filterForm.keyword"
                            type="text"
                            placeholder="Search by Academic_Year...."
                            class="input input-info w-full"
                        />

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
                <table class="table table-2xl">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Academic_Year</th>
                            <th>Advisor</th>
                            <th>College</th>
                            <th>Department</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(item, index) in thesisAdvisors.data"
                            :key="index"
                        >
                            <td>{{ item.id }}</td>
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
