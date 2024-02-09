# r3st0.fr
[![Documentation - Technique](https://img.shields.io/static/v1?label=Documentation&message=Technique&color=blue&style=for-the-badge&logo=php)](https://andronedev.github.io/sio_r3st0/doc_technique.html)
[![Documentation - Utilisateur](https://img.shields.io/static/v1?label=Documentation&message=Utilisateur&color=yellow&style=for-the-badge&logo=clubhouse)](https://andronedev.github.io/sio_r3st0/doc_utilisatrice.html)

Bienvenue sur le répertoire officiel de r3st0.fr, un projet scolaire développé par les étudiants en BTS SIO. Ce projet vise à fournir une plateforme web interactive pour explorer, évaluer et découvrir des restaurants.

## Table des Matières

- [Prérequis](#prérequis)
- [Installation](#installation)
- [Configuration](#configuration)
- [Lancement](#lancement)
- [Documentation](https://andronedev.github.io/sio_r3st0/)

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

   Ou téléchargez le projet directement depuis GitHub en cliquant [ici](https://github.com/andronedev/sio_r3st0/archive/refs/heads/main.zip)

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

