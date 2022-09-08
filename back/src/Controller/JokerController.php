<?php
namespace Pabiosoft\Controller;

use Pabiosoft\Repository\MessageRepository;
use Pabiosoft\Repository\PostRepository;
use Pabiosoft\Repository\SiteRepository;
use Pabiosoft\Repository\StyleRepository;

/**
 * Marathon des futur possible
 * localhost:9000/admin
 */
class JokerController{


    public function listeAllSite(){
        $siteRepo = new SiteRepository();
        $sites = $siteRepo->findAll();

        //$sites = $rep->fetchAll();

        require_once('view/joker/jokerSite.phtml');
    }

    public  function  listeAllStyle(){
        $styleRepo = new StyleRepository();
        $styles = $styleRepo->findAll();

        require_once('view/joker/jokerStyle.phtml');

    }

    public function styleBySite(){
        $styleBySite = new StyleRepository();
        $jointures = $styleBySite->styleBySite();

        require_once 'view/joker/styleBySite.phtml';
    }

    public  function  messageUser(){
        $messageRepo = new MessageRepository();
        $jointures = $messageRepo->messageUser();

        require_once 'view/joker/messageUser.phtml';

    }

    public  function postUser(){
        $postRespo = new PostRepository();
        $jointures = $postRespo->postUser();

        require_once 'view/joker/postUser.phtml';

    }


}