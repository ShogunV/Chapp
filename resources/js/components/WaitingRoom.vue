<template>
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          Rooms
          <router-link to="/newroom" class="btn btn-sm btn-primary float-right"
            >New</router-link
          >
        </div>
        <!-- if rooms > 0 -->
        <div class="card-body" v-if="rooms && rooms.length > 0">
          <div
            class="d-flex justify-content-between"
            v-for="room in rooms"
            v-bind:key="room.id"
          >
            <router-link :to="{ name: 'room', params: { id: room.id } }">{{
              room.name
            }}</router-link>
            <button
              class="btn btn-sm btn-danger float-right"
              @click="deleteRoom(room)"
              v-if="room.creator_id === user.id"
            >
              delete
            </button>
          </div>
        </div>
        <!-- else -->
        <div class="card-body" v-else>No rooms here!</div>
        <!-- endif -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "WaitingRoom",

  data() {
    return {
      rooms: null,
      user: this.$auth.getAuthenticatedUser(),
    };
  },

  methods: {
    deleteRoom(room) {
      this.rooms = this.rooms.filter((e) => e !== room);
      let token = this.$auth.getToken();
      axios({
        method: "delete",
        url: "api/room",
        data: {
          id: room.id,
          user: this.user,
        },
        headers: {
          Authorization: "Bearer " + token,
        },
      })
        .then((response) => {})
        .catch((e) => {
          this.errors = e.response.data;
        });
    },
  },

  mounted() {
    let token = this.$auth.getToken();
    axios({
      method: "get",
      url: "/api/waitingroom",
      headers: {
        Authorization: "Bearer " + token,
      },
    }).then((response) => {
      this.user = this.$auth.getAuthenticatedUser();
      this.rooms = response.data.rooms;
    });

    Echo.private("waitingroom")
      .listen("RoomCreated", (e) => {
        this.rooms.push({
          id: e.room.id,
          name: e.room.name,
          creator_id: e.room.creator_id,
        });
      })
      .listen("RoomDestroyed", (e) => {
        this.rooms = this.rooms.filter((item) => item.id !== e.room.id);
      });
  },
};
</script>

<style lang="css" scoped>
</style>
