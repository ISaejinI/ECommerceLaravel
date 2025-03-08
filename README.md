# Instant Café - E-Commerce Laravel

Instant Café est une application e-commerce développée avec le framework **Laravel** et les librairies **Filament**, **Jetstream** et **Inertia.js**. Elle offre une plateforme complète pour la gestion et la vente de produits en ligne.

## Technologies utilisées

- **Laravel** : Framework PHP robuste pour le développement web.
- **Jetstream** : Gestion de l'authentification et des sessions utilisateur.
- **Inertia.js** : Permet d'utiliser Vue.js ou React sans API REST.
- **Filament** : Outil d'administration puissant pour Laravel.
- **Tailwind CSS** : Framework CSS moderne pour un design élégant et réactif.

## Fonctionnalités

- **Gestion des produits** : Ajout, modification et suppression de produits avec des attributs tels que le prix, la description et les images.
- **Panier d'achat** : Les utilisateurs peuvent ajouter des produits à leur panier et gérer les quantités.
- **Processus de commande** : Gestion complète du processus de commande, y compris la validation et le suivi.
- **Authentification des utilisateurs** : Système d'inscription et de connexion sécurisé pour les clients.
- **Tableau de bord administrateur** : Interface dédiée pour les administrateurs permettant la gestion des produits, des commandes et des utilisateurs.
- **Gestion des adresses utilisateurs** : Système d'ajout de supression et de séléction d'adresse principale pour les clients.

## Prérequis

- PHP >= 8.0
- Composer
- Node.js & npm
- Serveur web (Apache, Nginx, etc.)
- Base de données (MySQL, PostgreSQL, SQlite, etc.)

## Installation

1. **Cloner le dépôt**

   ```bash
   git clone https://github.com/ISaejinI/ECommerceLaravel.git
   cd ECommerceLaravel
   ```

2. **Installer les dépendances**

   ```bash
   composer install
   npm install
   ```

3. **Configurer l'environnement**

    Copier le fichier .env.example en .env et ajuster les paramètres de connexion à la base de données et autres configurations nécessaires.

   ```bash
   cp .env.example .env
   ```
   Générer la clé de l'application :
   ```bash
   php artisan key:generate
   ```

4. **Migrer la base de données**

    ```bash
    php artisan migrate --seed
    ```

5. **Lancer le serveur de développement**

    ```bash
    npm run dev
    php artisan serve
    ```
    L'application sera accessible à l'adresse http://localhost:8000.