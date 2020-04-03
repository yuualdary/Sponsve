 
<template >
    <ul class="chat">
        <li class="left clearfix"v-for="message in messages">
            <div class="chat-body clearfix">
                <div class="header">
                    <strong class="primary-font">
                        {{ message.user.name }}
                    </strong>
                </div>
                <p>
                    {{ message.message }}
                </p>
            </div>
        </li>
    </ul>
</template>

<script>
  export default {
    props: ['messages']// apakah ini trigger,dimana dia akan baca setiap data yg masuk ke messages, tapi dia harus pake user_id :/ 
  };
</script>