<?php
 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit();
 }
 else {
   include("connexion.php");
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCO-ENICAR Etudiants Par CLasse</title>
    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap core JS-JQUERY -->
<script src="../assets/dist/js/jquery.min.js"></script>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="../assets/jumbotron.css" rel="stylesheet">

    </head>
<body onload="refresh()">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">SCO-Enicar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
        
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="index.php" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Groupes</a>              <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="afficherEtudiants.php">Lister tous les étudiants</a>
          <a class="dropdown-item" href="afficherEtudiantsParClasse.php">Etudiants par Groupe</a>
          <a class="dropdown-item" href="AjouterGroupe.php">Ajouter Groupe</a>
          <a class="dropdown-item" href="modifierGroupe.php">Modifier Groupe</a>
          <a class="dropdown-item" href="supprimerGroupe.php">Supprimer Groupe</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Etudiants</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="afficherEtudiants.php">Lister tous les étudiants</a>
              <a class="dropdown-item" href="ajouterEtudiant.php">Ajouter Etudiant</a>
                <a class="dropdown-item" href="#">Chercher Etudiant</a>
                <a class="dropdown-item" href="#">Modifier Etudiant</a>
                <a class="dropdown-item" href="supprimerEtudiant.php">Supprimer Etudiant</a>
      
      
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Absences</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="saisirAbsence.php">Saisir Absence</a>
                <a class="dropdown-item" href="etatAbsence.php">État des absences pour un groupe</a>
              </div>
            </li>
      
            <li class="nav-item active">
              <a class="nav-link" href="login.php">Se Déconnecter <span class="sr-only">(current)</span></a>
            </li>
      
          </ul>
        
      
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Saisir un groupe" aria-label="Chercher un groupe">
            <a href="#" class="btn btn-outline-success my-2 my-sm-0" type="submit">Chercher Groupe</a>
          </form>
        </div>
      </nav>
      
      <main role="main">
        <div class="jumbotron">
            <div class="container">
              <h1 class="display-4">Afficher la liste d'étudiants par groupe</h1>
              <p>Cliquer sur la liste afin de choisir une classe!</p>
            </div>
          </div>

<div class="container">


<form method="POST" action="afficherpar.php">
<div class="form-group">
<label for="classe">Choisir une classe:</label><br>

<select name="classe" class="custom-select custom-select-sm custom-select-lg">
       <?php $sel2=$pdo->prepare("select * from classe");
       $sel2->execute();
       $tab2 =$sel2->fetchAll();
       foreach ($tab2 as $c) {?>
    <option value="<?= $c['idclasse'] ?>"> <?= @$c['nomclasse']?> </option> <?php } ?>
      
</select>
</div>
<div class="container">
<div class="row">
<div class="table-responsive"> 
  
 <table id="demo"class="table table-striped table-hover">
 </table>
 <br>
 </div>
 <button  type="submit" class="btn btn-primary btn-block active" onclick="refresh()">Actualiser</button>
</div>
</div>



</form>
</div> 
</main>


<script>
    function refresh() {
      var xmlhttp = new XMLHttpRequest();
      var url ="http://localhost/mini/auth-php-mysql/afficherpar.php";

      xmlhttp.open("GET", url, true);
      xmlhttp.send();
           //Traiter la reponse
     xmlhttp.onreadystatechange=function()
            {  // alert(this.readyState+" "+this.status);
                if(this.readyState==4 && this.status==200){
                
                    myFunction(this.responseText);
                    console.log(this.responseText);
                    //console.log(this.responseText);
                }
            }
    //Parse la reponse JSON
	function myFunction(response){
		var obj=JSON.parse(response);
        //alert(obj.success);

        if (obj.success==1)
        {
		var arr=obj.etudiants;
		var i;
		var out=" <tr><th> CIN</th><th>Nom</th><th>Prénom</th><th>Email</th><th>Classe</th><th>Action</th>";
		for ( i = 0; i < arr.length; i++) {
			out+="<tr><td>"+
			arr[i].cin +
			"</td><td>"+
			arr[i].nom+
			"</td><td>"+
			arr[i].prenom+
			"</td><td>"+
			arr[i].email+
			"</td><td>"+
			arr[i].classe+
      "</td><td>"+  
  "<a type='button' style='background-color:green; border-radius: 5px; color: white; border: none; height: 35px; width=75px; ' href='modifier.php?mod="+arr[i].cin+" '>Modifier</a>"+ "   " +
  "<a type='button' style='background-color:red; border-radius: 5px; color: white; border: none; height: 35px; width: 75px;' href='supprimer.php?supp="+arr[i].cin+"'>Supprimer</a> " +
			"</td></tr>" ;
		}
		out +="";
		document.getElementById("demo").innerHTML=out;
       }
       else document.getElementById("demo").innerHTML="Aucune Inscriptions!";

    }
  }
</script>

<footer class="container">
  <p style="text-align:center">&copy; ENICAR 2021-2022</p>
</footer>
</body>
</html>