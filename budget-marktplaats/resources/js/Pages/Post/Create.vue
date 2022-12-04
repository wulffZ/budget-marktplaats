<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {useForm} from "@inertiajs/inertia-vue3";

const props = defineProps({
    posts: {
        type: Object,
        default: () => ({}),
    },
});

let photos = [];

function addPhotoToArray() {
    photos.push(document.getElementById('photos').files);
    console.log(photos);
}

const form = useForm({
    title: '',
    description: '',
    category: '',
    photos: photos,
});

const submit = () => {
    form.post(route("post.store"));
};
</script>

<template>
    <AppLayout title="Nieuwe advertentie">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 py-12">
            <div class="m-5">
                <h1 class="font-semibold text-lg">Maak een nieuwe advertentie aan</h1>
            </div>
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-neutral border-b border-secondary">
                    <form @submit.prevent="submit">
                        <div class="mb-6">
                            <label for="Title"
                                class="block mb-2 text-sm font-medium text-white">Titel</label>
                            <input
                                type="text"
                                v-model="form.title"
                                name="title"
                                class="bg-gray-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-secondary focus:border-secondary block w-full p-2.5"
                                placeholder=""/>
                            <div v-if="form.errors.title" class="text-sm text-red-600">
                                {{ form.errors.title }}
                            </div>
                        </div>
                        <div class="mb-6">
                            <label for="Description" class="block mb-2 text-sm font-medium text-white">Beschrijving</label>
                            <textarea
                                type="text"
                                v-model="form.description"
                                name="description"
                                class="bg-gray-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-secondary focus:border-secondary block w-full p-2.5"></textarea>

                            <div v-if="form.errors.description" class="text-sm text-red-600">
                                {{ form.errors.description }}
                            </div>
                        </div>
                        <div class="mb-6">
                            <label for="Category" class="block mb-2 text-sm font-medium text-white">Categorie</label>
                            <select name="category" v-model="form.category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-secondary focus:border-secondary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">Kies een catergorie</option>
                                <option value="automotive">Auto's en toebehoren</option>
                                <option value="it">Computers telefoons en toebehoren</option>
                                <option value="interior">Interieur</option>
                                <option value="tools">Gereedschap</option>
                            </select>
                            <div v-if="form.errors.category" class="text-sm text-red-600">
                                {{ form.errors.category }}
                            </div>
                        </div>
                        <div class="mb-6">
                            <label for="Photos" class="block mb-2 text-sm font-medium text-white">Foto's</label>
                            <input id="photos" type="file" v-on:change="addPhotoToArray" class="form-control" name="photos" multiple />
                            <div v-if="form.errors.photos" class="text-sm text-red-600">
                                {{ form.errors.photos }}
                            </div>
                        </div>
                        <button
                            type="submit"
                            class="text-white bg-secondary  focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 "
                            :disabled="form.processing"
                            :class="{ 'opacity-25': form.processing }">
                            Posten
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
