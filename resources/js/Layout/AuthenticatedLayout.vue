<!-- resources/js/Layouts/AuthenticatedLayout.vue -->
<template>
    <div>
      <!-- Cabeçalho principal -->
      <header class="bg-gray-800 text-white py-4 shadow">
        <div class="container mx-auto px-4 flex justify-between items-center">
          <h1 class="text-2xl font-bold">Sistema de Gerenciamento de Tarefas</h1>
          <nav>
            <a href="/dashboard" class="text-white hover:underline mr-4">Dashboard</a>
            <a href="/tasks" class="text-white hover:underline mr-4">Tarefas</a>
            <a href="/logout" class="text-white hover:underline">Sair</a>
          </nav>
        </div>
      </header>
  
      <!-- Conteúdo da página -->
      <main class="py-4">
        <slot />
      </main>
    </div>
  </template>
  
  <script>
  export default {
    name: 'AuthenticatedLayout',
  };
  </script>
  
  <style scoped>
  header {
    background-color: #2d3748;
  }
  nav a {
    margin-right: 1rem;
    font-weight: 500;
  }
  </style>
  