(self.webpackChunk=self.webpackChunk||[]).push([[193],{5193:(r,s,o)=>{"use strict";o.r(s),o.d(s,{default:()=>n});const t={mounted:function(){var r=this;this.$nextTick((function(){r.clearErrors()}))},data:function(){return{loading:!1,form:{current_password:"",password:"",password_confirmation:""}}},methods:{reset:function(){this.form={current_password:"",password:"",password_confirmation:""}},updatePassword:function(){var r=this;this.loading=!0,this.$inertia.put(route("user-password.update"),this.form,{preserveScroll:!0,onProgress:function(s){r.loading=!0},onSuccess:function(s){r.hasErrors()||r.reset(),r.loading=!1},onFinish:function(){r.loading=!1}})}}};const n=(0,o(1900).Z)(t,(function(){var r=this,s=r.$createElement,o=r._self._c||s;return o("v-card",{attrs:{elevation:"3"}},[o("v-container",[o("form",{on:{submit:function(s){return s.preventDefault(),r.updatePassword(s)}}},[o("v-card-title",{staticClass:"text-center"},[r._v(" تغيير كلمة المرور ")]),r._v(" "),o("v-row",{attrs:{"align-center":"","justify-center":""}},[o("v-col",{attrs:{cols:"12",md:"4"}},[o("v-card-subtitle",[r._v("\n            اعادة تعيين كلمة المرور الخاص بك\n          ")])],1),r._v(" "),o("v-col",{attrs:{cols:"12",md:"8"}},[o("v-card-text",[o("c-password",{attrs:{name:"current_password",label:"كلمة المرور الحالية"},model:{value:r.form.current_password,callback:function(s){r.$set(r.form,"current_password",s)},expression:"form.current_password"}}),r._v(" "),o("c-password",{attrs:{name:"password",label:"كلمة المرور الجديدة"},model:{value:r.form.password,callback:function(s){r.$set(r.form,"password",s)},expression:"form.password"}}),r._v(" "),o("c-password",{attrs:{label:"تاكيد كلمة المرور",name:"password_confirmation"},model:{value:r.form.password_confirmation,callback:function(s){r.$set(r.form,"password_confirmation",s)},expression:"form.password_confirmation"}})],1)],1),r._v(" "),o("v-col",[o("v-card-actions",[o("v-btn",{attrs:{type:"submit",color:"primary white--text",loading:r.loading,disabled:r.loading}},[r._v("\n              تغيير كلمة المرور\n            ")])],1)],1)],1)],1)])],1)}),[],!1,null,null,null).exports}}]);
//# sourceMappingURL=193.js.map