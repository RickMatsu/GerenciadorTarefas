<template>
  <div class="form-group">
    <label v-if="label" :for="id" class="form-label">{{ label }}</label>
    <input
      :id="id"
      :type="type"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      class="form-control"
      :class="{ 'is-invalid': error }"
      :placeholder="placeholder"
    />
    <div v-if="error" class="invalid-feedback">{{ error }}</div>
  </div>
</template>

<script>
export default {
  name: "TextInput",
  props: {
    modelValue: String, // Valor recebido do pai
    id: String,
    type: {
      type: String,
      default: "text",
    },
    label: String,
    placeholder: String,
    error: String, // Exibir mensagens de erro
  },
};
</script>

<style scoped>
.form-control {
  margin-top: 0.5rem;
}
</style>
