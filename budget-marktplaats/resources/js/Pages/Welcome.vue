<script setup>
import {Head, Link} from '@inertiajs/inertia-vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
});
</script>

<template>
    <Head title="Welkom"/>

    <div class="relative flex items-top justify-center min-h-screen bg-gray-800 sm:items-center sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                <img src="storage/images/banner-white.png" class="w-96 ml-8 rounded-md border border-white">
            </div>

            <div class="mt-8 bg-white bg-neutral overflow-hidden shadow sm:rounded-lg">
                <div class="flex items-center p-6">
                    <div class="text-lg leading-7 font-semibold text-gray-900 dark:text-white">
                        <h1 class="text-lg text-white font-semibold">Bij marktplaats maakt elke deal maakt het verschil</h1>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="ml-4 text-lg leading-7 font-semibold">
                                <p class="underline text-gray-900 dark:text-white">Gratis</p>
                            </div>
                        </div>

                        <div class="ml-8">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                Marktplaats is voor elke particulier gratis in Nederland, en advertenties worden niet
                                automatisch verwijderd.
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                        <div class="flex items-center">
                            <div class="ml-4 text-lg leading-7 font-semibold">
                                <p class="underline text-gray-900 dark:text-white">Grote
                                    hoeveelheid mogelijke kopers</p>
                            </div>
                        </div>

                        <div class="ml-8">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                Marktplaats is de grootste site van Nederland waar je gratis vele soorten producten kan
                                kopen en verkopen
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center">
                            <div class="ml-4 text-lg leading-7 font-semibold">
                                <a href="https://laravel-news.com/" class="underline text-gray-900 dark:text-white">Uitstekende
                                    klantenervaring</a>
                            </div>
                        </div>

                        <div class="ml-8">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                Marktplaats kan door hun jarenlange ervaring en expertise alle bedrijfsprocessen
                                goed inrichten en aan iedere behoefte van de hedendaagse consument voldoen.
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                        <div class="flex items-center">
                            <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 underline dark:text-white">
                                Sneller verkopen
                            </div>
                        </div>

                        <div class="ml-8">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                Je kan uw advertentie een populairheidsboost geven met Marktplaats-opvalmogelijkheden.
                                Met deze middelen valt uw advertentie meer op.
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">
                                Waar wacht u nog op?
                            </div>
                        </div>
                        <div v-if="canLogin" class=" px-6 py-4 sm:block">
                            <Link v-if="$page.props.user" :href="route('dashboard')"
                                  class="text-sm underline">Dashboard
                            </Link>

                            <template v-else>
                                <Link :href="route('login')" class="text-sm underline">
                                    Log in
                                </Link>

                                <Link v-if="canRegister" :href="route('register')"
                                      class="ml-4 text-sm underline">Register
                                </Link>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
