<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <!-- Inserindo o componente TaskIndex para exibir a lista de tarefas -->
            <TaskIndex :tasks="tasks" />
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import TaskIndex from '@/Components/TaskIndex.vue';
import TaskList from '@/Components/TaskList.vue';

export default {
  props: {
    tasks: Array  // Aqui você define 'tasks' como uma prop do tipo Array
  },
  components: {
    TaskList,
    Head,
    TaskIndex,
    AuthenticatedLayout,
  },
  mounted() {
    console.log(this.tasks);  // Aqui você verifica se as tarefas estão sendo passadas corretamente
  }
};
</script>
