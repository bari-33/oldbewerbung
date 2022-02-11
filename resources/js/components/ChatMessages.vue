<template>
    <ul class="chat">
        <li class="clearfix" v-for="message in messages">
            <div class="chat-avatar">
                <img src="" alt="male">
                <i>10:00</i>
            </div>
            <div class="conversation-text">
                <div class="ctext-wrap">
                    <i>{{ message.user.name }}</i>
                    <p>
                        {{ message.message }}
                    </p>
                </div>
            </div>
        </li>
    </ul>
</template>

<script>
    export default {
        props: ['messages']
    };
</script>