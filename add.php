<?php
include('gestion.php');

if(isset($_POST['ajout_etudiant'])){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $sexe = $_POST['sexe'];
    $niveau = $_POST['niveau'];
    $specialite = $_POST['specialite'];

    $query = "INSERT INTO etudiant (nom, prenom, date_naissance, sexe, niveau, specialite) 
              VALUES ('$nom', '$prenom', '$date_naissance', '$sexe', '$niveau', '$specialite')";

    $result = mysqli_query($connection, $query);

    if($result){
        header('Location: index.php?insert_message= Donnée insérée avec succès !');
    } else{
        die("Query failed: " . mysqli_error($connection));
    }
}
?>
