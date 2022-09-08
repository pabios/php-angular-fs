#!/usr/bin/env php
<?php
// bin/doctrine
//require_once 'bootstrap.php';
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

// Adjust this path to your actual bootstrap.php
require __DIR__ . '/bootstrap.php';

ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);

// php bin/doctrine orm:schema-tool:create
//php bin/doctrine orm:schema-tool:drop --force
//php bin/doctrine orm:schema-tool:create