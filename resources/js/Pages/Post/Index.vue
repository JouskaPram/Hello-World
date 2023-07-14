<template>
    <div class="w-full h-screen pb-5 md:pb-0 bg-[#9d88d3] ">


        <div class=" items-center px-16 pram h-[100vh]">
            <div class="image-container" v-for="image in images" :key="image.id">

                <transition name="slide-in" mode="out-in">
                    <img v-if="show" :src="image.url" class="slide-in-image ">
                </transition>
            </div>


            <div class="relative flex py-5 items-center">
                <div class="flex-grow border-t border-white"></div>
                <span class="flex-shrink mx-4 text-white md:text-3xl text-xl">Got Your Kuru Kuru</span>
                <div class="flex-grow border-t border-white"></div>
            </div>
            <h2 class="text-center text-white ">The Website Just For Fun</h2>

            <div class="flex h-[60vh] w-full align-middle items-center justify-center">

                <div class="align-middle items-center justify-center">

                    <h4 class=" text-center text-[#574f84] fw-bold text-lg">The Kuru~ Squished</h4>
                    <h1 class=" text-center text-white fw-bold text-3xl"
                        :class="{ 'scale-110 animate-spin duration-500': animate }" v-if="!loading">

                        {{ counter }}
                        <br>
                        <span>Times</span>
                    </h1>
                    <button @click="incrementCounter"
                        class="py-2 px-5 text-2xl fw-bold bg-[#574f84] rounded-lg mt-3 text-white hover:scale-105 hover:opacity-90">
                        Squisy Here!!
                    </button>
                </div>
            </div>

            <div class="relative flex py-5 items-center">
                <div class="flex-grow border-t border-white"></div>
                <span class="flex-shrink mx-4 text-white md:text-3xl text-xl">Got Your Kuru Kuru</span>
                <div class="flex-grow border-t border-white"></div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';

export default {
    setup() {
        const counter = ref(0);
        const show = ref(false);

        const images = ref([]);

        const incrementCounter = () => {

            counter.value += 1;
            show.value = true;
            localStorage.setItem('counter', counter.value.toString());
            const newImage = {
                id: Math.random(),
                url: 'https://herta.eu.org/img/hertaa2.webp'
            };
            images.value.push(newImage);
            console.log(images)
        };



        const getCounterFromStorage = () => {
            const savedCounter = localStorage.getItem('counter');
            if (savedCounter !== null) {
                counter.value = parseInt(savedCounter);
            }
        };

        onMounted(() => {
            getCounterFromStorage();
        });

        return {
            counter,
            show,
            incrementCounter,
            images,

        };
    },
};
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Lilita+One&family=Poppins&display=swap');

.pram {
    font-family: 'Lilita One', cursive;


}

body {
    height: 100%;
    margin: 0;
    padding: 0;
}

.container {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.wave-svg {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100px;
    z-index: -1;
}


.image-container {
    position: relative;
}

.image-container img {
    position: absolute;
    top: 0;
    right: 0;
    transition: transform 0.5s linear;

}

@keyframes slide-in {
    0% {
        right: 0;
    }

    100% {
        transform: translateX(-250%);
    }
}

.slide-in-image {
    animation-name: slide-in;
    animation-duration: 2.5s;
    animation-fill-mode: forwards;
}
</style>