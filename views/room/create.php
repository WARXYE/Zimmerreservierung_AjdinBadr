<?php
$title = "Zimmer erstellen";
include '../layouts/top.php';
include '../../models/Zimmer.php';

if(isset($_POST["submit"])){
    $neuesZimmer = new Zimmer();

    $neuesZimmer->setNr(isset($_POST["nr"]) ? $_POST["nr"] : null);
    $neuesZimmer->setName(isset($_POST["name"]) ? $_POST["name"] : null);
    $neuesZimmer->setPersonen(isset($_POST["size"]) ? $_POST["size"] : null);
    $neuesZimmer->setPreis(isset($_POST["price"]) ? $_POST["price"] : null);
    $neuesZimmer->setBalkon(isset($_POST["balcony"]) ? $_POST["balcony"] : null);

    if ($neuesZimmer->save()) {
        header("Location: view.php?nr=" . $neuesZimmer->biggestId()->getNr());
        exit();
    }
}
?>

<div class="container">
    <div class="row">
        <h2><?= $title ?></h2>
    </div>

    <form class="form-horizontal" action="/SWPP/Zimmerreservierung_AjdinBadr/Zimmerreservierung_AjdinBadr/views/room/create.php" method="post">

        <div class="row">
            <div class="col-md-2">
                <div class="form-group required">
                    <label class="control-label">Zimmernummer *</label>
                    <input type="text" class="form-control" name="nr" maxlength="4" value="">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="form-group required">
                    <label class="control-label">Name *</label>
                    <input type="text" class="form-control" name="name" maxlength="64" value="">
                </div>
            </div>
            <div class="col-md-5"></div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group required">
                    <label class="control-label">Personen *</label>
                    <input type="number" class="form-control" name="size" min="1" value="">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <div class="form-group required">
                    <label class="control-label">Preis *</label>
                    <input type="text" class="form-control" name="price" value="">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1">
                <div class="form-group required">
                    <label class="control-label">Balkon *</label>
                    <input type="checkbox" class="form-control" name="balcony" value="">
                </div>
            </div>
            <div class="col-md-5"></div>
        </div>

        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-success">Erstellen</button>
            <a class="btn btn-default" href="index.php">Abbruch</a>
        </div>
    </form>
</div> <!-- /container -->

<?php
include '../layouts/bottom.php';
?>
