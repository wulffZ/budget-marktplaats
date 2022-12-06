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
                        <div :id="`slide${ image.id }`" v-for="image in post.images"
                             class="carousel-item relative w-full">
                            <img :src="`storage/photos/${ image['file_uri'] }`" class="object-contain">
                        </div>
                    </div>
                    <div class="flex justify-center w-full py-2 gap-2">
                        <a :href="`#slide${ image.id }`" v-for="(image, index) in post.images"
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
                        <h2 class="card-title text-xs">Aangeboden door {{ post.user.name }}</h2>
                        <p>{{ post.description }}</p>
                        <div class="divider"></div>

                        <div class="max-h-64 overflow-y-auto">
                            <div v-for="bid in post.bids.sort((a, b) => (b.amount > a.amount) ? 1 : -1)">
                                <p>
                                <span class="font-semibold">
                                    {{ bid.amount }}
                                </span>
                                    geboden op
                                    <span class="font-semibold">
                                    {{ bid.created_at.slice(0, 10) }}
                                </span>
                                </p>

                                <label for="user-info"><span class="text-sm">
                                door
                                <span class="underline">
                                    {{ bid.user.name }}
                                </span>
                            </span>
                                </label>
                                <div class="divider"></div>

                                <input type="checkbox" id="user-info" class="modal-toggle"/>
                                <div class="modal">
                                    <div class="modal-box relative">
                                        <label for="user-info"
                                               class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                                        <h3 class="text-lg font-bold">Gebruikersinformatie</h3>
                                        <div class="stats stats-vertical shadow bg-secondary w-full mt-2">

                                            <div class="stat">
                                                <div class="stat-title">Gebruikersnaam</div>
                                                <div class="stat-value text-xl">{{ post.user.name }}</div>
                                            </div>

                                            <div class="stat">
                                                <div class="stat-title">Email</div>
                                                <div class="stat-value text-xl">{{ post.user.email }}</div>
                                            </div>

                                            <div class="stat">
                                                <div class="stat-title">Lid sinds</div>
                                                <div class="stat-value text-xl">{{ post.user.created_at.slice(0, 10) }}
                                                </div>
                                            </div>
                                        </div>
                                        <p class="py-4">Als u deze gebruiker wilt contacteren, klik <a class="underline"
                                                                                                       href="mailto: {{ post.user.email }}">hier</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-actions justify-end mb-4">
                            <a class="btn btn-primary" :href="route('post.show', post.id)">Bekijk</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
