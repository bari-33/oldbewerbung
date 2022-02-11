<template>

    <div class="row">
        <div class="col">
            <input type="text" name="message" class="form-control chat-input" placeholder="Enter your text" v-model="newMessage" @keyup.enter="sendMessage">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-danger chat-send btn-block waves-effect waves-light" @click="sendMessage">Send</button>
        </div>
    </div>

</template>

<script>
    export default {
        props: ['user'],

        data() {
            return {
                newMessage: ''
            }
        },

        methods: {
            sendMessage() {
                this.$emit('messagesent', {
                    user: this.user,
                    message: this.newMessage
                });

                this.newMessage = ''
            }
        }
    }
</script>