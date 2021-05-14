require('./bootstrap');

// Import modules...
import Vue from 'vue';

import vuetify from "./plugins/vuetify"

import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue';
// import PortalVue from 'portal-vue';
import { Inertia } from '@inertiajs/inertia'
import NProgress from 'nprogress'

import InteractsWithErrorBags from './Mixins/InteractsWithErrorBags'


require('./plugins/vue-meta');
Vue.mixin({ methods: { route } });
Vue.use(InertiaPlugin);

Vue.mixin(InteractsWithErrorBags);



Inertia.on('start', () => {  NProgress.configure({showSpinner: false,}).start();})
Inertia.on('finish', () => {  NProgress.done();})



Vue.component("cTextField",() => import("@/components/shared/cTextField"))
Vue.component("cCard",() => import("@/components/shared/cCard"))
Vue.component("cTextarea",() => import("@/components/shared/cTextarea"))
Vue.component("cSelect",() => import("@/components/shared/cSelect"))
Vue.component("cTextField",() => import("@/components/shared/cTextField"))
Vue.component("cPassword",() => import("@/components/shared/cPassword"))
Vue.component("cInertiaLink",() => import("@/components/shared/cInertiaLink"))
Vue.component("cInertiaLinkItem",() => import("@/components/shared/cInertiaLinkItem"))





const app = document.getElementById('app');

new Vue({
    mounted() {

        window.addEventListener('popstate', () => {
          this.$inertia.reload({preserveScroll: true, preserveState: false})
        })
      },
      metaInfo() {
        return {
          title:"قيدالتحميل",
        };
      },

    vuetify,
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
