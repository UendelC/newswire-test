<script setup>
import PageModal from '@/Components/PageModal.vue';
import { useTask } from '@/Composables/task';

defineProps({
    task: Object,
})

const { formatStatus } = useTask();
</script>

<template>
    <PageModal>
        <template #title>
            <h1 class="text-2xl text-center font-bold pb-4">Task Details</h1>
        </template>

        <div class="container mx-auto p-4 mt-10 bg-white rounded shadow-md">
            <div class="flex flex-col gap-4">
                <div class="flex items-center">
                    <label for="name" class="w-1/3 text-gray-700 font-bold">Name:</label>
                    <input type="text" id="name" class="w-2/3 px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500" :value="task.name" disabled>
                </div>

                <div class="flex items-start">
                    <label for="description" class="w-1/3 text-gray-700 font-bold">Description:</label>
                    <textarea id="description" class="w-2/3 px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500" rows="5" disabled v-model="task.description"></textarea>
                </div>

                <div class="flex items-center">
                    <label for="status" class="w-1/3 text-gray-700 font-bold">Status:</label>
                    <span id="status" class="w-2/3 px-3 py-2 rounded-md bg-gray-700 text-white font-medium">{{ formatStatus(task) }}</span>
                </div>

                <div class="flex items-center">
                    <label for="priority" class="w-1/3 text-gray-700 font-bold">Priority:</label>
                    <span class="w-2/3 px-3 py-2 rounded-md bg-gray-700 text-white font-medium">{{ task.priority }}</span>
                </div>

                <div class="flex items-center">
                    <label for="deadline" class="w-1/3 text-gray-700 font-bold">Deadline:</label>
                    <span class="w-2/3 px-3 py-2 rounded-md bg-gray-200 text-gray-700 font-medium">{{ task.deadline }}</span>
                </div>

                <div class="flex items-center">
                    <label for="user" class="w-1/3 text-gray-700 font-bold">Assigned To:</label>
                    <span class="w-2/3 px-3 py-2 rounded-md bg-gray-200 text-gray-700 font-medium">{{ task.user?.name }}</span>
                </div>
            </div>
        </div>
    </PageModal>
</template>
