<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Tasks" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tasks</h2>
        </template>

        <section class="max-w-7xl mx-auto sm:px-6 lg:px-4 py-4 my-4">
            <section class="py-4 my-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h2 class="p-6 text-gray-900">Welcome {{ $page.props.auth.user.name }}</h2>
                </div>
            </section>

            <section class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Description</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                        <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                    <tr>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">Review article 123</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Review article 123 for spelling issues</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Pending</td>
                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, task</span></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </section>
        </section>
    </AuthenticatedLayout>
</template>
