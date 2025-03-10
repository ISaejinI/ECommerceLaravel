<script setup>
import { ref, computed } from "vue";
import { Head, Link, router, usePage } from "@inertiajs/vue3";
import Banner from "@/Components/Banner.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { ShoppingBagIcon } from "@heroicons/vue/24/outline";

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);
const page = usePage();
const auth = computed(() => page.props.auth || { user: null });
const isAuthenticated = computed(() => auth.value.user !== null);

const logout = () => {
    router.post(route("logout"));
};
</script>

<template>
    <div>

        <Head :title="title" />

        <Banner />

        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('home')">
                                <img src="/images/logo.png" class="block h-9 w-auto">
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <NavLink :href="route('home')" :active="route().current('home')">
                                    Accueil
                                </NavLink>

                                <NavLink :href="route('categories')" :active="route().current('categories')">
                                    Catégories
                                </NavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <!-- Non connecté -->
                            <template v-if="!isAuthenticated">
                                <Link :href="route('login')"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                Se connecter
                                </Link>
                                <Link :href="route('register')"
                                    class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                S'inscrire
                                </Link>
                            </template>

                            <!-- Connecté -->
                            <template v-else>
                                <div class="ms-3 relative flex gap-6">
                                    <NavLink :href="route('cart')">
                                        <ShoppingBagIcon class="size-6" />
                                    </NavLink>
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                            <button v-if="
                                                $page.props.jetstream
                                                    .managesProfilePhotos
                                            "
                                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                <img class="size-8 rounded-full object-cover" :src="$page.props.auth.user
                                                    .profile_photo_url
                                                    " :alt="$page.props.auth.user
                                                        .name
                                                        " />
                                            </button>

                                            <span v-else class="inline-flex rounded-md">
                                                <button type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                    {{
                                                        $page.props.auth.user
                                                            .name
                                                    }}

                                                    <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>

                                        <template #content>
                                            <!-- Account Management -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                Gérer le compte
                                            </div>

                                            <DropdownLink :href="route('profile.show')">
                                                Profil
                                            </DropdownLink>

                                            <DropdownLink :href="route('cart')">
                                                Mon panier
                                            </DropdownLink>

                                            <div class="border-t border-gray-200" />

                                            <!-- Authentication -->
                                            <form @submit.prevent="logout">
                                                <DropdownLink as="button">
                                                    Déconnexion
                                                </DropdownLink>
                                            </form>
                                        </template>
                                    </Dropdown>
                                </div>
                            </template>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                                @click="
                                    showingNavigationDropdown =
                                    !showingNavigationDropdown
                                    ">
                                <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{
                                        hidden: showingNavigationDropdown,
                                        'inline-flex':
                                            !showingNavigationDropdown,
                                    }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{
                                        hidden: !showingNavigationDropdown,
                                        'inline-flex':
                                            showingNavigationDropdown,
                                    }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{
                    block: showingNavigationDropdown,
                    hidden: !showingNavigationDropdown,
                }" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('home')" :active="route().current('home')">
                            Accueil
                        </ResponsiveNavLink>

                        <ResponsiveNavLink :href="route('categories')" :active="route().current('categories')">
                            Catégories
                        </ResponsiveNavLink>
                    </div>

                    <!-- Non connecté (Mobile) -->
                    <template v-if="!isAuthenticated">
                        <div class="pt-4 pb-1 border-t border-gray-200">
                            <div class="space-y-1">
                                <ResponsiveNavLink :href="route('login')" :active="route().current('login')">
                                    Se connecter
                                </ResponsiveNavLink>
                                <ResponsiveNavLink :href="route('register')" :active="route().current('register')">
                                    S'inscrire
                                </ResponsiveNavLink>
                            </div>
                        </div>
                    </template>

                    <!-- Connecté (Mobile) -->
                    <template v-else>
                        <div class="pt-4 pb-1 border-t border-gray-200">
                            <div class="flex items-center px-4">
                                <div v-if="
                                    $page.props.jetstream
                                        .managesProfilePhotos
                                " class="shrink-0 me-3">
                                    <img class="size-10 rounded-full object-cover" :src="$page.props.auth.user
                                        .profile_photo_url
                                        " :alt="$page.props.auth.user.name" />
                                </div>

                                <div>
                                    <div class="font-medium text-base text-gray-800">
                                        {{ $page.props.auth.user.name }}
                                    </div>
                                    <div class="font-medium text-sm text-gray-500">
                                        {{ $page.props.auth.user.email }}
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 space-y-1">
                                <ResponsiveNavLink :href="route('profile.show')"
                                    :active="route().current('profile.show')">
                                    Profil
                                </ResponsiveNavLink>

                                <ResponsiveNavLink :href="route('cart')" :active="route().current('cart')">
                                    Mon panier
                                </ResponsiveNavLink>

                                <!-- Authentication -->
                                <form method="POST" @submit.prevent="logout">
                                    <ResponsiveNavLink as="button">
                                        Déconnexion
                                    </ResponsiveNavLink>
                                </form>
                            </div>
                        </div>
                    </template>
                </div>
            </nav>

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="!bg-cream">
                <slot />
            </main>

            <footer className="bg-darkgreen w-full text-white">
                <div
                    className="max-w-[1440px] mx-auto py-6 flex lg:flex-row justify-between text-sm md:items-center md:flex-col-reverse">
                    <p>© 2025 Développé par <a href="https://github.com/ISaejinI">Lou-Anne Biet.</a> Tous droits
                        réservés.</p>
                    <ul className="flex flex-wrap items-center">
                        <li>
                            <a class="hover:underline me-4" :href="route('home')">Accueil</a>
                        </li>
                        <li>
                            <a class="hover:underline me-4" :href="route('categories')">Catégories</a>
                        </li>
                    </ul>
                </div>
            </footer>
        </div>
    </div>
</template>