<template>
    <div id="app">
      <inertia-link href="/tasks">Tasks</inertia-link>
      <inertia-progress /> 
    </div>
  </template>
  
  <script>
  import { InertiaProgress } from '@inertiajs/progress'
  
  export default {
    mounted() {
      InertiaProgress.init()
    }
  }
  </script>
  