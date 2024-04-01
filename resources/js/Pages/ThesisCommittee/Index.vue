<script setup lang="ts">
import App from "@/Layouts/App.vue";
import { PaginateType } from "@/types/paginateType";
import { ThesisCommitteeType } from "@/types/thesisCommittee";
import { router, useForm } from "@inertiajs/vue3";
import { pickBy, throttle } from "lodash";
import Swal from "sweetalert2";
import { watch } from "vue";

const props = defineProps<{
    thesisCommittee?: ThesisCommitteeType
    thesisCommittees: PaginateType<ThesisCommitteeType>
    filters?: {
        keyword: string;
    }
}>();

const form = useForm({
    Academic_year: props.thesisCommittee?.Academic_Year ?? "",
    Department: props.thesisCommittee?.Department ?? "",
    Major: props.thesisCommittee?.Major ?? "",
    Committee: props.thesisCommittee?.Committee ?? "",
    Subject: props.thesisCommittee?.Subject ?? "",
});


const onSave = () => {
    form.post(route("thesisCommittee.store"), {
        onSuccess: () => {
            Swal.fire({
                icon: "success",
                title: "ThesisCommittee has been saved.",
                timer: 3000,
                position: "top-end",
                toast: true,
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
        router.get(route("thesisCommittee.index"), pickBy(filterForm.data()), {
            preserveState: true,
            only:["thesisCommittees"],
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
            router.delete(route("thesisCommittee.destroy", id), {
                onSuccess: () => {
                    Swal.fire({
                        icon: "success",
                        text: "Deleted successfully!",
                        title: "ThesisCommittee has been deleted.",
                        toast: true,
                        timer: 3000,
                    });
                },
            });
        }
    });
};
</script>
<template>
    <App>
        <div class="p-3">
            <h2 class="text-2xl font-bold">Create a ThesisCommittee</h2>
            <div class="mt-4">

            </div>
            <div class='mt-4 p-4 bg-base-100 rounded-xl'>
                <form @submit.prevent="onSave">
                    <div class="flex flex-col gap-2 lg:flex-row">
                        <div class="flex flex-col w-full">
                            <!-- <label class="label">Academic year</label> -->
                            <input
                            type="text"
                            placeholder="Academic Year"
                            className="input input-bordered input-info w-full max-w-xs" />
                            <div v-if="form.errors.Academic_year" class="text-error">
                                {{ form.errors.Academic_year }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <!-- <label class="label">Department</label> -->
                            <input
                            type="text"
                            placeholder="Department"
                            className="input input-bordered input-info w-full max-w-xs" />
                            <div v-if="form.errors.Department" class="text-error">
                                {{ form.errors.Department }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <!-- <label class="label">Major</label> -->
                            <input
                            type="text"
                            placeholder="Major"
                            className="input input-bordered input-info w-full max-w-xs" />
                            <div v-if="form.errors.Major" class="text-error">
                                {{ form.errors.Major }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <!-- <label class="label">Committee</label> -->
                            <input
                            type="text"
                            placeholder="Committee"
                            className="input input-bordered input-info w-full max-w-xs" />
                            <div v-if="form.errors.Committee" class="text-error">
                                {{ form.errors.Committee }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <!-- <label class="label">Subject</label> -->
                            <input
                            type="text"
                            placeholder="Subject"
                            className="input input-bordered input-info w-full max-w-xs" />
                            <div v-if="form.errors.Subject" class="text-error">
                                {{ form.errors.Subject }}
                            </div>
                        </div>

                    </div>
                    <div class="mt-2 flex justify-end">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>

                </form>
            </div>
        </div>
        <div class="p-3">
            <div class="mb-2">
                <h2 class="text-2xl font-bold">ThesisCommittee Management</h2>
                <div class="mt-4">
                    <div class="bg-base-100 p-2 rounded-xl flex gap-2 items-center">
                        <!-- <Link :href="route('thesisCommittee.create')" class="btn btn-primary">New</Link> -->
                        <input
                            v-model="filterForm.keyword"
                            type="text"
                            placeholder="Search..."
                            class="input input-info w-full"/>

                        <button class="btn btn-warning" type="button" @click="onClearFilter">Clear</button>
                    </div>
                </div>
            </div>
            <div class="bg-base-100 rounded-xl overflow-x-auto">
                <table class="table table-lg">
                    <thead>
                        <tr>
                            <th>Academic Year</th>
                            <th>Department</th>
                            <th>ID</th>
                            <th>Academic_Year</th>
                            <th>Major</th>
                            <th>Committee</th>
                            <th>Department</th>
                            <th>Subject</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(item, index) in thesisCommittees.data"
                            :key="index">
                            <td>{{ item.id }}</td>
                            <td>{{ item.Academic_Year }}</td>
                            <td>{{ item.Major }}</td>
                            <td>{{ item.Committee }}</td>
                            <td>{{ item.Department }}</td>
                            <td>{{ item.Subject }}</td>
                            <td>
                                <Link
                                    :href="route('thesisCommittee.edit', item.id)"
                                    class="btn btn-warning mr-2">Edit
                                </Link>
                                <button
                                    type="button"
                                    @click="onDelete(item.id)"
                                    class="btn btn-error">
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
                        v-for="link in thesisCommittees.links"
                        :href="link.url ?? '#'"
                        class="join-item btn"
                        :class="{ 'btn-info': link.active }">
                        <span v-html="link.label"></span>
                    </Link>
                </div>

            </div>
        </div>
    </App>
</template>
