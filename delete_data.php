<?php
include('gestion.php');

if(isset($_GET['id'])){
 
    $id= $_GET['id'];
    $query = "delete from `etudiant` where id = {$id}";

    $result = mysqli_query($connection, $query);

    if($result){
        header('Location: index.php?insert_message= Donnée supprimé avec succès !');
    } else{
        die("Query failed: " . mysqli_error($connection));
    }
}
?>
