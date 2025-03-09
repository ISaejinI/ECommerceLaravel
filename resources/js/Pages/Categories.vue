<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    categories: {
        type: Array
    },
})
</script>

<template>
    <AppLayout>        
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl py-16 sm:py-24 lg:max-w-none lg:py-32">
                <h1 class="text-4xl font-display font-bold text-darkgreen">Toutes nos catégories</h1>
                <div class="mt-6 space-y-12 lg:grid lg:grid-cols-3 lg:gap-x-6 lg:space-y-0">
                    <div v-for="category in categories" :key="category.name" class="group relative">
                        <img :src="'https://picsum.photos/500/600?rand=' + category.id" :alt="category.imageAlt"
                            class="mt-8 w-full rounded-lg bg-white object-cover group-hover:opacity-75 max-sm:h-80 sm:aspect-2/1 lg:aspect-square" />
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
    </AppLayout>
</template>