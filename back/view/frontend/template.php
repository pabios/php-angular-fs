<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="/assets/css/style.css" rel="stylesheet" />
        <link href="/assets/css/listePost.css" rel="stylesheet">
    </head>

    <body>

    <header>
        <div class="a11y-nav"><!--accessibilite-->
            <nav class="a11-nav">
                <ul>
                    <li>
                        <a href="#activite">voir les activites du mois</a>
                    </li>
                </ul>
            </nav>
        </div>

        <!--    @todo replace href="localhost:...." link by /admin/route-->

<!--        pour la presentation -->

        <div class="menuV2">
            <a href="http://localhost:9000/admin" class="elm1">
                Follow
            </a>
            <nav>
                <a  class="elm2 link" href="http://localhost:9000/admin/signUp">inscription</a>
                <a  class="elm2 link" href="http://localhost:9000/admin/login">connexion</a>
            </nav>
        </div>
    </header>
    <nav>
        <a  class="elm2 link" href="http://localhost:9000/admin/insert">publier</a>
        <a  class="elm2 link" href="http://localhost:9000/admin/update">modifier</a>
    </nav>
    <div class="info_resultat_filtre">
        <p class="icone_resultat"><i class="fas fa-info"></i></p>
        <p class="info">Plus de 500 logements sont disponibles dans cette ville</p>
    </div>

        <section>
             <?= $content ?>
        </section>

        <!-- use js display -->
    <h3> Les Affiches lister en js</h3>
        <div class="get__item">
            <table border="1" class="resultat">
                <tr>
                    <td>id</td>
                    <td>Titre</td>
                    <td>description</td>
                    <td>date</td>
                    <td>image_url</td>
                    <td>snaps</td>
                    <td>location</td>
                    <td>Edit</td>
                    <td>delete</td>
                </tr>
            </table>
        </div>

        <script src="/assets/js/app.js" ></script>
         <script src="https://kit.fontawesome.com/b4cf806350.js" crossorigin="anonymous"></script>
    </body>
</html>