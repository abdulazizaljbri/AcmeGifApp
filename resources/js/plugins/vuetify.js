import Vue from 'vue';
import Vuetify from 'vuetify';
// import 'vuetify/dist/vuetify.min.css'
Vue.use(Vuetify);

export default new Vuetify({
    rtl: true,

    defaultAssets: {
        icons: 'fa',

    },
    icons: {
        iconfont: 'fa',
    },
    theme: {

        themes: {
            light: {
                // primary: "#119DA4",
                primary: "#232c32",
                secondary: "#171b34",
                accent: "#3D87E4",
                wdw:"#eee"
            },

        }
    },

});
