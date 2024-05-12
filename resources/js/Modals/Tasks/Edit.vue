<script setup>
import PageModal from '@/Components/PageModal.vue';
import { router } from '@inertiajs/vue3';

defineProps({
    task: Object,
})
</script>

<template>
    <PageModal>
        <template #title>
            <h1 class="text-2xl text-center font-bold pb-4">Edit Task</h1>
        </template>

        <div class="container mx-auto p-4 mt-10 bg-white rounded shadow-md">
            <div class="flex flex-col gap-4">
                <div class="flex items-center">
                    <label for="name" class="w-1/3 text-gray-700 font-bold">Name:</label>
                    <input type="text" id="name" class="w-2/3 px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500" v-model="task.name" required>
                </div>

                <div class="flex items-start">
                    <label for="description" class="w-1/3 text-gray-700 font-bold">Description:</label>
                    <textarea id="description" class="w-2/3 px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500" rows="5" v-model="task.description" required></textarea>
                </div>

                <div class="flex items-center">
                    <label for="status" class="w-1/3 text-gray-700 font-bold">Status:</label>
                    <select v-model="task.status" name="priority" class="w-2/3 px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                        <option value="completed">Completed</option>
                        <option value="in-progress">In Progress</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>

                <div class="flex items-center">
                    <label for="priority" class="w-1/3 text-gray-700 font-bold">Priority:</label>
                    <select v-model="task.priority" name="priority" class="w-2/3 px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                        <option value="high">High</option>
                        <option value="medium">Medium</option>
                        <option value="low" selected>Low</option>
                    </select>
                </div>

                <div class="flex items-center">
                    <label for="deadline" class="w-1/3 text-gray-700 font-bold">Deadline:</label>
                    <input type="date" v-model="task.deadline" for="deadline" name="deadline" class="w-2/3 px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>

                <div>
                    <button
                        class="block mt-4 w-full px-3 py-2 rounded-md text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-1 focus:ring-blue-500"
                        @click="() => router.put(route('tasks.update', { task: task.id }), task)"
                    >
                        Update Task
                    </button>
                </div>
            </div>
        </div>
    </PageModal>
</template>
