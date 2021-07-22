<template>
  <div>
    <div class="choose-theme">
      <button
        type="button"
        name="theme"
        class="btn btn-sm btn-secondary theme"
        id="bubbles"
        value="bubbles"
        @click="changeTheme('bubbles')"
        :class="{ active: theme == 'bubbles' }"
      >
        bubbles
      </button>
      <button
        type="button"
        name="theme"
        class="btn btn-sm btn-secondary theme"
        id="terminal"
        value="terminal"
        @click="changeTheme('terminal')"
        :class="{ active: theme == 'terminal' }"
      >
        terminal
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "choose-theme",

  data() {
    return {
      theme: Event.theme || "bubbles",
    };
  },

  methods: {
    changeTheme(newTheme) {
      if (this.theme !== newTheme) {
        this.theme = newTheme;
        Event.$emit("themeChanged", this.theme);
        Event.theme = this.theme;
      }
    },
  },
};
</script>

<style lang="css" scoped>
button {
  cursor: pointer;
}
.choose-theme {
  display: block;
  text-align: right;
  margin-bottom: 10px;
}
</style>
