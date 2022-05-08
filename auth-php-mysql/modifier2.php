<?php
 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit();
 }
 else {
     include ("connexion.php");
     @$code = $_POST['id'];
    @$name = $_POST['nom'];
    if (isset($_POST['modifier'])) {
    $req3 ="UPDATE classe SET nomclasse='$name' WHERE idclasse = '$code'";
    $reponse = $pdo->query($req3);
    $msg= "La modification a été effectuée!";
    echo $msg;
    }
    else{ echo 'Erreur';
    }

//   header('location:Affichergroupes.php');
    }
 ?>