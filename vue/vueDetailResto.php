<h1><?= $unResto['nomR']; ?>

    <?php if ($aimer != false) { ?>
    <a href="./?action=aimer&idR=<?= $unResto['idR']; ?>"><img class="aimer" src="images/aime.png"
            alt="j'aime ce restaurant"></a>
    <?php } else { ?>
    <a href="./?action=aimer&idR=<?= $unResto['idR']; ?>"><img class="aimer" src="images/aimepas.png"
            alt="je n'aime pas encore ce restaurant"></a>
    <?php } ?>

</h1>

<span id="note">
    <?php for ($i = 1; $i <= 5; $i++) { ?>
    <a class="aimer" href="./?action=noter&note=<?= $i ?>&idR=<?= $unResto['idR']; ?>">
        <?php if ($i <= $noteMoy) { ?>
        <img class="note" src="images/like.png" alt="">
        <?php } else {
                ?>
        <img class="note" src="images/neutre.png" alt="line neutre">
        <?php } ?>
    </a>
    <?php } ?>
</span>
<section>
    Cuisine <br />
    <ul id="tagFood">
        <?php for ($j = 0; $j < count($lesTypesCuisine); $j++) { ?>
        <li class="tag"><span class="tag">#</span><?= $lesTypesCuisine[$j]["libelleTC"] ?></li>
        <?php } ?>
    </ul>

</section>
<p id="principal">
    <?php if (count($lesPhotos) > 0) { ?>
    <img src="photos/<?= $lesPhotos[0]["cheminP"] ?>" alt="photo du restaurant" />
    <?php } ?>
    <br />
    <?= $unResto['descR']; ?>
</p>
<h2 id="adresse">
    Adresse
</h2>
<p>
    <?= $unResto['numAdrR']; ?>
    <?= $unResto['voieAdrR']; ?><br />
    <?= $unResto['cpR']; ?>
    <?= $unResto['villeR']; ?>

</p>

<div id="map" style="width:100%; height: 300px; z-index: 1;"></div>

<div id="loading" style="display: none;">Chargement de la carte...</div>

<script>
    var address = <?= json_encode($unResto['numAdrR'] . ' ' . $unResto['voieAdrR'] . ', ' . $unResto['cpR'] . ' ' . $unResto['villeR']); ?>;
    var map = L.map('map');
    var loading = document.getElementById('loading');
    console.log("fetching address: " + address);
    
    loading.style.display = 'block';

    fetch('https://api-adresse.data.gouv.fr/search/?q=' + encodeURIComponent(address))
        .then(response => response.json())
        .then(data => {
            var latitude = data.features[0].geometry.coordinates[1];
            var longitude = data.features[0].geometry.coordinates[0];
            console.log("latitude: " + latitude);
            console.log("longitude: " + longitude);

            map.setView([latitude, longitude], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                maxZoom: 18,
            }).addTo(map);

            L.marker([latitude, longitude]).addTo(map)
                .bindPopup(<?= json_encode($unResto['nomR']); ?>)
                .openPopup();

            loading.style.display = 'none';
        })
        .catch(error => {
            console.error(error);
            loading.style.display = 'none';
        });
</script>




<h2 id="photos">
    Photos
</h2>
<ul id="galerie">
    <?php for ($i = 0; $i < count($lesPhotos); $i++) { ?>
    <li> <img class="galerie" src="photos/<?= $lesPhotos[$i]["cheminP"] ?>" alt="" /></li>
    <?php } ?>

</ul>

<h2 id="horaires">
    Horaires
</h2>
<?= $unResto['horairesR']; ?>


<h2 id="crit">Critiques</h2>

<ul id="critiques">
    <?php for ($i = 0; $i < count($critiques); $i++) { ?>
    <li>
        <span>
            <?= $critiques[$i]["mailU"] ?>
            <?php if ($critiques[$i]["mailU"] == $mailU) { ?>
            <a href='./?action=supprimerCritique&idR=<?= $unResto['idR']; ?>'>Supprimer</a>
            <?php } ?>
        </span>
        <div>
            <span>
                <?php
                    if ($critiques[$i]["note"]) {
                        echo $critiques[$i]["note"] . "/5";
                    }
                    ?>
            </span>
            <span><?= $critiques[$i]["commentaire"] ?> </span>
        </div>

    </li>
    <?php } ?>

</ul>

<h2>Ajouter une critique</h2>


<?php if ($maCritique == false) { ?>
<form action="?action=commenter" method="POST">
    <label for="commentaire">Commentaire :</label>
    <input type="text" name="commentaire" id="commentaire" required>

    <div> 
        <label>Note :</label>
        <input type="radio" name="note" value="1" required> 1
        <input type="radio" name="note" value="2" required> 2
        <input type="radio" name="note" value="3" required> 3
        <input type="radio" name="note" value="4" required> 4
        <input type="radio" name="note" value="5" required> 5
    </div>
    <br>
    <input type="hidden" name="do" value="ajouter">
    <input type="hidden" name="idR" value="<?= $unResto['idR']; ?>">
    <input type="submit" value="Ajouter" style="width: 100px; height: 30px;">
</form>

<?php } else { ?>
<p>Vous avez déjà commenté ce restaurant</p>
<small>Modifier votre commentaire</small>
<form action="?action=commenter" method="POST">
    <label for="commentaire">Commentaire :</label>
    <input type="text" name="commentaire" id="commentaire" required value="<?= $maCritique['commentaire']; ?>">

    <div> 
        <label>Note :</label>
        <input type="radio" name="note" value="1" required <?php if (!isset($maCritique['note']) || $maCritique['note'] == '1') echo 'checked'; ?>> 1
        <input type="radio" name="note" value="2" required <?php if (isset($maCritique['note']) && $maCritique['note'] == '2') echo 'checked'; ?>> 2
        <input type="radio" name="note" value="3" required <?php if (isset($maCritique['note']) && $maCritique['note'] == '3') echo 'checked'; ?>> 3
        <input type="radio" name="note" value="4" required <?php if (isset($maCritique['note']) && $maCritique['note'] == '4') echo 'checked'; ?>> 4
        <input type="radio" name="note" value="5" required <?php if (isset($maCritique['note']) && $maCritique['note'] == '5') echo 'checked'; ?>> 5
    </div>
    <br>
    <input type="hidden" name="do" value="modifier">
    <input type="hidden" name="idR" value="<?= $unResto['idR']; ?>">
    <input type="submit" value="Modifier" style="width: 100px; height: 30px;">
</form>
<?php } ?>