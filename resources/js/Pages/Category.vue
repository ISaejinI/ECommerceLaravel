<script setup>
import ProductCard from '@/Components/ProductCard.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    slug: {
        type: String,
        required: true
    },

    label: {
        type: String,
        required: true
    },

    products: {
        type: Array,
    }
})
</script>

<template>
    <AppLayout>
        <div class="bg-white">
            <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-8">Tous les produits de la catégorie <span class="text-blue-900">{{ label }}</span></h2>

                <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                    <a v-for="product in products" :key="product.id" :href="route('product', {product_slug: product.label})" class="group">
                        <ProductCard :product />
                    </a>
                </div>
            </div>
        </div>
    </AppLayout>
</template>