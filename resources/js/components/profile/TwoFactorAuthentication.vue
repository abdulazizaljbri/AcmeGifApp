<template>
  <v-card elevation="3">
    <v-container>
      <v-card-title class="text-center"> المصادقة الثنائية </v-card-title>
      <v-row align-center justify-center>
        <v-col cols="12" md="4">
          <v-card-subtitle>
            أضف أمانًا إضافيًا إلى حسابك باستخدام المصادقة الثنائية
          </v-card-subtitle>
        </v-col>
        <v-col cols="12" md="8">
          <v-card-text>
            <h3 class="text-lg font-medium gray--text" v-if="twoFactorEnabled">
              لقد قمت بتمكين المصادقة الثنائية
            </h3>

            <h3 class="text-lg font-medium gray--text" v-else>
              لم تقم بتمكين المصادقة الثنائية
            </h3>

            <div class="mt-3 max-w-xl text-sm gray--text">
              <p>
                عند تمكين المصادقة الثنائية ، ستتم مطالبتك برمز آمن وعشوائي
                أثناء المصادقة. يمكنك استرداد هذا الرمز المميز من تطبيق Google
                Authenticator بهاتفك.
              </p>
            </div>
          </v-card-text>
        </v-col>
        <v-col cols="12">
          <v-card-text>
            <div v-if="twoFactorEnabled">
              <v-row>
                <v-col cols="12" md="6" v-if="qrCode">
                  <div class="mt-4 max-w-xl text-sm gray--text">
                    <p class="font-semibold">
                      تم تمكين المصادقة الثنائية الآن. امسح رمز الاستجابة
                      السريعة التالي ضوئيًا باستخدام تطبيق المصادقة بهاتفك.
                    </p>
                  </div>

                  <div
                    class="mt-4 dark:p-4 dark:w-56 dark:bg-white"
                    v-html="qrCode"
                  ></div>
                </v-col>

                <v-col cols="12" md="6" v-if="recoveryCodes.length > 0">
                  <div class="mt-4 max-w-xl text-sm gray--text">
                    <p class="font-semibold">
                      قم بتخزين رموز الاسترداد هذه في مدير كلمات مرور آمن. يمكن
                      استخدامها لاستعادة الوصول إلى حسابك في حالة فقد جهاز
                      المصادقة الثنائية الخاص بك.
                    </p>
                  </div>

                  <div
                    class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg"
                  >
                    <div v-for="code in recoveryCodes" :key="code">
                      {{ code }}
                    </div>
                  </div>
                </v-col>
              </v-row>
            </div>
          </v-card-text>
        </v-col>
        <v-col>
          <v-card-actions>
            <div class="mt-5">
              <div v-if="!twoFactorEnabled">
                <ConfirmsPassword @confirmed="enableTwoFactorAuthentication">
                  <v-btn type="button"  color="primary white--text" :loading="enabling" :disabled="enabling">
                    تفعيل
                  </v-btn>
                </ConfirmsPassword>
              </div>

              <div v-else>
                <ConfirmsPassword
                  @confirmed="regenerateRecoveryCodes"
                  class="mr-3"
                >
                  <v-btn color="accent" dark type="button"  :loading="regenerate"  v-if="recoveryCodes.length > 0">
                    إعادة إنشاء رموز الاسترداد
                  </v-btn>
                </ConfirmsPassword>

                <ConfirmsPassword @confirmed="showRecoveryCodes" class="mr-3">
                  <v-btn  color="accent" dark type="button" :loading="showRecovery" v-if="recoveryCodes.length == 0">
                    إظهار رموز الاسترداد
                  </v-btn>
                </ConfirmsPassword>

                <ConfirmsPassword
                  @confirmed="disableTwoFactorAuthentication"
                  class="mr-3"
                >
                  <v-btn
                    type="button"
                    color="red"
                    dark
                    :loading="disabling"

                  >
                    تعطيل
                  </v-btn>
                </ConfirmsPassword>
              </div>
            </div>
          </v-card-actions>
        </v-col>
      </v-row>
    </v-container>
  </v-card>
</template>
<script>
import ConfirmsPassword from "@/components/profile/ConfirmsPassword";
export default {
  components: { ConfirmsPassword },
  data() {
    return {
      enabling: false,
      disabling: false,
      regenerate:false,
      showRecovery:false,

      qrCode: null,
      recoveryCodes: [],
    };
  },

  methods: {
    enableTwoFactorAuthentication() {
      this.enabling = true;

      this.$inertia
        .post(
          "/user/two-factor-authentication",
          {},
          {
            preserveScroll: true,
          }
        )
        .then(() => {
          return Promise.all([this.showQrCode(), this.showRecoveryCodes()]);
        })
        .then(() => {
          this.enabling = false;
        });
    },

    showQrCode() {
      return axios.get("/user/two-factor-qr-code").then((response) => {
        this.qrCode = response.data.svg;
      });
    },

    showRecoveryCodes() {
        this.showRecovery=true
      return axios.get("/user/two-factor-recovery-codes").then((response) => {
        this.recoveryCodes = response.data;
            this.showRecovery = false;
      });
    },

    regenerateRecoveryCodes() {
            this.regenerate = true;
      axios.post("/user/two-factor-recovery-codes").then((response) => {
        this.showRecoveryCodes();
           this.regenerate = false;
      });
    },

    disableTwoFactorAuthentication() {
      this.disabling = true;

      this.$inertia.post("/user/two-factor-authentication",{"_method":"delete"},{
           preserveScroll: true,
          onProgress: (progress) => {
            this.disabling = true;
          },
          onSuccess: (page) => {
            this.disabling = false;
          },
           onFinish: () => {
          this.disabling = false;
        },
      })

    //   this.$inertia
    //     .delete("/user/two-factor-authentication", {
    //       preserveScroll: true,
    //     })
    //     .then(() => {
    //       this.disabling = false;
    //     });
    },
  },

  computed: {
    twoFactorEnabled() {
      return !this.enabling && this.$page.props.user.two_factor_enabled;
    },
  },
};
</script>
<style>
.text-lg {
  font-size: 1.125rem;
  line-height: 1.75rem;
}
.font-medium {
  font-weight: 500;
}
.text-sm {
  font-size: 0.875rem;
  line-height: 1.25rem;
}
.max-w-xl {
  max-width: 36rem;
}
.grid {
  display: grid;
}
.gap-1 {
  grid-gap: 0.25rem;
  gap: 0.25rem;
}
.font-mono {
  font-family: Menlo, Monaco, Consolas, "Liberation Mono", "Courier New",
    monospace;
}
.bg-gray-100 {
  --bg-opacity: 1;
  background-color: #f4f5f7;
  background-color: rgba(244, 245, 247, var(--bg-opacity));
}
</style>
