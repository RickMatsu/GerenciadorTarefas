<template>
  <div class="d-flex justify-content-between align-items-center mb-">
    <h1>Lista de Tarefas</h1>
    <button @click="goToCreateTask" class="btn btn-primary">Criar Tarefa</button>
  </div>

  <!-- Componente de listagem -->
  <TaskList :tasks="tasks" @update-tasks="removeTaskFromList" />
</template>

<script>
import TaskList from './TaskList.vue';

export default {
  name: 'TaskIndex',
  components: {
    TaskList,
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
