<template>
  <v-card elevation="3">
    <v-container>
      <form @submit.prevent="updatePassword">
        <v-card-title class="text-center"> تغيير كلمة المرور </v-card-title>

        <v-row align-center justify-center>
          <v-col cols="12" md="4">
            <v-card-subtitle>
              اعادة تعيين كلمة المرور الخاص بك
            </v-card-subtitle>
          </v-col>
          <v-col cols="12" md="8">
            <v-card-text>
              <c-password
                name="current_password"
                label="كلمة المرور الحالية"
                v-model="form.current_password"
              />

              <c-password
                name="password"
                label="كلمة المرور الجديدة"
                v-model="form.password"
              />

              <c-password
                label="تاكيد كلمة المرور"
                name="password_confirmation"
                v-model="form.password_confirmation"
              />
            </v-card-text>
          </v-col>
          <v-col>
            <v-card-actions>
              <v-btn
                type="submit"
                color="primary white--text"
                :loading="loading"
                :disabled="loading"
              >
                تغيير كلمة المرور
              </v-btn>
            </v-card-actions>
          </v-col>
        </v-row>
      </form>
    </v-container>
  </v-card>
</template>

<script>
export default {
  mounted() {
    this.$nextTick(() => {
      this.clearErrors();
    });
  },
  data() {
    return {
      loading: false,

      form: {
        current_password: "",
        password: "",
        password_confirmation: "",
      },
    };
  },

  methods: {
    reset() {
      this.form = {
        current_password: "",
        password: "",
        password_confirmation: "",
      };
    },
    updatePassword() {
      this.loading = true;
      this.$inertia.put(route("user-password.update"), this.form, {
        preserveScroll: true,
        onProgress: (progress) => {
          this.loading = true;
        },
        onSuccess: (page) => {
          if (!this.hasErrors()) {
            this.reset();
          }
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
</style>
