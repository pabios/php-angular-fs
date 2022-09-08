<?php
// site follow
require_once 'src/Entity/Site.php';
require_once 'src/Entity/Style.php';
use App\Entity\Site;
use App\Entity\Style;

require_once "bootstrap.php";

//$name = $argv[1];
$name = 'follow';
$description = "suivre les evenement de l'association" ;
$logo = 'folo';
$proprietaire = 'kazar';

$site = new Site();
$site->setName($name);
$site->setDescription($description);
$site->setLogo($logo);
$site->setProprietaire($proprietaire);


$entityManager->persist($site);
$entityManager->flush();

/**
 * Style folo
 */

$style = new Style();
$titre = 'font-size:20px;color:#1C9E61';
$paragraphe='font-size:14px';
$lien ='text-decoration:none';

$style->setLien($lien);
$style->setParagraphe($paragraphe);
$style->setTitre($titre);

//@todo add relation with site

$entityManager->persist($style);
$entityManager->flush();

echo "Nouveau site ajouter  " . $site->getId() . "\n";

// vendor/bin/doctrine orm:schema-tool:create | dont forget
// vendor/bin/doctrine orm:schema-tool:update
// php site-1-folo.php in cli