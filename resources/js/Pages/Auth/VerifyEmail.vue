<template>
  <v-container class="py-0" fill-height fluid>
    <v-row align="center" justify="center">
      <v-col cols="12" md="6">
        <form @submit.prevent="submit">
          <v-card elevation="3">
              <v-card-title class="primary--text">
                  يرجئ التحقق من بريدك الالكتروني
              </v-card-title>
            <v-card-text>
               شكرا لتسجيلك! قبل البدء ، هل يمكنك التحقق من عنوان بريدك الإلكتروني من خلال النقر على الرابط الذي أرسلناه إليك عبر البريد الإلكتروني للتو؟ إذا لم تتلق البريد الإلكتروني ، فسنرسل لك رسالة أخرى بكل سرور



            </v-card-text>
            <v-card-actions>


              <v-spacer />

                 <v-btn @click.prevent="verifyEmail"  dark
                depressed
                :loading="loading"
                color="primary">
                        إعادة ارسال
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
            title:"تاكيد البريد الإلكتروني  ",

        }
    },
  data() {
    return {
      loading: false,



    };
  },
  methods: {

    verifyEmail() {
      this.loading = true;

    //   this.$inertia
        this.$inertia.post(route('verification.send'),{},{
            preserveScroll: true,
        onProgress: (progress) => {
          this.loading = true;
        },
        onSuccess: (page) => {

          this.loading = false;
        },
        onFinish:()=>{
               this.loading = false;
          }

        } )

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
