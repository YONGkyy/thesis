<script setup lang="ts">
import App from "@/Layouts/App.vue";
import { ThesisAdvisorType } from "@/types/thesisAdvisor";
import {PaginateType} from "@/types/paginateType";
import { useForm, router } from "@inertiajs/vue3";
import { watch } from "vue";
import { throttle, pickBy } from "lodash";
import Swal from "sweetalert2";

const props = defineProps<{
    thesisAdvisor?: ThesisAdvisorType
    thesisAdvisors: PaginateType<ThesisAdvisorType>
    filters?: {
        keyword: string;
    };
}>();

const form = useForm({
    Academic_year: props.thesisAdvisor?.Academic_year ?? "",
    n: props.thesisAdvisor?.n ?? "",
    College: props.thesisAdvisor?.College ?? "",
    Department: props.thesisAdvisor?.Department ?? "",
    Advisor: props.thesisAdvisor?.Advisor ?? "",
});
const onSave = () => {
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
            only:["thesisAdvisors"],
            replace: true,
        });
    }, 500),
);

const onClearFilter = () => {
    filterForm.keyword = "";
};

const onDelete = async (Academic_year: string) => {
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
            router.delete(route("thesisAdvisor.destroy", Academic_year), {
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
</script>
<template>
     <App>
        <div class="p-3">
            <h2 class="text-2xl font-bold">Create a ThesisAdvisor</h2>
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
                            <!-- <input v-model="form.Academic_year" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Academic_year }" /> -->
                            <div v-if="form.errors.Academic_year" class="text-error">
                                {{ form.errors.Academic_year }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <!-- <label class="label">ID</label> -->
                            <input 
                            type="text" 
                            placeholder="ID" 
                            className="input input-bordered input-info w-full max-w-xs" />
                            <!-- <input v-model="form.n" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.n }" /> -->
                            <div v-if="form.errors.n" class="text-error">
                                {{ form.errors.n }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <!-- <label class="label">College</label> -->
                            <input 
                            type="text" 
                            placeholder="College" 
                            className="input input-bordered input-info w-full max-w-xs" />
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
                            placeholder="Department" 
                            className="input input-bordered input-info w-full max-w-xs" />
                            <!-- <input v-model="form.Department" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Department }" /> -->
                            <div v-if="form.errors.Department" class="text-error">
                                {{ form.errors.Department }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <!-- <label class="label">Advisor</label> -->
                            <input 
                            type="text" 
                            placeholder="Advisor" 
                            className="input input-bordered input-info w-full max-w-xs" />
                            <!-- <input v-model="form.Advisor" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Advisor }" /> -->
                            <div v-if="form.errors.Advisor" class="text-error">
                                {{ form.errors.Advisor }}
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
                <h2 class="text-2xl font-bold">ThesisAdvisor Management</h2>
                <div class="mt-4">
                    <div class="bg-base-100 p-2 rounded-xl flex gap-2 items-center">
                        <Link :href="route('thesisAdvisor.create')" class="btn btn-primary">New</Link>
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
                            <th>ID</th>
                            <th>College</th>
                            <th>Department</th>
                            <th>Advisor</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(item, index) in thesisAdvisors.data" 
                            :key="index">
                            <td>{{ item.Academic_year }}</td>
                            <td>{{ item.n }}</td>
                            <td>{{ item.College }}</td>
                            <td>{{ item.Department }}</td>
                            <td>{{ item.Advisor }}</td>                          
                            <td>
                                <Link 
                                    :href="route('thesisAdvisor.edit', item.Academic_year)"
                                    class="btn btn-warning mr-2">Edit
                                </Link>
                                <button 
                                    type="button"
                                    @click="onDelete(item.Academic_year)"
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
                        v-for="link in thesisAdvisors.links" 
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