<template>
    <div>
        <h1 class="animated" :class="{ 'bounce': animate }">Counter: {{ counter }}</h1>
        <button @click="incrementTempCounter">Increment</button>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import Pusher from 'pusher-js';
import Echo from 'laravel-echo';

export default {
    setup() {
        const tempCounter = ref(0);
        const counter = ref(0);
        const totalClicks = ref(0);
        let animate = false;
        const pusherChannel = ref(null);
        let pendingUpdate = null;



        const updateCounterOnServer = async () => {
            getCounterFromServer()
            try {
                // Send the counter value to the server
                await axios.post('/api/increment', {
                    "count": totalClicks.value,
                }).then((response) => {
                    console.log(response)
                });
                console.log(totalClicks)

                // Reset the temporary counter
                tempCounter.value = 0;
                totalClicks.value = 0;
            } catch (error) {
                console.error(error);
            }
        };

        const incrementTempCounter = () => {
            tempCounter.value += 1;
            counter.value += 1;
            totalClicks.value += 1;
            animate = true;

            if (pendingUpdate !== null) {
                // If there is a pending update, clear it
                clearTimeout(pendingUpdate);
            }

            pendingUpdate = setTimeout(updateCounterOnServer, 1500);
        };

        const getCounterFromServer = () => {
            axios
                .get('/api/counter')
                .then((response) => {
                    counter.value = response.data.count;
                })
                .catch((error) => {
                    console.error(error);
                });
        };

        onMounted(() => {
            getCounterFromServer();

        });

        return {
            counter,
            animate,
            totalClicks,
            incrementTempCounter,
        };
    },
};
</script>





<style scoped></style>
