<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { computed, nextTick, ref, watch } from 'vue';
import axios from 'axios';

const props = defineProps(["songs"]);
const audio = ref(null);
const currentSongIndex = ref(null);
const isPlaying = ref(false);
const history = ref([]);
const isShuffling = ref(false);

const currentSong = computed(() => {
    return props.songs[currentSongIndex.value];
});

watch(audio, (newAudio) => {
    if (newAudio) {
        newAudio.addEventListener('ended', () => {
            if (isShuffling.value) {
                return random();
            }
            next();
        });
    }
});

const playSong = (index) => {
    if(!audio.value) return
    currentSongIndex.value = index
    nextTick(() => {
        audio.value.play()
        isPlaying.value = true
    })
}

const playPause = () => {
    if (!audio.value) return;

    isPlaying.value ? audio.value.pause() : audio.value.play();
    isPlaying.value = !isPlaying.value;
}

const next = () => {
    if (currentSongIndex.value < props.songs.length - 1) {
        currentSongIndex.value++;

    } else {
        currentSongIndex.value = 0;
    }

    if(isShuffling.value) {
        axios.post("/songs", { song_id: currentSong.value.id });
    }

    playSong(currentSongIndex.value);
}

const prev = () => {
    if (currentSongIndex.value > 0) {

        if (history.value.length > 0) {
            currentSongIndex.value = history.value.pop();
            console.log(history.value.pop());
            return playSong(currentSongIndex.value);
        }
        currentSongIndex.value--;
        playSong(currentSongIndex.value);
    }

}

const playRandom = async () => {
    isShuffling.value = !isShuffling.value;

    if(isShuffling.value) {
        if(isPlaying.value) return
        await random()
    }
};

const random = async() => {
    try {
        const { data } = await axios.get('songs/random');

        if(currentSong.value && currentSong.value.id == data.id) return random();

        const index = props.songs.findIndex(song => song.id === data.id);

        if(history.value.includes(index)) {
            console.log("Song already played");
            if(history.value.length === props.songs.length) {
                console.log("Reset history");
                history.value = [];
                return random();
            }
            return random();
        }


        if (index !== -1) {
            currentSongIndex.value = index;
            history.value.push(currentSongIndex.value);
            console.log(history.value);
            playSong(currentSongIndex.value);
        }

    } catch (error) {
        console.error("Error fetching random song", error);
    }
}

</script>

<template>
    <Head title="Songs" />
    <AuthenticatedLayout>
        <div class="max-w-5xl mx-auto px-4 md:px-6 mt-[20px] md:mb-[20px] mb-[70px]">
            <ul class="">
                <li v-for="song, i in songs" :key="song.id" @click="playSong(i)" class="py-3 px-4 flex items-center justify-between hover:bg-[#f9f9f9] cursor-pointer">
                    <div class="">
                        <span></span>
                        <div :class="`text-[16px] font-semibold leading-none ${currentSong?.id == song.id ? 'text-green-500' : ''}`"> {{ song.title }}</div>
                        <div class="text-sm text-gray-500"> {{ song.artist }}</div>
                    </div>
                    <div class="">
                        <div class="text-[14px] font-medium">
                            <audio :src="song.file_url" @loadedmetadata="event => song.duration = event.target.duration"></audio>
                            <span v-if="song.duration">{{ Math.floor(song.duration / 60) }}:{{ Math.floor(song.duration % 60).toString().padStart(2, '0') }}</span>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div :class="` w-full fixed bottom-0 left-0 bg-[#f1f3f4] border-t border-gray-200 `">
            <div class="max-w-5xl mx-auto p-2 md:flex justify-center justify-between">
                <div class="w-full md:w-auto flex items-center gap-2 justify-between">
                    <div class="w-full flex items-center gap-2 md:gap-4 px-2">
                        <div class=" flex items-center justify-center  md:pr-0 gap-1 md:gap-4">
                            <button class="" :disabled="!currentSong" @click="prev">
                                <span class="material-symbols-outlined" >skip_previous</span>
                            </button>
                            <button class="" :disabled="!currentSong"  @click="playPause">
                                <span style="font-size: 28px;" class="material-symbols-outlined">{{isPlaying ? "pause" : "play_circle"}}</span>
                            </button>
                            <button class="" :disabled="!currentSong" @click="next">
                                <span class="material-symbols-outlined" >skip_next</span>
                            </button>
                        </div>
                        <div class="flex-1">
                            <div class="text-[15px] font-semibold leading-none">{{ currentSong?.title }}</div>
                            <div class="text-sm text-gray-500 ">{{ currentSong?.artist }}</div>
                        </div>
                        <button class="md:hidden">
                            <span style="font-size: 18px;" class="material-symbols-outlined" @click="playRandom">{{isShuffling ? "shuffle_on" : "shuffle"}}</span>
                        </button>
                    </div>

                </div>
                <div class=" flex-1 ">
                    <audio ref="audio" controls :src="currentSong?.file_url" class="w-full -mt-1 md:max-w-[400px] mx-auto"></audio>
                </div>
                <div class="hidden md:flex items-center justify-center gap-4">
                    <button class="">
                        <span style="font-size: 20px;" class="material-symbols-outlined" @click="playRandom">{{isShuffling ? "shuffle_on" : "shuffle"}}</span>
                    </button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


<style>
    audio::-webkit-media-controls-play-button {
        display: none;
    }

    audio::-webkit-media-controls-start-playback-button {
        display: none;
    }

</style>
