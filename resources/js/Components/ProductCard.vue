<script setup>
import { PlusIcon } from '@heroicons/vue/24/outline';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    product: {
        type: Object,
    },
});

const addToCart = () => {
    router.post(
        route('addToCart', { productId: props.product.id }),
        {
            quantity: 1,
            productId: props.product.id
        },
        {
            preserveScroll: true,
        }
    )
}
</script>

<template>
    <div :key="product.id" class="bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transition-shadow group relative">
        <a :href="route('product', { product_slug: product.slug })">
            <img 
                :src=product.thumbnail
                :alt=product.label
                class="aspect-square w-full bg-gray-200 object-cover rounded-md mb-4 group-hover:opacity-75"
            />
        </a>
        <a :href="route('product', { product_slug: product.slug })">
            <h2 class="text-xl font-semibold text-gray-700 mb-2"> {{ product.label }} </h2>
        </a>
        <div class="w-full flex justify-between items-center">
            <p class="text-gray-900 font-bold text-lg mb-2">{{ product.price }} €</p>
            <button @click="addToCart()" class="w-fit bg-neutralgreen text-white px-4 py-2 rounded hover:bg-darkgreen">
                <PlusIcon class="size-6" />
            </button>
        </div>
    </div>
</template>