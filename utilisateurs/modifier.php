<?php
    require '../bdd/connexion_bdd.php';
    require '../includes/header.php';

    $sql = 'SELECT * FROM `utilisateur` WHERE id = :id';
    $requete = $bdd->prepare($sql);
    $requete->bindParam(":id", $_GET['id']);
    $requete->execute();
    $utilisateur = $requete->fetch();
?>

<div class="container">
    <br>
    <h3>Modification de l'utilisateur : <?php echo $utilisateur['prenom'].' '.$utilisateur['nom']; ?></h3>
    <br>

    <input type="text" class="form-control mb-3" name="prenom" placeholder="Prénom" value="<?php echo $utilisateur['prenom']; ?>" required>
    <input type="text" class="form-control mb-3" name="nom" placeholder="Nom" value="<?php echo $utilisateur['nom']; ?>" required>
    <input type="text" class="form-control mb-3" name="email" placeholder="Email" value="<?php echo $utilisateur['email']; ?>" required>
    <input type="text" class="form-control mb-3" name="identifiant" placeholder="Identifiant" value="<?php echo $utilisateur['identifiant']; ?>" required>
    <input type="password" class="form-control mb-3" name="motDePasse" placeholder="Mot de passe" value="<?php echo $utilisateur['motDePasse']; ?>" required>
    <input type="date" class="form-control mb-3" name="dateNaissance" placeholder="Date de naissance" value="<?php echo $utilisateur['dateNaissance']; ?>" required>
    <input type="date" class="form-control mb-3" name="dateEmbauche" placeholder="Date d'embauche" value="<?php echo $utilisateur['dateEmbauche']; ?>" required>
    <select class="form-select" name="role" placeholder="Role" value="<?php echo $utilisateur['roleId']; ?>" required>
        <option value="1">Visiteur</option>
        <option value="2">Comptable</option>
        <option value="3">Administrateur</option>
    </select>

    <br>

    <button type="submit" class="btn btn-success" name="mode" value="creation">Sauvegarder</button>
</div>



<?php
require '../includes/footer.php';
?>