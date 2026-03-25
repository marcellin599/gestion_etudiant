<?php
include('gestion.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
     rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
     integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
     crossorigin="anonymous"></script>
    <title>Student Modification</title>
</head>
<body>
    <div class="d-flex align-items-center mb-4">
    <img src="gestion-etudiant.jpg" alt="Logo" class="me-3" style="height: 140px;">
    <h1 class="pagehead m-0">
        MODIFICATION DES ETUDIANTS
    </h1>
    </div>

    <!-- OPERATION DE RECUPERATION DE L'ETUDIANT-->
<?php
    // Assurez-vous que la connexion est établie
    if (isset($_GET["id"])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM etudiant WHERE id = $id";

        $data = mysqli_query($connection, $query);
        if ($data) {
            $etudiant = mysqli_fetch_assoc($data);
            $specialite_query = "SELECT * FROM specialite WHERE id = {$etudiant['specialite']}";
            $specialite_data = mysqli_query($connection, $specialite_query);

            if ($specialite_data) {
                $specialite = mysqli_fetch_assoc($specialite_data);
            } else {
                $specialite = null; // No specialite found
            }
        } else {
            die("Query Failed: " . mysqli_error($connection));
        }
    }
?>
<?php 
if(isset($_POST['modif_etudiant'])){
    if(isset($_GET['sid'])){
        $sid = $_GET['sid'];
    }
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $sexe = $_POST['sexe'];
    $niveau = $_POST['niveau'];
    $specialite = $_POST['specialite'];

    $update_query = "UPDATE `etudiant` SET `nom`='$nom', `prenom`='$prenom', `date_naissance`='$date_naissance', `sexe`='$sexe', `niveau`='$niveau', `specialite`='$specialite' WHERE `id`='$sid'";

    $update = mysqli_query($connection, $update_query);
    if($update){
        header('Location: index.php?update_message=Donnée Modifiée avec succès');
    }else{
        die("Query Failed: " . mysqli_error($connection));
    }
}
?>
    
<div class="container">
    <form action="update_data.php?sid=<?php echo($etudiant['id']) ?>" method="POST">
        <div class="form-group mb-3">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" class="form-control" required value="<?php echo htmlspecialchars($etudiant["nom"]); ?>">
        </div>
        <div class="form-group mb-3">
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" class="form-control" required value="<?php echo htmlspecialchars($etudiant["prenom"]); ?>">
        </div>
        <div class="form-group mb-3">
            <label for="date_naissance">Date de naissance</label>
            <input type="date" id="date_naissance" name="date_naissance" class="form-control" required value="<?php echo htmlspecialchars($etudiant["date_naissance"]); ?>">
        </div>
        <div class="form-group mb-3">
            <label for="sexe">Sexe</label>
            <select id="sexe" name="sexe" class="form-control" required>
                <option value="M" <?php echo ($etudiant["sexe"] == 'M') ? 'selected' : ''; ?>>Masculin</option>
                <option value="F" <?php echo ($etudiant["sexe"] == 'F') ? 'selected' : ''; ?>>Féminin</option>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="niveau">Niveau</label>
            <select id="niveau" name="niveau" class="form-control" required>
                <option selected>Sélectionnez le niveau</option>
                <option value="B1" <?php echo ($etudiant["niveau"] == 'B1') ? 'selected' : ''; ?>>Bachelor 1</option>
                <option value="B2" <?php echo ($etudiant["niveau"] == 'B2') ? 'selected' : ''; ?>>Bachelor 2</option>
                <option value="B3" <?php echo ($etudiant["niveau"] == 'B3') ? 'selected' : ''; ?>>Bachelor 3</option>
                <option value="M1" <?php echo ($etudiant["niveau"] == 'M1') ? 'selected' : ''; ?>>Master 1</option>
                <option value="M2" <?php echo ($etudiant["niveau"] == 'M2') ? 'selected' : ''; ?>>Master 2</option>
            </select>   
        </div>
        <div class="form-group mb-3">
            <label for="specialite">Spécialité</label>
            <select class="form-select" aria-label="Default select example" name="specialite" id="specialite" required>
                <?php if ($specialite): ?>
                    <option selected value="<?php echo htmlspecialchars($specialite['id']); ?>"><?php echo htmlspecialchars($specialite['libelle']); ?></option>
                <?php else: ?>
                    <option selected>Sélectionnez une spécialité</option>
                <?php endif; ?>
                <?php
                    $requete_specialite = "SELECT * FROM specialite WHERE id <> {$specialite['id']}";
                    $query_result = mysqli_query($connection, $requete_specialite);

                    if ($query_result) {
                        while ($row = mysqli_fetch_assoc($query_result)) {
                            echo "<option value='{$row['id']}'>{$row['libelle']}</option>";
                        }
                    } else {
                        die("Query Failed: " . mysqli_error($connection));
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <br>
            <input type="submit"  class="btn btn-primary" name="modif_etudiant" value="Modifier">
        </div>

    </form>
</div>

</body>
</html>
