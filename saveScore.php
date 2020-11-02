<?php
require_once('init.php');

$score = new Score( $_POST['name'], $_POST['score']);
$score = $score->getRank($score);

$rslt = $score->saveScore($score);
echo json_encode($rslt);


die;
?>