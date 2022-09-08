<?php
namespace Pabiosoft\Repository;

use Cassandra\Date;
use Pabiosoft\Entity\Manager;
use Pabiosoft\Entity\Message;
use Pabiosoft\Entity\Post;

class MessageRepository extends Manager
{
    public function addMessage(Message $message):void
    {
        $sql = '
            INSERT INTO `message` (`content`, `laDate`,`user_id`)
            VALUES (:content, Now(),:userId)
        ';
        $q = $this->dbConnect()->prepare($sql);
//        $date = new \DateTime();
        $q->bindValue(':content', $message->getContent(), \PDO::PARAM_STR);
        $q->bindValue(':userId', $message->getUser());
        //$q->bindValue(':laDate', $date);

        $q->execute();
    }

    public function getAllMessage()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT u.email,m.content,m.id,u.id as user_id,m.laDate FROM follow.message as m inner join  follow.user as u   on u.id=m.user_id');

        return $req;

    }

    /**
     * @return void  for joker presentation
     */
    public  function messageUser(){
        $db=$this->dbConnect();
        $req = $db->query('SELECT * FROM follow.message as m inner join user as u on m.user_id = u.id where u.id = 1');

        return $req;
    }

}