<template>
  <v-card elevation="3">
    <v-container>
      <v-card-subtitle class="text-center">
        تعديل البيانات الشخصية
      </v-card-subtitle>
      <form @submit.prevent="updateProfileInformation">
        <v-row align="center">
          <v-col cols="12" sm="8" order="2" order-sm="1">

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

          </v-col>
          <v-col cols="12" sm="4" order="1" order-sm="2">
            <div
              class="d-flex justify-center align-center flex-column flex-wrap"
            >
              <div class="flex-grow-1">
                <input
                  type="file"
                  accept="image/*"
                  class="d-none"
                  ref="photo"
                  @change="updatePhotoPreview"
                />
                <v-avatar color="black" size="200">
                  <v-img
                    contain
                    :src="`${user.profile_photo_url}`"
                    v-if="user.profile_photo_url && !photoPreview"
                    maxHeight="200"
                    maxWidth="200"
                    class="img-fluid"
                  ></v-img>
                  <v-img
                    contain
                    ref="mylogo"
                    :src="photoPreview"
                    v-if="photoPreview"
                    class="img-fluid"
                    maxHeight="250"
                    maxWidth="250"
                  ></v-img>
                </v-avatar>

                <div
                  v-show="errorFor('photo', 'default')"
                  class="my-2"
                />
                <p class="text-sm red--text">
                  {{ errorFor("photo", "default") }}
                </p>
              </div>
            </div>
            <div class="d-flex flex-wrap justify-center">
              <v-btn
                class="ma-2"
                type="button"
                @click.prevent="selectNewPhoto"
                color="primary white--text"
              >
                اختيار صورة
              </v-btn>
              <v-btn
                type="button"
                class="ma-2"
                @click.prevent="open"
                :loading="loading_ph"
                color="red"
                dark
                v-if="user.profile_photo_path"
              >
                حذف الصورة
              </v-btn>
            </div>
          </v-col>
        </v-row>
        <v-card-actions>
          <v-btn
            type="submit"
            :disabled="loading"
            :loading="loading"
            class="white--text"
            color="primary"
          >
            تعديل
          </v-btn>
        </v-card-actions>
      </form>
    </v-container>
    <confirm ref="confirm"></confirm>
  </v-card>
</template>
<script>
import Confirm from "@/components/Confirm";
export default {
  props: ["user"],
  components: { Confirm },

  data() {
    return {
      loading: false,
      loading_ph: false,

      form: {
        name: this.user.name,
        email: this.user.email,
        photo: null,
      },

      photoPreview: null,
    };
  },
  methods: {
    updateProfileInformation() {
      let data = new FormData();
      data.append("_method", "PUT");
      data.append("name", this.form.name);
      data.append("email", this.form.email);
      if (this.$refs.photo.files[0]) {
        this.form.photo = this.$refs.photo.files[0];

        data.append("photo", this.$refs.photo.files[0]);
      }
      this.loading = true;
      this.$inertia.post(route("user-profile-information.update"), data, {
        preserveScroll: true,
        onProgress: (progress) => {
          this.loading = true;
        },
        onSuccess: (page) => {
          this.loading = false;
          // console.log(this.hasErrors())
        },
        onFinish: () => {
          this.loading = false;
          // console.log(this.hasErrors())
        },
      });
    },

    selectNewPhoto() {
      this.$refs.photo.click();
    },

    updatePhotoPreview() {
      const reader = new FileReader();

      reader.onload = (e) => {
        this.photoPreview = e.target.result;
      };

      reader.readAsDataURL(this.$refs.photo.files[0]);
    },

    open() {
      this.$refs.confirm
        .open("حذف", "هل تريد حذف الصورة الشخصية", { color: "red" })
        .then((confirm) => {
          if (confirm) {
            this.deletePhoto();
          }
        });
    },

    deletePhoto() {
      this.loading_ph = true;

      this.$inertia.delete(route("current-user-photo.destroy"), {
        preserveScroll: true,
        onProgress: (progress) => {
          this.loading_ph = true;
        },
        onSuccess: (page) => {
          if (!this.hasErrors()) {
            this.photoPreview = null;
          }
          this.loading_ph = false;
        },
        onFinish: () => {
          this.loading = false;
        },
      });
    },
  },
};
</script>
