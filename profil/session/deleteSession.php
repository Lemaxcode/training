<?php
if (!isset($_SESSION["name"])) {
    header("Location: http://localhost/training-project/training/index.php");
}

if (isset($_GET["id"]) === false) {
    header("Location: http://localhost/training-project/training/profil/session/index.php");
}

require_once("../utils/databaseManager.php");

$pdo = connectDB();

$id = $_GET["id"];

$session = findSessionById($pdo, $id);

if ($session === false) {
    header("Location: http://localhost/training-project/training/profil/session/index.php");
}

if ($_SERVER["REQUEST_METHOD"] === "POST")
   {
    deleteExercise($pdo,$id);
    header("Location: index.php");
   }
