<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {useForm} from "@inertiajs/inertia-vue3";
import {ref} from "vue";
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    post: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    amount: '',
    post_id: props.post.id,
});

const submit = () => {
    Inertia.reload({ only: ['bids'] })
    form.post(route("bid.store"));
};

</script>

<template>
    <AppLayout title="Nieuwe advertentie">
        <div class="h-screen max-w-4xl mx-auto">
            <div class="flex-col lg:flex-row h-screen mx-auto p-6">
                <div class="card w-full bg-secondary shadow-xl">
                    <div class="carousel w-full">
                        <div :id="`slide${ image.id }`" v-for="image in post.images"
                             class="carousel-item relative w-full justify-center">
                            <img :src="`/storage/photos/${ image.file_uri }`" class="h-96 object-contain">
                        </div>
                    </div>
                    <div class="flex justify-center w-full py-2 gap-2">
                        <a :href="`#slide${ image.id }`" v-for="(image, index) in post.images"
                           class="btn btn-xs">{{ index + 1 }}</a>
                    </div>
                    <div class="card-body p-8">
                        <div class="flex flex-row justify-between gap-2">
                            <h2 class="card-title">{{ post.title }}</h2>
                        </div>
                        <p>{{ post.description }}</p>
                        <div class="card-actions justify-end">
                            <a class="btn btn-primary" v-if="post.user_id == post.user_id"
                               :href="route('post.update', post.id)">Update</a>
                            <a class="btn bg-red-500" v-if="post.user_id == post.user_id"
                               :href="route('post.destroy', post.id)">Verwijderen</a>
                        </div>
                    </div>
                </div>
                <div class="stats stats-horizontal shadow bg-secondary w-full mt-2">
                    <div class="stat">
                        <div class="grid grid-cols-2 gap-8"
                             v-for="bid in post.bids.sort((a, b) => (b.amount > a.amount) ? 1 : -1)">
                            <div>
                                <div class="stat-title">Geboden door</div>
                                <div class="stat-value text-xl">{{ bid.user.name }}</div>
                                <div class="stat-desc">op {{ bid.created_at.slice(0, 10) }}</div>
                                <div class="divider"></div>
                            </div>
                            <div>
                                <div class="stat-title">Bedrag</div>
                                <div class="stat-value text-xl">{{ bid.amount }}</div>
                                <div class="stat-desc">euro</div>
                                <div class="divider"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-4 mt-2 mb-2">
                    <div class="stats stats-vertical lg:stats-horizontal shadow bg-secondary">

                        <div class="stat">
                            <div class="stat-title">Bieden</div>
                            <form @submit.prevent="submit">
                                <div class="flex flex-row">
                                    <div class="mb-6">
                                        <input
                                            type="text"
                                            v-model="form.amount"
                                            name="amount"
                                            class="bg-gray-300 h-10 mt-1 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-secondary focus:border-secondary w-full"
                                            placeholder=""/>
                                        <div v-if="form.errors.amount" class="text-sm text-red-600">
                                            {{ form.errors.amount }}
                                        </div>
                                    </div>
                                    <button
                                        type="submit"
                                        class="btn ml-2"
                                        :disabled="form.processing"
                                        :class="{ 'opacity-25': form.processing }">
                                        Bieden
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="stat">
                            <div class="stat-title">Categorie</div>
                            <div class="stat-value capitalize">{{ post['category'] }}</div>
                            <div class="stat-desc"></div>
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
