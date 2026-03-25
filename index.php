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
    <title>Student Management</title>
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex align-items-center mb-4">
            <img src="gestion-etudiant.jpg" alt="Logo" class="me-3" style="height: 150px;">
            <h1 class="pagehead m-0">GESTION DES ETUDIANTS</h1>
        </div>
        
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>LES ETUDIANTS</h2>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                AJOUTER
            </button>
            <?php
             if(isset($_GET['insert_message'])){
                echo"<h5>" .$_GET['insert_message']."</h5>";
                
             }
            ?>
        </div>

        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date Naissance</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
			<?php
				$query = "select * from etudiant";
				$result = mysqli_query($connection, $query);
				if($result){
					while ($rows = mysqli_fetch_assoc($result)) {
						  			// code...
				?>
			<tr>
				<td> <?php echo($rows['id']) ?> </td>
				<td>  <?php echo($rows['nom']) ?> </td>
				<td>  <?php echo($rows['prenom']) ?>  </td>
				<td>  <?php echo($rows['date_naissance']) ?>  </td>
				<td> 
                    <a class="btn btn-primary" href="update_data.php?id=<?php echo($rows['id']) ?>">Modifier</a>
                    <a class="btn btn-danger" href="delete_data.php?id=<?php echo($rows['id']) ?>">Supprimer</a>
                </td>
				<!--<a class="btn btn-primary" href="#">Supprimer</a></td>-->

			</tr>

						  	<?php
						  		}

						  	}else{
						  		die("query failed".msqli_error());
						  	}


						  ?>
			
		</tbody>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
          crossorigin="anonymous"></script>
        </table>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Ajouter un étudiant</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="add.php" method="post">
                            <div class="form-group mb-3">
                                <label for="nom">Nom</label>
                                <input type="text" id="nom" name="nom" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="prenom">Prénom</label>
                                <input type="text" id="prenom" name="prenom" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="date_naissance">Date de naissance</label>
                                <input type="date" id="date_naissance" name="date_naissance" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="sexe">Sexe</label>
                                <select id="sexe" name="sexe" class="form-control" required>
                                    <option value="">Sélectionnez le sexe</option>
                                    <option value="M">Masculin</option>
                                    <option value="F">Féminin</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="niveau">Niveau</label>
                                <select id="niveau" name="niveau" class="form-control" required>
                                    <option value="">Sélectionnez le niveau</option>
                                    <option value="B1">B1</option>
                                    <option value="B2">B2</option>
                                    <option value="B3">B3</option>
                                    <option value="M1">M1</option>
                                    <option value="M2">M2</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="specialite">Spécialité</label>
                                <select class="form-select" aria-label="Default select example" name="specialite" id="specialite" required>
                                    <option value="" selected>Sélectionnez la spécialité</option>
                                    <?php
                                        $requete_specialite = "SELECT * FROM specialite";
                                        $query_result = mysqli_query($connection, $requete_specialite);

                                        if($query_result){
                                            while($specialite = mysqli_fetch_assoc($query_result)){
                                                echo "<option value='{$specialite['id']}'>{$specialite['libelle']}</option>";
                                            }
                                        } else {
                                            die("Query Failed: " . mysqli_error($connection));
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                <input type="submit" class="btn btn-primary" value="Ajouter" name="ajout_etudiant">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
