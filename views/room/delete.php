<?php
$title = "Zimmer löschen";
include '../layouts/top.php';
include '../../models/Zimmer.php';
$nummer = !empty($_GET["nr"]) ? $_GET["nr"] : null;
$z = $nummer !== null ? Zimmer::get($nummer) : null;

if(isset($_POST["submit"])){
    Zimmer::delete($nummer);
    header("Location:/SWPP/Zimmerreservierung_AjdinBadr/Zimmerreservierung_AjdinBadr/views/room/index.php");
}
?>

    <div class="container">
        <h2><?= $title ?></h2>

        <form class="form-horizontal" action='delete.php?nr=<?=$nummer?>' method="post">
            <p class="alert alert-error">Wollen Sie das Zimmer <?=$nummer?> wirklich löschen?</p>
            <div class="form-actions">
                <button type="submit" name="submit" class="btn btn-danger">Löschen</button>
                <a class="btn btn-default" href="/SWPP/Zimmerreservierung_AjdinBadr/Zimmerreservierung_AjdinBadr/views/room/index.php">Abbruch</a>
            </div>
        </form>

    </div> <!-- /container -->

<?php
include '../layouts/bottom.php';
?>