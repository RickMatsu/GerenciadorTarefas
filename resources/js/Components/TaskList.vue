<template>
  <div>
    <div v-if="error" class="alert alert-danger">
      {{ error }}
    </div>

    <div v-if="loading">
      <p>Carregando tarefas...</p>
    </div>

    <div v-else-if="tasks.length === 0">
      <p>Nenhuma tarefa encontrada.</p>
    </div>

    <ul v-else class="list-group">
      <li v-for="task in tasks" :key="task.id" class="list-group-item">
        <h5>{{ task.title }}</h5>
        <p>{{ task.description }}</p>
        <span class="badge bg-secondary">{{ task.status }}</span>
        <div class="mt-2">
          <button @click="editTask(task.id)" class="btn btn-warning btn-sm">
            Editar
          </button>
          <button @click="deleteTask(task.id)" class="btn btn-danger btn-sm ml-2">
            Excluir
          </button>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'TaskList',
  props: {
    tasks: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      error: null,
      loading: false,
    };
  },
  methods: {
    editTask(taskId) {
      this.$inertia.visit(`/tasks/${taskId}/edit`);
    },
    deleteTask(taskId) {
      if (confirm('Você tem certeza que deseja excluir esta tarefa?')) {
        this.loading = true;
        axios
          .delete(`/tasks/${taskId}`)
          .then(() => {
            this.$emit('update-tasks', taskId);
            this.loading = false;
          })
          .catch(() => {
            this.error = 'Erro ao excluir a tarefa.';
            this.loading = false;
          });
      }
    },
  },
};
</script>
