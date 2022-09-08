<?php
namespace Pabiosoft\Controller;
//require_once('./src/model/Entity/Post.php');
//require_once('./src/model/Repository/PostManager.php');
//require_once('./src/model/CommentManager.php');
//require_once('./src/model/UserManager.php');
require('config/DotEnv.php');

use \Pabiosoft\Entity\Post;
use \Pabiosoft\Repository\PostRepository;
use \DRY\DotEnv;


class HomeController{

    /**
     * @return void ajout utiliser
     */
   public function ajout():void{
        $post = new Post();


        if (!empty($_POST['insert'])){
            $title = htmlspecialchars($_POST['title']);
            $desc = htmlspecialchars($_POST['description']);
            $photo = htmlspecialchars($_POST['photo']);
            $laDate =  $_POST['laDate'];
            $like = htmlspecialchars(intval($_POST['like']));
            $location = htmlspecialchars($_POST['location']);
            $user_id = intval($_POST['like']);


            $input = $laDate;
            $date = strtotime($input);
            $newDate= date('d/M/Y h:i:s', $date);


            if(!empty($title) AND !empty($desc) AND !empty($photo) AND !empty($like) AND !empty($location) AND !empty($laDate)) {
                $post->setTitle($title);
                $post->setDescription($desc);
                $post->setImageUrl($photo);
                $post->setCreatedDate($newDate);
                $post->setSnaps($like);
                $post->setLocation($location);
                $post->setUserId($user_id);
                $postRepo = new PostRepository();
                $postRepo->insert($post);
                //$postManager->addPost($title,$desc,$photo,$laDate,$like,$location);
            }else{
                //$env = new DotEnv();$env->demarrer();$env->load();
                $baseUrl = getenv('URL');
                echo $baseUrl;

                header('Location: '.$baseUrl);
                die();
            }
        }
        require('view/frontend/insert.html.php');

    }

    // old ajout
    public function insert(){
        $postManager = new PostRepository();

//        $pointEnv =  new DotEnv();
//        $pointEnv->demarrer();
//        $pointEnv->load();

//   echo getenv('URL');
//   echo  getenv('INSERT');

        if (!empty($_POST['insert'])){
            $title = htmlspecialchars($_POST['title']);
            $desc = htmlspecialchars($_POST['description']);
            $photo = htmlspecialchars($_POST['photo']);
            $laDate = htmlspecialchars($_POST['laDate']);
            $like = htmlspecialchars(intval($_POST['like']));
            $userId =  intval($_POST['userId']);
            $location = htmlspecialchars($_POST['location']);

            if(!empty($title) AND !empty($desc) AND !empty($photo) AND !empty($like) AND !empty($location) AND !empty($userId)) {
                $postManager->addPost($title,$desc,$photo,$laDate,$like,$location,$userId);
            }else{
               // $env = new DotEnv();$env->demarrer();$env->load();
                $baseUrl = getenv('URL');
                $baseUrl = getenv('URL');
                echo $baseUrl;

                header('Location: '.$baseUrl);
                die();
            }
        }


        require('view/frontend/insert.html.php');
    }

    public function update()
    {
        header("Access-Control-Allow-Origin : *");

        $postManager = new PostRepository();
        $pointEnv = new DotEnv();
        $pointEnv->demarrer();
        $pointEnv->load();

//   $baseUrl = getenv('URL');
        if (isset($_POST['update'])){
            $title = htmlspecialchars($_POST['title']);
            $desc = htmlspecialchars($_POST['description']);
            $photo = htmlspecialchars($_POST['photo']);
            $laDate = htmlspecialchars($_POST['laDate']);
            $like = htmlspecialchars(intval($_POST['like']));
            $location = htmlspecialchars($_POST['location']);
            $id = htmlspecialchars(intval($_POST['lId']));

            if(!empty($title) AND !empty($desc) AND !empty($photo) AND !empty($like) AND !empty($location) AND !empty($id)) {
                $postManager->updatePost($title, $desc, $photo, $laDate, $like, $location, $id);
            }else{
                $env = new DotEnv();$env->demarrer();$env->load();
                $baseUrl = getenv('URL');
                echo $baseUrl;

                header('Location: '.$baseUrl);
                die();
            }
        }

        require('view/frontend/update.html.php');


    }

    /**
     * Delete post
     */
    public function delete($id){
        $postManager = new PostRepository();
        $postManager->deletePost($id);

        $env = new DotEnv();$env->demarrer();$env->load();
        $baseUrl = getenv('URL');
        echo $baseUrl;

        header('Location: '.$baseUrl);
        die();
    }

    /**
     * @return void liker les affiches
     */
    public function like(){
        $postManager = new PostRepository();
        $pointEnv = new DotEnv();
        $pointEnv->demarrer();
        $pointEnv->load();

//   $baseUrl = getenv('URL');
        if (isset($_POST['update'])){
            $like = htmlspecialchars(intval($_POST['like']));
            $id = htmlspecialchars(intval($_POST['lId']));


            if( !empty($like)   AND !empty($id)) {
                $postManager->like($like,$id);
            }else{
                $env = new DotEnv();$env->demarrer();$env->load();
                $baseUrl = getenv('URL');
                echo $baseUrl;

                header('Location: '.$baseUrl);
                die();
            }
        }
        require('view/frontend/like.phtml');

    }

    /**
     * @return void rendu liste des posts
     */
    public function tableauPosts()
    {
        $postManager = new PostRepository();
        $posts = $postManager->getPosts();

        require('view/frontend/listPostsView.php');
    }

    /**
     * @return void Nombre totale de post
     */
    public function nbPost(){
        $postManager = new PostRepository();
        $posts = $postManager->countPost();
        $nb = $posts->fetch();

        echo $nb['nb'];
    }

    public  function  direBonjour(){
        echo 'bonjour le monde';
    }

    function listPosts()
    {
        $postManager = new PostRepository();
        $posts = $postManager->getPosts(10);

        require('view/frontend/listPostsView.php');
    }

    /*********************************************************
     *                E R R O R
     **************************************/
    public function  error404(){
        echo ' pages non disponible ';
        die();
    }

    public function  error405(){
        echo ' une erreur s\'est produite  ';
        die();
    }

}





