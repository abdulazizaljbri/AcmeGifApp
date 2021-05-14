<template>
  <v-container class="py-0" fill-height fluid>
    <v-row align="center" justify="center">
      <v-col cols="12" md="6">

        <form @submit.prevent="submit">
          <v-card elevation="2" class="pa-5">
            <v-card-title
              class="d-flex my-7 justify-center primary--text"
            >
              الاشتراك
            </v-card-title>
            <v-card-text>
              <c-text-field
                name="name"
                label="اسم المستخدم"
                append-icon="fa-user"
                v-model="form.name"
              />
              <c-text-field
                type="email"
                name="email"
                label="البريد الالكتروني"
                append-icon="fa-envelope"
                v-model="form.email"
              />

              <c-password
                name="password"
                label="كلمة المرور"
                v-model="form.password"
              />

              <c-password
                label="تاكيد كلمة المرور"
                name="password_confirmation"
                v-model="form.password_confirmation"
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
                انشاء حساب
              </v-btn>
            </v-card-actions>
          </v-card>
        </form>
      </v-col>

    </v-row>
  </v-container>
</template>
<script>
import layout from "@/Layouts/AuthLayout";

export default {

  layout: layout,
  metaInfo() {
    return {
      title: "الاشتراك ",
    };
  },
  data() {
    return {
      loading: false,
      form: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
    };
  },
  methods: {
    submit() {
      //   this.loading = true;

      this.$inertia.post("/register", this.form, {
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
  /* background-image: url(/imgs/bgDrawer.jpg); */

  height: 100vh;
  width: 100%;
  background-position: center;
  background-size: cover;
}
.text-decoration-none {
  text-decoration: none;
}
</style>
