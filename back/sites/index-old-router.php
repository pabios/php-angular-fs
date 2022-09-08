<?php

require './src/Controller/frontend.php';
require './src/Controller/ApiController.php';
require './src/Controller/HomeController.php';
require './src/Controller/UserController.php';
require './src/Controller/StyleController.php';

try {
    if (isset($_GET['action'])) {
        if($_GET['action'] == 'test')  {
            var_dump($_SERVER);
        }

      if($_GET['action'] == 'postsApi'){
            listePosts(); // api Posts list
        }else if($_GET['action'] == 'addPostApi'){
          addPostApi();
      }else if($_GET['action'] == 'reaction'){
          reaction();
      } else if($_GET['action'] == 'inscription'){
          inscription();
      }else if($_GET['action'] == 'connexion'){
          connexion();
      }if($_GET['action'] == 'signUpApi'){
            signUpApi();
        }else if($_GET['action'] == 'nbPost'){
            nbPost();
        }else if($_GET['action'] == 'nbPostApi'){
            nbPostApi();
        }else if($_GET['action'] == 'troisDernier'){
            troisDernier();
        }
        else if($_GET['action'] == 'style'){ // Style
            style();
        }
      else if($_GET['action'] == 'listUsersApi'){
            listUsersApi();
        } else if($_GET['action'] == 'unPost'){
          unPost();
        }  else if ($_GET['action'] == 'listPosts') {
            listPosts();
        }else if($_GET['action'] == 'insert'){
          ajout();
        }else if($_GET['action'] == 'update'){
          update();
      }else if($_GET['action'] == 'ajout'){
          ajout();  // fais
      } else if($_GET['action'] == 'like'){
          like();

//          if(isset($_POST['lId'])){
//               // $id = htmlspecialchars(intval($_POST['id']));
//                like();
//            }else{
//                throw new Exception('absence de l\'identifiant de post ');
//            }
      }
      else if ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        else if ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }else if ($_GET['action'] == 'deletePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_GET['id'])) {
                    $id = htmlspecialchars(intval($_GET['id']));
                    delete($id);
                }
                else {
                    throw new Exception('id ne peut pas etre null');
                }
            }
            else {
                throw new Exception('id aubligatoir');
            }
        } else if($_GET['action'] == 'signIn'){// a securiser plutard
            if (isset($_POST['id']) && $_POST['id'] > 0) {
                if (!empty($_POST['nom']) && !empty($_POST['ville'])) {

                    rejoindre($_POST['id'], $_POST['nom'], $_POST['ville']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('impossible de s\'inscrire | voir erreur dans  Router ');
            }
        }else if($_GET['action'] == 'showUser'){
            showUser();
        }else if($_GET['action'] == 'home'){
            compte();
        }else if($_GET['action'] == 'send'){
            transfert();
        }else if($_GET['action'] == 'sends'){
            transferts();
        }

    }
    else {
        //listPosts();
       // showUsers();
        tableauPosts();
    }
}
catch(Exception $e) {  
    echo 'Erreur oups aucune action n\' a reussi  voir le message : ' . $e->getMessage();
}
