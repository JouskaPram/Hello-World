<template>
    <div class="w-full h-screen pb-5 md:pb-0 ">


        <div class="  px-16 pram h-[100vh]">


            <div class="relative flex md:py-5 py-2 items-center">
                <div class="flex-grow border-t border-white"></div>
                <span class="flex-shrink mx-4 text-white md:text-3xl text-xl">Got Your Kuru Kuru</span>
                <div class="flex-grow border-t border-white"></div>
            </div>
            <h2 class="text-center text-white ">The Website Just For Fun</h2>

            <audio ref="audioPlayer" :src="audioUrl"></audio>
            <div class="flex h-[70vh] w-full align-middle items-center justify-center z-10">

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


            <p class="text-center text-white text-md ">It Will Change Character In Every 24 Hours</p>
        </div>
    </div>
    <div class="image-container -z-[1] pt-40 md:pt-0" v-for="image in images" :key="image.id">

        <transition name="slide-in" mode="out-in">
            <img v-if="show" :src="image.url" class="slide-in-image ">
        </transition>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import sound from '@/Pages/Post/kuru.mp3';
import kuru from '@/Pages/Post/hertaa2.webp'
export default {
    setup() {

        const counter = ref(0);
        const show = ref(false);

        const images = ref([]);


        const incrementCounter = () => {
            const audio = new Audio(sound);
            audio.play();

            counter.value += 1;
            show.value = true;

            localStorage.setItem('counter', counter.value.toString());
            const newImage = {
                id: Math.random(),
                url: kuru
            };
            images.value.push(newImage);
            console.log(images)
            setTimeout(() => {
                show.value = false
            }, 100)
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
    background-color: #9d88d3;
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
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    z-index: -1;
}

.image-container img {
    position: absolute;
    bottom: 10;
    right: 0;
    transition: transform 0.5s linear;
    transform: translateX(0%);
}

@keyframes slide-in {
    0% {
        right: 0;
    }

    100% {
        transform: translateX(-270%);
    }
}

.slide-in-image {
    animation-name: slide-in;
    animation-duration: 2.5s;
    animation-fill-mode: forwards;
}
</style>