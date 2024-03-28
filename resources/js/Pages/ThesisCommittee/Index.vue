<script setup lang="ts">
import App from "@/Layouts/App.vue";
import { PaginateType } from "@/types/paginateType";
import { ThesisCommitteeType } from "@/types/thesisCommittee";
import { router, useForm } from "@inertiajs/vue3";
import { pickBy, throttle } from "lodash";
import Swal from "sweetalert2";
import { watch } from "vue";

const props = defineProps<{
    thesisCommittees: PaginateType<ThesisCommitteeType>
    filters?: {
        keyword: string;      
    };
}>();

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
            <div class="mb-2">
                <h2 class="text-2xl font-bold">ThesisCommittee Management</h2>
                <div class="mt-4">
                    <div class="bg-base-100 p-2 rounded-xl flex gap-2 items-center">
                        <Link :href="route('thesisCommittee.create')" class="btn btn-primary">New</Link>
                        <input 
                            v-model="filterForm.keyword"
                            type="text" 
                            placeholder="Search..." 
                            class="input input-primary w-full"/>

                        <button class="btn btn-warning" type="button" @click="onClearFilter">Clear</button>
                    </div>
                </div>
            </div>
            <div class="bg-base-100 rounded-xl overflow-x-auto">
                <table class="table table-lg">
                    <thead>
                        <tr>
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
                        :class="{ 'btn-primary': link.active }">
                        <span v-html="link.label"></span>
                    </Link>
                </div>
                
            </div>
        </div>
    </App>
</template>