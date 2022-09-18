import { Component, OnInit } from '@angular/core';
import { FaceSnap } from '../../../core/models/face-snap.model';
import { FaceSnapsService } from '../../../core/services/face-snaps.service';
import { ActivatedRoute } from '@angular/router';
import {Observable} from "rxjs";
import {tap} from "rxjs/operators";
import {FormBuilder, FormControl, FormGroup, NgForm, Validators} from "@angular/forms";
import {NotificationService} from "../../../core/services/notification.service";
import Pusher from "pusher-js";
import {FroalaEditorModule} from "angular-froala-wysiwyg";
//  https://techincent.com/angular-code-editor/
import 'ace-builds';
import 'ace-builds/src-noconflict/mode-json';
import 'ace-builds/src-noconflict/mode-yaml';
import 'ace-builds/src-noconflict/mode-typescript';
import 'ace-builds/src-noconflict/mode-scss';
import  'ace-builds/src-noconflict/mode-html';
import  'ace-builds/src-noconflict/mode-php';
//
@Component({
  selector: 'app-single-face-snap',
  templateUrl: './single-face-snap.component.html',
  styleUrls: ['./single-face-snap.component.scss']
})
export class SingleFaceSnapComponent implements OnInit {
  faceSnap!: FaceSnap;
  faceSnap$!: Observable<FaceSnap>;
  snapForm!: FormGroup;

  buttonText!: string;
  entierRegex!: RegExp;
  channel!:any;
  info!: string;
  lesLikes$!: Observable<any>;


  // editor begin

  //taille
    taille_200:{} = {'font-size': '1.1em', color: 'blue','min-height':'2.2em'};

//

  title = 'angular-code-editor';
  jsonInputData = '';
  yamlInputData = '';
  appModuleTsData = ' import x from y';
  scssData = '';
  htmlInputData = '  <?php echo " asd2"; ?> ';
  getPostPhp = '';
  putAngular = '';
  putReqPhp = '';
  phpInputData = ' echo " 2"; ';
  managerPhp = '';
  postPhp = '';
  postRepository = '';
  postController = '';
  composerJson = '';
  fastRooter = '';
  dispathFastRoute = '';
  routeUnPost = '';
  homeController = '';
  resultApiPost = '';

  constructor(private faceSnapsService: FaceSnapsService,
              private route: ActivatedRoute,
              private  formBuilder: FormBuilder,
              private pusherS:NotificationService) {}

  ngOnInit() {
    this.buttonText = 'Oh Snap!';
    const faceSnapId = +this.route.snapshot.params['id'];
    // this.faceSnap = this.faceSnapsService.getFaceSnapById(faceSnapId);
     this.faceSnap$ = this.faceSnapsService.getFaceSnapById(faceSnapId);
    this.buttonText = 'aimer!';

    // // // //@todo logique a remplacer par snapFacesnapService
    // this.entierRegex = /^\d+$/;
    // this.snapForm = this.formBuilder.group({
    //     like: [null, Validators.required],
    //     lId: [null, Validators.required]
    //   }, {
    //     updateOn: 'blur' // formulaire mis a jours lorsqu'on change de champs
    //   }
    // );

    this.getPostPhp = '' +
      ' <?php \n \n \n \t \t \t \t // on elimine toutes les balises  et on  parse la saisie en entier   \n ' +
      ' \t \t \t $id =  htmlspecialchars(intval($_GET[\'id\']));\n \n \n' +
      ' \t \t \t \t $title = htmlspecialchars($_POST[\'title\'] \n ?>'

    this.putAngular = '<script> \n \n const body = { title: \'Angular PUT Request Example\' };\n' +
      '    this.http.put<any>(\'https://domain.com/posts/1\', body)\n' +
      '        .subscribe(data => this.postId = data.id); \n \n </script>'

    this.putReqPhp = ' <?php \n \t if($_SERVER[\'REQUEST_METHOD\'] == \'PUT\') {\n' +
      '    echo "une requete put \\n";\n' +
      '    parse_str(file_get_contents("php://input"),$post_vars);\n' +
      '    echo $post_vars[\'orders\']." est le nom\\n";\n' +
      '    echo "je recupere une quantite ".$post_vars[\'quantity\']."  \\n\\n";\n' +
      '} \n \t?>'

    this.managerPhp = '<?php\n' +
      'namespace Pabiosoft\\Entity;\n' +
      '\n' +
      '\n' +
      'class Manager\n' +
      '{\n' +
      '    private $db;\n' +
      '\n' +
      '    protected function dbConnect()\n' +
      '    {\n' +
      '        try{\n' +
      '            $this->db = new \\PDO(\'mysql:host=localhost;dbname=labe;charset=utf8\', \'root\', \'pass\');\n' +
      '            return $this->db;\n' +
      '        }catch(\\Exception $e){\n' +
      '            echo \' impossible de se connecter\';\n' +
      '        }\n' +
      '        return $this->db;\n' +
      '    }\n' +
      '}';

      this.postPhp = '<?php\n' +
        'namespace Pabiosoft\\Entity;\n' +
        '\n' +
        'class Post\n' +
        '{\n' +
        '    private ?int $id = null;\n' +
        '\n' +
        '    private ?string $title = null;\n' +
        '\n' +
        '    private ?string $description = null;\n' +
        '\n' +
        '\n' +
        '\n' +
        '    public function getId(): ?int\n' +
        '    {\n' +
        '        return $this->id;\n' +
        '    }\n' +
        '\n' +
        '    public function getTitle(): ?string\n' +
        '    {\n' +
        '        return $this->title;\n' +
        '    }\n' +
        '\n' +
        '    public function setTitle(string $title): self\n' +
        '    {\n' +
        '        $this->title = $title;\n' +
        '\n' +
        '        return $this;\n' +
        '    }\n' +
        '\n' +
        '    public function getDescription(): ?string\n' +
        '    {\n' +
        '        return $this->description;\n' +
        '    }\n' +
        '\n' +
        '    public function setDescription(string $description): self\n' +
        '    {\n' +
        '        $this->description = $description;\n' +
        '\n' +
        '        return $this;\n' +
        '    }\n' +
        '     \n' +
        '}\n';
      this.postRepository = '<?php\n' +
        'namespace Pabiosoft\\Repository;\n' +
        '\n' +
        'use Pabiosoft\\Entity\\Manager;\n' +
        'use Pabiosoft\\Entity\\Post;\n' +
        '\n' +
        'class PostRepository extends Manager\n' +
        '{\n' +
        '    public function getPosts()\n' +
        '    {\n' +
        '\n' +
        '        $db = $this->dbConnect();\n' +
        '        $req = $db->query(\'SELECT id, title, description  FROM post ORDER BY id DESC \');\n' +
        '\n' +
        '        return $req;\n' +
        '    }\n' +
        '    \n' +
        '    public function insert(Post $post): void\n' +
        '    {\n' +
        '        $sql = \'\n' +
        '            INSERT INTO `post` (`title`, `description`)\n' +
        '            VALUES (:title, :description)\n' +
        '        \';\n' +
        '        $q = $this->dbConnect()->prepare($sql);\n' +
        '\n' +
        '        $q->bindValue(\':title\', $post->getTitle(), \\PDO::PARAM_STR);\n' +
        '        $q->bindValue(\':description\', $post->getDescription(), \\PDO::PARAM_STR);\n' +
        '\n' +
        '        $q->execute();\n' +
        '    }\n' +
        '\n' +
        '}'

       this.postController = '<?php\n' +
         'namespace Pabiosoft\\Controller;\n' +
         '\n' +
         'use \\Pabiosoft\\Entity\\Post;\n' +
         'use \\Pabiosoft\\Repository\\PostRepository;\n' +
         '\n' +
         '\n' +
         'class PostController{\n' +
         '\n' +
         '    /**\n' +
         '     * @return void liste des posts format json\n' +
         '     */\n' +
         '    public function posts()\n' +
         '    {\n' +
         '        header("Access-Control-Allow-Origin : *");\n' +
         '        header(\'Content-Type: application/json\' );\n' +
         '\n' +
         '        //var_dump($_POST);\n' +
         '\n' +
         '        $postManager = new PostRepository();\n' +
         '        $posts = $postManager->getPosts();\n' +
         '        $response = [];\n' +
         '        foreach($posts as $all ){\n' +
         '            $response[] = $all;\n' +
         '        }\n' +
         '\n' +
         '        $final = [];\n' +
         '        $i = 0;\n' +
         '\n' +
         '        while ($i != count($response)){\n' +
         '            $final[] = array(\n' +
         '                "id"=> $response[$i]["id"],\n' +
         '                "title"=> $response[$i]["title"],\n' +
         '                "description"=> $response[$i]["description"],\n' +
         '            );\n' +
         '\n' +
         '            $i++;\n' +
         '        }\n' +
         '\n' +
         '        echo json_encode($final, JSON_PRETTY_PRINT);\n' +
         '    }\n' +
         '\n' +
         '     /**\n' +
         '     * @return void ajout d\'un post\n' +
         '     */\n' +
         '   public function ajout():void{\n' +
         '    header("Access-Control-Allow-Origin : *");\n' +
         '    header(\'Content-Type: application/json\' );\n' +
         '\n' +
         '    $post = new Post();\n' +
         '\n' +
         '\n' +
         '    if (!empty($_POST[\'insert\'])){\n' +
         '        $title = htmlspecialchars($_POST[\'title\']);\n' +
         '        $desc = htmlspecialchars($_POST[\'description\']);\n' +
         '\n' +
         '\n' +
         '\n' +
         '        if(!empty($title) AND !empty($desc) ) {\n' +
         '            $post->setTitle($title);\n' +
         '            $post->setDescription($desc);\n' +
         '            $postRepo = new PostRepository();\n' +
         '            $postRepo->insert($post);\n' +
         '            echo json_encode(\'bien inserer\', JSON_PRETTY_PRINT);\n' +
         '\n' +
         '        }else{\n' +
         '            echo json_encode(\'oups donnees doivent exister et contenir des valeur \', JSON_PRETTY_PRINT);\n' +
         '        }\n' +
         '    }\n' +
         '}\n' +
         '\n' +
         '}\n'

      this.composerJson ='{\n' +
        '    "require": {\n' +
        '        "nikic/fast-route": "^1.3"  \n' +
        '    },\n' +
        '    "autoload": {\n' +
        '        "psr-4": {\n' +
        '          "Pabiosoft\\\\": "src/"\n' +
        '        }\n' +
        '      }\n' +
        '\n' +
        '}\n';

      this.fastRooter = '<?php\n' +
        '\n' +
        'require \'vendor/autoload.php\';\n' +
        '\n' +
        '$dispatcher = FastRoute\\simpleDispatcher(function(FastRoute\\RouteCollector $r) {\n' +
        '    $r->addRoute(\'GET\', \'/posts\', \'\\Pabiosoft\\Controller\\PostController::posts\');\n' +
        '});\n' +
        '\n' +
        '\n' +
        '// Fetch method and URI from somewhere\n' +
        '$httpMethod = $_SERVER[\'REQUEST_METHOD\'];\n' +
        '$uri = $_SERVER[\'REQUEST_URI\'];\n' +
        '\n' +
        '// Strip query string (?foo=bar) and decode URI\n' +
        'if (false !== $pos = strpos($uri, \'?\')) {\n' +
        '    $uri = substr($uri, 0, $pos);\n' +
        '}\n' +
        '\n' +
        '$uri = rawurldecode($uri);\n' +
        '\n' +
        '$routeInfo = $dispatcher->dispatch($httpMethod, $uri);\n' +
        '\n' +
        '\n' +
        '\n' +
        'if($routeInfo[0] == FastRoute\\Dispatcher::FOUND){\n' +
        '    // je verifie si mon parametre est une chaine de caratere\n' +
        '    if(is_string($routeInfo[1])){\n' +
        '        // si dans la chaine recue on trouve les ::\n' +
        '        if(strpos($routeInfo[1],\'::\') !== false){\n' +
        '            // on coupe par ::\n' +
        '            $route = explode(\'::\',$routeInfo[1]);\n' +
        '            $method = [new $route[0],$route[1]];\n' +
        '        }else{\n' +
        '            // diretement la chaine\n' +
        '            $method = $routeInfo[1];\n' +
        '        }\n' +
        '        //var_dump($routeInfo[2]);\n' +
        '        call_user_func_array($method,$routeInfo[2]);\n' +
        '    }\n' +
        '}\n' +
        'elseif($routeInfo[0] == FastRoute\\Dispatcher::NOT_FOUND){\n' +
        '    header("HTTP/1.0 404 Not Found");\n' +
        '    if(method_exists(\'\\Pabiosoft\\Controller\\HomeController\',\'error404\')) {\n' +
        '        echo call_user_func([new \\Pabiosoft\\Controller\\HomeController, \'error404\']);\n' +
        '    } else {\n' +
        '        echo \'<h1>404 Not Found</h1>\';\n' +
        '        exit();\n' +
        '    }\n' +
        '}\n' +
        'elseif($routeInfo[0] == FastRoute\\Dispatcher::METHOD_NOT_ALLOWED){\n' +
        '    header("HTTP/1.0 405 Method Not Allowed");\n' +
        '    if(method_exists(\'\\Pabiosoft\\Controller\\HomeController\',\'error405\')) {\n' +
        '        echo call_user_func([new \\Pabiosoft\\Controller\\HomeController, \'error405\']);\n' +
        '    } else {\n' +
        '        echo \'<h1>405 Method Not Allowed</h1>\';\n' +
        '        exit();\n' +
        '    }\n' +
        '}\n' +
        '\n' +
        '\n';

      this.dispathFastRoute = '<?php\n' +
        '\n' +
        'require \'vendor/autoload.php\';\n' +
        '\n' +
        '$dispatcher = FastRoute\\simpleDispatcher(function(FastRoute\\RouteCollector $r) {\n' +
        '    $r->addRoute(\'GET\', \'/posts\', \'\\Pabiosoft\\Controller\\PostController::posts\');\n' +
        '});'


    this.routeUnPost = '<?php\n' +
      '\n' +
      'require \'vendor/autoload.php\';\n' +
      '\n' +
      '$dispatcher = FastRoute\\simpleDispatcher(function(FastRoute\\RouteCollector $r) {\n' +
      '    $r->addRoute(\'GET\', \'/posts\', \'\\Pabiosoft\\Controller\\PostController::posts\');\n' +
      '    $r->addRoute([\'GET\', \'POST\'], \'/add\', \'\\Pabiosoft\\Controller\\ApiController::addPostApi\');\n' +
      '    $r->addRoute(\'GET\', \'/post/{id:\\d+}\', \'\\Pabiosoft\\Controller\\ApiController::post\');\n' +
      '\n' +
      '});\n';

      this.homeController = '<?php\n' +
        'namespace Pabiosoft\\Controller;\n' +
        '\n' +
        'class HomeController{\n' +
        '\n' +
        '      /*********************************************************\n' +
        '     *                E R R O R\n' +
        '     **************************************/\n' +
        '    public function  error404(){\n' +
        '        echo \' pages non disponible \';\n' +
        '        die();\n' +
        '    }\n' +
        '\n' +
        '    public function  error405(){\n' +
        '        echo "une erreur s\'y est produite";\n' +
        '        die();\n' +
        '    }\n' +
        '}'

    this.resultApiPost = '[\n' +
      '    {\n' +
      '        "id": 11,\n' +
      '        "title": "Buildozer",\n' +
      '        "description": "convertit ton code python et kivy en  .apk"\n' +
      '    },\n' +
      '    {\n' +
      '        "id": 10,\n' +
      '        "title": "React Native",\n' +
      '        "description": "concevoir des des application  mobile natif"\n' +
      '    },\n' +
      '    {\n' +
      '        "id": 9,\n' +
      '        "title": "Arduino ",\n' +
      '        "description": "microcontroller"\n' +
      '    },\n' +
      '    {\n' +
      '        "id": 8,\n' +
      '        "title": "Automotive os",\n' +
      '        "description": "un Os qui a de l\'avenir"\n' +
      '    },\n' +
      '    {\n' +
      '        "id": 7,\n' +
      '        "title": "ionic",\n' +
      '        "description": "web view"\n' +
      '    },\n' +
      '    {\n' +
      '        "id": 6,\n' +
      '        "title": "PCB",\n' +
      '        "description": "circuit imprimer"\n' +
      '    },\n' +
      '    {\n' +
      '        "id": 5,\n' +
      '        "title": "Raspberry Pi 4",\n' +
      '        "description": "8 Go Ram wifi \\/ blutooth"\n' +
      '    },\n' +
      '    {\n' +
      '        "id": 4,\n' +
      '        "title": "Api REST php mysql",\n' +
      '        "description": "le web 2.0"\n' +
      '    }\n' +
      ']';

      // taille
  }


  /**
   * likons ce truc
   */

  onSendReact(faceSnapId: string,like:string){


    const formData : FormData = new FormData();
    formData.append('like',like.toString())
    formData.append('lId',faceSnapId.toString())

    this.faceSnapsService.reaction(formData).subscribe(
      (res=>{
       // console.log(res)
      })
    );


    if (this.buttonText === 'aimer!') {
      this.buttonText = 'deja aimer!';
    }
  }


}
