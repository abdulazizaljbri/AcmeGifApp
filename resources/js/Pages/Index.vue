<template>
  <v-container fluid>
     

      <v-row class="my-10" align="center" justify="center">
        <v-col cols="12" md="6" shaped>
              <v-card width="100%" height="400px" class="d-flex justify-center align-center">
                  <v-card-title >
                      قيد التطوير ...
                  </v-card-title>
              </v-card>
        </v-col>
          <v-col cols="12" md="6">
              <v-card width="100%" height="400px" class="d-flex justify-center align-center">
                    <v-card-title  >
                      قيد التطوير ...
                  </v-card-title>
              </v-card>
        </v-col>
      </v-row>
  </v-container>
</template>

<script>
 import AppLayout from '@/Layouts/Layout'
  export default {
      layout:AppLayout,
       metaInfo() {
    return {
      title: this.pageTitle,
    };
  },

  data(){
      return{
          pageTitle:"AcmeGif"
      }
  }

}
</script>

<style>

</style>
