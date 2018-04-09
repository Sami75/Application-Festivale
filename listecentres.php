<?php

include("_debut2.inc.php");
include("_gestionBase.inc.php"); 
include("_controlesEtGestionErreurs.inc.php");

// CONNEXION AU SERVEUR MYSQL PUIS SÉLECTION DE LA BASE DE DONNÉES festival

$connexion=connect();
if (!$connexion)
{
   ajouterErreur("Echec de la connexion au serveur MySql");
   afficherErreurs();
   exit();
}
if (!selectBase($connexion))
{
   ajouterErreur("La base de données festival est inexistante ou non accessible");
   afficherErreurs();
   exit();
}

// AFFICHER L'ENSEMBLE DES ÉTABLISSEMENTS
// CETTE PAGE CONTIENT UN TABLEAU CONSTITUÉ D'1 LIGNE D'EN-TÊTE ET D'1 LIGNE PAR
// ÉTABLISSEMENT

echo "
<table width='70%' cellspacing='0' cellpadding='0' align='center' 
class='tabNonQuadrille'>
   <tr class='enTeteTabNonQuad'>
      <td width='45%' colspan='4'>Centres</td>
	  <td width='20%' colspan='4'>Attributions</td>
   </tr>";
     
   $req=obtenirReqcentres();
   $rsEtab=$connexion->query("SELECT * FROM centre ORDER BY id ASC");
   // BOUCLE SUR LES ÉTABLISSEMENTS
   while ($lgEtab=$rsEtab->fetch())
   {
      $nbOffre = $lgEtab['nombreChambresOffertes'];
      $id=$lgEtab['id'];
      $nom=$lgEtab['nom'];
      echo "
		<tr class='ligneTabNonQuad'>
         <td width='52%'>$nom</td>
         
         <td width='16%' align='center'>
         <a href='detailcentre.php?action=demanderVoirEtab&amp;id=$id'>
         Voir détail</a></td>
         
         <td width='16%' align='center'> 
         <a href='modificationcentre.php?action=demanderModifEtab&amp;id=$id'>
         Modifier</a></td>";
         

         if(!existeAttributionsEtab($connexion, $id)) {
            echo"<td width='16%' align='center'><a href='suppressioncentre.php?action=demanderSupprEtab&amp;id=$id'>Supprimer</a></td></tr>";
         }

         else if(existeAttributionsEtab($connexion, $id)){
            $req2=obtenirNbAttrib($connexion, $id);
            /*$req3=obtenirNbChambreOfferte($connexion, $id);*/

            if($req2==$nbOffre)
               echo"<td width='16%' align='center'>COMPLET</tr>";
         }

         else {
             echo"<td width='16%' align='center'></tr>";
         }

   }
         // S'il existe déjà des attributions pour l'établissement, il faudra
         // d'abord les supprimer avant de pouvoir supprimer l'établissement
       
  
   echo "
   <tr class='ligneTabNonQuad'>
      <td colspan='4'><a href='creationcentre.php?action=demanderCreEtab'>
      Création d'un centre</a ></td>
  </tr>
</table>";

?>
