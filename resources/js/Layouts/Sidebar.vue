<script setup lang="ts">
import { useToggleSidebar } from "@/Stores/useToggleSidebar";
import TheSidebarItem from "@/Components/Layout/TheSidebarItem.vue";
// import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
// import { faMyIcon } from '@awesome.me/kit-KIT_CODE/icons/kit/custom';
// import { NotebookPen } from 'lucide-vue-next';


const sidebar = useToggleSidebar();
</script>
<template>
    <div class="flex print:hidden">
       

        <!-- Backdrop -->
        <div
            :class="sidebar.isOpen ? 'block' : 'hidden'"
            @click="sidebar.isOpen = false"
            class="fixed inset-0 z-40 transition-opacity bg-black opacity-50 lg:hidden"
        ></div>
        <!-- End Backdrop -->
        
        <div
            :class="
                sidebar.isOpen
                    ? 'translate-x-0 ease-out'
                    : '-translate-x-full ease-in'
            "
            class="fixed inset-y-0 left-0 z-50 overflow-y-auto transition transform bg-blue-700 w-60 dark:bg-blue-900 lg:translate-x-0 lg:static lg:inset-0"
        >
            <div class="flex items-center justify-center mt-8">
                <div class="flex items-center justify-center">
                    <div
                        class="mx-4 text-4xl font-semibold text-center text-white"
                    >
                        Norton University 
                </div>
            </div>
            </div>

            <div class="flex items-center justify-center mt-2">
                <div class="flex items-center justify-center">
                    <div
                        class="mx-2 text-md font-semibold text-center text-white"
                    >
                    <font-awesome-icon :icon="['fas', 'school']" />Thesis System Management
                </div>
            </div>
            </div>

            <nav class="mt-8">
               
                <TheSidebarItem
                    title="Dashboard"
                    :link="route('dashboard')"
                    :is-active="$page.component === 'Dashboard'"
                />
                
                <TheSidebarItem
                title="Thesis"
                :link="route('thesis.index')"
                :is-active="$page.component.startsWith('Thesis/')" 
               
                />
                
                <TheSidebarItem
                    title="ThesisAdvisor"
                    :link="route('thesisAdvisor.index')"
                    :is-active="$page.component.startsWith('ThesisAdvisor/')"
                />
                <TheSidebarItem
                    title="ThesisCommittee"
                    :link="route('thesisCommittee.index')"
                    :is-active="$page.component.startsWith('ThesisCommittee/')"
                />
                <TheSidebarItem
                    title="ThesisDetail"
                    :link="route('thesisDetail.index')"
                    :is-active="$page.component.startsWith('ThesisDetail/')"
                />         
            </nav>
        </div>
    </div>
</template>