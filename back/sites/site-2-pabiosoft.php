<?php
// site pabiosoft
use Pabiosoft\Entity\Site;

require_once 'src/Entity/Site.php';

require_once "bootstrap.php";

//$name = $argv[1];
$name = 'pabiosoft';
$description = "site perso" ;
$logo = 'pabiosoft';
$proprietaire = 'moi';

$site = new Site();
$site->setName($name);
$site->setDescription($description);
$site->setLogo($logo);
$site->setProprietaire($proprietaire);


$entityManager->persist($site);
$entityManager->flush();

echo "Nouveau site ajouter  " . $site->getId() . "\n";

// php site-x-y.php in cli