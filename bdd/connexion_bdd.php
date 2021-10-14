<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=gsb;charset=utf8', 'root', '');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

// $reponse = $bdd->query('SELECT * FROM `role`');
// $reponse->execute();
// $roles = $reponse->fetchAll();
// var_dump($roles);
?>