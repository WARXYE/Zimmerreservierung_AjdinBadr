<?php
$title = "Zimmer anzeigen";
include '../layouts/top.php';
include_once '../../models/Zimmer.php';

if (empty($_GET["nr"])){
    header("Location: index.php");
}else if (!is_numeric($_GET['nr'])) {
    http_response_code(400);
    die();
}else{
    $zimmer = Zimmer::get($_GET["nr"]);
}
?>

    <div class="container">
        <h2><?= $title ?></h2>

        <p>
            <a class="btn btn-primary" href="update.php?id=29">Aktualisieren</a>
            <a class="btn btn-danger" href="delete.php?id=29">Löschen</a>
            <a class="btn btn-default" href="index.php">Zurück</a>
        </p>

        <table class="table table-striped table-bordered detail-view">
            <tbody>
            <tr>
                <th>Zimmernummer</th>
                <td><?= $zimmer->getNr()?></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><?= $zimmer->getName()?></td>
            </tr>
            <tr>
                <th>Personen</th>
                <td><?= $zimmer->getPersonen()?></td>
            </tr>
            <tr>
                <th>Preis</th>
                <td><?= $zimmer->getPreis()?>€</td>
            </tr>
            <tr>
                <th>Balkon</th>
                <td><?= $zimmer->getBalkon()?></td>
            </tr>
            </tbody>
        </table>
    </div> <!-- /container -->

<?php
include '../layouts/bottom.php';
?>