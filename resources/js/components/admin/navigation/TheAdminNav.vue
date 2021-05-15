<template>
  <div>
    <v-app-bar color="primary" app dark flat>
        <v-app-bar-nav-icon
                @click.stop="drawer = !drawer"
                class="hidden-md-and-up"
            ></v-app-bar-nav-icon>
         <v-toolbar-items class="hidden-sm-and-down">


                <c-inertia-link
                    v-for="item in pages"
                    :title="item.title"
                  
                    :href="item.path"
                    :key="item.title"
                    class="theme--dark v-btn v-list-item nav"
                    preserve-state
                    :color="route().current(item.name)?'v-list-item--active':''"
                />


            </v-toolbar-items>

      <v-spacer />


          <UserMenu  />
    </v-app-bar>
 <home-drawer
            v-model="drawer"
            :items="pages"
            @close-drawer="closeDrawer"
        />

  </div>
</template>

<script>
import UserMenu from "@/components/UserMenu";

import InertiaLinkBtn from "@/components/InertiaLinkBtn";
import {Inertia} from '@inertiajs/inertia'
 
export default {
  components: {
      UserMenu,

    InertiaLinkBtn,
           
        HomeDrawer: () => import("./HomeDrawer"),
  },
  data() {
    return {
        drawer:null,
 

  pages: [
                {title: "Home", path: "/" ,name:"dashboard"},
                {title: "Giphy", path: "/giphy", name:"giphy"},
                {title: "Tenor", path: "/tenor" , name:"tenor"},
               
            ],
    };
  },
   methods: {
        closeDrawer() {
            Inertia.on('finish', () => {
                this.drawer = false;
            })
        }
    },

};
</script>

<style>
.w-100 {
  width: 100%;
}
</style>
