<template>
  <v-card elevation="3">
    <v-container>
      <v-card-title class="text-center">
        جلسات المتصفح || سجلات الدخول
      </v-card-title>
      <v-row align-center justify-center>
        <v-col cols="12" md="4">
          <v-card-subtitle>
            إدارة جلساتك النشطة وتسجيل الخروج منها على المتصفحات والأجهزة
            الأخرى.
          </v-card-subtitle>
        </v-col>
        <v-col cols="12" md="8">
          <v-card-text>
            <p>
              إذا لزم الأمر ، يمكنك تسجيل الخروج من جميع جلسات المتصفح الأخرى
              عبر جميع أجهزتك. بعض جلساتك الأخيرة مذكورة أدناه ؛ ومع ذلك ، قد لا
              تكون هذه القائمة شاملة. إذا شعرت أنه تم اختراق حسابك ، فيجب عليك
              أيضًا تحديث كلمة المرور الخاصة بك.
            </p>
            <!-- Other Browser Sessions -->
            <div class="mt-5 space-y-6" v-if="sessions.length > 0">
              <div
                class="d-flex flex-wrap align-center"
                v-for="(session, i) in sessions"
                :key="i"
              >
                <div>
                  <svg
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    class="w-8 h-8 gray--text"
                    v-if="session.agent.is_desktop"
                  >
                    <path
                      d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                    ></path>
                  </svg>

                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="w-8 h-8 gray--text"
                    v-else
                  >
                    <path d="M0 0h24v24H0z" stroke="none"></path>
                    <rect x="7" y="4" width="10" height="16" rx="1"></rect>
                    <path d="M11 5h2M12 17v.01"></path>
                  </svg>
                </div>

                <div class="mr-3">
                  <div class="text-sm text--gray">
                    {{ session.agent.platform }} - {{ session.agent.browser }}
                  </div>

                  <div>
                    <div class="text-xs text--gray">
                      {{ session.ip_address }},

                      <span
                        class="green--text font-semibold"
                        v-if="session.is_current_device"
                        >This device</span
                      >
                      <span v-else>Last active {{ session.last_active }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </v-card-text>
        </v-col>
        <v-col>
          <v-card-actions>
            <div class="flex items-center mt-5">
              <v-btn @click.native="confirmLogout" color="primary white--text">
                تسجيل الخروج من جلسات المتصفح الأخرى
              </v-btn>
            </div>
          </v-card-actions>
        </v-col>
      </v-row>
    </v-container>

    <!-- Logout Other Devices Confirmation Modal -->
    <v-dialog v-model="confirmingLogout" persistent max-width="500">
      <v-card>
        <v-card-title class="headline">
          تسجيل الخروج من جلسات المتصفح الأخرى
        </v-card-title>
        <v-card-text>
          <p>
            يرجى إدخال كلمة المرور الخاصة بك لتأكيد رغبتك في تسجيل الخروج من
            جلسات المتصفح الأخرى عبر جميع أجهزتك.
          </p>

          <c-password
            name="password"
            label="كلمة المرور"
            v-model="form.password"
            ref="password"
            @keyup.enter.native="logoutOtherBrowserSessions"
          />
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary white--text"
            dark
            @click="confirmingLogout = false"
          >
            لا
          </v-btn>
          <v-btn
            color="primary white--text"
            dark
            @click="logoutOtherBrowserSessions"
            :loading="loading"
          >
            تسجيل الخروج من جلسات المتصفح الأخرى
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-card>
</template>

<script>
export default {
  props: ["sessions"],
  data() {
    return {
      dialog: false,
      loading: false,
      confirmingLogout: false,

      form: {
        _method: "DELETE",
        password: "",
      },
    };
  },

  methods: {
    confirmLogout() {
      this.form.password = "";
      this.clearErrors();
      this.confirmingLogout = true;
    },

    logoutOtherBrowserSessions() {
      this.loading = true;
      this.$inertia.post(route("other-browser-sessions.destroy"), this.form, {
        preserveScroll: true,
        onProgress: (progress) => {
          this.confirmingLogout = true;
          this.loading = true;
        },
        onSuccess: (page) => {
          if (!this.hasErrors("logoutOtherBrowserSessions")) {
            this.confirmingLogout = false;
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
.w-8 {
  width: 2rem;
}
.h-8 {
  height: 2rem;
}
.text-sm {
  font-size: 0.875rem;
  line-height: 1.25rem;
}

.text-xs {
  font-size: 0.75rem;
  line-height: 1rem;
}
.space-y-6 {
  margin-top: 1.5rem;
  margin-bottom: 1.5rem;
}
</style>
