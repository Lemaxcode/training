<?php
if (!isset($_SESSION["nbSeries"])) {
    header("Location: https://localhost/training-project/training/index.php");
}

if (!isset($_SESSION["nbReps"])) {
    header("Location: https://localhost/training-project/training/index.php");
}

if (isset($_GET["id"]) === false) {
    header("Location: https://localhost/training-project/training/profil/sessionExercise/index.php");
}

require_once("../utils/databaseManager.php");

$pdo = connectDB();

$id = $_GET["id"];

$pokemon = findSessionExerciseById($pdo, $id);

if ($pokemon === false) {
    header("Location: https://localhost/training-project/training/profil/sessionExercise/index.php");
}

if ($_SERVER["REQUEST_METHOD"] === "POST")
   {
    deleteSessionExercise($pdo,$id);
    header("Location: index.php");
   }