# Arcadia - Zoo de Brocéliande

Bienvenue dans le README d'Arcadia, un site web dédié à la découverte de la faune et de la flore.

## Présentation

Le Zoo de Brocéliande - Arcadia est un projet visant à sensibiliser le public à la préservation de la nature en mettant en avant les espèces diverses vivant dans différents habitats. À travers des expositions interactives, des guides éducatifs et des événements spéciaux, le zoo offre une expérience unique pour les visiteurs de tous âges.

## Fonctionnalités

- **Explorer :** Plongez dans l'univers du Zoo de Brocéliande à travers des photos et des descriptions détaillées des animaux qui y résident.
- **Activités :** Découvrez une variété d'activités ludiques et éducatives pour toute la famille, telles que des visites guidées, des restaurants et des balades en train.

## Installation

Le site du Zoo - Arcadia est déjà déployé sur Internet et accessible à l'adresse suivante : mennad.fr, Vous pouvez explorer le site en visitant ce lien dans votre navigateur web.

## Contribution

Nous accueillons les contributions de la communauté pour enrichir l'expérience d'Arcadia. Si vous souhaitez contribuer, veuillez laisser un avis sur la page d'accueil du zoo.

## Retour d'information

Nous sommes ouverts à vos retours ! Si vous avez des suggestions, des idées ou rencontrez des problèmes lors de l'utilisation du site, n'hésitez pas à nous contacter par mail : boutaleb.mennad@gmail.com, Vos commentaires nous aident à améliorer l'expérience pour tous nos visiteurs.

## Installation

Le site du Zoo de Brocéliande - Arcadia est déjà déployé sur Internet et accessible à l'adresse suivante : mennad.fr, Vous pouvez explorer le site en visitant ce lien dans votre navigateur web.

# Déploiement Local du Site Web

Ce dépôt contient le code source d'un site web ainsi que la base de données nécessaire pour le faire fonctionner en local. Suivez les instructions ci-dessous pour configurer votre environnement de développement local.

## Prérequis

- [XAMPP](https://www.apachefriends.org/index.html), [WAMP](http://www.wampserver.com/en/), ou [MAMP](https://www.mamp.info/en/) pour servir Apache et MySQL.
- [Git](https://git-scm.com/) pour cloner le dépôt.
- [phpMyAdmin](https://www.phpmyadmin.net/) pour gérer la base de données.

## Étapes pour Déployer le Site

### 1. Cloner le Dépôt

Ouvrez un terminal ou une invite de commande et clonez le dépôt Git :

git clone https://github.com/Mennad92/Arcadia
cd ARCADIA

### 2. Configurer l'Environnement Local

Démarrez les services Apache et MySQL via le panneau de contrôle de XAMPP (ou WAMP/MAMP).

### 3. Créer la Base de Données

Accédez à phpMyAdmin via http://localhost/phpmyadmin.
Créez une nouvelle base de données en utilisant le nom arcadia.

### 4. Importer le Fichier SQL

Dans phpMyAdmin, sélectionnez la base de données que vous venez de créer.
Cliquez sur l'onglet "Importer".
Cliquez sur "Choisir un fichier" et sélectionnez le fichier SQL situé dans le répertoire database/ de votre projet.
Cliquez sur "Exécuter" pour importer les données.

### 5. Configurer les Connexions à la Base de Données

Vous devez mettre à jour les informations de connexion dans votre script PHP. Voici comment modifier les paramètres pour un environnement local :

Ouvrez le fichier PHP où la connexion à la base de données est établie dans le src/connect.php Recherchez le code de connexion PDO, par exemple :

' $db = new PDO('mysql:host=localhost;dbname=arcadia;charset=utf8;port=3307', 'root', ''); '
Modifiez les informations de connexion pour correspondre à votre environnement local.


### 6. Accéder au Site

Déplacez le répertoire du projet dans le répertoire htdocs de XAMPP (ou le répertoire racine de votre serveur local pour WAMP/MAMP).
Ouvrez votre navigateur et accédez à http://localhost/arcadia. (ou autre si vous n'avez pas choisi d'appelé votre dossier Arcadia)