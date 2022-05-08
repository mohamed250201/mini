<?php 
 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit();
 }
else {
include('connexion.php'); }

 ?>
<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Modifier l'Etudiant: </title>
        <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="../assets/dist/js/jquery.min.js"></script>
        <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
            <link href="../assets/dist/css/jumbotron.css" rel="stylesheet">
        
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
              <a class="nav-link" href="deconnexion.php">Se Déconnecter <span class="sr-only">(current)</span></a>
            </li>
      
          </ul>
        
      
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Saisir un groupe" aria-label="Chercher un groupe">
            <a href="recherchergroupe.php" class="btn btn-outline-success my-2 my-sm-0" type="submit">Chercher Groupe</a>
          </form>
        </div>
      </nav>
              
        <main role="main">
                <div class="jumbotron">
                    <div class="container">
                      <h1 class="display-4">Modifier etudiant</h1>
                      <p>Remplir le formulaire ci-dessous afin de modifier l'etudiant!</p>
                    </div>
                  </div> 
                  <div class="container">
                    <form id="myForm" method="POST" action="modifierE2.php">

                    <div class="form-group">
                         <label for="cin">CIN:</label><br>
                         <input type="text" id="cin" name="cin"  class="form-control" required pattern="[0-9]{8}" title="8 chiffres"/>
                         </div>
                         <div class="form-group">
                         <label for="nom">Nom:</label><br>
                          <input type="text" id="nom" name="nom" class="form-control" required autofocus>
                         </div>
                         <div class="form-group">
                         <label for="prenom">Prénom:</label><br>
                         <input type="text" id="prenom" name="prenom" class="form-control" required>
                          </div>  
                          <div class="form-group">
                          <label for="pwd">Mot de passe:</label><br>
                         <input type="password" id="pwd" name="pwd" class="form-control"  required />
                         </div>
                         <div class="form-group">
                         <label for="cpwd">Confirmer Mot de passe:</label><br>
                            <input type="password" id="cpwd" name="cpwd" class="form-control"  required/>
                          </div>
                         <div class="form-group">
                         <label for="email">Email:</label><br>
                         <input type="email" id="email" name="email" class="form-control" required>
                          </div>
                          <div class="form-group">
                          <label for="classe">Classe:</label><br>
                          <input type="text" id="classe" name="classe" class="form-control" required "
                         title="Pattern INFOX-X. Par Exemple: INFO1-A, INFO2-E, INFO3-C">
                         </div>
                         <div class="form-group">
                         <label for="adresse">Adresse:</label><br>
                         <textarea id="adresse" name="adresse" rows="10" cols="30" class="form-control" required>
                           </textarea>
                            </div>
                       <button name='modifier' type="submit" class="btn btn-primary btn-block" onclick="modifier()">Enregistrer</button>
                    </form> 
                    <div id="demo"></div>
                   </div> 
                   </main>
                   </div> 

                   
           
     </form>
     <script>
      function modifier()
    {
        var xmlhttp = new XMLHttpRequest();
        var url="http://localhost/mini/auth-php-mysql/modifierE2.php";
        
        //Envoie Req
        xmlhttp.open("POST",url,true);

        form=document.getElementById("myForm");
        formdata=new FormData(form);

        xmlhttp.send(formdata);    
        xmlhttp.onreadystatechange=function()
            {   
                if(this.readyState==4 && this.status==200){
                 alert(this.responseText);
                    if(this.responseText=="OK")
                    {
                        document.getElementById("demo").innerHTML="La modification de l'étudiant a été bien effectué";
                        document.getElementById("demo").style.backgroundColor="green";
                    }
                    else
                    {
                        document.getElementById("demo").innerHTML="L'étudiant est pas inscrit, merci de vérifier le CIN";
                        document.getElementById("demo").style.backgroundColor="#fba";
                    }
                }
            }    
    }
    </script>
    </body>
    </html>