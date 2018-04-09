<?php

// FONCTIONS DE CONNEXION

function connect()
{
  try{
   $connexion = new PDO('mysql:host=localhost;dbname=festival','root','');
   return $connexion;
 }
 catch(Exception $e){
  die ('Error: ' . $e->getMessage());
 }
}

function selectBase($connexion)
{
   $bd="festival";
   $query="SET CHARACTER SET utf8";
   // Modification du jeu de caractères de la connexion
   $res=$connexion->query("SELECT * FROM centre ORDER BY id ASC");
   return $res->fetch();
}

// FONCTIONS DE GESTION DES ÉTABLISSEMENTS

function obtenirReqcentres()
{
   $req="SELECT id, nom from centre order by id";
   return $req;
}

function obtenirReqcentresOffrantChambres()
{
   $req="SELECT id, nom, nombreChambresOffertes from centre where 
         nombreChambresOffertes!=0 order by id";
   return $req;
}

function obtenirReqcentresAyantChambresAttribuées()
{
   $req="SELECT distinct id, nom, nombreChambresOffertes from centre, 
         Attribution where id = idCentre order by id";
   return $req;
}

function obtenirNbChambreOfferte($connexion, $id) {
  $req="SELECT nombreChambresOffertes from centre where idCentre = $id";
   $rsAttrib=$connexion->query($req);
    $lgAttrib=$rsAttrib->fetch();
    return $lgAttrib['nombreChambresOffertes'];
}

function obtenirDetailcentre($connexion, $id)
{
   //$req="select * from centre where id='$id'";
   $rsEtab=$connexion->query("SELECT * FROM centre ORDER BY id ASC");
   return $rsEtab->fetch();
}

function supprimercentre($connexion, $id)
{
   //$req="delete from centre where id='$id'";
   //mysql_query($req, $connexion);
   $rsAttrib=$connexion->query("DELETE from centre where id='$id'");
   return $rsAttrib->fetch();
}

 
function modifiercentre($connexion, $id, $nom, $adresseRue, $codePostal, 
                               $ville, $tel, $adresseElectronique, $type, 
                               $civiliteResponsable, $nomResponsable, 
                               $prenomResponsable, $nombreChambresOffertes)
{  
   $nom=str_replace("'", "''", $nom);
   $adresseRue=str_replace("'","''", $adresseRue);
   $ville=str_replace("'","''", $ville);
   $adresseElectronique=str_replace("'","''", $adresseElectronique);
   $nomResponsable=str_replace("'","''", $nomResponsable);
   $prenomResponsable=str_replace("'","''", $prenomResponsable);
  
   //$req="update centre set nom='$nom',adresseRue='$adresseRue',
         //codePostal='$codePostal',ville='$ville',tel='$tel',
         //adresseElectronique='$adresseElectronique',type='$type',
         //civiliteResponsable='$civiliteResponsable',nomResponsable=
         //'$nomResponsable',prenomResponsable='$prenomResponsable',
         //nombreChambresOffertes='$nombreChambresOffertes' where id='$id'";
   
   $req=$connexion->query("UPDATE centre set nom='$nom',adresseRue='$adresseRue',
         codePostal='$codePostal',ville='$ville',tel='$tel',
         adresseElectronique='$adresseElectronique',type='$type',
         civiliteResponsable='$civiliteResponsable',nomResponsable=
         '$nomResponsable',prenomResponsable='$prenomResponsable',
         nombreChambresOffertes='$nombreChambresOffertes' where id='$id'");
}

function creercentre($connexion, $id, $nom, $adresseRue, $codePostal, 
                            $ville, $tel, $adresseElectronique, $type, 
                            $civiliteResponsable, $nomResponsable, 
                            $prenomResponsable, $nombreChambresOffertes)
{ 
   $nom=str_replace("'", "''", $nom);
   $adresseRue=str_replace("'","''", $adresseRue);
   $ville=str_replace("'","''", $ville);
   $adresseElectronique=str_replace("'","''", $adresseElectronique);
   $nomResponsable=str_replace("'","''", $nomResponsable);
   $prenomResponsable=str_replace("'","''", $prenomResponsable);
   
   $req=$connexion->query("INSERT into centre values ('$id', '$nom', '$adresseRue', 
         '$codePostal', '$ville', '$tel', '$adresseElectronique', '$type', 
         '$civiliteResponsable', '$nomResponsable', '$prenomResponsable',
         '$nombreChambresOffertes')");
   
}


function estUnIdcentre($connexion, $id)
{
   //$req="select * from centre where id='$id'";
   $rsEtab=$connexion->query("SELECT * from centre where id='$id'");
   return $rsEtab->fetch();
}

function estUnNomcentre($connexion, $mode, $id, $nom)
{
   $nom=str_replace("'", "''", $nom);
   // S'il s'agit d'une création, on vérifie juste la non existence du nom sinon
   // on vérifie la non existence d'un autre établissement (id!='$id') portant 
   // le même nom
   if ($mode=='C')
   {
      $rsAttrib=$connexion->query("SELECT * from centre where nom='$nom'");
      return $rsAttrib->fetch();
   }
   else
   {
      $rsAttrib=$connexion->query("SELECT * from centre where nom='$nom' and id!='$id'");
      return $rsAttrib->fetch();
   }
   
}


function obtenirNbEtab($connexion)
{
   //$req="select count(*) as nombreEtab from centre";
   //$rsEtab=mysql_query($req, $connexion);
   //$lgEtab=mysql_fetch_array($rsEtab);
   $lgEtab=$connexion->query("SELECT count(*) as nombreEtab from centre");
   return $lgEtab->fetch();
   return $lgEtab["nombreEtab"];
}

function obtenirNbEtabOffrantChambres($connexion)
{
   //$req="select count(*) as nombreEtabOffrantChambres from centre where 
         //nombreChambresOffertes!=0";
   //$rsEtabOffrantChambres=mysql_query($req, $connexion);
   //$lgEtabOffrantChambres=mysql_fetch_array($rsEtabOffrantChambres);
   $lgEtabOffrantChambres=$connexion->query("SELECT count(*) as nombreEtabOffrantChambres FROM centre where nombreChambresOffertes!=0");
   return $lgEtabOffrantChambres->fetch();
   return $lgEtabOffrantChambres["nombreEtabOffrantChambres"];
}

// Retourne false si le nombre de chambres transmis est inférieur au nombre de 
// chambres occupées pour l'établissement transmis 
// Retourne true dans le cas contraire
function estModifOffreCorrecte($connexion, $idEtab, $nombreChambres)
{
   $nbOccup=obtenirNbOccup($connexion, $idEtab);
   return ($nombreChambres>=$nbOccup);
}

// FONCTIONS RELATIVES AUX GROUPES

function obtenirReqIdNomGroupesAHeberger()
{
   $req="SELECT id, nom from Groupe where hebergement='O' order by id";
   return $req;
}

function obtenirNomGroupe($connexion, $id)
{

   $lgGroupe=$connexion->query("SELECT nom FROM equipe where id='$id'");
   return $lgGroupe->fetch();
   return $lgGroupe["nom"];
}


// FONCTIONS RELATIVES AUX ATTRIBUTIONS

// Teste la présence d'attributions pour l'établissement transmis    
function existeAttributionsEtab($connexion, $id)
{
   $rsAttrib=$connexion->query("SELECT * FROM Attribution where idCentre='$id'");
   return $rsAttrib->fetch();
}

// Retourne le nombre de chambres occupées pour l'id étab transmis
function obtenirNbOccup($connexion, $idEtab)
{
   $lgOccup=$connexion->query("SELECT IFNULL(sum(nombreChambres), 0) as totalChambresOccup from
        Attribution where idCentre='$idEtab'");
   return $lgOccup;
}

// Met à jour (suppression, modification ou ajout) l'attribution correspondant à
// l'id étab et à l'id groupe transmis
function modifierAttribChamb($connexion, $idEtab, $idGroupe, $nbChambres)
{
   //$req="select count(*) as nombreAttribGroupe from Attribution where idEtab=
        //'$idEtab' and idGroupe='$idGroupe'";
   $rsAttrib=$connexion->query("SELECT count(*) as nombreAttribGroupe from Attribution where idCentre=
        '$idEtab' and idEquipe='$idGroupe'");
	$lgAttrib=$rsAttrib->fetch();
   //$lgAttrib=mysql_fetch_array($rsAttrib);
   if ($nbChambres==0)
      $rsAttrib=$connexion->query("DELETE from Attribution where idCentre='$idEtab' and idEquipe='$idGroupe'");
      //$req="delete from Attribution where idEtab='$idEtab' and idGroupe='$idGroupe'";
   else
   {
	  
      if ($lgAttrib["nombreAttribGroupe"]!=0)
         $lgAttrib=$connexion->query("UPDATE Attribution set nombreChambres=$nbChambres where idCentre=
              '$idEtab' and idEquipe='$idGroupe'");
         //$req="update Attribution set nombreChambres=$nbChambres where idEtab=
              //'$idEtab' and idGroupe='$idGroupe'";
      else
         $rsAttrib=$connexion->query("INSERT into Attribution values('$idEtab','$idGroupe', $nbChambres)");
         //$req="insert into Attribution values('$idEtab','$idGroupe', $nbChambres)";
   }
}

// Retourne la requête permettant d'obtenir les id et noms des groupes affectés
// dans l'établissement transmis
function obtenirReqGroupesEtab($id)
{
   $req="SELECT distinct id, nom, nomPays from equipe, Attribution where 
        Attribution.idEquipe=equipe.id and idCentre='$id'";
   return $req;
}
            
// Retourne le nombre de chambres occupées par le groupe transmis pour l'id étab
// et l'id groupe transmis
function obtenirNbOccupGroupe($connexion, $idEtab, $idGroupe)
{
   $rsAttribGroupe=$connexion->query("SELECT nombreChambres From Attribution where idCentre='$idEtab'
        and idEquipe='$idGroupe'");
   if ($lgAttribGroupe=$rsAttribGroupe->fetch(PDO::FETCH_ASSOC))
      return $lgAttribGroupe["nombreChambres"];
   else
      return 0;
}

function obtenirNbAttrib($connexion,$id)
{
    $req="SELECT SUM(nombreChambres) as nbAttrib from Attribution where idCentre='$id'";
    $rsAttrib=$connexion->query($req);
    $lgAttrib=$rsAttrib->fetch();
    return $lgAttrib['nbAttrib'];
}

?>