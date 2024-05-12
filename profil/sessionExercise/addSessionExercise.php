<?php
require_once("../../utils/databaseManager.php");
check_session();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo ("Le form est validé");
    // est ce que les champs du formulaires sont remplits 
    if (!empty($_POST["nbSeries"]) && !empty($_POST["nbReps"]) && isset($_POST["weight"])) {
        $pdo = connectDB();
        var_dump($_POST);
       $r= insertSessionExercise($pdo,$_POST);
        var_dump($r);
    }
}

include("../../block/header.php");
include("../../block/navbar.php");

?>
<h1>Ajout séance</h1>

<form action="addSessionExercise.php" method="POST">
    <!-- Champ pour le Nombre de séries-->
    <label for="nbSeries">Nombre de séries:</label>
    <input type="text" id="nbSeries" name="nbSeries" required>

    <!-- Champ pour le Nombre de répétitions -->
    <label for="nbReps">Nombre de répétitions:</label>
    <textarea id="nbReps" name="nbReps" ></textarea>

    <!-- Champ pour la charge -->
    <label for="weight">Charge:</label>
    <input type="number" id="weight" name="weight" required>

    <!-- Bouton pour soumettre le formulaire -->
    <input type="submit" value="Créer la séance">
</form>

<?php
include("../../block/footer.php");
?>