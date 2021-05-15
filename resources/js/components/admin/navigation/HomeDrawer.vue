<template>
  <v-navigation-drawer
    bottom
    color="transparent"
    height="auto"
    fixed
    overlay-color="secondary"
    overlay-opacity=".8"
    temporary
    v-bind="$attrs"
  >
  
    <v-list color="white" shaped>
      <v-list-item v-for="item in items" :key="item.title" color="primary">
          <c-inertia-link-item 
           :href="item.path" 
           :title="item.title"
           
           
             color=" v-btn v-list-item  theme--light "
             :class="route().current(item.name)?'v-list-item--active primary ':''"
             
             @close-drawer="$emit('close-drawer')"
            />
         
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
 
export default {
  name: "HomeDrawer",  
 

  props: {
    items: {
      type: Array,
      default: () => [],
    },
  },
};
</script>
