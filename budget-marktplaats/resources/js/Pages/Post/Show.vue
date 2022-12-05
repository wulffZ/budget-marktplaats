<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    post: {
        type: Object,
        default: () => ({}),
    },
});

</script>

<template>
    <AppLayout title="Nieuwe advertentie">
        <div class="h-screen max-w-4xl mx-auto">
            <div class="flex-col lg:flex-row h-screen mx-auto p-6">
                <div class="card w-full bg-secondary shadow-xl">
                    <div class="carousel w-full">
                        <div :id="`slide${ image['id']}`" v-for="image in post['images']"
                             class="carousel-item relative w-full justify-center">
                            <img :src="`/storage/photos/${ image['file_uri'] }`" class="h-96 object-contain">
                        </div>
                    </div>
                    <div class="flex justify-center w-full py-2 gap-2">
                        <a :href="`#slide${ image['id'] }`" v-for="(image, index) in post.images"
                           class="btn btn-xs">{{ index + 1 }}</a>
                    </div>
                    <div class="card-body p-8">
                        <div class="flex flex-row justify-between gap-2">
                            <h2 class="card-title">{{ post['title'] }}</h2>
                        </div>
                        <p>{{ post['description'] }}</p>
                        <div class="card-actions justify-end">
                            <a class="btn btn-primary" v-if="$page.props.user.id == post.user_id" :href="route('post.update', post.id)">Update</a>
                            <a class="btn bg-red-500" v-if="$page.props.user.id == post.user_id" :href="route('post.destroy', post.id)">Verwijderen</a>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-4 mt-4">
                    <div class="stats stats-vertical lg:stats-horizontal shadow bg-secondary">

                        <div class="stat">
                            <div class="stat-title">Categorie</div>
                            <div class="stat-value capitalize">{{ post['category'] }}</div>
                        </div>

                        <div class="stat">
                            <div class="stat-title">Beschikbaar sinds</div>
                            <div class="stat-value">{{ post['created_at'].slice(0, 10) }}</div>
                            <div class="stat-desc"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
