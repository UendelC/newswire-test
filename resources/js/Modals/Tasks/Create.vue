<script setup>
import PageModal from '@/Components/PageModal.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    description: '',
    priority: 'low',
    deadline: '',
    status: 'pending',
})
</script>

<template>
    <PageModal>
        <template #title>
            Create New Task
        </template>
        <form @submit.prevent="form.post('/tasks')">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Task Name:</label>
                <input type="text" v-model="form.name" name="name" class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-bold mb-2">Description:</label>
                <textarea v-model="form.description" name="description" class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500" required></textarea>
            </div>

            <div class="mb-4">
                <label for="priority" class="block text-gray-700 font-bold mb-2">Priority:</label>
                <select v-model="form.priority" name="priority" class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                    <option value="high">High</option>
                    <option value="medium">Medium</option>
                    <option value="low" selected>Low</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="deadline" class="block text-gray-700 font-bold mb-2">Deadline:</label>
                <input type="date" v-model="form.deadline" for="deadline" name="deadline" class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500" required>
            </div>

            <button type="submit" class="block w-full px-3 py-2 rounded-md text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-1 focus:ring-blue-500" :disabled="form.processing">Create Task</button>
        </form>
    </PageModal>
</template>
