<template>
  <div>
    <div class="card sm:rounded-lg border border-4">
      <div class="card-header bg-gray-200" style="font-weight:bolder, font-size:16px">{{ message.user.name }}:</div>
      <div class="card-body" style="font-size:20px">{{ message.message }}</div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["message"],
};
</script>