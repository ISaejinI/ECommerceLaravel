<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { MinusIcon, PlusIcon, TrashIcon } from '@heroicons/vue/24/outline';
import { computed } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    products: {
        type: Array
    },
    addresses: {
        type: Object
    },
})

const totalAmount = computed(() => {
    return props.products.reduce((sum, product) => sum + (product.price * product.pivot.quantity), 0); 
})

const deleteFromCart = (product) => {
    router.delete(
        route('deleteFromCart', { product: product.id }),
        {
            preserveScroll: true,
        }
    )
}

const updateCart = (product, quantity) => {
    router.put(
        route('updateCart', { product: product.id }),
        {
            quantity: quantity,
        },
        {
            preserveScroll: true,
        }
    )
}

const updateAddress = (address) => {
    router.put(
        route('updateAddress', { address: address.id }),
        {
            is_default: true,
        },
        {
            preserveScroll: true,
        }
    )
}

const createOrder = () => {
    router.post (
        route('addOrder'),
        {
            preserveScroll: true,
        }
    )
}
</script>

<template>
    <AppLayout>
        <section class="w-full py-12">
            <div class="mx-auto my-16 max-w-7xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-4xl font-display font-bold text-darkgreen leading-10 mb-8 text-center">Panier</h2>

                <div class="grid grid-cols-12">
                    <div class="col-span-12 xl:col-span-8">
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
                                    <div class="block w-full">
                                        <select @change="updateCart(product, $event.target.value)" id="quantity" class="h-12 border border-gray-300 text-gray-600 text-base rounded-lg block w-full py-2.5 px-4 focus:outline-none">
                                            <option v-for="n in product.stock" :key="n" :selected="n == product.pivot.quantity" :value="n">{{ n }}</option>
                                        </select>
                                    </div>
                                    <button @click="deleteFromCart(product)" class="rounded-full px-6 py-[18px] border border-gray-200 flex items-center justify-center shadow-sm shadow-transparent transition-all duration-500 hover:shadow-gray-200 hover:border-gray-300 hover:bg-gray-50">
                                        <TrashIcon class="size-6" />
                                    </button>
                                </div>
                                <p class="text-darkgreen font-manrope font-bold text-2xl leading-9 w-full max-w-[176px] text-center">
                                    {{ product.price * product.pivot.quantity }} €
                                </p>
                            </div>
                        </div>
                    </div>



                    
                    <div class="col-span-12 xl:col-span-4">
                        <h2 class="font-manrope font-bold text-3xl leading-10 text-black pb-8 border-b border-gray-300">
                            Récapitulatif de commande</h2>
                        <div class="mt-8">
                            <div class="flex items-center justify-between pb-6">
                                <p class="font-normal text-lg leading-8 text-black">{{ products.length }} produit(s)</p>
                                <p class="font-medium text-lg leading-8 text-black">{{ totalAmount }} €</p>
                            </div>
                            <form>
                                <label class="flex  items-center mb-1.5 text-gray-600 text-sm font-medium">Adresse de livraison :
                                </label>
                                <div class="pb-6">
                                    <div v-for="address in addresses" class="w-full flex items-center gap-4"> 
                                        <input @change="updateAddress(address)" type="radio" name="addresse" :checked="address.is_default == true" :id="address.id">
                                        <label :for="address.id">
                                            <p> {{ address.street }} {{ address.postcode }} {{ address.city }}</p>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between py-8">
                                    <p class="font-medium text-xl leading-8 text-black">{{ products.length }} produit(s)</p>
                                    <p class="font-semibold text-xl leading-8 text-indigo-600">{{ totalAmount }} €</p>
                                </div>
                                <button @click="createOrder()" class="w-full text-center bg-pink rounded-xl py-3 px-6 font-semibold text-lg text-white transition-all duration-500 hover:bg-lightgreen">
                                    Commander
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>