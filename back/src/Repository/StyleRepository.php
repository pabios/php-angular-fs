<?php
namespace Pabiosoft\Repository;

use Pabiosoft\Entity\Manager;

class StyleRepository extends Manager
{

    public function findAll()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, titre, paragraphe,lien   FROM style  ');

        return $req;
    }
    public function  styleBySite(){
        $db = $this->dbConnect();
        $req = $db->query('SELECT si.id,sty.titre,sty.paragraphe FROM follow.site_has_style as ss inner join site as si inner join style as sty on ss.site_id = si.id ');

        return $req;
    }


}