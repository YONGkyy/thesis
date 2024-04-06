<script setup lang="ts">
import App from "@/Layouts/App.vue";
import { useForm } from "@inertiajs/vue3";
import { ThesisType } from "@/types/thesisType";
import { MoveLeft } from "lucide-vue-next";
import Swal from "sweetalert2";

const props = defineProps<{
    thesis?: ThesisType;
}>();
const form = useForm({
    id: props.thesis?.id ?? "",
    Thesis_No: props.thesis?.Thesis_No ?? "",
    Thesis_Group: props.thesis?.Thesis_Group ?? "",
    Academic_Year: props.thesis?.Academic_Year ?? "",
    Department: props.thesis?.Department ?? "",
    Major: props.thesis?.Major ?? "",
    Year: props.thesis?.Year ?? "",
    Batch: props.thesis?.Batch ?? "",
    Session: props.thesis?.Session ?? "",
    Organizaition: props.thesis?.Organizaition ?? "",
    Organization_Type: props.thesis?.Organization_Type ?? "",
    Location: props.thesis?.Location ?? "",
    Organization_Phone: props.thesis?.Organization_Phone ?? "",
    Title: props.thesis?.Title ?? "",
    Title_Khmer: props.thesis?.Title_Khmer ?? "",
    Objective: props.thesis?.Objective ?? "",
    Objective_Khmer: props.thesis?.Objective_Khmer ?? "",
    Summary: props.thesis?.Summary ?? "",
    Submit_Date: props.thesis?.Submit_Date ?? "",
    Teacher_id: props.thesis?.Teacher_id ?? "",
    Defend_Date: props.thesis?.Defend_Date ?? "",
    Book_Score: props.thesis?.Book_Score ?? "",
    Defend_time: props.thesis?.Defend_time ?? "",
    Submit_book: props.thesis?.Submit_book ?? "",
    Building: props.thesis?.Building ?? "",
    Room: props.thesis?.Room ?? "",
});
const onSave = () => {
    form.post(route("thesis.store"), {
        onSuccess: () => {
            Swal.fire({
                icon: "success",
                title: "Thesis has been saved.",
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
            <h2 class="text-2xl font-bold">Create a Thesis</h2>
            <div class="mt-4">
                <div class="bg-base-100 p-2 rounded-xl">
                    <Link :href="route('thesis.index')" class="btn btn-warning">
                        <MoveLeft class="w-5 h-5" />Back</Link
                    >
                </div>
            </div>
            <div class="mt-4 p-4 bg-base-100 rounded-xl">
                <form @submit.prevent="onSave">
                    <div class="flex flex-col gap-2 lg:flex-row">
                        <div class="flex flex-col w-full">
                            <label class="label">Thesis_No</label>
                            <input
                                v-model="form.Thesis_No"
                                class="input input-primary w-full"
                                :class="{
                                    'input-error': form.errors.Thesis_No,
                                }"
                            />
                            <div
                                v-if="form.errors.Thesis_No"
                                class="text-error"
                            >
                                {{ form.errors.Thesis_No }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Thesis_Group</label>
                            <input
                                v-model="form.Thesis_Group"
                                class="input input-primary w-full"
                                :class="{
                                    'input-error': form.errors.Thesis_Group,
                                }"
                            />
                            <div
                                v-if="form.errors.Thesis_Group"
                                class="text-error"
                            >
                                {{ form.errors.Thesis_Group }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Academic_Year</label>
                            <input
                                v-model="form.Academic_Year"
                                class="input input-primary w-full"
                                :class="{
                                    'input-error': form.errors.Academic_Year,
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
                            <label class="label">Department</label>
                            <input
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
                        <div class="flex flex-col w-full">
                            <label class="label">Major</label>
                            <input
                                v-model="form.Major"
                                class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Major }"
                            />
                            <div v-if="form.errors.Major" class="text-error">
                                {{ form.errors.Major }}
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 lg:flex-row">
                        <div class="flex flex-col w-full">
                            <label class="label">Year</label>
                            <input
                                v-model="form.Year"
                                class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Year }"
                            />
                            <div v-if="form.errors.Year" class="text-error">
                                {{ form.errors.Year }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Batch</label>
                            <input
                                v-model="form.Batch"
                                class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Batch }"
                            />
                            <div v-if="form.errors.Batch" class="text-error">
                                {{ form.errors.Batch }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Session</label>
                            <input
                                v-model="form.Session"
                                class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Session }"
                            />
                            <div v-if="form.errors.Session" class="text-error">
                                {{ form.errors.Session }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Organizaition</label>
                            <input
                                v-model="form.Organizaition"
                                class="input input-primary w-full"
                                :class="{
                                    'input-error': form.errors.Organizaition,
                                }"
                            />
                            <div
                                v-if="form.errors.Organizaition"
                                class="text-error"
                            >
                                {{ form.errors.Organizaition }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Organization_Type</label>
                            <input
                                v-model="form.Organization_Type"
                                class="input input-primary w-full"
                                :class="{
                                    'input-error':
                                        form.errors.Organization_Type,
                                }"
                            />
                            <div
                                v-if="form.errors.Organization_Type"
                                class="text-error"
                            >
                                {{ form.errors.Organization_Type }}
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 lg:flex-row">
                        <div class="flex flex-col w-full">
                            <label class="label">Location</label>
                            <input
                                v-model="form.Location"
                                class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Location }"
                            />
                            <div v-if="form.errors.Location" class="text-error">
                                {{ form.errors.Location }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Organization_Phone</label>
                            <input
                                v-model="form.Organization_Phone"
                                class="input input-primary w-full"
                                :class="{
                                    'input-error':
                                        form.errors.Organization_Phone,
                                }"
                            />
                            <div
                                v-if="form.errors.Organization_Phone"
                                class="text-error"
                            >
                                {{ form.errors.Organization_Phone }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Title</label>
                            <input
                                v-model="form.Title"
                                class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Title }"
                            />
                            <div v-if="form.errors.Title" class="text-error">
                                {{ form.errors.Title }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Title_Khmer</label>
                            <input
                                v-model="form.Title_Khmer"
                                class="input input-primary w-full"
                                :class="{
                                    'input-error': form.errors.Title_Khmer,
                                }"
                            />
                            <div
                                v-if="form.errors.Title_Khmer"
                                class="text-error"
                            >
                                {{ form.errors.Title_Khmer }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Objective</label>
                            <input
                                v-model="form.Objective"
                                class="input input-primary w-full"
                                :class="{
                                    'input-error': form.errors.Objective,
                                }"
                            />
                            <div
                                v-if="form.errors.Objective"
                                class="text-error"
                            >
                                {{ form.errors.Objective }}
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 lg:flex-row">
                        <div class="flex flex-col w-full">
                            <label class="label">Objective_Khmer</label>
                            <input
                                v-model="form.Objective_Khmer"
                                class="input input-primary w-full"
                                :class="{
                                    'input-error': form.errors.Objective_Khmer,
                                }"
                            />
                            <div
                                v-if="form.errors.Objective_Khmer"
                                class="text-error"
                            >
                                {{ form.errors.Objective_Khmer }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Summary</label>
                            <input
                                v-model="form.Summary"
                                class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Summary }"
                            />
                            <div v-if="form.errors.Summary" class="text-error">
                                {{ form.errors.Summary }}
                            </div>
                        </div>

                        <div class="flex flex-col w-full">
                            <label class="label">Submit_Date</label>
                            <input
                                v-model="form.Submit_Date"
                                class="input input-primary w-full"
                                :class="{
                                    'input-error': form.errors.Submit_Date,
                                }"
                            />
                            <div
                                v-if="form.errors.Submit_Date"
                                class="text-error"
                            >
                                {{ form.errors.Submit_Date }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Teacher_id</label>
                            <input
                                v-model="form.Teacher_id"
                                class="input input-primary w-full"
                                :class="{
                                    'input-error': form.errors.Teacher_id,
                                }"
                            />
                            <div
                                v-if="form.errors.Teacher_id"
                                class="text-error"
                            >
                                {{ form.errors.Teacher_id }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Defend_Date</label>
                            <input
                                v-model="form.Defend_Date"
                                class="input input-primary w-full"
                                :class="{
                                    'input-error': form.errors.Defend_Date,
                                }"
                            />
                            <div
                                v-if="form.errors.Defend_Date"
                                class="text-error"
                            >
                                {{ form.errors.Defend_Date }}
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 lg:flex-row">
                        <div class="flex flex-col w-full">
                            <label class="label">Book_Score</label>
                            <input
                                v-model="form.Book_Score"
                                class="input input-primary w-full"
                                :class="{
                                    'input-error': form.errors.Book_Score,
                                }"
                            />
                            <div
                                v-if="form.errors.Book_Score"
                                class="text-error"
                            >
                                {{ form.errors.Book_Score }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Defend_time</label>
                            <input
                                v-model="form.Defend_time"
                                class="input input-primary w-full"
                                :class="{
                                    'input-error': form.errors.Defend_time,
                                }"
                            />
                            <div
                                v-if="form.errors.Defend_time"
                                class="text-error"
                            >
                                {{ form.errors.Defend_time }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Submit_book</label>
                            <input
                                v-model="form.Submit_book"
                                class="input input-primary w-full"
                                :class="{
                                    'input-error': form.errors.Submit_book,
                                }"
                            />
                            <div
                                v-if="form.errors.Submit_book"
                                class="text-error"
                            >
                                {{ form.errors.Submit_book }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Building</label>
                            <input
                                v-model="form.Building"
                                class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Building }"
                            />
                            <div v-if="form.errors.Building" class="text-error">
                                {{ form.errors.Building }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Room</label>
                            <input
                                v-model="form.Room"
                                class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Room }"
                            />
                            <div v-if="form.errors.Room" class="text-error">
                                {{ form.errors.Room }}
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
    </App>
</template>
