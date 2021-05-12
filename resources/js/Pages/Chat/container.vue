<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Witaj {{ $page.props.user.name }} w {{ currentRoom.name }}
      </h2>
    </template>

    <div class="grid grid-flow-col grid-cols-12 gap-4 py-6">
      <div class="col overflow-hidden">
        <span class="py-12">
          <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              <wybor-pokoju
                v-if="currentRoom.id"
                :rooms="chatRooms"
                :currentRoom="currentRoom"
                v-on:roomchanged="setRoom($event)"
              />
            </h2>
          </div>
        </span>
      </div>

      <div class="col-span-12">
        <span class="py-12">
          <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <okno-wiadomosci style="height: 600px" :messages="messages" />
              <wpis-wiadomosci
                :room="currentRoom"
                v-on:messagesend="getMessages()"
              />
            </div>
          </div>
        </span>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import OknoWiadomosci from "./oknoWiadomosci";
import WpisWiadomosci from "./wpisWiadomosci.vue";
import WyborPokoju from "./wyborPokoju.vue";
export default {
  components: {
    AppLayout,
    OknoWiadomosci,
    WpisWiadomosci,
    WyborPokoju,
  },
  data: function () {
    return {
      chatRooms: [],
      currentRoom: [],
      messages: [],
    };
  },
  watch: {
    currentRoom(val, old) {
      if (old.id) {
        this.disconnect(old);
      }
      this.connect();
    },
  },
  methods: {
    connect() {
      if (this.currentRoom.id) {
        let vm = this;
        this.getMessages();
        window.Echo.private("chat." + this.currentRoom.id).listen(
          ".message.new",
          (e) => {
            vm.getMessages();
          }
        );
      }
    },
    disconnect(room) {
      window.Echo.leave("chat." + room.id);
    },
    getRooms() {
      axios
        .get("/chat/rooms")
        .then((response) => {
          this.chatRooms = response.data;
          this.setRoom(response.data[0]);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    setRoom(room) {
      this.currentRoom = room;
    },
    getMessages() {
      axios
        .get("/chat/room/" + this.currentRoom.id + "/messages")
        .then((response) => {
          this.messages = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  created() {
    this.getRooms();
  },
};
</script>
