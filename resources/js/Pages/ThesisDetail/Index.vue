<script setup lang="ts">
import App from "@/Layouts/App.vue";
import { ThesisDetailType } from "@/types/thesisDetail";
import {PaginateType} from "@/types/paginateType";
import { useForm, router } from "@inertiajs/vue3";
import { watch } from "vue";
import { throttle, pickBy } from "lodash";
import Swal from "sweetalert2";

const props = defineProps<{
    thesisDetails: PaginateType<ThesisDetailType>
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
        router.get(route("thesisDetail.index"), pickBy(filterForm.data()), {
            preserveState: true,
            only:["thesisDetails"],
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
            router.delete(route("thesisDetail.destroy", id), {
                onSuccess: () => {
                    Swal.fire({
                        icon: "success",
                        text: "Deleted successfully!",
                        title: "ThesisDetail has been deleted.",
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
                <h2 class="text-2xl font-bold">ThesisDetail Management</h2>
                <div class="mt-4">
                    <div class="bg-base-100 p-2 rounded-xl flex gap-2 items-center">
                        <Link :href="route('thesisDetail.create')" class="btn btn-primary">New</Link>
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
                            <th>Thesis_No</th>
                            <th>Student_ID</th>
                            <th>Phone</th>
                            <th>Defend</th>
                            <th>Pass_State</th>
                            <th>Issue_Tem_Certificate</th>
                            <th>Other</th>
                            <th>Hardwork</th>
                            <th>Charateristic</th>
                            <th>Remark</th>
                            <th>Result</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(item, index) in thesisDetails.data" 
                            :key="index">
                            <td>{{ item.id }}</td>
                            <td>{{ item.Thesis_No }}</td>
                            <td>{{ item.Student_ID }}</td>
                            <td>{{ item.Phone }}</td>
                            <td>{{ item.Defend }}</td>
                            <td>{{ item.Pass_State }}</td> 
                            <td>{{ item.Issue_Tem_Certificate}}</td>
                            <td>{{ item.Other}}</td>
                            <td>{{ item.Hardwork}}</td>
                            <td>{{ item.Charateristic}}</td>
                            <td>{{ item.Remark}}</td>
                            <td>{{ item.Result}}</td>
                            <td>
                                <Link 
                                    :href="route('thesisDetail.edit', item.id)"
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
                        v-for="link in thesisDetails.links" 
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