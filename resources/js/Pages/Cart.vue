<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { MinusIcon, PlusIcon } from '@heroicons/vue/24/outline';
import { computed } from 'vue';

const props = defineProps({
    products: {
        type: Array
    },
})

const totalAmount = computed(() => {
    return props.products.reduce((sum, product) => sum + (product.price * product.pivot.quantity), 0); 
})
</script>

<template>
    <AppLayout>
        <section class="w-full py-12">
            <div class="mx-auto my-16 max-w-7xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-4xl font-display font-bold text-darkgreen leading-10 mb-8 text-center">Panier</h2>

                <div class="hidden lg:grid grid-cols-2 py-6">
                    <div class="font-normal text-xl leading-8 text-gray-500">Produit</div>
                    <p class="font-normal text-xl leading-8 text-gray-500 flex items-center justify-between">
                        <span class="w-full max-w-[260px] text-center">Quantité</span>
                        <span class="w-full max-w-[200px] text-center">Total</span>
                    </p>
                </div>

                <div v-for="product in products" class="grid grid-cols-1 lg:grid-cols-2 min-[550px]:gap-6 border-t border-gray-200 py-6">
                    <div class="flex items-center flex-col min-[550px]:flex-row gap-3 min-[550px]:gap-6 w-full max-xl:justify-center max-xl:max-w-xl max-xl:mx-auto">
                        <div class="img-box">
                            <img src="https://pagedone.io/asset/uploads/1701162850.png" alt="perfume bottle image" class="xl:w-[140px] rounded-xl object-cover">
                        </div>
                        <div class="pro-data w-full max-w-sm ">
                            <h3 class="font-semibold text-xl leading-8 text-black max-[550px]:text-center">
                                {{ product.label }}
                            </h3>
                            <p class="font-medium text-lg leading-8 text-darkgreen  max-[550px]:text-center">
                                {{ product.price }} €
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center flex-col min-[550px]:flex-row w-full max-xl:max-w-xl max-xl:mx-auto gap-2">
                        <div class="flex items-center w-full mx-auto justify-center">
                            <button class="group rounded-l-full px-6 py-[18px] border border-gray-200 flex items-center justify-center shadow-sm shadow-transparent transition-all duration-500 hover:shadow-gray-200 hover:border-gray-300 hover:bg-gray-50">
                                <MinusIcon class="size-6" />
                            </button>
                            <input disabled type="text" class="border-y border-gray-200 outline-none text-gray-900 font-semibold text-lg w-full max-w-[118px] min-w-[80px] placeholder:text-gray-900 py-[15px] text-center bg-transparent" :placeholder="product.pivot.quantity">
                            <button class="group rounded-r-full px-6 py-[18px] border border-gray-200 flex items-center justify-center shadow-sm shadow-transparent transition-all duration-500 hover:shadow-gray-200 hover:border-gray-300 hover:bg-gray-50">
                                <PlusIcon class="size-6" />
                            </button>
                        </div>
                        <p class="text-darkgreen font-manrope font-bold text-2xl leading-9 w-full max-w-[176px] text-center">
                            {{ product.price * product.pivot.quantity }} €
                        </p>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-xl p-6 w-full mb-8 max-lg:max-w-xl max-lg:mx-auto">
                    <div class="flex items-center justify-between w-full py-6">
                        <p class="font-manrope font-medium text-2xl leading-9 text-gray-900">Total</p>
                        <p class="font-manrope font-medium text-2xl leading-9 text-neutralgreen">{{ totalAmount }} €</p>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>