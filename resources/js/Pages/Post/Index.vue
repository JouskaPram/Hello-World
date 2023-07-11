<template>
    <div>
        <h1>Counter: {{ counter }}</h1>
        <button @click="incrementCounter">Increment</button>
    </div>
</template>

<script setup>
import axios from 'axios';
import { ref } from 'vue';
import { onMounted } from 'vue';

const counter = ref(0)
const getPost = async () => {
    const res = await axios.get("/api/increment")
    counter.value = res.data
}
const incrementCounter = async () => {
    const res = await axios.post("/api/counter", {
        "count": counter.value
    }).then(
        res => {
            counter.value = res.data.counter
        }
    )
}
onMounted(() => {
    getPost()
})
</script>

<style lang="scss" scoped></style>