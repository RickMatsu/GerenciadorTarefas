<template>
  <AuthenticatedLayout>
    <template #header>
        <!-- Header com título e botão -->
        <div class="d-flex justify-content-between align-items-center mb-1">
          <h1 class="mb-0">Criar Nova Tarefa</h1>
          <a href="/dashboard" class="btn btn-secondary">Voltar para Lista de Tarefas</a>
        </div>
    </template>

    <div class="py-12">
      <div class="container">
        <form @submit.prevent="createTask" class="mt-4">
          <!-- Campo de Título -->
          <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input 
              id="title" 
              type="text" 
              v-model="task.title" 
              class="form-control" 
              required
              placeholder="Digite o título da tarefa"
            />
          </div>

          <!-- Campo de Descrição -->
          <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <textarea 
              id="description" 
              v-model="task.description" 
              class="form-control" 
              required
              placeholder="Digite a descrição da tarefa"
            ></textarea>
          </div>

          <!-- Campo de Status -->
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
    </div>
  </AuthenticatedLayout>
</template>


<script>
import { Inertia } from '@inertiajs/inertia';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
  components: {
    AuthenticatedLayout,
  },
  data() {
    return {
      task: {
        title: '',
        description: '',
        status: 'pendente',
      },
    };
  },
  methods: {
    async createTask() {
      try {
        await axios.post('/tasks', this.task);
        alert('Tarefa criada com sucesso!');
        this.task = {
          title: '',
          description: '',
          status: 'pendente',
        };
      } catch (error) {
        console.error('Erro ao criar a tarefa:', error);
        alert('Ocorreu um erro ao criar a tarefa.');
      }
    },
  },
};
</script>

<style scoped>
.container {
  max-width: 600px;
  margin: 0 auto;
}

.d-flex {
  display: flex;
}

.justify-content-between {
  justify-content: space-between;
}

.align-items-center {
  align-items: center;
}
</style>
