<?php
// site transit
use Pabiosoft\Entity\Site;

require_once 'src/Entity/Site.php';

require_once "bootstrap.php";

//$name = $argv[1];
$name = 'transit';
$description = "transite guinee" ;
$logo = 'transit-guinee';
$proprietaire = 'koto';

$site = new Site();
$site->setName($name);
$site->setDescription($description);
$site->setLogo($logo);
$site->setProprietaire($proprietaire);


$entityManager->persist($site);
$entityManager->flush();

echo "Nouveau site ajouter  " . $site->getId() . "\n";

// php site-x-y.php in cli