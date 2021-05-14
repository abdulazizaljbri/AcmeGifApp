<template>
  <v-dialog
  persistent
     scrollable
    v-model="dialog"
    :max-width="options.width"
    :style="{ zIndex: options.zIndex }"
    @keydown.esc="cancel"
  >
    <v-card>
      <v-toolbar dark :color="options.color" dense flat>
        <v-toolbar-title class="white--text">{{ title }}</v-toolbar-title>
      </v-toolbar>
      <v-card-text   class="pa-4">
        <slot name="body" />

      </v-card-text>
      <v-card-actions class="pt-0">
        <v-spacer></v-spacer>
        <slot name="footer" />
           <!-- <v-btn color="primary darken-1" text @click.native="agree" :loading="loading">نعم</v-btn>
        <v-btn color="grey" text @click.native="cancel">لا</v-btn> -->

      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
export default {
    // props:["dialog","loading"],
  data() {
    return {
    dialog:false,
      resolve: null,
      reject: null,
    //   message: null,
      title: null,
      options: {
          color:"secondary-color white--text",
        width: 500,
        zIndex: 200,
      },
    };
  },
  methods: {
    open(title, message, options) {
        this.dialog=true
      this.title = title
    //   this.message = message
      this.options = Object.assign(this.options, options)
    //   return new Promise((resolve, reject) => {
    //     this.resolve = resolve
    //     this.reject = reject
    //   })
    },
    close(){
        this.dialog=false

    },

    agree() {
      this.resolve(true)

    },
    cancel() {
      this.resolve(false)
      this.$emit("close")

    }
  }
};
</script>
