<template>
  <v-textarea
    v-bind="$attrs"
    outlined
    dense
    @keydown="clearError(name)"
    v-on="$listeners"
    :error="!!errorFor(name)"
    :error-messages="errorFor(name)"
  />

</template>

<script>
import _ from 'lodash'
export default {
   name:"customTextarea",
  props: {
    name: {
      type: String,
      required: true,
    },
  },
  methods:{
    clearError:_.throttle(function(name)  {
      this.clearErrors(name)

    }, 2000),

  }
}
</script>

<style>
</style>
