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

const addMsg = (data) => {
    datas.value.push(data)
    console.log(data)
    const res = axios.post("/chat", data);
    pesan.value = ""; // Clear the input field
};
const getUser = async () => {
    const res = await axios.get("/user")
    // console.log(res.data)
    user.value = res.data;
}
</script>

<style lang="scss" scoped></style>
