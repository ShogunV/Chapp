<template>
  <div class="chat-message">
    <div class="message" v-if="test">
      <slot name="message"></slot>
      <slot name="author"></slot>
    </div>
    <div class="message" v-if="!test">
      <div>$ Users/<slot name="author"></slot>></div>
      <slot name="message"></slot>
    </div>
  </div>
</template>

<script>
export default {
  name: "ChatMessage",

  props: ["message"],

  data() {
    return {
      theme: "bubbles",
    };
  },

  computed: {
    test() {
      if (this.$parent.theme == "bubbles") {
        return true;
      } else {
        return false;
      }
    },
  },

  created() {
    Event.$on("themeChanged", (theme) => (this.theme = theme));
  },
};
</script>

<style lang="css" scoped>
.bubbles .chat-message {
  display: flex;
  margin-bottom: 10px;
}
.bubbles .message {
  background: white;
  padding: 10px;
  border-radius: 10px;
  box-shadow: 0 1px 2px rgba(black, 0.2);
  max-width: 90%;
  margin: 20px;
}
.bubbles .me .message {
  position: relative;
}
.bubbles .me .message:before {
  content: "";
  width: 0px;
  height: 0px;
  position: absolute;
  border-left: 10px solid transparent;
  border-right: 10px solid white;
  border-top: 10px solid white;
  border-bottom: 10px solid transparent;
  left: -19px;
  top: 6px;
}
.bubbles .not-me {
  justify-content: flex-end;
  align-items: flex-end;
}
.bubbles .not-me small {
  display: block;
  text-align: right;
}
.bubbles .not-me .message {
  color: white;
  background-color: #ad7ab5;
  position: relative;
}
.bubbles .not-me .message:before {
  content: "";
  width: 0px;
  height: 0px;
  position: absolute;
  border-left: 10px solid #ad7ab5;
  border-right: 10px solid transparent;
  border-top: 10px solid #ad7ab5;
  border-bottom: 10px solid transparent;
  right: -19px;
  top: 6px;
}
.terminal .message {
  background-color: #141414;
  color: #00ff00;
  margin-left: 5px;
}
.terminal .not-me .message {
  color: white;
}
.terminal .chat-message div,
.terminal .chat-message p {
  display: inline;
}
</style>
