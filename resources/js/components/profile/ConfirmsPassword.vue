<template>
  <span>
    <span @click="startConfirmingPassword">
      <slot />
    </span>
    <v-dialog v-model="confirmingPassword" persistent max-width="500">
      <v-card>
        <v-card-title class="headline">
          {{ title }}
        </v-card-title>
        <v-card-text>
          <p>
            {{ content }}
          </p>

          <v-text-field
            v-model="form.password"
            label="كلمة السر "
            ref="password"
            @keyup.enter.native="confirmPassword"
            append-icon="fa-key"
            outlined
            type="password"
            name="password"
            :class="{ 'is-invalid': form.error }"
            :error="!!form.error"
            :error-messages="form.error"
          />
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary white--text"
            dark
            @click="confirmingPassword = false"
          >
            لا
          </v-btn>
          <v-btn
            color="primary white--text"
            dark
            @click="confirmPassword"
            :loading="loading"
          >
            {{ button }}
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </span>
</template>
<script>
export default {
  props: {
    title: {
      default: "تاكيدد كلمة المرور",
    },
    content: {
      default: "لحمايتك ، يرجى تأكيد كلمة المرور الخاصة بك للمتابعة.",
    },
    button: {
      default: "تاكيد",
    },
  },

  data() {
    return {
      loading: false,
      confirmingPassword: false,

      // form: this.$inertia.form({
      //     password: '',
      //     error: '',
      // }, {
      //     bag: 'confirmPassword',
      // }),
      form: {
        password: "",
        error: "",
      },
    };
  },

  methods: {
    startConfirmingPassword() {
      this.form.error = "";
      // make sure if it confirm password or not
      axios.get(route("password.confirmation")).then((response) => {
        if (response.data.confirmed) {
          this.$emit("confirmed");
        } else {
          this.confirmingPassword = true;
          this.form.password = "";
 
        }
      });
    },

    confirmPassword() {
      this.loading = true;

      axios
        .post(route("password.confirm"), {
          password: this.form.password,
        })
        .then((response) => {
          this.confirmingPassword = false;
          this.form.password = "";
          this.form.error = "";
          this.loading = false;

          this.$nextTick(() => this.$emit("confirmed"));
        })
        .catch((error) => {
          this.loading = false;
          this.form.error = error.response.data.errors.password[0];
        });
    },
  },
};
</script>
