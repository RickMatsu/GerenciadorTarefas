<!-- resources/js/components/TaskEdit.vue -->
<template>
  <div class="container mt-5">
    <h1>Editar Tarefa</h1>
    <form @submit.prevent="editTask" class="mt-4">
      <TaskInput :task="task" />
      <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select 
          id="status" 
          v-model="task.status" 
          class="form-select" 
          required
        >
          <option value="pendente">Pendente</option>
          <option value="em andamento">Em Andamento</option>
          <option value="concluída">Concluída</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
  </div>
</template>

<script>
import TaskInput from '../components/TaskInput.vue';
import { Inertia } from '@inertiajs/inertia';

export default {
  components: {
    TaskInput,
  },
  data() {
    return {
      task: {
        id: this.$route.params.id,
        title: '',
        description: '',
        status: 'pendente',
      },
    };
  },
  created() {
    this.fetchTask();
  },
  methods: {
    async fetchTask() {
      try {
        const response = await axios.get(`/api/tasks/${this.task.id}`);
        this.task = response.data;
      } catch (error) {
        console.error('Erro ao carregar tarefa', error);
      }
    },
    async editTask() {
      try {
        await axios.put(`/api/tasks/${this.task.id}`, this.task);
        Inertia.visit('/tasks'); // Redireciona para a lista de tarefas
      } catch (error) {
        console.error('Erro ao editar tarefa', error);
      }
    },
  },
};
</script>
