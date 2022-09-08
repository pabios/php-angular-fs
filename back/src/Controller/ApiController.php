<?php
namespace Pabiosoft\Controller;


use \Pabiosoft\Entity\Post;
use \Pabiosoft\Entity\User;
use \Pabiosoft\Repository\PostRepository;
use  \Pabiosoft\Repository\UserRepository;
use Pusher\Pusher;

class ApiController{

    /**
     * @return void liste des post format json
     */
    public function listePosts()
    {
        header("Access-Control-Allow-Origin : *");
        header('Content-Type: application/json' );

        //var_dump($_POST);

        $postManager = new PostRepository();
        $posts = $postManager->getPosts(9);
        $response = [];
        foreach($posts as $all ){
            $response[] = $all;
        }

        $final = [];
        $i = 0;

        while ($i != count($response)){
            $final[] = array(
                "id"=> $response[$i]["id"],
                "title"=> $response[$i]["title"],
                "description"=> $response[$i]["description"],
                "imageUrl"=> $response[$i]["image_url"],
                "createdDate"=> $response[$i]["created_date"],
                "snaps"=> $response[$i]["snaps"],
                "location"=> $response[$i]["location"]
            );

            $i++;
        }



        echo json_encode($final, JSON_PRETTY_PRINT);
    }

    /**
     * recupere un post
     */
    public function unPost($id){
        $postManager = new PostRepository();
        //http://localhost:9000/posts/1  -->

        $id = intval($id);
        $post = $postManager->getPost($id);

        $final = array(
            "id"=> $post["id"],
            "title"=> $post["title"],
            "description"=> $post["description"],
            "imageUrl"=> $post["image_url"],
            "createdDate"=> $post["created_date"],
            "snaps"=> $post["snaps"],
            "location"=> $post["location"]
        );

        $objet = (object) $final;


        header("Access-Control-Allow-Origin : *");
        header('Content-Type: application/json' );
        echo json_encode($objet, JSON_PRETTY_PRINT);

    }


    /**
     * @return void ajout Angular
     */
    public function addPostApi():void{
        header("Access-Control-Allow-Origin : *");
        $post = new Post();

        $title = htmlspecialchars($_POST['title']);
        $desc = htmlspecialchars($_POST['description']);
        $photo = htmlspecialchars($_POST['photo']);
        $laDate =  $_POST['laDate'];
        $like = 0;
        $location = htmlspecialchars($_POST['location']);


        $input = $laDate;
        $date = strtotime($input);
        $newDate= date('d/M/Y h:i:s', $date);

        if (empty($_POST['user_id'])){
            echo 'aucun user pour ce post';
            $user_id =  intval($_POST['user_id']);

        }else{
            echo $_POST['user_id'];
        }
        $user_id =  intval($_POST['user_id']);

//        echo $user_id; echo 'est le user_id';

        if(!empty($title) AND !empty($desc) AND !empty($photo)  AND !empty($location) AND !empty($laDate) AND !empty($user_id)) {
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
            //var_dump($_POST);
            echo 'sucesss';
        }else{
            echo ' une empty erreur ';
            die();
        }

    }

    /**
     * @return void liker les affiches
     * ?action=reaction
     */
    public function reaction(){
        header("Access-Control-Allow-Origin : *");
        header('Content-Type: application/json' );

       /// var_dump($_SERVER);
        $postManager = new PostRepository();
//        $pointEnv = new DotEnv();
//        $pointEnv->demarrer();
//        $pointEnv->load();

//        echo getenv('URL');

        if(isset($_POST)){
            $msg = '';


            $like = htmlspecialchars(intval($_POST['like']));
            $id = htmlspecialchars(intval($_POST['lId']));


            if( !empty($like)   AND !empty($id)) {
                $postManager->like($like,$id);
                $msg = 'succesReaction';
            }else{
                $msg = 'error';
                //die();
            }
            echo json_encode($msg, JSON_PRETTY_PRINT);

        }



    }


    /*****************************************************************************************************
     *                                      USER
     ***************************************************************************************************/

    public function signUpApi()
    {
        header("Access-Control-Allow-Origin : *");
        header('Content-Type: application/json' );

//        if(isset($_SERVER['HTTP_X_API_KEY'])){
//            echo $_SERVER['HTTP_X_API_KEY'];
//            // @todo verifier token
//        }else{
//            echo ' token pas envoyer';
//        }

        $user = new User();

        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        $hash = hash('SHA512',$password);
        $role[] = 'ROLE_USER';
        $json = json_encode($role);

        // echo $json;
        if (!empty($email) and !empty($password)) {


            $userRepo = new UserRepository();
            $check = $userRepo->findByEmail($email);
            $msg = '';
            if(!empty($check['email']) ){
                $msg = 'emailExist';
            }else{
                $user->setEmail($email);
                $user->setPassword($hash);
                $userRepo = new  UserRepository();
               $id =  $userRepo->inscription($user);
                //$msg = 'success';
                $msg = $id;

            }


        } else {
//            $env = new DotEnv();
//            $env->demarrer();
//            $env->load();
//            $baseUrl = getenv('URL');
//            echo $baseUrl;
            $msg= 'champs requis';
//            header('Location: ' . $baseUrl);
            die();
        }
        echo json_encode($msg, JSON_PRETTY_PRINT);


    }

   public function login(){
       // if(isset($_POST['signIn'])){
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['mdp']);


            $hash = hash('SHA512',$password);

            $userRepo = new UserRepository();
            $check = $userRepo->findByEmail($email);

            if(!empty($check)){
                echo $check['email'];
                echo $check['password'];

                if($hash === $check['password']){
                    echo 'mdb correspondand';
                }else{
                    echo 'mdp ne sont pas les meme';
                }
            }else{
                echo ' aucun user trouver ';
            }
       // }

        //require('view/user/singIn.phtml');
    }


        /**
     * @return void liste des user format json
     */
    public function listUsersApi()
    {
        header("Access-Control-Allow-Origin : *");
        header('Content-Type: application/json' );

        $userRepo = new UserRepository();
        $users = $userRepo->findAll();

        if(isset($_SERVER['HTTP_X_API_KEY'])){
            //echo $_SERVER['HTTP_X_API_KEY'];// envoyer par x_api_key du front
            // @todo verifier token
        }else{
            //echo ' token pas envoyer';
        }
        //var_dump($_SERVER);

        $response = [];
        foreach($users as $all ){
            $response[] = $all;
        }
        $final = [];
        $i = 0;

        while ($i != count($response)){
            $final[] = array(
                "email"=> $response[$i]["email"],
                "password"=> $response[$i]["password"],
                "roles"=> $response[$i]["roles"],
            );

            $i++;
        }

        echo json_encode($final, JSON_PRETTY_PRINT);
    }


    /******************************************************
     * Home
     */
    /**
     * @return void Nombre totale de post
     */
    public function nbPostApi(){
        header("Access-Control-Allow-Origin : *");
        header('Content-Type: application/json' );

        $postManager = new PostRepository();
        $posts = $postManager->countPost();
        $nb = $posts->fetch();

        $valeur = $nb['nb'];

        echo json_encode($valeur, JSON_PRETTY_PRINT);
    }

    /**
     * filtre par plus grand like limit 3
     */
   public  function troisDernier(){

        header("Access-Control-Allow-Origin : *");
        header('Content-Type: application/json' );

        $postManager = new PostRepository();
        $posts = $postManager->getPosts(3);
        $response = [];
        foreach($posts as $all ){
            $response[] = $all;
        }
        $final = [];
        $i = 0;

        while ($i != count($response)){
            $final[] = array(
                "id"=> $response[$i]["id"],
                "title"=> $response[$i]["title"],
                "description"=> $response[$i]["description"],
                "imageUrl"=> $response[$i]["image_url"],
                "createdDate"=> $response[$i]["created_date"],
                "snaps"=> $response[$i]["snaps"],
                "location"=> $response[$i]["location"]
            );

            $i++;
        }



        echo json_encode($final, JSON_PRETTY_PRINT);

    }


    /**************************************
     *      P U S H E R
     */
    public function pusherLike($id){
        //require 'vendor/autoload.php';

        header("Access-Control-Allow-Origin : *");
        header('Content-Type: application/json' );

        $options = array(
            'cluster' => 'eu',
            'useTLS' => true
        );

        $pusher = new  Pusher(
            '2e4bc757da112b198aaf',
            'c4f181960b67c4f98291',
            '1473875',
            $options
        );

        $postRepo = new PostRepository();
        $post = $postRepo->getPost($id);
        //echo $id;echo '<br/>';
        $like= $post['snaps'];

        echo json_encode($like);
        //$data['message'] = json_encode($like);
        $data=json_encode($like);
        $pusher->trigger('pabiosoft', 'my-event', $data);
    }


}
