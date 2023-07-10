<template>
    <div>
        <p>{{ user.name }}</p>
        <ul v-for="data in datas" :key="data.id">
            <li>{{ data.pesan }}</li>
            <li>{{ data.user.email }}</li>
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

const datas = ref([]);
const pesan = ref("");
const user = ref([])
onMounted(() => {
    getMsg();
    getUser()
});

const getMsg = async () => {
    const res = await axios.get("/chat");
    datas.value = res.data;
};

const addMsg = () => {

    const res = axios.post("/chat", {
        "pesan": pesan.value,


    });
    pesan.value = ""; // Clear the input field
    getMsg()
};

</script>

<style lang="scss" scoped></style>
