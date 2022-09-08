<?php
//namespace Pabiosoft\fontend;

require_once('./src/model/Repository/PostManager.php');
require_once('./src/model/CommentManager.php');
require_once('./src/model/UserManager.php');

use \Pabiosoft\Blog\Model\PostManager;
use \Pabiosoft\Blog\Model\CommentManager;
use \Pabiosoft\Blog\Model\UserManager;

function listPosts()
{
    $postManager = new PostManager();  
    $posts = $postManager->getPosts();  
    
    require('view/frontend/listPostsView.php');
}



function post()
{
    $postManager = new  PostManager();
    $commentManager = new  CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function showUsers(){
    $userManager = new UserManager();
    $users = $userManager->getUsers();  

    require('view/frontend/showUsers.php');
}
/**
 * showUser pour js 
 */
function showUser(){
    $userManager = new UserManager();
    $request_method = $_SERVER["REQUEST_METHOD"];
    //$users = $userManager->getUsers();  
    switch($request_method)
	{
		case 'GET':
			if(!empty($_GET["id"]))
			{
				// Récupérer un seul user
				$id = intval($_GET["id"]);
                $users = $userManager->getUser($id);  
			}
			else
			{
				// Récupérer tous les users
                $users = $userManager->getUser();  

			}
			break;
		default:
			// Requête invalide
			header("HTTP/1.0 405 Method Not Allowed");
			break;
	}
    //require('view/frontend/showUsers.php');
}




function rejoindre($userId,$name,$ville){
    $userManager = new UserManager();

    $inscription = $userManager->signIn($userId,$name,$ville);

    if ($inscription === false) {
        throw new Exception('Impossible de s\'inscrire !');
    }
    else {
        header('Location: index.php?action=showUser');
    }

}
 
