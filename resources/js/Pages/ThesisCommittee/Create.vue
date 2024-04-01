<script setup lang="ts">
import App from "@/Layouts/App.vue";
import { ThesisCommitteeType } from "@/types/thesisCommittee";
import {PaginateType} from "@/types/paginateType";
import { useForm, router } from "@inertiajs/vue3";
import Swal from "sweetalert2";



const props = defineProps<{
    thesisCommittee?: ThesisCommitteeType
    thesisCommittees: PaginateType<ThesisCommitteeType>
    filters?: {
        keyword: string;
    }
}>();

const form = useForm({
    id: props.thesisCommittee?.id ?? "",
    Academic_Year: props.thesisCommittee?.Academic_Year ?? "",
    Major: props.thesisCommittee?.Major ?? "",
    Committee: props.thesisCommittee?.Committee ?? "",
    Department: props.thesisCommittee?.Department ?? "",
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
</script>

<template>

    <App>
        <div class="p-3">
            <h2 class="text-2xl font-bold">Create a ThesisCommittee</h2>
            <div class="mt-4">
                <div class="bg-base-100 p-2 rounded-xl">
                    <Link :href="route('thesisCommittee.index')" class="btn btn-warning">
                    <MoveLeft class="w-5 h-5" />Back</Link>
                </div>
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
                            <label class="label">Academic_Year</label>
                            <input v-model="form.Academic_Year" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Academic_Year }" />
                            <div v-if="form.errors.Academic_Year" class="text-error">
                                {{ form.errors.Academic_Year }}

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
                            <label class="label">Department</label>
                            <input v-model="form.Department" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Department }" />
                            <div v-if="form.errors.Department" class="text-error">
                                {{ form.errors.Department }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Subject</label>
                            <input v-model="form.Subject" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Subject }" />
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
    </App>

</template>




