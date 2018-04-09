<?php 
if($_SERVER["HTTP_REFERER"] == "http://localhost/codeapplifestival/consultationAttributions.php") {
   $chemin = "Accueil > Attribution des chambres > Gestion centres";
}
else if($_SERVER["PHP_SELF"] == "/codeapplifestival/creationcentre.php") {
   $chemin = "Accueil > Gestion centres > Création d'un nouveau centre";
}
else if($_SERVER["PHP_SELF"] == "/codeapplifestival/detailcentre.php") {
   $chemin = "Accueil > Gestion centres > Détail centre";
}
else if($_SERVER["PHP_SELF"] == "/codeapplifestival/modificationcentre.php"){
   $chemin = "Accueil > Gestion centres > Modifier les informations d'un centre";
}
else {
   $chemin = "Accueil > Gestion centres";
}

echo '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
"http://www.w3.org/TR/html4/loose.dtd">
<!-- TITRE ET MENUS -->
<html lang="fr">
<head>
<title>'.$chemin.'</title>
<meta http-equiv="Content-Language" content="fr">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/cssGeneral.css" rel="stylesheet" type="text/css">
</head>
<body class="basePage">

<!--  Tableau contenant le titre -->
<table width="100%" cellpadding="0" cellspacing="0">
   <tr> 
      <td class="titre">Festival de sport<br>
      <span id="texteNiveau2" class="texteNiveau2">
      H&eacute;bergement des équipes</span><br>&nbsp;
      </td>
   </tr>
</table>

<!--  Tableau contenant les menus -->
<table width="80%" cellpadding="0" cellspacing="0" class="tabMenu" align="center">
   <tr>
      <td class="menu"><a href="index.php">Accueil</a></td>
      <td class="menu"><a href="listecentres.php">
      Gestion centres</a></td>
      <td class="menu"><a href="consultationAttributions.php">
      Attributions chambres</a></td>
   </tr>
</table>
<br>';


