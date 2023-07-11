<template>
    <div>
        <p>{{ user.name }}</p>
        <ul v-for="data in datas" :key="data.id">
            <li>{{ data.pesan }}</li>

        </ul>
        <form @submit.prevent="addMsg">
            <input type="text" v-model="pesan">
            <button type="submit">Submit</button>
        </form>
    </div>
</template>

<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";
import Pusher from "pusher-js";

const datas = ref([]);
const pesan = ref("");
const user = ref([]);

let pusher;

onMounted(() => {
    initializePusher();
    getUser();
    getMsg();
});

const getMsg = async () => {
    try {
        const res = await axios.get("/chat");
        datas.value = res.data;
        console.log(res.data)
    } catch (error) {
        console.error("Error fetching messages:", error);
    }
};

const initializePusher = () => {
    pusher = new Pusher("c830acc9e6221d6f6967", {
        cluster: "ap1",
    });

    const channel = pusher.subscribe("chatting");

    channel.bind("msgsend", (data) => {
        datas.value.push(data);
        console.log(data.values)
    });

    getMsg();
};

const addMsg = async () => {
    try {
        const res = await axios.post("/chat", {
            pesan: pesan.value,
        });
        pesan.value = "";
        getMsg() // Clear the input field
    } catch (error) {
        console.error("Error adding message:", error);
    }
};
const getUser = async () => {
    const res = await axios.get("/user")
    // console.log(res.data)
    user.value = res.data;
}
</script>

<style lang="scss" scoped></style>
