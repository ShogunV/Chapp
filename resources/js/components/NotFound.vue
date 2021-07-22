<template>
  <div class="text-center">
    <h1>404</h1>
    <h1>Place you were looking for is not there!</h1>
    <h1>We think you might be lost!</h1>
    <h1>Please go <router-link to="/" exact>home</router-link> !</h1>
  </div>
</template>

<script>
export default {
  name: "NotFound",

  data() {
    return {};
  },
};
</script>

<style lang="css" scoped>
</style>
