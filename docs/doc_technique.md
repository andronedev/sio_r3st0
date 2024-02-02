## Documentation Technique du Projet SIO R3ST0

## Table des matières

1. [Introduction](#introduction)
2. [Ajout de la carte](#ajout-de-la-carte)
3. [Adaptation du responsive](#adaptation-du-responsive)
4. [Système d'étoiles](#système-d'étoiles)

## Introduction

Ce document fournit une vue d'ensemble technique du projet SIO R3ST0. Il couvre spécifiquement les fonctionnalités d'ajout de la carte, d'adaptation du responsive et du système d'étoiles.

## Ajout de la carte

![capture d'écran](image.png)

La fonctionnalité d'ajout de la carte permet d'afficher une carte interactive sur la page de détail du restaurant en utilisant la bibliothèque Leaflet.js. Voici une explication détaillée du code :

### 1. Récupération de l'adresse du restaurant
Nous commençons par récupérer l'adresse du restaurant depuis le serveur et la stockons dans la variable `address`. Cette étape est essentielle pour obtenir l'emplacement exact du restaurant.

```php
var address = <?= json_encode($unResto['numAdrR'] . ' ' . $unResto['voieAdrR'] . ', ' . $unResto['cpR'] . ' ' . $unResto['villeR']); ?>;
```

### 2. Initialisation de la carte
Nous créons ensuite une instance de la carte Leaflet dans la `<div>` avec l'ID "map". La carte est configurée avec un marqueur pour le restaurant en utilisant les coordonnées géographiques obtenues à partir de l'API de données d'adresse du gouvernement français.

```javascript
var map = L.map('map');
var loading = document.getElementById('loading');
console.log("fetching address: " + address);

loading.style.display = 'block';
```

### 3. Récupération des coordonnées géographiques
Nous utilisons l'API de données d'adresse du gouvernement français pour obtenir les coordonnées géographiques à partir de l'adresse du restaurant. Les résultats sont affichés dans la console pour le débogage.

```javascript
fetch('https://api-adresse.data.gouv.fr/search/?q=' + encodeURIComponent(address))
    .then(response => response.json())
    .then(data => {
        var latitude = data.features[0].geometry.coordinates[1];
        var longitude = data.features[0].geometry.coordinates[0];
        console.log("latitude: " + latitude);
        console.log("longitude: " + longitude);
```

### 4. Affichage de la carte
Une fois les coordonnées obtenues, la carte est centrée sur ces coordonnées, et un marqueur avec le nom du restaurant est ajouté à la carte.

```javascript
map.setView([latitude, longitude], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
    maxZoom: 18,
}).addTo(map);

L.marker([latitude, longitude]).addTo(map)
    .bindPopup(<?= json_encode($unResto['nomR']); ?>)
    .openPopup();

loading.style.display = 'none';
```

[Voir le code Complet](https://github.com/andronedev/sio_r3st0/blob/f103856713e5f9400fc19c1aab0e65750c7ec669/vue/vueDetailResto.php#L52)


## Adaptation du responsive

<img src="image-1.png" alt="capture d'écran" height="500px">

L'adaptation du responsive a été réalisée pour rendre le site utilisable sur les appareils mobiles. Voici quelques ajustements qui ont été apportés pour améliorer la compatibilité avec les petits écrans :

```html
<!-- Meta tag pour la gestion du viewport -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
```

Le méta-tag ci-dessus a été ajouté pour garantir que la mise en page s'adapte correctement à la largeur de l'écran du dispositif utilisé.

```css
/* Media query pour les écrans de petite taille (600px ou moins) */
@media only screen and (max-width: 600px) {
    /* Réglages spécifiques pour le responsive */

    /* Exemple de style pour la classe .card */
    .card {
        width: 85% !important;
        display: flex;
        align-items: center;
    }

    /* Exemple de style pour la classe .photoCard */
    .photoCard {
        flex: 0 0 auto;
        margin-right: 10px;
    }

    /* Ajoutez ici d'autres styles pour d'autres éléments si nécessaire */
}
```

**Ces styles seront appliqués uniquement lorsque l'écran a une largeur maximale de 600 pixels (ou moins).** Il est possible de modifier cette partie du code si vous souhaitez apporter des ajustements spécifiques à la mise en page sur les appareils mobiles.

## Système d'étoiles

![capture d'écran](image-2.png)

Le système d'étoiles a été ajouté sur la page de la liste des restaurants. Pour ce faire, le contrôleur et la vue de la liste des restaurants ont été modifiés. Cela permet aux utilisateurs de voir rapidement la note globale de chaque restaurant.

### Modifications apportées

Les améliorations du système d'étoiles ont été réalisées grâce à plusieurs modifications du code, notamment dans le contrôleur des listes de restaurants, les fichiers de style CSS, et la vue de la liste des restaurants. Voici un résumé des changements effectués :

#### Contrôleur (`controleur/listeRestos.php`)

- **Inclusion d'un nouveau modèle** : Le fichier `bd.critiquer.inc.php` a été inclus pour accéder aux fonctions permettant de calculer la note moyenne des restaurants.
  
- **Calcul des notes moyennes** : Pour chaque restaurant listé, la note moyenne est calculée en faisant appel à la fonction `getNoteMoyenneByIdR` et est ajoutée au tableau des restaurants sous la clé `noteMoy`.

#### CSS (`css/base.css`)

- **Style du système d'étoiles** : Des styles spécifiques ont été ajoutés pour le nouvel élément `.note`, permettant d'afficher la note moyenne de manière élégante et lisible. Ces styles incluent la mise en forme du texte, l'ajout d'une icône d'étoile et le changement de l'apparence au survol.

#### Vue de la liste des restaurants (`vue/vueListeRestos.php`)

- **Affichage de la note moyenne** : Au sein de chaque carte de restaurant, un nouvel élément HTML a été ajouté pour afficher la note moyenne à l'aide d'une icône d'étoile suivie de la valeur numérique de la note. Cette présentation visuelle permet aux utilisateurs de rapidement évaluer la qualité du restaurant.
