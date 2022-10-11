<?php

$bdd = new PDO('mysql:host=localhost;dbname=autoscout24;', 'root', '');
$query = 'SELECT * from voitures';

$allvoitures = $bdd->query($query);

    if(isset($_GET['s']) or isset($_GET['carburant']) or isset($_GET['immatriculation'])){
    $recherche = htmlspecialchars($_GET['s']);
    $carburant = htmlspecialchars($_GET['carburant']);
    $immatriculation = ($_GET['immatriculation']);
    $conditions = array();

    if(!empty($recherche)) {
        $conditions[] = 'marque like "%' .$recherche. '%"';
    }
    if(!empty($carburant)) {
        $conditions[] = 'carburant like "%' .$carburant. '%"';
    }
    if(!empty($immatriculation)) {
        $conditions[] = "Premiere_immatriculation = '$immatriculation'";
    }

    $sql = $query;
    if (count($conditions) > 0) {
        $sql .= " WHERE " . implode(' AND ', $conditions);
    }

    $allvoitures = $bdd->query($sql);

}
?>

<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Recherche avec filtre</title>
<link rel="stylesheet" href="style.css">

</head>
<body>
    <h1>VROOMISSIMO</h1>
<div class="bloc">
<form method="GET">
<label for="s">Rechercher une marque :</label>
<input type="search" name="s">
<label for="carburant">Rechercher par carburant :</label>
<input type="search" id="carburant" name="carburant"><br/>
<label for="immatriculation">Rechercher par date d'immatriculation :</label>
<input type="search" id="immatriculation" name="immatriculation">
<input type="submit" name="envoyer"><br/>

 


</form></div>
<br/><br/><br/>
<section class="afficher_marque">
<?php
    if($allvoitures->rowCount() > 0){
        while($marque = $allvoitures->fetch()){
            ?>
            <p><?= $marque['marque']; ?>
               <?= $marque['carburant']; ?>
               <?= $marque['Premiere_immatriculation']; ?></p>
            <?php
        }

    }else{
        ?>
        <p>aucune marque trouvée</p>
        <?php
    }
?>
</section>
</body>
</html>