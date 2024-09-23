<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    todos: Array
});

// Create a form for adding todos
const { data, setData, post, processing, errors } = useForm({
    TaskName: '',
    Deadline: ''
});

// Method to handle form submission
const submit = () => {
    post(route('todos.store'), {
        onSuccess: () => {
            // Reset the form fields on success
            data.TaskName = '';
            data.Deadline = '';
        },
    });
};

</script>

<template>
    <AppLayout title="Todos">

        <div class="flex justify-center items-center" style="margin-top: 50px;">
            <div style="width: 1200px">

                <div class="flex items-center justify-between bg-white shadow-md rounded-lg p-6" style="margin-bottom: 30px;">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        My ToDos
                    </h2>
                </div>

                <div class="bg-white shadow-md rounded-lg p-6">
                    <div>
                        <form @submit.prevent="submit">
                            <label for="taskName" class="block mt-4 text-sm font-medium text-gray-700">Task Name:</label>
                            <input
                                type="text"
                                id="taskName"
                                v-model="data.TaskName"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                required
                            />
                            <div class="text-red-600">{{ errors.TaskName }}</div>

                            <label for="deadline" class="block mt-4 text-sm font-medium text-gray-700">Deadline:</label>
                            <input
                                type="date"
                                id="deadline"
                                v-model="data.Deadline"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            />
                            <div class="text-red-600">{{ errors.Deadline }}</div>

                            <button
                                type="submit"
                                class="mt-4 bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600"
                                :disabled="processing"
                            >
                                Add Todo
                            </button>
                        </form>
                    </div>
                </div>

                <div class="mt-6">
                    <ul>
                        <li v-for="todo in todos" :key="todo.id" class="py-2">
                            <span class="font-medium">{{ todo.TaskName }}</span>
                            <span class="text-gray-500"> - {{ todo.Deadline }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


    </AppLayout>
</template>
