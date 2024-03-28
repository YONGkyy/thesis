<script setup lang="ts">
import App from '@/Layouts/App.vue';
import { useForm } from '@inertiajs/vue3';
import { ThesisAdvisorType } from "@/types/thesisAdvisor";
import { MoveLeft } from 'lucide-vue-next';
import Swal from 'sweetalert2'

const props = defineProps<{
    thesisAdvisor?: ThesisAdvisorType;
}>();
const form = useForm({
    id: props.thesisAdvisor?.id ?? "",
    Academic_Year: props.thesisAdvisor?.Academic_Year ?? "",
    Advisor: props.thesisAdvisor?.Advisor ?? "",
    College: props.thesisAdvisor?.College ?? "",
    Department: props.thesisAdvisor?.Department ?? "",
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
</script>
<template>
    <App>
        <div class="p-3">
            <h2 class="text-2xl font-bold">Create a ThesisAdvisor</h2>
            <div class="mt-4">
                <div class="bg-base-100 p-2 rounded-xl">
                    <Link :href="route('thesisAdvisor.index')" class="btn btn-warning">
                    <MoveLeft class="w-5 h-5" />Back</Link>
                </div>
            </div>
            <div class='mt-4 p-4 bg-base-100 rounded-xl'>
                <form @submit.prevent="onSave">
                    <div class="flex flex-col gap-2 lg:flex-row">

                        <div class="flex flex-col w-full">
                            <label class="label">Academic_Year</label>
                            <input v-model="form.Academic_Year" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Academic_Year }" />
                            <div v-if="form.errors.Academic_Year" class="text-error">
                                {{ form.errors.Academic_Year }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Advisor</label>
                            <input v-model="form.Advisor" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Advisor }" />
                            <div v-if="form.errors.Advisor" class="text-error">
                                {{ form.errors.Advisor }}
                            </div>
                        </div>

                        <div class="flex flex-col w-full">
                            <label class="label">College</label>
                            <input v-model="form.College" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.College }" />
                            <div v-if="form.errors.College" class="text-error">
                                {{ form.errors.College }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Department</label>
                            <input v-model="form.Department" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Department }" />
                            <div v-if="form.errors.Department" class="text-error">
                                {{ form.errors.Department }}
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