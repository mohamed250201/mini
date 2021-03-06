<?php
   session_start();
   @$nom=$_POST["nom"];
   @$prenom=$_POST["prenom"];
   @$login=$_POST["login"];
   @$pass=$_POST["pass"];
   @$repass=$_POST["repass"];
   @$valider=$_POST["valider"];
   
   $erreur="";
   if(isset($valider)){
      if(empty($nom)) $erreur="Nom laissé vide!";
      elseif(empty($prenom)) $erreur="Prénom laissé vide!";
      elseif(empty($prenom)) $erreur="Prénom laissé vide!";
      elseif(empty($login)) $erreur="Login laissé vide!";
      elseif(empty($pass)) $erreur="Mot de passe laissé vide!";
      elseif($pass!=$repass) $erreur="Mots de passe non identiques!";
      else{
         include("connexion.php");
         $sel=$pdo->prepare("select id from enseignant where login=? limit 1");
         $sel->execute(array($login));
         $tab=$sel->fetchAll();
         if(count($tab)>0)
            $erreur="Login existe déjà!";
         else{
            $ins=$pdo->prepare("insert into enseignant(nom,prenom,login,pass) values(?,?,?,?)");
            if($ins->execute(array($nom,$prenom,$login,md5($pass))))
               header("location:login.php");
         }   
      }
   }
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <style>
         *{
            font-family:arial;
         }
         body{
            margin:20px;
         }
         input{
            border:solid 1px #2222AA;
            margin-bottom:10px;
            padding:16px;
            outline:none;
            border-radius:6px;
         }
         .erreur{
            color:#CC0000;
            margin-bottom:10px;
         }
      </style>
      <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>SCO-ENICAR Inscription Enseignant</title>

    <!-- Bootstrap core CSS -->
   <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/dist/css/signin.css" rel="stylesheet">
   </head>
   <body  class="text-center">
      <h1>Inscription</h1>
      <div class="erreur"><?php echo $erreur ?></div>
      <form  class="form-signin" name="fo" method="post" action="">
      <img class="mb-4" src="../assets/brand/user-login.svg" alt="" width="72" height="72">
       <h1 class="h3 mb-3 font-weight-normal">Veuillez créer votre compte</h1>

         <input type="text" class="form-control" name="nom" placeholder="Nom" value="<?php echo $nom?>" /><br />
         <input type="text" class="form-control" name="prenom" placeholder="Prénom" value="<?php echo $prenom?>" /><br />
         <input type="text" class="form-control" name="login" placeholder="Login" value="<?php echo $login?>" /><br />
         <input type="password"  class="form-control" name="pass" placeholder="Mot de passe" /><br />
         <input type="password" class="form-control" name="repass" placeholder="Confirmer Mot de passe" /><br />
         <input type="submit"class="form-control" name="valider" value="S'inscrire" />
      </form>
   </body>
</html>