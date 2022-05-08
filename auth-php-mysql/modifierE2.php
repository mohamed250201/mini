<?php
 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit();
 }
 else {
     include ("connexion.php");
     @$code = $_POST['cin'];
    @$name = $_POST['nom'];
    @$prenom = $_POST['prenom'];        
    @$pwd = $_POST['pwd'];               
    @$cpwd = $_POST['cpwd'];              
    @$email = $_POST['email'];               
    @$classe = $_POST['classe'];               
    @$adresse = $_POST['adresse'];             
   // if (isset($_POST['modifier'])) {
    $req3 ="UPDATE Etudiant SET nom='$name' WHERE cin = '$code'";
    $reponse = $pdo->query($req3);
    $req3 ="UPDATE Etudiant SET prenom='$prenom' WHERE cin = '$code'";
    $reponse = $pdo->query($req3);
    $req3 ="UPDATE Etudiant SET password=md5('$pwd') WHERE cin = '$code'";
    $reponse = $pdo->query($req3);
    $req3 ="UPDATE Etudiant SET  cpassword=md5('$pwd') WHERE cin = '$code'";
    $reponse = $pdo->query($req3);
    $req3 ="UPDATE Etudiant SET email='$email' WHERE cin = '$code'";
    $reponse = $pdo->query($req3);
    $req3 ="UPDATE Etudiant SET classe='$classe' WHERE cin = '$code'";
    $reponse = $pdo->query($req3);
    $req3 ="UPDATE Etudiant SET  adresse='$adresse' WHERE cin = '$code'";
    $reponse = $pdo->query($req3);
  //  $msg= "La modification a été effectuée!";
  //  echo $msg;
   // }
   // else{ echo 'Erreur';
   // }

  header('location:AfficherEtudiants.php');
    }
 ?>