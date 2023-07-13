<template>
    <div>
        <h1 class="animated" :class="{ 'bounce': animate }">Counter: {{ counter }}</h1>
        <button @click="updateCounterOnServer">Increment</button>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import Pusher from 'pusher-js';
import Echo from 'laravel-echo';
export default {
    setup() {
        const counter = ref(0);
        let animate = false;
        const pusherChannel = ref(null)
        const setupPusher = () => {
            const pusher = new Pusher('c830acc9e6221d6f6967', {
                cluster: 'ap1',
                encrypted: true,
            });

            pusherChannel.value = pusher.subscribe('counter-channel');
        };

        const setupEcho = () => {
            pusherChannel.value.bind('msgsend', (data) => {
                counter.value = data.count;
            });
        };



        const updateCounterOnServer = async () => {
            try {
                await axios.post('/api/increment');
                getCounterFromServer();
            } catch (error) {
                console.error(error);
            }
        };

        const getCounterFromServer = () => {
            axios.get('/api/counter')
                .then((response) => {
                    console.log(response)
                    counter.value = response.data.count;
                    console.log(response.data)
                })
                .catch((error) => {
                    console.error(error);
                });
        };

        onMounted(() => {
            getCounterFromServer();
            setupPusher();
            setupEcho();
        });

        return {
            counter,
            animate,
            updateCounterOnServer,
        };
    },
};
</script>

<style scoped></style>
