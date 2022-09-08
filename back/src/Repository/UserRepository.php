<?php
namespace Pabiosoft\Repository;

//require_once("./src/model/Manager.php");
//include_once("config/lib/Flash.php");

use \DRY\DotEnv;
use Pabiosoft\Entity\Manager;
use Pabiosoft\Entity\User;

class UserRepository extends Manager
{
    public function inscription(User $user)
    {
        $sql = '
            INSERT INTO `user` (`email`, `roles`, `password`,`site_id`)
            VALUES (:email, :roles, :password,:siteId)  
        ';
        $db = $this->dbConnect();
        $lastId = $db->lastInsertId();
        $q = $this->dbConnect()->prepare($sql);
        $roleUser = $user->getRoles();
        $siteId = 1; // @todo replace by DotEnv class
        $q->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
        $q->bindParam(':roles', $roleUser);
        $q->bindParam(':siteId', $siteId);
        $q->bindValue(':password', $user->getPassword(), \PDO::PARAM_STR);

        $q->execute();

        $id = $this->keepId($user->getEmail());
       return $id['id'];
    }
    /**
     * Récupère le dernier ID
     */
    public function keepId($email){
        $db = $this->dbConnect();

        $db = $this->dbConnect();
        $req = $db->prepare('SELECT  id,email FROM user WHERE email = ? ');
        $req->execute(array($email));

        return $req->fetch();

    }
    public function findAll()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT  email, password,roles   FROM user  ');

        return $req;
    }

    public function findById($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, description,snaps,image_url,location, DATE_FORMAT(created_date, \'%d/%m/%Y à %Hh%imin%ss\') AS created_date FROM post WHERE id = ?');
        //@TODO securise postId
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email)
    {
        $sql = 'SELECT * FROM `user` as u WHERE u.email = :email';
        $q = $this->dbConnect()->prepare($sql);

        $q->bindValue(':email', $email, \PDO::PARAM_STR);

        $q->execute();

        $user = $q->fetch(\PDO::FETCH_ASSOC);

        return $user;
    }




}