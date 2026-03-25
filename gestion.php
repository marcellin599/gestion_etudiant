<?php 
// Pour se connecter à une base de donnée à distance, on a besoin de 4 informations : HOSTNAME, USERNAME, PASSWORD, DB
define('HOSTNAME', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DB', 'gestion_etudiant');

// Pour se connecter, on utilise la fonction "mysqli_connect"
$connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DB);

// Vérification de la connexion
if(!$connection){
    die("Connection failed: " . mysqli_connect_error($connection));
} else {
    echo "Connection réussie";
}
?>
