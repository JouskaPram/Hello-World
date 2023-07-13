<template>
    <div>
        <div class="w-full h-full min-h-screen bg-purple-600">
            <div class="flex h-screen w-full align-middle items-center justify-center ">
                <div class="align-middle items-center justify-center ">
                    <h1 class="animated text-center text-white fw-bold text-3xl" v-if="loading == true">Tunggu Sebentar^^
                    </h1>
                    <h1 class="animated text-center text-white fw-bold text-3xl"
                        :class="{ 'scale-110 animate-spin duration-500': animate }" v-if="!loading"> {{
                            counter
                        }}</h1>
                    <button @click="incrementTempCounter"
                        class="py-2 px-5 text-2xl fw-bold bg-purple-400 rounded-md mt-3 text-white">Kuru
                        Kuru</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import Pusher from 'pusher-js';
import Echo from 'laravel-echo';

export default {
    setup() {
        const tempCounter = ref(0);
        const counter = ref();
        const totalClicks = ref(0);
        const loading = ref(true)
        let animate = ref(false);
        const pusherChannel = ref(null);
        let pendingUpdate = null;



        const updateCounterOnServer = async () => {
            getCounterFromServer()

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

        };


        const incrementTempCounter = () => {
            animate.value = true;
            tempCounter.value += 1;
            counter.value += 1;
            totalClicks.value += 1;


            if (pendingUpdate !== null) {
                // If there is a pending update, clear it
                clearTimeout(pendingUpdate);
            };

            pendingUpdate = setTimeout(updateCounterOnServer, 1500);

        };

        const getCounterFromServer = () => {
            loading.value = true
            animate.value = false;
            axios
                .get('/api/counter')
                .then((response) => {
                    counter.value = response.data.count;
                })

            loading.value = false
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
