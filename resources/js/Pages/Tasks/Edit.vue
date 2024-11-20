<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Tarefa</h2>
    </template>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <form @submit.prevent="updateTask">
            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                Título
              </label>
              <input
                v-model="form.title"
                id="title"
                type="text"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                required
              />
            </div>
            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                Descrição
              </label>
              <textarea
                v-model="form.description"
                id="description"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                required
              ></textarea>
            </div>
            <div class="flex items-center justify-between">
              <button
                type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
              >
                Atualizar Tarefa
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

export default {
  props: {
    task: {
      type: Object,
      required: true,
    },
  },
  setup(props) {
    const form = useForm({
      title: props.task.title,
      description: props.task.description,
    });

    const updateTask = () => {
      form.put(`/tasks/${props.task.id}`, {
        onSuccess: () => {
          alert('Tarefa atualizada com sucesso!');
        },
        onError: (errors) => {
          console.error(errors);
        },
      });
    };

    return {
      form,
      updateTask,
    };
  },
};
</script>
