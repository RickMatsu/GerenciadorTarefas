<!-- resources/js/components/Dashboard.vue -->
<template>
    <div>
      <h1>Dashboard</h1>
      <TaskIndex /> <!-- Aqui, você está incluindo o componente TaskIndex -->
    </div>
  </template>
  
  <script>
  import TaskIndex from './TaskIndex.vue'; // Certifique-se de importar o componente
  
  export default {
    components: {
      TaskIndex
    }
  };
  </script>
  
  <style scoped>
  /* Você pode adicionar estilos específicos para o Dashboard aqui */
  </style>
  