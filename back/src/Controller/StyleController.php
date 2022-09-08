<?php
namespace Pabiosoft\Controller;

//require_once('./src/model/Repository/PostManager.php');
//require_once('./src/model/CommentManager.php');
//require_once('./src/model/UserManager.php');
//require_once('./src/model/Repository/StyleRepository.php');

use Pabiosoft\Repository\StyleRepository;

class StyleController{

    public function style(){
        header("Access-Control-Allow-Origin : *");
        header('Content-Type: application/json' );

        $styleRepo = new  StyleRepository();
        $style = $styleRepo->findAll();
        $rep = $style->fetchAll();




//    echo $rep[0]['titre'];
//    echo $rep[0]['paragraphe'];
//    echo $rep[0]['lien'];

        $response = [];
        foreach($rep as $all ){
            $response[] = $all;
        }


        $final = [];
        $i = 0;

        //@todo  later titre+$i = value
        while ($i != count($response)){
            $final[] = array(
                "titre"=> $response[$i]["titre"],
                "paragraphe"=> $response[$i]["paragraphe"],
                "lien"=> $response[$i]["lien"],
            );

            $i++;
        }



        echo json_encode($final, JSON_PRETTY_PRINT);
    }
}


