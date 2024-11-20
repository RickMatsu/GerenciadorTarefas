<template>
  <div>
    <TaskIndex :tasks="tasks" />
  </div>
</template>

<script setup>
import TaskIndex from '@/Components/TaskIndex.vue';
defineProps({
  tasks: Array, // Confirma que as tarefas são passadas como array
});
</script>

