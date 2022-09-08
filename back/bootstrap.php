<?php
// bootstrap.php
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;
$config = ORMSetup::createAnnotationMetadataConfiguration(array(__DIR__ . "/src/Entity"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);
// or if you prefer YAML or XML
// $config = ORMSetup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
// $config = ORMSetup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);

// database configuration parameters
$conn = array(
    'driver' => 'pdo_mysql',
    'host' => 'localhost',
    'user' => 'root',
    'password' => 'pass',
    'dbname' => 'folo'
);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);