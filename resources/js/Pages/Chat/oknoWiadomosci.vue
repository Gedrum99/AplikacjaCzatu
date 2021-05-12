<template>
    <div class="h-96 w-full">
        <div class="h-full p-2 flex flex-col-reverse overflow-scroll">
            <div v-for="(message,i) in messages" :key="i">
                <wiadomosc :message="message"/>
            </div>
        </div>
    </div>
</template>

<script>
import wiadomosc from './wiadomosc.vue'
export default{
  components: { wiadomosc },
    props:['messages'],
}
</script>