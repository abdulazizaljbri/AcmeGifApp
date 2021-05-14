<template>
  <v-text-field
                v-bind="$attrs"
                v-on="$listeners"
                filled
                :label="label"
                outlined

                 :append-icon="showPassword ? 'fa-eye' : 'fa-eye-slash'"

                :type="showPassword ? 'text' : 'password'"
                @click:append="showPassword = !showPassword"
              />
</template>

<script>
export default {
    props:["label"],
data(){
    return {
        showPassword:false
    }
}
}
</script>

<style>

</style>
