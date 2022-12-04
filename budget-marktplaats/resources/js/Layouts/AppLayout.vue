<script setup>
import {Inertia} from '@inertiajs/inertia';
import {Head, Link} from '@inertiajs/inertia-vue3';

defineProps({
    title: String,
});

const logout = () => {
    Inertia.post(route('logout'));
};
</script>

<template>
    <div>
        <Head :title="title"/>
        <div class="navbar bg-neutral">
            <div class="flex-1">
                <a :href="route('dashboard')" class="btn btn-ghost normal-case text-xl" >marktplaats</a>
                <ul class="menu menu-horizontal p-0">
                    <li><a class="btn" :href="route('dashboard')">Dashboard</a></li>
                    <li tabindex="0" class="z-50">
                        <a class="btn">
                            MIJN ADVERTENTIES
                            <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                 viewBox="0 0 24 24">
                                <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/>
                            </svg>
                        </a>
                        <ul class="p-2">
                            <li><a class="btn" :href="route('post.show.create')">Nieuwe advertentie</a></li>
                            <li><a class="btn mt-1">overzicht</a></li>
                        </ul>
                    </li>
                    <li><a>Item 3</a></li>
                </ul>
            </div>
            <div class="flex-1 justify-between">
            </div>
            <div class="flex-none">
                <div class="dropdown dropdown-end">
                    <label tabindex="0" class="btn m-1">
                        {{ $page.props.user.name }}
                        <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                             viewBox="0 0 24 24">
                            <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/>
                        </svg>
                    </label>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow rounded-box w-52">

                        <li><a class="btn mt-1" :href="route('profile.show')">Account beheer</a></li>
                        <form method="POST" @submit.prevent="logout">
                            <button class="btn mt-1 w-full">logout</button>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Page Content -->
        <main>
            <slot/>
        </main>
    </div>
</template>
