<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    product: {
        type: Array
    }
})

const quantity = ref(1);

// Définir la fonction qui appelle la route
// Avec Inertia et passer les paramètres
function addtocart() {
  router.post(route("addToCart",{
    "product": props.product.id
  }),{
    "quantity": quantity.value
  })
}
</script>

<template>
    <AppLayout>
        <h1>Coucou, vous êtes sur la page du produit : {{ product.label }}</h1>
        <p>Prix : {{ product.price }} €</p>
        <p>Description : {{ product.description }}</p>
        <p>Nombre en stock : {{ product.stock }}</p>

        <p>Toutes les catégories</p>
        <li v-for="category in product.categories" :key="category.id" >{{ category.name }}</li>



        <br><br><br>

        <form @submit.prevent="addtocart"> <!-- Modifier l'action avec la fonction du dessus -->
            <label for="qte">Quantité</label> <br>
            <input type="number" name="qte" id="qte" min="1" :max="product.stock" v-model="quantity"> <br>
            <input type="hidden" name="current_product" :value="product.id">
            <button>Add to cart</button>
        </form>
    </AppLayout>
</template>