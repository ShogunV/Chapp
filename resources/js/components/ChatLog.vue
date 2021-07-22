<template>
  <div class="chat-log" :class="theme">
    <p v-if="theme === 'terminal'" class="head">
      /Documents/Room/{{ roomName }}
    </p>
    <chat-message
      v-for="message in messages"
      :message="message"
      :key="message.id"
      :class="{
        me: isMe(message.user.name),
        'not-me': !isMe(message.user.name),
      }"
    >
      <small slot="author">{{ message.user.name }}</small>
      <p slot="message">{{ message.message }}</p>
    </chat-message>
    <div class="empty" v-show="messages.length === 0">No messages!!!</div>
  </div>
</template>

<script>
import ChatMessage from "./ChatMessage.vue";
export default {
  name: "ChatLog",

  props: ["messages", "roomName"],

  data() {
    return {
      theme: Event.theme || "bubbles",
    };
  },

  methods: {
    isMe(user) {
      return (
        user.trim() ==
        document
          .querySelector(".navbar-right .dropdown-toggle")
          .textContent.trim()
      );
    },
  },

  created() {
    Event.$on("themeChanged", (theme) => (this.theme = theme));
  },

  updated: function () {
    let el = document.querySelector(".chat-log");
    el.scrollTop = el.scrollHeight;
  },

  components: {
    "chat-message": ChatMessage,
  },
};
</script>

<style lang="css" scoped>
.chat-log {
  height: 90%;
  overflow-y: auto;
}
.terminal {
  background-color: black;
  color: #00ff00;
  font-family: monospace;
  border-top-left-radius: 4px;
  border-top-right-radius: 4px;
}
.head {
  text-align: center;
  color: #525252;
  padding: 5px 0;
  margin: 0;
  text-shadow: 1px 1px 0 rgba(255, 255, 255, 0.5);
  font-size: 0.85em;
  border: 1px solid #cccccc;
  border-bottom: none;
  border-top-left-radius: 3px;
  border-top-right-radius: 3px;
  background: #f7f7f7;
  background: linear-gradient(to bottom, #f7f7f7 0%, #b8b8b8 100%);
}
@media (max-height: 700px) {
  .chat-log {
    height: 85%;
  }
}
@media (max-height: 600px) {
  .chat-log {
    height: 80%;
  }
}
@media (max-height: 600px) {
  .chat-log {
    height: 70%;
  }
}
</style>
