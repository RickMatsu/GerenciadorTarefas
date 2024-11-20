<!-- resources/js/App.vue -->
<template>
    <div id="app">
      <router-view></router-view> <!-- Aqui as páginas serão renderizadas conforme as rotas -->
    </div>
  </template>
  
  <script>
  export default {
    name: 'App',
  };
  </script>
  
  <style>
  /* Estilos globais para a aplicação */
  #app {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
  }
  </style>
  