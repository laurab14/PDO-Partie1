<?php

// Permet d'accéder à la BDD en spécifiant l'hébergeur, le nom de la BDD,
// le compte d'un utilisateur phpmyadmin et son mot de passe

  $bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'pdo', 'pdo');
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

// Exo1 : on affiche les clients
// On envoie une requête à mysql pour afficher tout ce qu'il y a dans la table clients
$reponse = $bdd->query('SELECT * FROM clients'); ?>
<p><b>Noms des clients de la BDD Colyseum :</b><br /></p> <?php
// On instaure une boucle pour afficher les noms et prénoms les uns en dessous des autres
while ($donnees = $reponse->fetch()){
  ?><p><?= $donnees['lastName'] . ' ' . $donnees['firstName']; ?></p>
  <?php
}

// Exo2 : on affiche les genres
$reponse = $bdd->query('SELECT * FROM genres'); ?>
<p><b>Liste des genres de spectacle :</b><br /></p> <?php
while ($donnees = $reponse->fetch()){
  ?><p><?= $donnees['genre']; ?></p>
  <?php
}

// Exo3 : on affiche les 20 premiers trader_cdlidentical3crows
$reponse = $bdd->query('SELECT * FROM clients LIMIT 0, 20'); ?>

<p><b>Noms des 20 premiers clients de la BDD Colyseum :</b><br /></p> <?php

while ($donnees = $reponse->fetch()){
  ?><p><?= $donnees['lastName'] . ' ' . $donnees['firstName']; ?></p>
  <?php
}

// Exo4 : on n'affiche que les clients possédant une carte de fidélité
$reponse = $bdd->query('SELECT * FROM clients WHERE card=1'); ?>

<p><b>Noms clients possédant une carte de fidélité :</b><br /></p> <?php

while ($donnees = $reponse->fetch()){
  ?><p><?= $donnees['lastName'] . ' ' . $donnees['firstName']; ?></p>
  <?php
}

// Exo5 : on affiche les clients dont le nom commence par la lettre M
$reponse = $bdd->query('SELECT * FROM `clients` WHERE `lastName` LIKE \'M%\' ORDER BY lastName'); ?>

<p><b>Noms clients avec un nom commençant par M :</b><br /></p> <?php

while ($donnees = $reponse->fetch()){
  ?><p><?= $donnees['lastName'] . ' ' . $donnees['firstName']; ?></p>
  <?php
}

// Exo6 : On affiche Spectacle par artiste, le date à heure
$reponse = $bdd->query('SELECT * FROM shows ORDER BY title'); ?>

<p><b>Liste des spectacles :</b><br /></p> <?php

while ($donnees = $reponse->fetch()){
  ?><p><?= $donnees['title'] . ' par ' . $donnees['performer'] . ', le ' . date('d/m/Y',strtotime($donnees['date'])) . ' à ' . $donnees['startTime']; ?></p>
  <?php
}

// Exo7 : on affiche tous les clients comme ceci
$reponse = $bdd->query('SELECT * FROM clients ORDER BY lastName'); ?>

<p><b>Liste des clients:</b><br /></p> <?php

while ($donnees = $reponse->fetch()){
  ?><p><b>Nom : </b> <?= $donnees['lastName'] ?> </p>
   <p><b>Prénom : </b> <?= $donnees['firstName'] ?> </p>
   <!-- Pour afficher la date au format fr : date('d/m/Y',strtotime()) -->
   <p><b>Date de naissance : </b> <?= date('d/m/Y',strtotime($donnees['birthDate'])) ?> </p>
   <p><b>Carte de fidélité : </b> <?= ($donnees['card'] == 0) ? 'Non <br /><br />' : 'Oui' ?></p> <?php
   if ($donnees['card'] == 1) {
     ?> <p><b>Numéro de carte : </b> <?= $donnees['cardNumber'] ?> <br /><br /> </p> <?php
   }
      }
  
 ?>
