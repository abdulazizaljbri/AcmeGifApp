<template>
  <v-tabs
    v-model="tab"
    centered
    leave-absolute
    show-arrows
    background-color="primary"
    height="80"
    dark
  >
    <v-tab
      href="#info"
      v-if="$page.props.jetstream.canUpdateProfileInformation"
    >
      البيانات الشخصية
    </v-tab>
    <v-tab href="#account_settings"> اعدادات الحساب </v-tab>


    <v-tabs-items
      v-model="tab"
      background-color="transparent"
      class="transparent"
    >
      <v-container>
        <v-tab-item
          value="info"
          v-if="$page.props.jetstream.canUpdateProfileInformation"
        >
          <UpdateProfileInformation :user="$page.props.user" />
        </v-tab-item>

        <v-tab-item value="account_settings">
          <div v-if="$page.props.jetstream.canUpdatePassword">
            <UpdatePassword />
          </div>

          <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
            <TwoFactorAuthentication class="my-15" />
          </div>

          <LogoutOtherBrowserSessions :sessions="sessions" class="my-15" />

          <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
            <DeleteUser class="my-15" />
          </template>
        </v-tab-item>
      </v-container>
    </v-tabs-items>
  </v-tabs>
</template>

    <script>
import AppLayout from "@/Layouts/Layout";

export default {
  layout: AppLayout,
  metaInfo() {
    return {
      title: `الملف الشخصي`,
    };
  },
  props: ["sessions"],

  components: {
    UpdateProfileInformation: () =>
      import("@/components/profile/UpdateProfileInformation"),
    UpdatePassword: () => import("@/components/profile/UpdatePassword"),
    LogoutOtherBrowserSessions: () =>
      import("@/components/profile/LogoutOtherBrowserSessions"),
    DeleteUser: () => import("@/components/profile/DeleteUser"),
    TwoFactorAuthentication: () =>
      import("@/components/profile/TwoFactorAuthentication"),
  },
  data() {
    return {
      tab: null,
    };
  },
};
</script>

    <style>
.v-tabs-bar {
  border-radius: unset;
}
</style>
