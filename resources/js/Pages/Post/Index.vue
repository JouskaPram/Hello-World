<template>
    <div>
        <h1 class="animated" :class="{ 'bounce': animate }">Counter: {{ counter }}</h1>
        <button @click="updateCounterOnServer">Increment</button>
    </div>
</template>

<script setup>
import axios from 'axios';
import { onBeforeUnmount } from 'vue';
import { ref } from 'vue';
import { onMounted } from 'vue';

const counter = ref();
let intervalId;
const getCounter = async () => {
    try {
        const response = await axios.get('/api/increment');
        counter.value = response.data;

    } catch (error) {
        console.error(error);
    }
};



const updateCounterOnServer = () => {
    axios.post('/api/counter', {
        "count": 1
    })
    getCounter();


};

const startDataFetching = () => {
    setInterval(() => {
        getCounter();
    }, 5000);
};

const stopDataFetching = () => {
    clearInterval(intervalId);
};
// onBeforeUnmount(() => {
//     stopDataFetching();
// });


onMounted(() => {
    startDataFetching();
    getCounter();

});
</script>

<style scoped>
.animated {
    transition: 0.5s;
}

.bounce {
    animation: bounce 0.5s;
}

@keyframes bounce {
    0% {
        transform: scale(1);
    }

    50% {
        transform: scale(1.2);
    }

    100% {
        transform: scale(1);
    }
}
</style>
