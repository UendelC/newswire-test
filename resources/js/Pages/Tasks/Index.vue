<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useTask } from '@/Composables/task';
import { router, Link } from '@inertiajs/vue3'
import { ref } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import DropdownItem from '@/Components/DropdownItem.vue';
import Badge from '@/Components/Badge.vue';

const props = defineProps({
    tasks: {
        type: Object,
        required: true,
    },
    hasSearch: {
        type: Boolean,
        required: true,
    },
})

const searchQuery = ref('');

const { formatStatus, trimmedDescription, statusColor } = useTask();
const { takeOn, deleteTask, markAsCompleted, isTaskCompleted, showTaskDetails } = useTask();

</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center">Task Manager</h2>
            <div class="bg-green-500"></div>
            <div class="bg-yellow-500"></div>
        </template>

        <section class="max-w-7xl mx-auto sm:px-6 lg:px-4 py-4 my-4">
            <section class="shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                <div class="container mx-auto p-4 bg-white rounded shadow-md">
                    <div class="flex justify-between mb-8">
                        <div class="flex justify-between gap-1">
                            <input
                            v-model="searchQuery"
                            type="search"
                            class="w-2/3 px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500"
                            placeholder="Search Tasks"
                            @keydown.enter="() => $inertia.visit(`/tasks?search=${searchQuery}`)"
                            >
                            <Link :href="`/tasks?search=${searchQuery}`" class="bg-white border-2 border-blue-500 py-2 px-3 text-blue-400 hover:bg-blue-500 font-semibold hover:text-white rounded-md w-16 flex justify-center items-center">Search</Link>
                        </div>
                        <Link href="tasks/create" class="bg-blue-500 py-3 px-2 text-white hover:bg-blue-700 rounded-md w-16 flex justify-center items-center">Create</Link>
                    </div>

                    <table class="w-full rounded-md border border-gray-200">
                        <thead>
                            <tr class="text-gray-700 bg-gray-100">
                            <th class="px-4 py-3 text-left">Name</th>
                            <th class="px-4 py-3 text-left">Description</th>
                            <th class="px-4 py-3 text-center">Status</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="task in tasks.data" :key="task.id">
                                <td class="px-4 py-3 text-left w-1/6">{{ task.name }}</td>
                                <td class="px-4 py-3 text-left w-3/6">{{ trimmedDescription(task) }}</td>
                                <td class="px-4 py-3 text-center w-1/6">
                                    <Badge :color="statusColor(task)">{{ formatStatus(task) }}</Badge>
                                </td>
                                <td class="px-4 py-3 text-center w-1/6">
                                    <Dropdown>
                                        <template #trigger>
                                            <div class="cursor-pointer bg-gray-300 rounded-md hover:bg-gray-400 mx-3">More</div>
                                        </template>

                                        <template #content>
                                            <DropdownLink :href="showTaskDetails(task)" >Details</DropdownLink>
                                            <DropdownLink :href="route('tasks.edit', task.id)">Edit</DropdownLink>
                                            <DropdownItem @click="takeOn(task)">Take On</DropdownItem>
                                            <DropdownItem @click="markAsCompleted(task)">Mark as Completed</DropdownItem>
                                            <DropdownItem @click="deleteTask(task)">Delete</DropdownItem>
                                        </template>
                                    </Dropdown>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div v-if="hasSearch && tasks.total === 0">
                        <p class="text-center mt-8">No tasks found</p>
                    </div>
                    <div v-if="!hasSearch && tasks.total === 0" class="flex flex-col items-center">
                        <p class="text-center mt-8">No tasks available</p>
                        <Link href="tasks/create" class="bg-blue-500 py-3 px-2 text-white hover:bg-blue-700 rounded-md flex justify-center items-center w-fit mt-2">Create one now!</Link>
                    </div>
                    <div class="mt-3 flex justify-between" v-if="tasks.total > 15">
                        <span>Showing {{ tasks.from }} to {{ tasks.to }} of {{ tasks.total }} tasks</span>
                        <div class="flex gap-2">
                            <Link :href="tasks.first_page_url" class="bg-gray-300 rounded px-1.5 py-1 hover:bg-gray-400 text-white">First</Link>
                            <Link :href="tasks.prev_page_url" class="bg-gray-300 rounded px-1.5 py-1 hover:bg-gray-400 text-white">Previous</Link>
                            <Link :href="tasks.next_page_url" class="bg-gray-300 rounded px-1.5 py-1 hover:bg-gray-400 text-white">Next</Link>
                            <Link :href="tasks.last_page_url" class="bg-gray-300 rounded px-1.5 py-1 hover:bg-gray-400 text-white">Last</Link>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </AuthenticatedLayout>
</template>
