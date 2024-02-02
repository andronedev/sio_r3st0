# r3st0.fr

Bienvenue sur le répertoire officiel de r3st0.fr, un projet scolaire développé par les étudiants en BTS SIO. Ce projet vise à fournir une plateforme web interactive pour explorer, évaluer et découvrir des restaurants.

## Table des Matières

- [Prérequis](#prérequis)
- [Installation](#installation)
- [Configuration](#configuration)
- [Lancement](#lancement)
- [Contribuer](#contribuer)
- [Documentation](#documentation)
- [Support](#support)

## Prérequis

Avant de commencer, assurez-vous d'avoir installé :
- PHP 8 recommandé
- MySQL
- Un serveur web tel que Apache ou Nginx, ou simplement utiliser le serveur intégré de PHP pour un test local

## Installation

Suivez ces étapes pour installer le projet sur votre machine locale :

1. **Clonage du projet**

   Utilisez la commande suivante pour cloner le projet via Git :

   ```bash
   git clone https://github.com/andronedev/sio_r3st0.git
   ```

2. **Accès au répertoire du projet**

   Changez de répertoire pour accéder au projet cloné :

   ```bash
   cd sio_r3st0
   ```

## Configuration

1. **Base de Données**

   - Modifiez le fichier `modele/bd.inc.php` avec vos informations de connexion à la base de données.

   - Importez le fichier `base.sql` dans votre système de gestion de base de données pour créer la structure nécessaire au fonctionnement de l'application.

## Lancement

Pour lancer le projet localement, utilisez la commande suivante :

```bash
php -S localhost:8080
```

Ouvrez votre navigateur et accédez à `http://localhost:8080` pour voir l'application en action.

## Contribuer

Nous accueillons les contributions de tous ! Si vous souhaitez contribuer, veuillez forker le projet, créer une branche pour chaque fonctionnalité ou correction, puis soumettre une pull request.

## Documentation

Pour plus d'informations sur l'utilisation et le développement du projet, veuillez consulter [notre documentation en ligne](https://andronedev.github.io/sio_r3st0/).
