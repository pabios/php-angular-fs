<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
    <div>
        <h1>UPDATE</h1>
        <ul>
            <li>Posts</li>
            <li><a href="like">Like</a> </li>
        </ul>
        <form method="post" action="update">
            <input type="text" name="title" placeholder="titre"  />
            <input type="text" name="description" placeholder="description"  />
            <input type="text" name="photo" placeholder="photo"  />
            <input type="datetime-local" name="laDate" placeholder="laDate"  />
            <input type="text" name="like" placeholder="like" />
            <input type="text" name="location" placeholder="ville ou zone"  />
            <input type="number" name="lId" placeholder="id" />
            <input type="submit" name="update" value="save">
        </form>
    </div>


<?php
//$users->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>