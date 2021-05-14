<template>

     <v-snackbar
      v-model="snackbar"
      :timeout="timeout"
      shaped
      top

       :color="color"
    >
      {{ message }}

      <template v-slot:action="{ attrs }">
        <v-btn
          text
          v-bind="attrs"
          @click="snackbar =false"

        >
          <!-- :color="color" -->
          اغلاق
        </v-btn>
      </template>
    </v-snackbar>
</template>

<script>
export default {
    props:["flash","show"],
    computed:{

        snackbar:{
            get(){
                  return  this.flash.showing
                // return true
            },
            set(value){
                return  this.flash.showing=false
            }
        },
        message(){
            if(this.flash.success){
                return this.flash.success;
            }else if(this.flash.status){
                return this.flash.status;
            }else if(this.flash.error){
               return this.flash.error;
            }
            return ""
            // return this.flash.showing ?(this.flash.success ? this.flash.success : this.flash.error):""
        },
        color(){

             return this.flash.showing ? (this.flash.success || this.flash.status? "success" : "red"):""
        }
    },
data(){
    return {

        timeout:10000,
        // timeout:-1,

    }
}
}
</script>

<style>

</style>
