<?php
 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit();
 }
else {
$nom=$_REQUEST['nom'];
include("connexion.php");
         $sel=$pdo->prepare("select nomclasse from classe where nomclasse=? limit 1");  
         $sel->execute(array($nom));
         $tab=$sel->fetchAll();
         if(count($tab)>0) {
            $erreur="NOT OK";}// Groupe existe déja
         else{
            $req="insert into classe values (0, '$nom')";
            $reponse = $pdo->exec($req) or die("error");
            $erreur ="OK";
         }
         header("location: AjouterGroupe.php"); 
         echo $erreur;
      }
?>