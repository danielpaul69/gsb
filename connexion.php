<?php
require 'bdd/connexion_bdd.php';
require 'includes/header.php';

// require 'bdd/entities/utilisateur.php';
?>

<div class="container">
    <div class="card m-5 p-4">
        <form method="POST" action="">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Identifiant</label>
                <input type="text" class="form-control" name="identifiant">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="motDePasse">
            </div>
            <button type="submit" class="btn btn-primary">Connexion</button>
        </form>
    </div>
</div>

<?php
    session_start();

if (
    isset($_POST['identifiant']) && 
    isset($_POST['motDePasse']) &&
    !empty($_POST['identifiant']) &&
    !empty($_POST['motDePasse'])
    ) {
    $sql = 'SELECT * FROM `utilisateur` WHERE identifiant = :identifiant AND motDePasse = :motDePasse';
    $requete = $bdd->prepare($sql);
    $requete->bindParam(":identifiant", $_POST['identifiant']);
    $requete->bindParam(":motDePasse", $_POST['motDePasse']);
    $requete->execute();
    $resultats = $requete->fetchAll();

    if (!empty($resultats)) {
        $_SESSION['utilisateur'] = $resultats[0];
        if ($resultats[0]['roleId'] == 3) {
            header('location: utilisateurs/liste.php');
        }else{
            header('location: index.php');
        }
    }
}

require 'includes/footer.php';
?>