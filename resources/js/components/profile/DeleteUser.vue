<template>
  <v-card elevation="3">
    <v-container>
      <v-card-title> حذف الحساب </v-card-title>
      <v-row>
        <v-col cols="12" md="4">
          <v-card-subtitle> حذف الحساب بشكل نهائي </v-card-subtitle>
        </v-col>
        <v-col cols="12" md="8">
          <v-card-text>
            <p>بمجرد حذف حسابك ، سيتم حذف جميع بياناتك نهائيًا</p>

            <div class="mt-5">
              <v-btn color="red" dark @click.native="confirmUserDeletion">
                حذف الحساب
              </v-btn>
            </div>
          </v-card-text>
        </v-col>
      </v-row>
    </v-container>

    <!-- Delete Account Confirmation Modal -->

    <v-dialog v-model="confirmingUserDeletion" persistent max-width="500">
      <v-card>
        <v-card-title class="headline"> حذف الحساب </v-card-title>
        <v-card-text>
          <p>
            هل انت متأكد انك تريد حذف حسابك؟ بمجرد حذف حسابك ، سيتم حذف جميع
            بياناتك نهائيًا. الرجاء إدخال كلمة المرور الخاصة بك لتأكيد رغبتك في
            حذف حسابك بشكل دائم.
          </p>

          <c-password
            name="password"
            label="كلمة المرور"
            v-model="form.password"
            ref="password"
            @keyup.enter.native="deleteUser"
          />
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="gray darken-1"
            dark
            @click="confirmingUserDeletion = false"
          >
            لا
          </v-btn>
          <v-btn
            color="red darken-1"
            dark
            @click="deleteUser"
            :loading="loading"
          >
            حذف الحساب
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-card>
</template>

<script>
export default {
  data() {
    return {
      confirmingUserDeletion: false,
      deleting: false,
      loading: false,

      form: {
        _method: "DELETE",
        password: "",
      },
    };
  },

  methods: {
    confirmUserDeletion() {
      this.form.password = "";
      this.clearErrors();

      this.confirmingUserDeletion = true;
    },

    deleteUser() {
      this.loading = true;
      this.$inertia.post(route("current-user.destroy"), this.form, {
        preserveScroll: true,
        onProgress: (progress) => {
          this.loading = true;
        },
        onSuccess: (page) => {
          this.loading = false;

          if (!this.hasErrors("deleteUser")) {
            this.confirmingUserDeletion = false;
          }
        },
        onFinish: () => {
          this.loading = false;
        },
      });
    },
  },
};
</script>
