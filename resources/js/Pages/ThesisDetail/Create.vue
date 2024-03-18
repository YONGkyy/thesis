<script setup lang="ts">
import App from '@/Layouts/App.vue';
import { useForm } from '@inertiajs/vue3';
import { ThesisDetailType } from "@/types/thesisDetail";
import { MoveLeft } from 'lucide-vue-next';
import Swal from 'sweetalert2'

const props = defineProps<{
    thesisDetail?: ThesisDetailType;
}>();
const form = useForm({
    Thesis_No: props.thesisDetail?.Thesis_No ?? "",
    Student_ID: props.thesisDetail?.Student_ID ?? "",
    Phone: props.thesisDetail?.Phone ?? "",
    Defend: props.thesisDetail?.Defend ?? "",
    Pass_State: props.thesisDetail?.Pass_State ?? "",
    Issue_Tem_Certificate: props.thesisDetail?.Issue_Tem_Certificate ?? "",
    other: props.thesisDetail?.other ?? "",
    hardwork: props.thesisDetail?.hardwork ?? "",
    charateristic: props.thesisDetail?.charateristic ?? "",
    remark: props.thesisDetail?.remark ?? "",
    result: props.thesisDetail?.result ?? "",

});
const onSave = () => {
    form.post(route("thesisDetail.store"), {
        onSuccess: () => {
            Swal.fire({
                icon: "success",
                title: "ThesisDetail has been saved.",
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
            <h2 class="text-2xl font-bold">Create a ThesisDetail</h2>
            <div class="mt-4">
                <div class="bg-base-100 p-2 rounded-xl">
                    <Link :href="route('thesisDetail.index')" class="btn btn-warning">
                    <MoveLeft class="w-5 h-5" />Back</Link>
                </div>
            </div>
            <div class='mt-4 p-4 bg-base-100 rounded-xl'>
                <form @submit.prevent="onSave">
                    <div class="flex flex-col gap-2 lg:flex-row">                    
                        <div class="flex flex-col w-full">
                            <label class="label">Thesis_No</label>
                            <input v-model="form.Thesis_No" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Thesis_No }" />
                            <div v-if="form.errors.Thesis_No" class="text-error">
                                {{ form.errors.Thesis_No }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Student_ID</label>
                            <input v-model="form.Student_ID" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Student_ID }" />
                            <div v-if="form.errors.Student_ID" class="text-error">
                                {{ form.errors.Student_ID }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Phone</label>
                            <input v-model="form.Phone" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Phone }" />
                            <div v-if="form.errors.Phone" class="text-error">
                                {{ form.errors.Phone }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Defend</label>
                            <input v-model="form.Defend" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Defend }" />
                            <div v-if="form.errors.Defend" class="text-error">
                                {{ form.errors.Defend }}
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 lg:flex-row">                        
                        <div class="flex flex-col w-full">
                            <label class="label">Pass_State</label>
                            <input v-model="form.Pass_State" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Pass_State }" />
                            <div v-if="form.errors.Pass_State" class="text-error">
                                {{ form.errors.Pass_State }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Issue_Tem_Certificate</label>
                            <input v-model="form.Issue_Tem_Certificate" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.Issue_Tem_Certificate }" />
                            <div v-if="form.errors.Issue_Tem_Certificate" class="text-error">
                                {{ form.errors.Issue_Tem_Certificate }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">other</label>
                            <input v-model="form.other" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.other }" />
                            <div v-if="form.errors.other" class="text-error">
                                {{ form.errors.other }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">hardwork</label>
                            <input v-model="form.hardwork" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.hardwork }" />
                            <div v-if="form.errors.hardwork" class="text-error">
                                {{ form.errors.hardwork }}
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 lg:flex-row">                    
                        <div class="flex flex-col w-full">
                            <label class="label">charateristic</label>
                            <input v-model="form.charateristic" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.charateristic }" />
                            <div v-if="form.errors.charateristic" class="text-error">
                                {{ form.errors.charateristic }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">remark</label>
                            <input v-model="form.remark" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.remark }" />
                            <div v-if="form.errors.remark" class="text-error">
                                {{ form.errors.remark }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">result</label>
                            <input v-model="form.result" class="input input-primary w-full"
                                :class="{ 'input-error': form.errors.result }" />
                            <div v-if="form.errors.result" class="text-error">
                                {{ form.errors.result }}
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