<template>
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
      <router-link to="/" exact class="navbar-brand"
        ><img src="/img/ChappBrandLogo.png"
      /></router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div
        class="collapse navbar-collapse d-flex justify-content-end"
        id="navbarSupportedContent"
      >
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto"></ul>

        <!-- Right Side Of Navbar -->
        <navbar-auth-links></navbar-auth-links>
      </div>
    </div>
  </nav>
</template>

<script>
import NavbarAuthLinks from './NavbarAuthLinks'
export default {
  name: "NavbarBar",

  components: {
    "navbar-auth-links": NavbarAuthLinks,
  },
};
</script>

<style lang="css" scoped></style>
