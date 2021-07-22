<template>
  <div>
    <div class="text-center logo-container">
      <img src="img/ChappLogo.png" class="text-center img-fluid" />
    </div>

    <h2 class="text-center">Welcome to Chapp, a simple chat app!!!</h2>
    <h3 class="text-center" v-if="isAuth">
      Please <router-link to="/login" exact>Log in</router-link> or
      <router-link to="/register" exact>Register</router-link>
    </h3>
  </div>
</template>

<script>
export default {
  name: "Start",

  data() {
    return {};
  },

  computed: {
    isAuth: function () {
      return !this.$auth.isAuthenticated();
    },
  },
};
</script>

<style lang="css" scoped>
.logo-container {
  height: 300px;
  width: 300px;
  margin: 0 auto;
}
h2 {
  margin-top: 50px;
}
a {
  text-decoration: none;
  color: #ad7ab5;
}
a:hover {
  color: #874c9e;
}
</style>
