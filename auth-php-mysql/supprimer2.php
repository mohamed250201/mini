<?php
   session_start();
   if($_SESSION["autoriser"]!="oui"){
      header("location:login.php");
      exit();
   }
   else  {
        include("connexion.php");
        
      @$id=$_POST['nom'];
        $req4 = "delete from classe where nomclasse = '$id'";
        //alert($id);
        $reponse = $pdo->query($req4);
        
        header("location:index.php");
 }
?>