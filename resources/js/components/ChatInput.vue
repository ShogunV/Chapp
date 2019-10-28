<template>
<div class="chat-input" :class="theme">
    <div v-if="theme == 'bubbles'">
        <input type="text" name="message" class="offset-sm-2 col-sm-7 offset-xs-1 col-xs-8" placeholder="Your message goes here ..." v-model="messageText" v-focus @keyup.enter="sendMessage">
        <button type="button" class="btn btn-primary" @click="sendMessage">Send</button>
    </div>
    <div v-if="theme == 'terminal'">
        <div><label>? Users/{{ user }}></label><input type="text" name="message" v-model="messageText" @keyup.enter="sendMessage" v-focus autofocus></div>
    </div>
</div>
</template>

<script>
export default {

    name: 'ChatInput',

    data () {
        return {
            messageText: '',
            theme: Event.theme || 'bubbles',
            user: this.$auth.getAuthenticatedUser().name
        };
    },

    methods: {
        sendMessage () {
            this.$emit('messagesent', {
                message: this.messageText,
                user: {name: this.user || $('.navbar-right .dropdown-toggle').text().trim()},
            room: window.location.pathname.substring(6)
            });
            this.messageText = '';
        }
    },

    created(){
        Event.$on('themeChanged', theme => {
            this.theme = theme;
            this.user = this.$auth.getAuthenticatedUser().name;
        });
    }
};
</script>

<style lang="css" scoped>
.chat-input input {
    height: 36px;
}
.chat-input button {
    margin: 0 10px;
}
.terminal, .terminal input {
    background-color: black;
    color: #00ff00;
    border: none;
    outline: none;
}
.terminal div {
    font-family: monospace;
    display: flex;
    width: 100%;
}
.terminal label {
    padding-top: 7px;
    margin-left: 5px;

}
.terminal input {
    flex-grow: 1;
    margin-right: 5px;
}
</style>