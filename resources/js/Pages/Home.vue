<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    categories: {
        type: Array
    }
})
</script>
<!-- Container : mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 -->
<template>
    <AppLayout>
        <div>
            <!-- Hero -->
            <section class="w-full bg-[url('/bgHero.jpg')] bg-cover bg-center relative">
                <div class="absolute inset-0 bg-black bg-opacity-30 z-0"></div>
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 min-h-[550px] flex flex-col justify-end py-16 z-10 relative">
                    <h1 class="text-7xl font-display font-bold text-lightgreen mb-6">Arrêtez-vous un insant : <br /> Café et Matcha d'exception</h1>
                    <p class='w-1/2 text-gray-50'>Redéfinissez votre pause café avec des saveurs uniques et authentiques. Café corsé ou matcha onctueux, trouvez votre allié parfait pour booster votre journée avec style et énergie.</p>
                    <a :href="route('home')" class="mt-6 px-6 py-3 bg-neutralgreen hover:bg-lightgreen text-white font-semibold rounded-lg shadow-lg w-fit">
                        Découvrez nos produits
                    </a>
                </div>
            </section>
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                
                <div class="mx-auto max-w-2xl py-16 sm:py-24 lg:max-w-none lg:py-32">
                    <h2 class="text-2xl font-bold text-gray-900">Toutes nos catégories</h2>
                    <div class="mt-6 space-y-12 lg:grid lg:grid-cols-3 lg:gap-x-6 lg:space-y-0">
                        <div v-for="category in categories" :key="category.name" class="group relative">
                            <img :src="'https://picsum.photos/500/600?rand=' + category.id" :alt="category.imageAlt"
                                class="w-full rounded-lg bg-white object-cover group-hover:opacity-75 max-sm:h-80 sm:aspect-2/1 lg:aspect-square" />
                            <h3 class="mt-6 text-sm text-gray-500">
                                <a :href="route('category', { slug: category.slug })">
                                    <span class="absolute inset-0" />
                                    {{ category.label }}
                                </a>
                            </h3>
                            <p class="text-base font-semibold text-gray-900">{{ category.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>