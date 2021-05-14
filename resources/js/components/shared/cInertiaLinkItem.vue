<template>
  <c-inertia-link
    class=" v-list-item v-list-item--link  "
    :href="href"
    v-bind="$attrs"
    @click="$emit('close-drawer')"
  >
    <v-list-item-action class="ml-3" v-if="icon != ''">
      <v-icon>{{ icon }}</v-icon>
    </v-list-item-action>
    <v-list-item-content>{{ title }}</v-list-item-content>
  </c-inertia-link>
</template>

<script>
export default {
  props: {
    href: {
      type: String,
      default: "/",
    },
    title: {
      type: String,
      default: "",
    },
    icon: {
      type: String,
      default: "",
    },
  },
};
</script>

<style>
.text-decoration-inherit {
  text-decoration: inherit;
}
</style>
