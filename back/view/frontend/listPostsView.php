<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Framework pathern mvc  </h1>


<!-- ok new -->

<!-- debut deux -->
<section class="sec2" id="hebergement">
    <div class="main-sec2">
        <h2>Hébergements à Marseille</h2>
        <div class="les_box ">
                     <?php
                     while ($data = $posts->fetch())
                     {
                     ?>
            <div class="box box_appear">
                <a href="index.php?action=deletePost&amp;id=<?= $data['id'] ?>" class="carte">

                    <img src="<?= $data['image_url'] ?>"  alt="" class="src">
                    <h4><?= htmlspecialchars($data['title']) ?></h4>
                    <p>  <?= nl2br(htmlspecialchars($data['description'])) ?></p>
                    <p>
                        <i class="fas fa-star bleu"></i>
                        <i class="fas fa-star bleu"></i>
                        <i class="fas fa-star bleu"></i>
                        <i class="fas fa-star bleu"></i>
                        <span class="videIco"><i class="fas fa-star"></i></span>
                    </p>
                </a>
                <button (click)="onViewFaceSnap()">VIEW</button>
            </div>
                         <?php
                     }
                     $posts->closeCursor();
                     ?>

        </div>
        <p class="afficherPlus"><a href="#">Afficher plus</a> </p>
    </div>


    <!-- une route api pour les 3 plus populare -->
    <div class="sidebar">
        <div class="titre_sidebar">
            <h2>Les plus populaires</h2>
            <p><i class="fas fa-chart-line"></i></p>
        </div>
        <div class="liste">
            <a href="#"  class="carte">
                <div class="box_sidebar box_appear">
                    <div class="image_box_sidebar">
                        <img src="/public/images/nasa.jpeg" alt="" class="src">
                    </div>
                    <div class="info_box_sidebar">
                        <span class="titre_h4">Hôtel Le soleil du matin</span>
                        <span class="sidebar-info__item2 "> Nuit à partir de 128€</span>
                        <span class="sidebar-info__item3">
                                <i class="fas fa-star bleu"></i>
                                <i class="fas fa-star bleu"></i>
                                <i class="fas fa-star bleu"></i>
                                <i class="fas fa-star bleu"></i>
                                <i class="fas fa-star bleu"></i>
            </span>
                    </div>
                </div>
            </a>

        </div>
    </div>
</section>





<!-- decommente pour un affichage php -->
<!---->
<!-- <div>-->
<!--     <table border="1">-->
<!--         <tr>-->
<!--             <td>id</td>-->
<!--             <td>Titre</td>-->
<!--             <td>description</td>-->
<!--             <td>date</td>-->
<!--             <td>image_url</td>-->
<!--             <td>snaps</td>-->
<!--             <td>location</td>-->
<!--             <td>delete</td>-->
<!--         </tr>-->
<!--         --><?php
//         while ($data = $posts->fetch())
//         {
//         ?>
<!--             <tr>-->
<!--                 <td>--><?//=$data['id'] ?><!--</td>-->
<!--                 <td>--><?//= htmlspecialchars($data['title']) ?><!-- </td>-->
<!--                 <td>--><?//= nl2br(htmlspecialchars($data['description'])) ?><!--</td>-->
<!--                 <td>--><?//= htmlspecialchars($data['created_date']) ?><!--</td>-->
<!--                 <td>--><?//= $data['image_url'] ?><!--</td>-->
<!--                 <td>--><?//=$data['snaps']?><!--</td>-->
<!--                 <td>--><?//= $data['location']  ?><!--</td>-->
<!--                 <td><a href="index.php?action=deletePost&amp;id=--><?//= $data['id'] ?><!--" > delete</a></td>-->
<!--             </tr>-->
<!---->
<!---->
<!---->
<!--             --><?php
//         }
//         $posts->closeCursor();
//         ?>
<!--     </table>-->
<!---->
<!-- </div>-->



<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
