<script setup>
import ProductCard from '@/Components/ProductCard.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { ArrowUpRightIcon, TruckIcon, GlobeEuropeAfricaIcon, FaceSmileIcon, SparklesIcon } from '@heroicons/vue/24/outline'

defineProps({
    randomCategories: {
        type: Array
    },

    mostSoldProducts: {
        type: Array
    },
})
</script>
<!-- Sections : w-full py-12 my-16 -->
<!-- Container : mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 -->
<template>
    <AppLayout>
        <div>
            <!-- Hero -->
            <section class="w-full bg-[url('/images/bgHero.jpg')] bg-cover bg-center relative mb-16">
                <div class="absolute inset-0 bg-black bg-opacity-30 z-0"></div>
                <div
                    class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 min-h-[550px] flex flex-col justify-end py-16 z-10 relative">
                    <h1 class="text-7xl font-display font-bold text-lightgreen mb-6">Arrêtez-vous un insant : <br />
                        Café et Matcha d'exception</h1>
                    <p class='w-1/2 text-gray-50'>Redéfinissez votre pause café avec des saveurs uniques et
                        authentiques. Café corsé ou matcha onctueux, trouvez votre allié parfait pour booster votre
                        journée avec style et énergie.</p>
                    <a :href="route('home')"
                        class="mt-6 px-6 py-3 bg-neutralgreen hover:bg-lightgreen text-white font-semibold rounded-lg shadow-lg w-fit">
                        Découvrez nos produits
                    </a>
                </div>
            </section>

            <!-- Catégories à la une -->
            <section class="w-full py-12 my-16">
                <div class="mx-auto max-w-7xl px-4 my-16 sm:px-6 lg:px-8">
                    <div class="flex justify-between mb-8 items-center">
                        <h2 class="text-4xl font-display font-bold text-darkgreen">Nos catégories à la une</h2>
                        <a :href="route('home')"
                            class="mt-6 px-6 py-3 bg-neutralgreen hover:bg-lightgreen text-white font-semibold rounded-lg shadow-lg w-fit">
                            Toutes les catégories
                        </a>
                    </div>
                    <div class='flex min-h-[600px]'>
                        <div
                            class="w-1/2 overflow-hidden rounded-3xl mr-4 bg-[url('/images/fouet.jpg')] bg-cover bg-center">
                        </div>
                        <div class='w-1/2 pl-4'>
                            <div v-for="category in randomCategories" :key="category.slug"
                                class='w-full pt-6 pb-6 border-b-2 mb-8 border-black'>
                                <a :href="route('category', { slug: category.slug })"
                                    class="flex justify-between items-center w-full">
                                    <p class='text-2xl'>{{ category.label }}</p>
                                    <ArrowUpRightIcon class='size-6' />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Valeurs -->
            <section class="w-full bg-pink py-12 my-16 text-center">
                <div class='max-w-7xl mx-auto px-4 sm:px-6 lg:px-8'>
                    <h2 class="text-4xl font-display font-bold text-darkgreen mb-8">Pourquoi nous choisir ?</h2>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 px-8">
                        <div class="flex flex-col items-center">
                            <TruckIcon class="size-24 text-neutralgreen" />
                            <p class="mt-2 text-gray-900">Livraison rapide</p>
                        </div>
                        <div class="flex flex-col items-center">
                            <GlobeEuropeAfricaIcon class="size-24 text-neutralgreen" />
                            <p class="mt-2 text-gray-900">Produits naturels</p>
                        </div>
                        <div class="flex flex-col items-center">
                            <SparklesIcon class="size-24 text-neutralgreen" />
                            <p class="mt-2 text-gray-900">Qualité premium</p>
                        </div>
                        <div class="flex flex-col items-center">
                            <FaceSmileIcon class="size-24 text-neutralgreen" />
                            <p class="mt-2 text-gray-900">Satisfait ou remboursé</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Produits les plus vendus -->
            <section class="w-full py-12 my-16">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between mb-8 items-center">
                        <h2 class="text-4xl font-display font-bold text-darkgreen">Nos produits les plus vendus</h2>
                        <a :href="route('home')"
                            class="mt-6 px-6 py-3 bg-neutralgreen hover:bg-lightgreen text-white font-semibold rounded-lg shadow-lg w-fit">
                            Tous les produits
                        </a>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        <div v-for="product in mostSoldProducts">
                            <ProductCard :product />
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </AppLayout>
</template>