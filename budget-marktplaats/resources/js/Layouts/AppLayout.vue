<script setup>
import {ref} from 'vue';
import {Inertia} from '@inertiajs/inertia';
import {Head, Link} from '@inertiajs/inertia-vue3';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    Inertia.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    Inertia.post(route('logout'));
};
</script>

<template>
    <div>
        <Head :title="title"/>
            <div class="navbar bg-base-100">
                <div class="navbar-start">
                    <div class="dropdown">
                        <label tabindex="0" class="btn btn-ghost btn-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 6h16M4 12h16M4 18h7"/>
                            </svg>
                        </label>
                        <ul tabindex="0"
                            class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                            <li><a>Homepage</a></li>
                            <li><a>Portfolio</a></li>
                            <li><a>About</a></li>
                        </ul>
                    </div>
                </div>
                <div class="navbar-center">
                    <a class="btn btn-ghost normal-case text-xl" :href="route('dashboard')">
                        marktplaats
                        <img src="storage/images/logo.svg" width="50">
                    </a>
                </div>
                <div class="navbar-end">
                    <ul class="menu menu-horizontal p-0">
                        <li tabindex="0">
                            <a>
                                {{ $page.props.user.name }}
                                <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                     viewBox="0 0 24 24">
                                    <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/>
                                </svg>
                            </a>
                            <ul class="p-2 bg-base-100">
                                <li><a :href="route('profile.show')">Manage account</a></li>
                            </ul>
                        </li>
                        <li>
                            <form method="POST" @submit.prevent="logout">
                                <ResponsiveNavLink as="button" class="w-full h-full">
                                    Log out
                                </ResponsiveNavLink>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Page Content -->
            <main>
                <slot/>
            </main>
        </div>
    </div>
</template>
