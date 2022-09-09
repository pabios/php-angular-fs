<?php
// site follow
//require_once 'src/Entity/Site.php';
//require_once 'src/Entity/Style.php';
use Pabiosoft\Entity\Site;
use Pabiosoft\Entity\Style;

require_once "bootstrap.php";

$site = new Site();

//$name = $argv[1];
$name = 'follow';
$description = 'suivreles' ;
$logo = 'folo';
$proprietaire = 'kazar';
$update = '10h';

$site->setName($name);
$site->setDescription($description);
$site->setLogo($logo);
$site->setProprietaire($proprietaire);
$site->setMisAjour($update);



$entityManager->persist($site);
$entityManager->flush();


/**
 * Style folo
 */

$style = new Style();
$titre = 'font-size:20px;color:#1C9E61';
$paragraphe='font-size:14px';
$lien ='text-decoration:none';

//$lien = readline("css code : ");

    $style->setLien($lien);
$style->setParagraphe($paragraphe);
$style->setTitre($titre);

//@todo add relation with site Many to Many

$entityManager->persist($style);
$entityManager->flush();

echo "Nouveau site ajouter  " . $site->getId() . "\n";

// vendor/bin/doctrine orm:schema-tool:create |
// vendor/bin/doctrine orm:schema-tool:update
// php site-1-folo.php in cli