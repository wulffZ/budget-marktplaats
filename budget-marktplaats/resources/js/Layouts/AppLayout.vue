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
            <div class="navbar-start">
                <div class="dropdown">
                    <label tabindex="0" class="btn btn-ghost lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h8m-8 6h16"/>
                        </svg>
                    </label>
                    <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                        <li><a class="btn" :href="route('post.create')">Nieuwe advertentie</a></li>
                        <li><a class="btn mt-2" >Mijn advertenties</a></li>
                    </ul>
                </div>
                <a class="btn btn-ghost normal-case text-xl" :href="route('dashboard')">marktplaats</a>
            </div>
            <div class="navbar-center hidden lg:flex">
                <ul class="menu menu-horizontal p-0 gap-2">
                    <li><a class="btn" :href="route('post.create')">Nieuwe advertentie</a></li>
                    <li><a class="btn" >Mijn advertenties</a></li>
                </ul>
            </div>
            <div class="navbar-end">
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
