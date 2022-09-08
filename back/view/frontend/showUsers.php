<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Folo  </h1>
<p>Liste de tout les Users</p>
<?php 
var_dump($users);

?>
<table border="1" style="margin: 0 auto;">
    <tr>
        <td>id</td>
        <td>email</td>
        <td>roles[]</td>
        <td>password</td>
    </tr>
    <?php while ($data = $users->fetch()){ ?>
    <tr>
        <td><?php echo htmlspecialchars($data['id']) ?></td>
        <td><?= $data['email'] ?></td>

        <td><?php
              var_dump($data['roles']);


            ?>
        </td>
        <td>
            <a href="index.php?action=post&amp;id=<?= $data['id'] ?>">edit profils</a>
        </td>
    </tr>

    <?php } ?>
</table>
<?php
$users->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>