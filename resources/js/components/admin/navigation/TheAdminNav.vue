<template>
  <div>
    <v-app-bar color="primary" app dark flat>

      <v-spacer />


          <UserMenu  />
    </v-app-bar>


  </div>
</template>

<script>
import UserMenu from "@/components/UserMenu";

import InertiaLinkBtn from "@/components/InertiaLinkBtn";

 
export default {
  components: {
      UserMenu,

    InertiaLinkBtn,
  },
  data() {
    return {


    };
  },
  methods: {

  },

};
</script>

<style>
.w-100 {
  width: 100%;
}
</style>
