<template>
  <v-hover v-slot="{ hover }">
    <v-card
      height="180"
      shaped
      link
      width="180"
      :elevation="hover ? 12 : 6"
      :class="{ 'on-hover': hover }"
      :color="color"
      @click="clicked(href)"
      class="d-flex flex-column justify-center align-center white--text"
    >
      <v-icon class="white--text xx-large">{{ icon }}</v-icon>
      <span class="mt-5 font-weight-bold">{{ title }}</span>
    </v-card>
  </v-hover>
</template>

<script>
export default {
  props: {
    href: {
      type: String,
      default: "#",
    },
    icon: {
      type: String,
      default: "fa-file",
    },
    title: {
      type: String,
      default: "",
    },
    color: {
      type: String,
      default: "light-blue",
    },
  },

  methods:{
      clicked(e){
          let url =this.href
          if (url =="#"){
            this.$emit("click")
              return;
          }
             
          this.$inertia.visit(url)

      }
  }
};
</script>

<style scoped>
.xx-large {
  font-size: 58px;
}
.v-card {
  transition: opacity 0.4s ease-in-out;
}

.v-card:not(.on-hover) {
  opacity: 0.7;
}
.text-decoration-inherit {
  text-decoration: inherit;
}
</style>
