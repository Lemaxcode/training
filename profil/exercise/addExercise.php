<?php
require_once("../../utils/databaseManager.php");
check_session();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo ("Le form est validé");
    // est ce que les champs du formulaires sont remplits 
    if (!empty($_POST["name"]) && !empty($_POST["description"]) && isset($_POST["execution"])) {
        $pdo = connectDB();
        var_dump($_POST);
       $r= insertExercise($pdo,$_POST);
        var_dump($r);
    }
}

include("../../block/header.php");
include("../../block/navbar.php");

?>
<h1>Ajout Exercice</h1>

<form action="addSession.php" method="POST">
    <!-- Champ pour le nom de l'exercice -->
    <label for="name">Nom de l'exercice:</label>
    <input type="text" id="name" name="name" required>

    <!-- Champ pour la description de l'exercice -->
    <label for="description">Description:</label>
    <textarea id="description" name="description" rows="5" cols="30"></textarea>

    <!-- Champ pour l'éxécution de l'exercice -->
    <label for="execution">Execution de l'éxercice:</label>
    <input type="text" id="execution" name="execution" required>

    <!-- Bouton pour soumettre le formulaire -->
    <input type="submit" value="Ajouter l'exercice">
</form>

<?php
include("../../block/footer.php");
?>
