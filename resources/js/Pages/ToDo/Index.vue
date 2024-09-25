<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    todos: Array,
    user_id: Number
});

const form = useForm({
    TaskName: '',
    Deadline: '',
    user_id: props.user_id
});

const HandleSubmit = () => {
    console.log('Task Name:', form.TaskName);
    console.log('User Id:', props.user_id);

    form.post(route('todos.store'), {
        onSuccess: () => {
            form.TaskName = '';
            form.Deadline = '';
        },
    });
};

const HandleDelete = (todo) => {
    if (confirm('Confirm Deletion of Task: ' + todo.TaskName)) {
        form.delete(route('todos.delete', todo.id), {
            onSuccess: () => {
                props.todos = props.todos.filter(todo => todo.id !== id);
            },
        });
    }
};

</script>

<template>
    <AppLayout title="Todos">

        <div class="flex justify-center items-center" style="margin-top: 50px;">
            <div style="width: 1200px">

                <div class="flex items-center justify-between bg-white shadow-md rounded-lg p-6" style="margin-bottom: 30px;">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        My ToDos Index Page
                    </h2>
                </div>

                <div class="bg-white shadow-md rounded-lg p-6">
                    <div>
                        <form @submit.prevent="HandleSubmit">
                            <label for="taskName" class="block mt-4 text-sm font-medium text-gray-700">Task Name:</label>
                            <input
                                type="text"
                                id="taskName"
                                v-model="form.TaskName"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            />
                            <div class="text-red-600" v-if="form.errors.TaskName">{{ form.errors.TaskName }}</div>

                            <label for="deadline" class="block mt-4 text-sm font-medium text-gray-700">Deadline:</label>
                            <input
                                type="date"
                                id="deadline"
                                v-model="form.Deadline"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            />
                            <div class="text-red-600" v-if="form.errors.Deadline">{{ form.errors.Deadline }}</div>

                            <button
                                type="submit" :disabled="form.processing"
                                class="mt-4 bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600"
                            >
                                Add Todo
                            </button>
                        </form>
                    </div>
                </div>

                <div class="mt-6">
                    <ul>
                        <li v-for="todo in props.todos" :key="todo.id" class="py-2">
                            <div class="bg-white shadow-md rounded-lg p-6 flex justify-between items-center">
                                <div>
                                    <span class="font-medium">Task: {{ todo.TaskName }}</span>
                                    <span class="font-medium">, Deadline: {{ todo.Deadline }}</span>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="bg-green-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-green-600" style="font-size: 14px;">Update</button>
                                    <button @click="HandleDelete(todo)" class="bg-red-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-red-600" style="font-size: 14px;">Delete</button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>


    </AppLayout>
</template>
