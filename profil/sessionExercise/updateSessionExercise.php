<?php
if (!isset($_SESSION["name"])) {
    header("Location: https://localhost/training-project/training/index.php");
}

if (isset($_GET["id"]) === false) {
    header("Location: https://localhost/training-project/training/profil/session/index.php");
}

require_once("../utils/databaseManager.php");

$pdo = connectDB();

$id = $_GET["id"];

$sessionExercise = findSessionExerciseById($pdo, $id);

if ($sessionExercise === false) {
    header("Location: https://localhost/training-project/training/profil/sessionExercise/index.php");
}


$title = "Update";
include("block/header.php");
include("block/navbar.php");
// ce bloc de code traite la soumission d'un formulaire qui contient des données de Session. Il valide d'abord les champs requis, puis met à jour les données du Pokémon dans la base de données s'il n'y a pas d'erreurs de validation, et enfin redirige l'utilisateur vers la page d'index de l'interface d'administration.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sessionExercise = $_POST;
    $sessionExercise["id"] = $id;

    $errors = validateSessionExerciseRequiredFields($_POST);
    if (empty($errors)) {
        $pdo = connectDB();
        updateSession($pdo, $sessionExercise);
        header('Location: index.php');
    }
    return;
}
?>
<form action="updateSessionExercise.php?id=<?php echo ($id) ?>" method="POST">
    <div class="form-group">
        <label for="id">ID de la séance:</label>
        <input type="number" id="id" name="id" value="<?php echo ($sessionExercise["id"]) ?>" required>
    </div>
    <div class="form-group">
    <label for="nbSeries">Nombre de séries:</label>
        <input type="text" id="nbSeries" name="nbSeries" value="<?php echo ($sessionExercise["nbSeries"]) ?>" required>
    </div>
    <div class="form-group">
    <label for="nbReps">Nombre de répétitions:</label>
        <input type="text" id="nbReps" name="nbReps" value="<?php echo ($sessionExercise["nbReps"]) ?>">
    </div>
    <div class="form-group">
    <label for="weight">Charge:</label>
        <input type="number" id="weight" name="weight" value="<?php echo ($sessionExercise["date"]) ?>" required>
    </div>
    <input type="submit" value="Mettre à jour">
    <?php
    include("block/footer.php");
    ?>