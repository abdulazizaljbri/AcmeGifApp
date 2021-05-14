<template>
<div>
    <inertia-link
    class=" v-btn--flat v-list-item--link white--text text-decoration-inherit"
    :class="color"
    :href="url"

    v-bind="$attrs"
    @click="$emit('close-drawer')"
  >
    <v-list-item-action class="ml-3" v-if="icon != ''">
      <v-icon>{{ icon }}</v-icon>
    </v-list-item-action>
    <v-list-item-content>{{ title }}</v-list-item-content>
  </inertia-link>

</div>

</template>

<script>
export default {
  props: {
    url: {
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
    color: {
      type: String,
      default: "theme--dark",
    },
  },
};
</script>

<style>
.text-decoration-inherit{
    text-decoration: inherit;
}
</style>
