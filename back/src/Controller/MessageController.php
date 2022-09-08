<?php
namespace Pabiosoft\Controller;

use Pabiosoft\Entity\Message;
use Pabiosoft\Entity\Post;
use Pabiosoft\Repository\MessageRepository;
use Pusher\Pusher;

class MessageController
{
    /**
     * @return void tous les messages
     */
    public function  getAllMessage(){
        header("Access-Control-Allow-Origin : *");
        header('Content-Type: application/json' );

        $msgRepo = new MessageRepository();
        $msg = $msgRepo->getAllMessage();
        $reps = $msg->fetchAll();

        $response = [];
        foreach($reps as $all ){
            $response[] = $all;
        }

        $final = [];
        $i = 0;

        while ($i != count($response)){
            $final[] = array(
                "id"=> $response[$i]["id"],
                "content"=> $response[$i]["content"],
                "laDate"=> $response[$i]["laDate"],
            );

            $i++;
        }



        echo json_encode($final, JSON_PRETTY_PRINT);
    }

    public  function  addMessage(){
        header("Access-Control-Allow-Origin : *");
        header('Content-Type: application/json' );


        $message = new Message();

        $content = htmlspecialchars($_POST['content']);
        $user_id = intval($_POST['user_id']);

       // $laDate =  $_POST['laDate'];


        $info = '';

        if(!empty($content)  ){
            $message->setContent($content);
           // $message->setLaDate($laDate);
            $message->setUser($user_id);


            $msgRepo = new MessageRepository();
            $msgRepo->addMessage($message);

            $info = 'succes';

        }else{
            $info = 'error';
        }

        if(!empty($info)){
            echo json_encode($info, JSON_PRETTY_PRINT);
        }

    }


    /**************************************
     *      P U S H E R
     */
    public function pusherMessage(){
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



        $msgRepo = new MessageRepository();
        $msg = $msgRepo->getAllMessage();
        $reps = $msg->fetchAll();

        $response = [];
        foreach($reps as $all ){
            $response[] = $all;
        }

        $final = [];
        $i = 0;

        while ($i != count($response)){
            $final[] = array(
                "id"=> $response[$i]["id"],
                "content"=> $response[$i]["content"],
                "laDate"=> $response[$i]["laDate"],
                "email" => $response[$i]["email"],
            );

            $i++;
        }



        echo json_encode($final, JSON_PRETTY_PRINT);


        $pusher->trigger('pabiosoft', 'my-event', $final);
    }

}