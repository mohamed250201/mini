<?php
   session_start();
   if($_SESSION["autoriser"]!="oui"){
      header("location:login.php");
      exit();
   }
   else  {
        include("connexion.php");
        @$nom = $_POST['cin'];
        $sql = "DELETE FROM etudiant WHERE cin= '$nom' ";
        $reponse = $pdo->query($sql);
        $msg= "La suppression a été effectuée!";
        echo $msg ;
      
        header("location:afficherEtudiants.php");
 }
?>