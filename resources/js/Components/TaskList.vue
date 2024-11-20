<template>
    <div>
      <!-- Exibição de erro -->
      <div v-if="error" class="alert alert-danger">
        {{ error }}
      </div>
  
      <!-- Estado de carregamento -->
      <div v-if="loading">
        <p>Carregando tarefas...</p>
      </div>
  
      <!-- Sem tarefas -->
      <div v-else-if="tasks.length === 0">
        <p>Nenhuma tarefa encontrada.</p>
      </div>
  
      <!-- Exibir lista de tarefas -->
      <ul v-else class="list-group">
        <li v-for="task in tasks" :key="task.id" class="list-group-item">
          <h5>{{ task.title }}</h5>
          <p>{{ task.description }}</p>
          <span class="badge bg-secondary">{{ task.status }}</span>
          <div class="mt-2">
            <!-- Botão Editar -->
            <button @click="editTask(task.id)" class="btn btn-warning btn-sm">
              Editar
            </button>
  
            <!-- Botão Excluir -->
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
        default: () => [], // Evita erros se nenhum dado for passado
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
              this.$emit('update-tasks', taskId); // Emite um evento para atualizar a lista de tarefas
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
  