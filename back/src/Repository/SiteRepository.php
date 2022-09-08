<?php
namespace Pabiosoft\Repository;

use Pabiosoft\Entity\Manager;

class SiteRepository extends Manager
{

    public function findAll()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, name, description,logo,proprietaire   FROM site  ');

        return $req;
    }


}