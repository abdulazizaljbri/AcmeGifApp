<template>
  <c-text-field
    v-bind="$attrs"
    v-on="$listeners"
    :name="name"

    :append-icon="showPassword ? 'fa-eye' : 'fa-eye-slash'"
    :type="showPassword ? 'text' : 'password'"
    @click:append="showPassword = !showPassword"
  />
</template>

<script>

export default {
  name:"customPassword",
  props: {
    name: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      showPassword: false,
    }
  },
}
</script>

<style>
</style>
