<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen w-full">
            <header class="bg-[#f1f3f4] border-b border-gray-200 fixed w-full z-10">
                <div class="max-w-7xl mx-auto py-5 px-6">
                    <div class="flex justify-between items-center">
                        <div class=""></div>
                        <span class="material-symbols-outlined">
                            music_note
                        </span>
                        <Link  :href="route('logout')" method="post" as="button">
                            <span style="font-size: 20px;" class="material-symbols-outlined mt-1">
                                mode_off_on
                            </span>
                        </Link>
                    </div>
                </div>
            </header>
            <main class="py-16">
                <slot />
            </main>
        </div>
    </div>
</template>
