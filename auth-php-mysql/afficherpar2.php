<?php

session_start();
if($_SESSION["autoriser"]!="oui"){
    header("location:login.php");
	exit();
}
else {  
    include("connexion.php");
    $grp = $_POST['classe'];

$req="SELECT * FROM etudiant WHERE classe ='$grp'";
$reponse = $pdo->query($req);
if($reponse->rowCount()>0) {
	$outputs["etudiants"]=array();
while ($row = $reponse ->fetch(PDO::FETCH_ASSOC)) {
        $etudiant = array();
        $etudiant["cin"] = $row["cin"];
        $etudiant["nom"] = $row["nom"];
        $etudiant["prenom"] = $row["prenom"];
        $etudiant["adresse"] = $row["adresse"];
        $etudiant["email"] = $row["email"];
        $etudiant["classe"] = $row["Classe"];
         array_push($outputs["etudiants"], $etudiant);
    }
    // success
    $outputs["success"] = 1;
     echo json_encode($outputs);
} else {
    $outputs["success"] = 0;
    $outputs["message"] = "Pas d'étudiants";
    // echo no users JSON
    echo json_encode($outputs);
}
$sel2= $pdo->prepare("select nomclasse from classe where nomclasse = '$grp' ");
         $sel2->execute();
         $tab2 = $sel2->fetchAll();
}
?>
