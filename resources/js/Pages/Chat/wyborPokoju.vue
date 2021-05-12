<template>
  <div>
    <div class="overflow-y-scroll" style="background-color:lightblue">
      <div class="py-2 border" v-for="(room, i) in rooms" :key="i" :value="room">
        <button v-on:click="ZmienPokoj(room)">
          {{ room.name }}
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["rooms", "currentRoom"],
  data: function () {
    return {
      selected: "",
    };
  },
  created() {
    this.selected = this.currentRoom;
  },
  methods: {
    ZmienPokoj(pokoj) {
      this.selected = pokoj;
      this.$emit("roomchanged", this.selected);
    },
  },
};
</script>