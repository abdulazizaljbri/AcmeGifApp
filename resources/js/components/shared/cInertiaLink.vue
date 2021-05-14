<template>
  <inertia-link
    class="v-btn v-btn--flat v-btn--text"
    :href="href"
    :method="method"
  >
    <slot>
      {{ title }}
    </slot>
  </inertia-link>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      default: "",
    },
    href: {
      type: String,
      default: "/",
    },
    method: {
      type: String,
      default: "get",
    },
  },
};
</script>

<style>
</style>
