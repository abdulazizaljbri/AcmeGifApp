<template>

      <v-menu
       max-width="250"
        offset-y
        origin="center center"
        :nudge-bottom="10"
        transition="scale-transition"
      >
        <template v-slot:activator="{ on }">
          <div large text v-on="on" style="cursor: pointer">
            <span class="hidden-sm-and-down"> {{ $page.props.user.name  | minUserName}}   </span>


                <v-avatar size="30px">

              <img
                :src="`https://ui-avatars.com/api/?name=${$page.props.user.name}&amp;color=7F9CF5&amp;background=EBF4FF`"
                alt="Avatar"
              />
            </v-avatar>
          </div>
        </template>

        <v-list class="pa-0">




<InertiaLinkBtn
            url="/"
            title="الصفحة الرئيسية"
            icon="fa-home"
            color="theme--light  v-list-item"
          />



          <InertiaLinkBtn
            url="/user/profile"
            title="الملف الشخصي"
            icon="fa-user"
            color="theme--light  v-list-item"
          />
          <InertiaLinkBtn
            url="/logout"
            method="post"
            as="button"

            title="  تسجيل الخروج"
            icon="fa-sign-out-alt"
            color="theme--light v-list-item w-100 "
          />
        </v-list>
      </v-menu>
</template>

<script>
import InertiaLinkBtn from '@/components/InertiaLinkBtn'
export default {
    props:{

        },
    components:{
        InertiaLinkBtn
    },
      filters:{
    minUserName:function(value){
        if (!value) return ''
        return value.slice(0, 15) + (value.length > 15 ? "..." : "")
    }
  },
}
</script>

<style>

</style>
