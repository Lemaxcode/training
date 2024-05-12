<?php
if (!isset($_SESSION["name"])) {
    header("Location: https://localhost/training-project/training/index.php");
}

if (isset($_GET["id"]) === false) {
    header("Location: https://localhost/training-project/training/profil/exercise/index.php");
}

require_once("../utils/databaseManager.php");

$pdo = connectDB();

$id = $_GET["id"];

$pokemon = findSessionById($pdo, $id);

if ($pokemon === false) {
    header("Location: https://localhost/training-project/training/profil/exercise/index.php");
}


$title = "Update";
include("block/header.php");
include("block/navbar.php");
// ce bloc de code traite la soumission d'un formulaire qui contient des données de Session. Il valide d'abord les champs requis, puis met à jour les données du Pokémon dans la base de données s'il n'y a pas d'erreurs de validation, et enfin redirige l'utilisateur vers la page d'index de l'interface d'administration.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $exercise = $_POST;
    $exercise["id"] = $id;

    $errors = validateExerciseRequiredFields($_POST);
    if (empty($errors)) {
        $pdo = connectDB();
        updateSession($pdo, $exercise);
        header('Location: index.php');
    }
    return;
}
?>
<form action="updateExercise.php?id=<?php echo ($id) ?>" method="POST">
    <div class="form-group">
        <label for="id">ID de la séance:</label>
        <input type="number" id="id" name="id" value="<?php echo ($exercise["id"]) ?>" required>
    </div>
    <div class="form-group">
        <label for="nameFr">Nom de la séance :</label>
        <input type="text" id="name" name="name" value="<?php echo ($exercise["name"]) ?>" required>
    </div>
    <div class="form-group">
        <label for="nameJp">description :</label>
        <input type="text" id="description" name="description" value="<?php echo ($exercise["description"]) ?>">
    </div>
    <div class="form-group">
        <label for="execution">Execution :</label>
        <input type="text" id="execution" name="execution" value="<?php echo ($exercise["execution"]) ?>">
    </div>
    <input type="submit" value="Mettre à jour">
    <?php
    include("block/footer.php");
    ?>