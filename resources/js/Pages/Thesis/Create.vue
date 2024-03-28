<script setup lang="ts">
import App from '@/Layouts/App.vue';
import { useForm } from '@inertiajs/vue3';
import { ThesisType } from "@/types/thesisType";
import { MoveLeft } from 'lucide-vue-next';
import Swal from 'sweetalert2'

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
            <h2 class="text-2xl font-bold">Create The Thesis</h2>
            <div class="mt-4">
                <div class="bg-base-100 p-2 rounded-xl">
                    <Link :href="route('thesis.index')" class="btn btn-warning">
                    <MoveLeft class="w-5 h-5" />Back</Link>
                </div>
            </div>

            <div class='mt-4 p-4 bg-base-100 rounded-xl'>
                <h2 class="text-2xl font-bold">Thesis Information</h2>
                <form @submit.prevent="onSave">
                    <div class="flex flex-col gap-2 lg:flex-row">


                        <div class="flex flex-col w-full">
<<<<<<< HEAD
                            <!-- <label class="label">ID</label> -->
                            <input v-model="form.N" placeholder="ID"  
                            class="input input-info w-full"
                                :class="{ 'input-error': form.errors.N }" />
                            <div v-if="form.errors.N" class="text-error">
                                {{ form.errors.N }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <!-- <label class="label">Thesis No</label> -->
                            <input v-model="form.Thesis_No" placeholder="Thesis No"  
                            class="input input-info w-full"
=======
                            <label class="label">Thesis_No</label>
                            <input v-model="form.Thesis_No" class="input input-primary w-full"
>>>>>>> yong
                                :class="{ 'input-error': form.errors.Thesis_No }" />
                            <div v-if="form.errors.Thesis_No" class="text-error">
                                {{ form.errors.Thesis_No }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <!-- <label class="label">Thesis Group</label> -->
                            <input v-model="form.Thesis_Group" placeholder="Thesis Group"  
                            class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Thesis_Group }" />
                            <div v-if="form.errors.Thesis_Group" class="text-error">
                                {{ form.errors.Thesis_Group }}
                            </div>
                        </div>
                        </div>
                   </form>
            </div>

            <div class='mt-4 p-4 bg-base-100 rounded-xl'>
                <h2 class="text-2xl font-bold">Student Information</h2>
                <form @submit.prevent="onSave">
                   
                    <div class="flex flex-col gap-2 lg:flex-row">
                        <div class="flex flex-col w-full">
                            <div class="mt-2">
                            <!-- <label class="label">Academic Year</label> -->
                            <input v-model="form.Academic_Year" placeholder="Academic Year"  
                            class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Academic_Year }" />
                            </div>
                            <div v-if="form.errors.Academic_Year" class="text-error">
                                {{ form.errors.Academic_Year }}
                            </div>
                        </div>
                  

                   
                        <div class="flex flex-col w-full">
                            <!-- <label class="label">Department</label> -->
                            <div class="mt-2">
                                <input v-model="form.Department" placeholder="Department"  
                                 class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Department}" />
                        </div>
                            <div v-if="form.errors.Department" class="text-error">
                                {{ form.errors.Department }}
                            </div>
                      
                        </div>   
                   
                    


                        <div class="flex flex-col w-full">
                            <!-- <label class="label">Major</label> -->
                            <div class="mt-2">
                                <input v-model="form.Major" placeholder="Major"  
                            class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Major }" />
                          </div>
                            <div v-if="form.errors.Major" class="text-error">
                                {{ form.errors.Major }}
                            </div>
                        </div>
                                  
                    </div>
                    <div class="flex flex-col gap-2 lg:flex-row">
                        <div class="flex flex-col w-full">
                            <div class="mt-2">
                            <!-- <label class="label">Year</label> -->
                            <input v-model="form.Year" placeholder="Year"  
                            class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Year }" />
                            </div>
                            <div v-if="form.errors.Year" class="text-error">
                                {{ form.errors.Year }}
                            </div>
                        </div>
                    
                   
                        <div class="flex flex-col w-full">
                            <!-- <label class="label">Batch</label> -->
                            <div class="mt-2">
                                <input v-model="form.Batch" placeholder="Batch"  
                            class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Batch }" />
                            </div>
                            <div v-if="form.errors.Batch" class="text-error">
                                {{ form.errors.Batch }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <div class="mt-2">
                            <!-- <label class="label">Session</label> -->
                            <select className="select select-info w-full max-w-xs">
                                <option disabled selected>Select Session</option>
                                <option>Morning</option>
                                <option>Afternoon</option>
                                <option>Evening</option>
                                </select>
                                </div>
                            <div v-if="form.errors.Session" class="text-error">
                                {{ form.errors.Session }}
                            </div>
                        </div>
                   </div>
               
          
                    </form>
              </div>

              
            <div class='mt-4 p-4 bg-base-100 rounded-xl'>
                <h2 class="text-2xl font-bold">Organizaition Information</h2>
                <form @submit.prevent="onSave">

                        <div class="flex flex-col w-full">
                            <label class="label">Organizaition</label>
                            <textarea className="textarea textarea-info" placeholder=""></textarea>
                            <div v-if="form.errors.Organizaition" class="text-error">
                                {{ form.errors.Organizaition }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Organization Type</label>
                            <textarea className="textarea textarea-info" placeholder=""></textarea>
                            <div v-if="form.errors.Organization_Type" class="text-error">
                                {{ form.errors.Organization_Type }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Organization Phone</label>
                            <textarea className="textarea textarea-info" placeholder=""></textarea>
                            <div v-if="form.errors.Organization_Phone" class="text-error">
                                {{ form.errors.Organization_Phone }}
                            </div>
                        </div>  
                        <div class="flex flex-col w-full">
                            <label class="label">Organization Location</label>
                            <textarea className="textarea textarea-info" placeholder=""></textarea>
                            <div v-if="form.errors.Location" class="text-error">
                                {{ form.errors.Location }}
                            </div>
                        </div>
                    </form> 
                 </div>
                </div>


             <div class="p-3">
              <div class='mt-4 p-4 bg-base-100 rounded-xl'>
                  <h2 class="text-2xl font-bold">Topic Information</h2>
                    <form @submit.prevent="onSave">
                        
                        <div class="flex flex-col w-full">
                            <label class="label">Title in English</label>
                            <textarea className="textarea textarea-info" placeholder=""></textarea>
                            <div v-if="form.errors.Title" class="text-error">
                                {{ form.errors.Title }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Title in Khmer</label>
                            <textarea className="textarea textarea-info" placeholder=""></textarea>
                            <div v-if="form.errors.Title_Khmer" class="text-error">
                                {{ form.errors.Title_Khmer }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Objective in English</label>
                            <textarea className="textarea textarea-info" placeholder=""></textarea>
                            <div v-if="form.errors.Objective" class="text-error">
                                {{ form.errors.Objective }}
                            </div>
                        </div>
              
                        <div class="flex flex-col w-full">
                            <label class="label">Objective in Khmer</label>
                            <textarea className="textarea textarea-info" placeholder=""></textarea>
                            <div v-if="form.errors.Objective_Khmer" class="text-error">
                                {{ form.errors.Objective_Khmer }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label class="label">Summary</label>
                            <textarea className="textarea textarea-info" placeholder=""></textarea>
                            <div v-if="form.errors.Summary" class="text-error">
                                {{ form.errors.Summary }}
                            </div>
                        </div>    
                    </form>
                 </div> 
             </div> 


            <div class="p-3">
              <div class='mt-4 p-4 bg-base-100 rounded-xl'>
                  <h2 class="text-2xl font-bold">Submitted</h2>
                    <form @submit.prevent="onSave">

                        <div class="flex flex-col gap-2 lg:flex-row">
                        <div class="flex flex-col w-full">
                            <div class="mt-2">
                            <!-- <label class="label">Teacher Name</label> -->
                            <input v-model="form.Teacher_id" placeholder="Teacher Name"  
                            class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Teacher_id }" />
                            </div>
                            <div v-if="form.errors.Teacher_id" class="text-error">
                                {{ form.errors.Teacher_id }}
                            </div>
                        </div>

                        <div class="flex flex-col w-full">
                            <div class="mt-2">
                            <!-- <label class="label">Submit Date</label> -->
                            <input v-model="form.Submit_Date" placeholder="Submit Date"  
                            class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Submit_Date }" />
                            </div>
                            <div v-if="form.errors.Submit_Date" class="text-error">
                                {{ form.errors.Submit_Date }}
                            </div>
                        </div>

                        <div class="flex flex-col w-full">
                            <div class="mt-2">
                            <!-- <label class="label">Defend Date</label> -->
                            <input v-model="form.Defend_Date" placeholder="Defend Date"  
                            class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Defend_Date }" />
                            </div>
                            <div v-if="form.errors.Defend_Date" class="text-error">
                                {{ form.errors.Defend_Date }}
                            </div>
                        </div>
                    
                        <div class="flex flex-col w-full">
                            <!-- <label class="label">Defend time</label> -->
                            <div class="mt-2">
                                <input v-model="form.Defend_time" placeholder="Defend Time"  
                            class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Defend_time }" />
                            </div>
                            <div v-if="form.errors.Defend_time" class="text-error">
                                {{ form.errors.Defend_time }}
                            </div>
                        </div>
                        </div>

                        <div class="flex flex-col gap-2 lg:flex-row">
                        <div class="flex flex-col w-full">
                            <div class="mt-2">
                            <!-- <label class="label">Book Score</label> -->
                            <input v-model="form.Book_Score" placeholder="Book Score"  
                            class="input input-info w-full"
                                :class="{ 'input-error': form.Book_Score }" />
                            </div>
                            <div v-if="form.errors.Book_Score" class="text-error">
                                {{ form.errors.Book_Score }}
                            </div>
                        </div>

                        <div class="flex flex-col w-full">
                            <!-- <label class="label">Submit Book</label> -->
                            <div class="mt-2">
                                <input v-model="form.Submit_book" placeholder="Submit Book"  
                            class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Submit_book }" />
                            </div>
                            <div v-if="form.errors.Submit_book" class="text-error">
                                {{ form.errors.Submit_book }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <!-- <label class="label">Building</label> -->
                            <div class="mt-2">
                                <select className="select select-info w-full max-w-xs">
                                <option disabled selected>Select Building</option>
                                <option>G</option>
                                <option>H</option>
                                <option>L</option>
                                </select>
                            </div>
                            <div v-if="form.errors.Building" class="text-error">
                                {{ form.errors.Building }}
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <!-- <label class="label">Room</label> -->
                            <div class="mt-2">
                                <input v-model="form.Room" placeholder="Room"  
                            class="input input-info w-full"
                                :class="{ 'input-error': form.errors.Room }" />
                            </div>
                            <div v-if="form.errors.Room" class="text-error">
                                {{ form.errors.Room }}
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