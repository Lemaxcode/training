<?php
require_once("../../utils/databaseManager.php");
check_session();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo ("Le form est validé");
    // est ce que les champs du formulaires sont remplits 
    if (!empty($_POST["name"]) && !empty($_POST["date"]) && isset($_POST["description"])) {
        $pdo = connectDB();
        var_dump($_POST);
       $r= insertSession($pdo,$_POST);
        var_dump($r);
    }
}

include("../../block/header.php");
include("../../block/navbar.php");

?>
<h1>Ajout séance</h1>

<form action="addSession.php" method="POST">
    <!-- Champ pour le nom de la séance -->
    <label for="name">Nom de la séance:</label>
    <input type="text" id="name" name="name" required>

    <!-- Champ pour la description de la séance -->
    <label for="description">Description:</label>
    <textarea id="description" name="description" rows="5" cols="30"></textarea>

    <!-- Champ pour la date de la séance -->
    <label for="date">Date de la séance:</label>
    <input type="date" id="date" name="date" required>

    <!-- Bouton pour soumettre le formulaire -->
    <input type="submit" value="Créer la séance">
</form>

<?php
include("../../block/footer.php");
?>