require("./bootstrap");

import Vue from "vue/dist/vue";
import VueRouter from "vue-router";
import router from "./Routes";
Vue.use(VueRouter);

import Auth from "./Auth.js";
Vue.use(Auth);

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.forVisitors)) {
    if (Vue.auth.isAuthenticated()) {
      next({ path: "/waitingroom" });
    } else next();
  } else if (to.matched.some(record => record.meta.forAuth)) {
    if (!Vue.auth.isAuthenticated()) {
      next({ path: "/login" });
    } else next();
  } else next();
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component("start", require("./components/Start.vue").default);
Vue.component("navbar", require("./components/Navbar.vue").default);

window.Event = new Vue();

Vue.directive("focus", {
  // When the bound element is inserted into the DOM...
  inserted: function(el) {
    // Focus the element
    el.focus();
  }
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  el: "#app",
  // render: h => h(App),
  router: router
});
