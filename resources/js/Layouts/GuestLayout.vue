<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center  justify-center sm:pt-0"
    >
        <div>
            <Link href="/">
                <span class="material-symbols-outlined">
                    music_note
                </span>
            </Link>
        </div>

        <div
            class="mt-6 w-full overflow-hidden bg-white px-6 py-4  sm:max-w-md rounded"
        >
            <slot />
        </div>
    </div>
</template>
