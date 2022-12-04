<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import AutomotiveIcon from "@/Components/AutomotiveIcon.vue";
import ItIcon from "@/Components/ItIcon.vue";
import InteriorIcon from "@/Components/InteriorIcon.vue";
import ToolsIcon from "@/Components/ToolsIcon.vue";

const props = defineProps({
    posts: Array,
});

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>


        <div class="flex flex-col h-screen justify-between mt-4">
            <div class="grid grid-cols-3 gap-12 max-w-6xl mx-auto">
                <div v-for="post in posts" class="card w-96 bg-secondary shadow-xl">
                    <div class="carousel w-full">
                        <div :id="`slide${ image['id']}`" v-for="image in post.images"
                             class="carousel-item relative w-full">
                            <img :src="`storage/photos/${ image['file_uri'] }`">
                        </div>
                    </div>
                    <div class="flex justify-center w-full py-2 gap-2">
                        <a :href="`#slide${ image['id'] }`" v-for="(image, index) in post.images"
                           class="btn btn-xs">{{ index + 1 }}</a>
                    </div>
                    <div class="card-body py-2">
                        <div class="flex flex-row justify-between gap-2">
                            <h2 class="card-title">{{ post.title }}</h2>
                            <automotive-icon v-if="post.category === 'automotive'"></automotive-icon>
                            <it-icon v-if="post.category === 'it'"></it-icon>
                            <interior-icon v-if="post.category === 'interior'"></interior-icon>
                            <tools-icon v-if="post.category === 'tools'"></tools-icon>
                        </div>
                        <p>{{ post.description }}</p>
                        <div class="card-actions justify-end">
                            <button class="btn btn-primary">Bekijk</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
