(self.webpackChunk=self.webpackChunk||[]).push([[405],{9195:(t,n,e)=>{"use strict";e.d(n,{Z:()=>c});var i=e(4015),s=e.n(i),r=e(3645),l=e.n(r)()(s());l.push([t.id,".text-decoration-inherit{text-decoration:inherit}","",{version:3,sources:["webpack://./resources/js/components/shared/cInertiaLinkItem.vue"],names:[],mappings:"AAkCA,yBACA,uBACA",sourcesContent:['<template>\n  <c-inertia-link\n    class=" v-list-item v-list-item--link  "\n    :href="href"\n    v-bind="$attrs"\n    @click="$emit(\'close-drawer\')"\n  >\n    <v-list-item-action class="ml-3" v-if="icon != \'\'">\n      <v-icon>{{ icon }}</v-icon>\n    </v-list-item-action>\n    <v-list-item-content>{{ title }}</v-list-item-content>\n  </c-inertia-link>\n</template>\n\n<script>\nexport default {\n  props: {\n    href: {\n      type: String,\n      default: "/",\n    },\n    title: {\n      type: String,\n      default: "",\n    },\n    icon: {\n      type: String,\n      default: "",\n    },\n  },\n};\n<\/script>\n\n<style>\n.text-decoration-inherit {\n  text-decoration: inherit;\n}\n</style>\n'],sourceRoot:""}]);const c=l},1405:(t,n,e)=>{"use strict";e.r(n),e.d(n,{default:()=>o});const i={props:{href:{type:String,default:"/"},title:{type:String,default:""},icon:{type:String,default:""}}};var s=e(3379),r=e.n(s),l=e(9195),c={insert:"head",singleton:!1};r()(l.Z,c);l.Z.locals;const o=(0,e(1900).Z)(i,(function(){var t=this,n=t.$createElement,e=t._self._c||n;return e("c-inertia-link",t._b({staticClass:" v-list-item v-list-item--link  ",attrs:{href:t.href},on:{click:function(n){return t.$emit("close-drawer")}}},"c-inertia-link",t.$attrs,!1),[""!=t.icon?e("v-list-item-action",{staticClass:"ml-3"},[e("v-icon",[t._v(t._s(t.icon))])],1):t._e(),t._v(" "),e("v-list-item-content",[t._v(t._s(t.title))])],1)}),[],!1,null,null,null).exports}}]);
//# sourceMappingURL=405.js.map