<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<div>
    <h1>INSERT</h1>
    <h2>Merci de passer par engular pour inserer</h2>
    <form method="post" action="insert">
        <input type="text" name="title" placeholder="titre"/>
        <input type="text" name="description" placeholder="description"  />
        <input type="text" name="photo" placeholder="photo"/>
        <input type="datetime-local" name="laDate" placeholder="laDate"  />
        <input type="text" name="like" placeholder="like"  />
        <input type="text" name="location" placeholder="ville ou zone" />
        <input type="text" name="userId" placeholder="pour la presentation" />
        <input type="submit" name="insert" value="save">
    </form>
</div>



<?php
//$users->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>