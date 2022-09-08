<?php
namespace Pabiosoft\Controller;

//require_once('./src/model/Entity/User.php');
//require_once('./src/model/Repository/UserRepository.php');
//require_once('./src/model/Repository/PostManager.php');
//require_once('./src/model/CommentManager.php');
//require_once('./src/model/UserManager.php');
require_once('config/DotEnv.php');

use \Pabiosoft\Repository\PostRepository;
//use \DRY\DotEnv;
use Pabiosoft\Repository\UserRepository;
use Pabiosoft\Entity\User;

class UserController{

   public function inscription()
    {
        $user = new User();
        header("Access-Control-Allow-Origin : *");


        if (!empty($_POST['signUp'])) {
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['mdp']);
//            $name = htmlspecialchars($_POST['name']);
            // $hash = crypt($email,'ArduinO');
            $hash = hash('SHA512',$password);
            $role[] = 'ROLE_USER';
            $json = json_encode($role);
            $roles = 'ROLE_USER';
            // echo $json;
            if (!empty($email) and !empty($password)) {
                $user->setEmail($email);
                $user->setPassword($hash);
                // $user->setRoles($roles);
                $userRepo = new  UserRepository();
                $userRepo->inscription($user,1);
                echo 'successss';
            } else {
                $env = new DotEnv();
                $env->demarrer();
                $env->load();
                $baseUrl = getenv('URL');
                echo $baseUrl;
                echo 'erreur c est produite ';
                header('Location: ' . $baseUrl);
                die();
            }
        }
        require('view/user/signUp.phtml');

    }

    public  function connexion(){

        if(isset($_POST['signIn'])){
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
        }
//    if (isset($_POST['email']) && isset($_POST['password'])) {
//        $manager = new UserManager();
//        $user = $manager->findByEmail($_POST['email']);
//        if ($user && password_verify($_POST['password'], $user->getPassword())) {
//            $this->auth->login($user->getId());
//            $this->router->redirectToRoute('homepage');
//        }
//    }
        require('view/user/singIn.phtml');

    }





}

