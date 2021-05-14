<template>
  <v-container class="py-0" fill-height fluid>
    <v-row align="center" justify="center">
      <v-col cols="12" md="6">
        <form @submit.prevent="submit">
          <v-card elevation="2" class="pa-5">
            <v-card-title class="primary--text">تغيير كلمة المرور</v-card-title>
            <v-card-text>
              <c-text-field
                type="email"
                name="email"
                label="البريد الالكتروني"
                append-icon="fa-envelope"
                v-model="form.email"
              />
            </v-card-text>
            <v-card-actions>
              <c-inertia-link
                class="primary--text"
                title="العودة الئ  تسجيل الدخول"
                :href="route('login')"
              />

              <v-spacer />
              <v-btn
                dark
                depressed
                :loading="loading"
                color="primary"
                type="submit"
              >
                ارسال
              </v-btn>
            </v-card-actions>
          </v-card>
        </form>
      </v-col>
      <!-- <v-col cols="12" md="6" class="cover hidden-sm-and-down"> </v-col> -->
    </v-row>
  </v-container>
</template>

<script>
import layout from "@/Layouts/AuthLayout";
export default {
  layout: layout,
  metaInfo() {
    return {
      title: "تغيير كلمة المرور",
    };
  },
  data() {
    return {
      loading: false,

      form: {
        email: null,
      },
    };
  },
  methods: {
    submit() {
      //   this.loading = true;

      this.$inertia.post(route("password.email"), this.form, {
        preserveScroll: true,
        onProgress: (progress) => {
          this.loading = true;
        },
        onSuccess: (page) => {
          this.loading = false;
        },
        onFinish: () => {
          this.loading = false;
        },
      });
    },
  },
};
</script>

<style>
.cover {
  background-image: url(/imgs/bgDrawer.jpg);

  height: 100vh;
  width: 100%;
  background-position: center;
  background-size: cover;
}
</style>
