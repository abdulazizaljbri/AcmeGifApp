<template>
  <v-container class="py-0" fill-height fluid>
    <v-row align="center" justify="center">
      <v-col cols="12" md="6">
        <h1 class="d-flex my-7 font-weight-light justify-center">

        </h1>
        <form @submit.prevent="submit">
          <v-card elevation="2" class="pa-5">
            <v-card-title
              class="d-flex my-7 justify-center primary--text"
            >
              تسجيل الدخول
            </v-card-title>
            <v-card-text>
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

            </v-card-text>
            <v-card-actions>
              <v-checkbox
                v-model="form.remember"
                label=" تذكرني"

              />
              <v-spacer />
              <v-btn
                dark
                depressed
                :loading="form.processing"
                color="primary"
                type="submit"
              >
                تسجيل الدخول
              </v-btn>
            </v-card-actions>

       <v-card-actions>
            <c-inertia-link
                class="primary--text"
                title="نسيت كلمة المرور"
             :href="route('password.request')"
              v-if="canResetPassword"
               />
               <v-spacer></v-spacer>
                <c-inertia-link
                class="primary--text"
                title="تسجيل حساب جديد"
             :href="route('register')"
              v-if="canResetPassword"
               />
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
      title: "تسجيل الدخول",
    };
  },

  props: {
    canResetPassword: Boolean,
    status: String,
  },

  data() {
    return {
      form: this.$inertia.form({
        email: "",
        password: "",
        remember: false,
      }),
    };
  },

  methods: {
    submit() {
      this.form
        .transform((data) => ({
          ...data,
          remember: this.form.remember ? "on" : "",
        }))
        .post(this.route("login"), {
          onFinish: () => this.form.reset("password"),
        });
    },
  },
};
</script>
