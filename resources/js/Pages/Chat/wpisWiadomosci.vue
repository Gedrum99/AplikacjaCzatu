<template>
    <div class="relative h-10 m-1">
        <div style="border-top: 1px solid black;" class="grid grid-cols-6">
            <input
                type="text"
                v-model="message"
                @keyup.enter="sendMessage()"
                placeholder="Napisz coś...."
                class="col-span-5 outline-none p-1"
                />
            <button
                @click="sendMessage()"
                class="place-self-end bg-gray-500 hover:bg-green-700 p-1 rounded text-yellow">
                Wyślij
            </button>
        </div>
    </div>
</template>

<script>
import Button from '../../Jetstream/Button.vue'
import Input from '../../Jetstream/Input.vue'
export default{
  components: { Input, Button },
    props: ['room'],
    data: function(){
        return{
            message:''
        }
    },
    methods:{
        sendMessage(){
            if(this.message==' '){
                return;
            }
            axios.post('/chat/room/'+this.room.id +'/message', {
                message:this.message
            }).then(response=>{
                if(response.status==201){
                    this.message='';
                    this.$emit('messagesend');
                }
            }).catch(error=>{
                console.log(error);
            })
        }
    }
}
</script>