<template>
  <div class="chat-screen">
    <h1>Let's chat!!!</h1>
    <choose-theme></choose-theme>
    <chat-log :messages="messages" :roomName="roomName"></chat-log>
    <chat-input v-on:messagesent="addMessage"></chat-input>
    <router-link to="/waitingroom" class="btn btn-default btn-lg back-btn"
      >Back</router-link
    >
  </div>
</template>

<script>
import ChatInput from "./ChatInput.vue";
import ChatLog from "./ChatLog.vue";
import ChooseTheme from "./ChooseTheme.vue";
export default {
  name: "Room",

  data() {
    return {
      messages: [],
      roomName: "",
    };
  },

  methods: {
    addMessage(message) {
      let token = this.$auth.getToken();
      this.messages.push(message);
      axios({
        method: "post",
        url: "/api/messages",
        data: message,
        headers: {
          Authorization: "Bearer " + token,
        },
      })
        .then((response) => {})
        .catch((e) => {});
    },
  },
  mounted() {
    let token = this.$auth.getToken();
    axios
      .get("/api/messages", {
        params: {
          room: window.location.pathname.substring(6),
        },
        respose: "json",
        headers: {
          Authorization: "Bearer " + token,
        },
      })
      .then((response) => {
        this.messages = response.data.messages;
        this.roomName = response.data.room.name;
      });

    let roomNumber = window.location.pathname.substring(6);
    let room = `room.${roomNumber}`;

    Echo.private(room).listen("MessageCreated", (e) => {
      this.messages.push({
        message: e.message.message,
        user: e.user,
        room: e.room,
      });
    });
  },

  components: {
    "chat-input": ChatInput,
    "chat-log": ChatLog,
    "choose-theme": ChooseTheme,
  },
};
</script>

<style lang="css" scoped>
.chat-screen {
  height: 94%;
}
.back-btn {
  margin-top: 5px;
}
@media (max-height: 700px) {
  h1 {
    font-size: 18px;
  }
}
</style>
