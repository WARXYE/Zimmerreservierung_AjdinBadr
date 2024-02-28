<?php
$title = "Zimmerverwaltung";
include '../layouts/top.php';
include "../../models/Zimmer.php";
$z = Zimmer::getAll();

?>

    <div class="container">
        <div class="row">
            <h2><?= $title ?></h2>
        </div>
        <div class="row">
            <p>
                <a href="create.php" class="btn btn-success">Erstellen <span class="glyphicon glyphicon-plus"></span></a>
            </p>

            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Zimmernummer</th>
                    <th>Name</th>
                    <th>Personen</th>
                    <th>Preis</th>
                    <th>Balkon</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php

                foreach ($z as $room):
                    $balkonString = $room->getBalkon() == 1 ? "Besitzt einen Balkon" : "Besitze keinen";
                    echo "<tr>";
                    echo "<td>" . $room->getNr() . "</td>";
                    echo "<td>" . $room->getName() . "</td>";
                    echo "<td>" . $room->getPersonen() . "</td>";
                    echo "<td>" . $room->getPreis() . "€</td>";
                    echo "<td>" . $balkonString . "</td>";

                    ?>
                    <td>
                        <a href='updatebetter.php?nr=<?=$room->getNr()?>' class="btn btn-primary">
                            Bearbeiten
                        </a>
                        <a href='view.php?nr=<?=$room->getNr()?>' class="btn btn-primary">
                            View
                        </a>
                        <a href='delete.php?nr=<?=$room->getNr()?>' class=" btn btn-danger">
                            Delete
                        </a>
                    </td>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>

<?php
include '../layouts/bottom.php';
?>