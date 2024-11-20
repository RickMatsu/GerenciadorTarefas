<template>
  <AuthenticatedLayout>
    <template #header>
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Lista de Tarefas</h1>
        <button @click="goToCreateTask" class="btn btn-primary">Criar Tarefa</button>
      </div>
    </template>
    <TaskList :tasks="tasks" @update-tasks="removeTaskFromList" />
  </AuthenticatedLayout>
</template>

<script>
import TaskList from './TaskList.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
  name: 'TaskIndex',
  components: {
    TaskList,
    AuthenticatedLayout,
  },
  props: {
    tasks: {
      type: Array,
      default: () => [], // Definindo um valor padrão para evitar erro caso `tasks` não seja passado
    },
  },
  methods: {
    goToCreateTask() {
      this.$inertia.visit('/tasks/create');
    },
    removeTaskFromList(taskId) {
      this.tasks = this.tasks.filter(task => task.id !== taskId);
    },
  },
};
</script>
