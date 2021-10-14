<?php
    require '../bdd/connexion_bdd.php';
    require '../includes/header.php';    

    if (isset($_POST['mode']) && $_POST['mode'] == 'creation') {
        $sql = '
            INSERT INTO `utilisateur`(`nom`, `prenom`, `email`, `identifiant`, `motDePasse`, `dateNaissance`, `dateEmbauche`, `roleId`) 
            VALUES (:nom, :prenom, :email, :identifiant, :motDePasse, :dateNaissance, :dateEmbauche, :roleId)
        ';
        $requete = $bdd->prepare($sql);
        $requete->bindParam(":nom", $_POST['nom']);
        $requete->bindParam(":prenom", $_POST['prenom']);
        $requete->bindParam(":email", $_POST['email']);
        $requete->bindParam(":identifiant", $_POST['identifiant']);
        $requete->bindParam(":motDePasse", $_POST['motDePasse']);
        $requete->bindParam(":dateNaissance", $_POST['dateNaissance']);
        $requete->bindParam(":dateEmbauche", $_POST['dateEmbauche']);
        $requete->bindParam(":roleId", $_POST['role']);
        var_dump($requete->execute());
    }
    
    $reponse = $bdd->query('
        SELECT utilisateur.`id`, `nom`, `prenom`, `email`, `identifiant`, `motDePasse`, `dateNaissance`, `dateEmbauche`, `libelle` as libelleRole 
        FROM utilisateur 
        INNER JOIN role ON utilisateur.roleId = role.id
    ');
    $reponse->execute();
    $utilisateurs = $reponse->fetchAll();
?>

<div class="container">
    <br><br>

    <!-- Bouton pour ouvrir le formulaire de création -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Nouveau
    </button>
    <!-- Bouton pour ouvrir le formulaire de création -->

    <!-- Modal : Formulaire de création -->
    <form method="POST" action="">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nouvel utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <input type="text" class="form-control mb-3" name="prenom" placeholder="Prénom" required>
                    <input type="text" class="form-control mb-3" name="nom" placeholder="Nom" required>
                    <input type="text" class="form-control mb-3" name="email" placeholder="Email" required>
                    <input type="text" class="form-control mb-3" name="identifiant" placeholder="Identifiant" required>
                    <input type="password" class="form-control mb-3" name="motDePasse" placeholder="Mot de passe" required>
                    <input type="date" class="form-control mb-3" name="dateNaissance" placeholder="Date de naissance" required>
                    <input type="date" class="form-control mb-3" name="dateEmbauche" placeholder="Date d'embauche" required>
                    <select class="form-select" name="role" placeholder="Role" required>
                        <option value="1">Visiteur</option>
                        <option value="2">Comptable</option>
                        <option value="3">Administrateur</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-success" name="mode" value="creation">Sauvegarder</button>
            </div>
            </div>
        </div>
        </div>
    </form>
    <!-- Modal : Formulaire de création -->

    <table class="table">
    <thead>
        <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Identifiant</th>
        <th>Date de naissance</th>
        <th>Date d'embauche</th>
        <th>Role</th>
        <th>Actions</th>
        </tr>
    </thead>
    <tbody>
            <?php
                foreach ($utilisateurs as $utilisateur) {
                    ?>
                        <tr>
                            <td><?php echo $utilisateur['nom']; ?></td>
                            <td><?php echo $utilisateur['prenom']; ?></td>
                            <td><?php echo $utilisateur['email']; ?></td>
                            <td><?php echo $utilisateur['identifiant']; ?></td>
                            <td>
                                <?php 
                                    $dateNaissance = new DateTime($utilisateur['dateNaissance']); 
                                    echo $dateNaissance->format('d/m/Y'); 
                                ?>
                            </td>
                            <td>
                                <?php 
                                    $dateEmbauche = new DateTime($utilisateur['dateEmbauche']); 
                                    echo $dateEmbauche->format('d/m/Y'); 
                                ?>
                            </td>
                            <td><?php echo $utilisateur['libelleRole']; ?></td>
                            <td>
                                <button class="btn btn-warning"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    <?php
                }
            ?>
    </tbody>
    </table>
</div>

<?php
require '../includes/footer.php';
?>