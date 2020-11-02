<?php
require_once ("./init.php"); 

if($_POST['name']){
    $game = Game::getInstance($_POST['name']);
    $jsonAnts = [];
    foreach( $game->ants as $ant ){
        $jsonAnts[$ant->name] = $ant;
    }
}else{
    throw new Exception("Name isn't valid");
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/style.css" media="all"/>

    <title>Document</title>
</head>
<body>
    <h1>Le jeu de la fourmilière </h1>
    <div class="info">Pseudo :<div id="playerName"></div></div>
    <div class="info">Nombre d'attaque :<div id="attackNumber"></div></div>
    <div class="info">Score :<div id="score"></div></div>

    <div id="gameBoard"></div>
    <button class="gameFinished" id="restart">restart</button>
    <button class="gameFinished" id="saveScore">sauvegarder mon score</button>
    <button id="attack">Attaquer</button>
    <button id="perfectAttack">Attaque parfaite</button>

</body>
</html>

<script>
    let jsonAnts     = <?php echo json_encode($jsonAnts); ?>;
    let playerName   = <?php echo json_encode($game->playerName); ?>;
    let attackNumber = <?php echo json_encode($game->attackNumber); ?>;
</script>
<script src="public/js/main.js"></script>