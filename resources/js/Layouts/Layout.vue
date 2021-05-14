<template>
  <v-app>
    <navbar />
    <v-main>


      <slot />
  <confirm ref="confirm"></confirm>
    </v-main>
  </v-app>
</template>

<script>
import navbar from "@/components/admin/navigation/TheAdminNav";
import Confirm from "@/components/Confirm.vue";
export default {
  components: { navbar ,Confirm},
  metaInfo() {
    return {
        title:"اسم الموقع"
      //   titleTemplate: (title) => title ? `${title} - ${this.$page.props.company.name}` : `${this.$page.props.company.name}`
    };
  },
    mounted() {
         this.$root.$confirm = this.$refs.confirm;
   }
};
</script>
<style  >
.v-main {
  background-color: #efefef;
}
</style>
