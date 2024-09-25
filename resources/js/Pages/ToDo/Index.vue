<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import { ref } from 'vue';

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

    form.clearErrors();

    form.post(route('todos.store'), {
        onSuccess: () => {
            form.reset();
        },
    });
};

const HandleDelete = (todo) => {
    if (confirm('Confirm Deletion of Task: ' + todo.TaskName)) {
        form.delete(route('todos.destroy', todo.id), {
            onSuccess: () => {
                console.log('record deleted.')
            },
        });
    }
};

const todoToEdit = ref(null);

const updateForm = useForm({
    TaskName: '',
    Deadline: '',
    user_id: props.user_id
});

const HandleEditButtonClicked = (todo) => {
    todoToEdit.value = todo.id;
    updateForm.TaskName = todo.TaskName;
    updateForm.Deadline = todo.Deadline;
};

const HandleUpdate = () => {

    updateForm.clearErrors();

    updateForm.put(route('todos.update', { id: todoToEdit.value }), {
        onSuccess: () => {
            todoToEdit.value = null;
            updateForm.reset();
        },
    });
};

</script>

<template>
    <AppLayout title="Todos">

        <div class="flex justify-center items-center">
            <div style="width: 1200px; margin-top: 50px; margin-bottom: 100px;">

                <div class="flex items-center justify-between bg-white shadow-md rounded-lg p-6"
                    style="margin-bottom: 30px;">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        My ToDos
                    </h2>
                </div>

                <div class="bg-white shadow-md rounded-lg p-6">
                    <div>
                        <form @submit.prevent="HandleSubmit">
                            <label for="taskName" class="block mt-4 text-sm font-medium text-gray-700">Task
                                Name:</label>
                            <input type="text" id="taskName" v-model="form.TaskName"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                            <InputError class="mt-2 text-red-600" :message="form.errors.TaskName" />

                            <label for="deadline" class="block mt-4 text-sm font-medium text-gray-700">Deadline:</label>
                            <input type="date" id="deadline" v-model="form.Deadline"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                            <InputError class="mt-2 text-red-600" :message="form.errors.Deadline" />

                            <button type="submit" :disabled="form.processing"
                                class="mt-4 bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600">
                                Add Todo
                            </button>
                        </form>
                    </div>
                </div>

                <div class="mt-6">
                    <ul>
                        <li v-for="todo in props.todos" :key="todo.id" class="py-2">
                            <div class="bg-white shadow-md rounded-lg p-6">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <span class="font-medium">Task: {{ todo.TaskName }}</span>
                                        <span class="font-medium">, Deadline: {{ todo.Deadline }}</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button @click="HandleEditButtonClicked(todo)"
                                            class="bg-green-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-green-600"
                                            style="font-size: 14px;">
                                            Update
                                        </button>
                                        <button @click="HandleDelete(todo)"
                                            class="bg-red-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-red-600"
                                            style="font-size: 14px;">
                                            Delete
                                        </button>
                                    </div>
                                </div>

                                <div v-if="todoToEdit === todo.id" class="mt-4">
                                    <form @submit.prevent="HandleUpdate">
                                        <label for="updateTaskName"
                                            class="block mt-4 text-sm font-medium text-gray-700">Update Task
                                            Name:</label>
                                        <input type="text" id="updateTaskName" v-model="updateForm.TaskName"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                                        <InputError class="mt-2 text-red-600" :message="updateForm.errors.TaskName" />

                                        <label for="updateDeadline"
                                            class="block mt-4 text-sm font-medium text-gray-700">Update
                                            Deadline:</label>
                                        <input type="date" id="updateDeadline" v-model="updateForm.Deadline"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                                        <InputError class="mt-2 text-red-600" :message="updateForm.errors.Deadline" />

                                        <button type="submit" :disabled="form.processing"
                                            class="mt-4 bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600">
                                            Update Todo
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>


    </AppLayout>
</template>
