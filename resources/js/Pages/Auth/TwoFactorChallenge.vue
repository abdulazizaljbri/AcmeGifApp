<template>
  <v-container class="py-0" fill-height fluid>
    <v-row align="center" justify="center">
      <v-col cols="12" md="6">
        <form @submit.prevent="submit">
          <v-card elevation="2">
            <v-card-subtitle>
              <div class="mb-4 text-sm text-gray-600" v-if="!recovery">
                يرجى تأكيد الوصول إلى حسابك عن طريق إدخال رمز المصادقة المقدم من
                تطبيق المصادقة الخاص بك
              </div>

              <div class="mb-4 text-sm text-gray-600" v-if="recovery">
                يرجى تأكيد الوصول إلى حسابك عن طريق إدخال أحد رموز الاسترداد في
                حالات الطوارئ.
              </div>
            </v-card-subtitle>
            <v-card-text>
              <div class="mt-4" v-if="!recovery">
                <c-text-field name="code" label="رمز المصادقة" v-model="code" />

              </div>

              <div class="mt-4" v-if="recovery">
                <c-text-field
                  name="recovery_code"
                  label="رمز الاسترداد"
                  v-model="recovery_code"
                />

              </div>
            </v-card-text>
            <v-card-actions>
              <v-btn
                text
                v-if="!recovery"
                @click="recovery = true"
                color="primary--text"
                >استخدم رمز الاسترداد
              </v-btn>
              <v-btn
                text
                v-if="recovery"
                @click="recovery = false"
                color="primary--text"
              >
                استخدم رمز المصادقة
              </v-btn>

              <v-spacer />
              <v-btn
                dark
                depressed
                :loading="loading"
                color="primary"
                type="submit"
              >
                تسجيل الدخول
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
      title: "المصاقة الثنائية ",
    };
  },
  data() {
    return {
      loading: false,
      code: null,
      recovery_code: null,

      recovery: false,
    };
  },
  methods: {
    submit() {
      this.loading = true;

      // this.$inertia
      //   .post("/two-factor-challenge", {
      //     code: this.code,
      //     recovery_code: this.recovery_code,

      //     })
      //   .then(() => (this.loading = false));

      this.$inertia.post(
        "/two-factor-challenge",
        {
          code: this.code,
          recovery_code: this.recovery_code,
        },
        {},
        {
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
        }
      );
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
</style>
