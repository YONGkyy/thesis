<script setup lang="ts">
import App from "@/Layouts/App.vue";
import { PaginateType } from "@/types/paginateType";
import { ThesisType } from "@/types/thesisType";
import { router, useForm } from "@inertiajs/vue3";
import { pickBy, throttle } from "lodash";
import Swal from "sweetalert2";
import { watch } from "vue";

const props = defineProps<{
    thesises: PaginateType<ThesisType>
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
        router.get(route("thesis.index"), pickBy(filterForm.data()), {
            preserveState: true,
            only:["thesises"],
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
            router.delete(route("thesis.destroy", id), {
                onSuccess: () => {
                    Swal.fire({
                        icon: "success",
                        text: "Deleted successfully!",
                        title: "thesis has been deleted.",
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
                <h2 class="text-2xl font-bold">Thesis Management</h2>
                <div class="mt-4">
                    <div class="bg-base-100 p-2 rounded-xl flex gap-2 items-center">
                        <Link :href="route('thesis.create')" class="btn btn-info">New</Link>
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
                <table class="table table-lg ">
                    <thead class="bg-blue-800 text-white">
                        <tr>
                            <th>ID</th>
<<<<<<< HEAD
                            <th>Thesis No</th>
                            <th>Thesis Group</th>
                            <!-- <th>Academic Year</th>
=======
                            <th>Thesis_No</th>
                            <th>Thesis_Group</th>
                            <th>Academic_Year</th>
>>>>>>> yong
                            <th>Department</th>
                            <th>Major</th>
                            <th>Year</th>
                            <th>Batch</th>
<<<<<<< HEAD
                            <th>Session</th> -->
                            <th>Organizaition</th>
                            <!-- <th>Organization Type</th>
                            <th>Organization Location</th>
                            <th>Organization Phone</th> -->
=======
                            <th>Session</th>
                            <!-- <th>Organizaition</th>
                            <th>Organization_Type</th>
                            <th>Location</th>
                            <th>Organization_Phone</th>
>>>>>>> yong
                            <th>Title</th>
                            <!-- <th>Title Khmer</th>
                            <th>Objective</th>
                            <th>Objective Khmer</th> -->
                            <th>Summary</th>
<<<<<<< HEAD
                            <th>Submit Date</th>
                            <th>Teacher id</th>
                            <!-- <th>Defend Date</th>
                            <th>Book Score</th>
                            <th>Defend time</th>
                            <th>Submit book</th> -->
=======
                            <th>Submit_Date</th> -->
                            <th>Teacher_id</th>
                            <!-- <th>Defend_Date</th> -->
                            <th>Book_Score</th>
                            <!-- <th>Defend_time</th>
                            <th>Submit_book</th>
>>>>>>> yong
                            <th>Building</th>
                            <th>Room</th> -->
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(item, index) in thesises.data" 
                            :key="index">  
                            <td>{{ item.id }}</td>                 
                            <td>{{ item.Thesis_No }}</td>
                            <td>{{ item.Thesis_Group }}</td>
                            <!-- <td>{{ item.Academic_Year }}</td>
                            <td>{{ item.Department }}</td>
                            <td>{{ item.Major }}</td>
                            <td>{{ item.Year }}</td>
                            <td>{{ item.Batch }}</td>
<<<<<<< HEAD
                            <td>{{ item.Session }}</td> -->
                            <td>{{ item.Organizaition }}</td>
                            <!-- <td>{{ item.Organization_Type }}</td>
=======
                            <td>{{ item.Session }}</td>
                            <!-- <td>{{ item.Organizaition }}</td>
                            <td>{{ item.Organization_Type }}</td>
>>>>>>> yong
                            <td>{{ item.Location }}</td>
                            <td>{{ item.Organization_Phone }}</td> -->
                            <td>{{ item.Title }}</td>
                            <!-- <td>{{ item.Title_Khmer }}</td>
                            <td>{{ item.Objective }}</td>
<<<<<<< HEAD
                            <td>{{ item.Objective_Khmer }}</td>-->
                            <td>{{ item.Summary }}</td> 
                            <td>{{ item.Submit_Date }}</td>
                            <td>{{ item.Teacher_id }}</td>
                            <!-- <td>{{ item.Defend_Date }}</td>
                            <td>{{ item.Book_Score }}</td>
                            <td>{{ item.Defend_time }}</td>
                            <td>{{ item.Submit_book }}</td> -->
=======
                            <td>{{ item.Objective_Khmer }}</td>
                            <td>{{ item.Summary }}</td>
                            <td>{{ item.Submit_Date }}</td> -->
                            <td>{{ item.Teacher_id }}</td>
                            <!-- <td>{{ item.Defend_Date }}</td> -->
                            <td>{{ item.Book_Score }}</td>
                            <!-- <td>{{ item.Defend_time }}</td>
                            <td>{{ item.Submit_book }}</td>
>>>>>>> yong
                            <td>{{ item.Building }}</td>
                            <td>{{ item.Room }}</td>  -->                         
                            <td>
                                <Link 
                                    :href="route('thesis.edit', item.id)"
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
                        v-for="link in thesises.links" 
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


