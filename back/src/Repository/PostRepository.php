<?php
namespace Pabiosoft\Repository;
//require_once("./src/model/Manager.php");
include("config/lib/Flash.php");

use \DRY\DotEnv;
use Pabiosoft\Entity\Manager;
use Pabiosoft\Entity\Post;

class PostRepository extends Manager
{
    public function insert(Post $post): void
    {
        $sql = '
            INSERT INTO `post` (`title`, `description`, `image_url`,`created_date`,`snaps`,`location`,`user_id`)
            VALUES (:title, :description, :imageUrl,:createdDate,:snaps,:location,:userId)
        ';
        $q = $this->dbConnect()->prepare($sql);

        $q->bindValue(':title', $post->getTitle(), \PDO::PARAM_STR);
        $q->bindValue(':description', $post->getDescription(), \PDO::PARAM_STR);
        $q->bindValue(':imageUrl', $post->getImageUrl(), \PDO::PARAM_STR);
        $q->bindValue(':createdDate', $post->getCreatedDate());
        $q->bindValue(':userId', $post->getUserId());
        $q->bindValue(':snaps', $post->getSnaps(), \PDO::PARAM_STR);
        $q->bindValue(':location', $post->getLocation(), \PDO::PARAM_STR);

        $q->execute();
    }
    public function getPosts(int $limit = null)
    {

        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, description,snaps,image_url, location,DATE_FORMAT(created_date, \'%d/%m/%Y à %Hh%imin%ss\') AS created_date FROM post ORDER BY id DESC limit '.$limit);

        return $req;
    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, description,snaps,image_url,location, DATE_FORMAT(created_date, \'%d/%m/%Y à %Hh%imin%ss\') AS created_date FROM post WHERE id = ?');
       //@TODO securise postId
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    public function  addPost($title,$desc,$photo,$laDate,$like,$location){
        $db = $this->dbConnect();
        $query = sprintf('INSERT INTO post (title, description, image_url, created_date,snaps,location) VALUES (%s, %s, %s, NOW(),%s,%s)', $db->quote($title),$db->quote($desc), $db->quote($photo),$db->quote($like),$db->quote($location));
        $result = $db->exec($query);

        if ($result) {
           // $flash = new Flash();$flash->add_flash('success', 'un poste a ete ajouter');
            $env = new DotEnv();$env->demarrer();$env->load();
          $baseUrl = getenv('URL');


           header('Location: '.$baseUrl);
            die();
        }
    }

    /**
     * @param $title
     * @param $desc
     * @param $photo
     * @param $laDate
     * @param $like
     * @param $location
     * @return void update post
     */
    public function  updatePost($title,$desc,$photo,$laDate,$like,$location,$id){
        $db = $this->dbConnect();
        $query = sprintf('UPDATE post  set title =%s,  description =%s, image_url=%s,snaps =%s, location =%s  WHERE id=%s', $db->quote($title),$db->quote($desc), $db->quote($photo),$db->quote($like),$db->quote($location),$db->quote($id));
        $result = $db->exec($query);

        if ($result) {
            // $flash = new Flash();$flash->add_flash('success', 'un poste a ete modifier');
            $env = new DotEnv();$env->demarrer();$env->load();
            $baseUrl = getenv('URL');

            header('Location: '.$baseUrl);
            die();
        }
    }

    public function  like($like,$id){
        $db = $this->dbConnect();
            $er = 12;
        $req = $db->prepare('UPDATE post set snaps =:like WHERE id=:id');
        $req->bindParam(':like',$like);
        $req->bindParam(':id', $id);
        $req->execute();
        $result= $req->rowCount();

        if ($result == 1) {
            // $flash = new Flash();$flash->add_flash('success', 'un poste a ete modifier');
           // $env = new DotEnv();$env->demarrer();$env->load();
            $baseUrl = getenv('URL');
            header('Location: '.$baseUrl);
            die();
        }
    }


    public  function deletePost($id){
        $db = $this->dbConnect();
        //$query = sprintf('DELETE FROM `folo`.`post` WHERE (`id` = %s),$db->quote');
        $query = sprintf('DELETE FROM post  WHERE id=%s', $db->quote($id));
        $result = $db->exec($query);

        if ($result) {
            // $flash = new Flash();$flash->add_flash('success', 'un poste a ete modifier');
            $env = new DotEnv();$env->demarrer();$env->load();
            $baseUrl = getenv('URL');

            header('Location: '.$baseUrl);
            die();
        }

    }

    /**
     * @return false|\PDOStatement nombre de post
     */
    public function  countPost(){
        $db = $this->dbConnect();
        $query = $db->query('SELECT count(id) as nb  FROM follow.post');

        return $query;
    }

    public  function filtreParLike(){
        $db = $this->dbConnect();
        $query = $db->query('SELECT * FROM follow.post order by snaps DESC limit 3');

        return $query;
    }


    /**
     * @return void for present we make in = 1
     */
    public  function postUser(){
        $db = $this->dbConnect();
        $query = $db->query('SELECT * FROM follow.post as p inner join user as u on p.user_id = u.id where u.id = 1');

        return $query;
    }

}