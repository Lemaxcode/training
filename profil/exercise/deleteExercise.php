
<?php
if (!isset($_SESSION["name"])) {
    header("Location: http://localhost/training-project/training/index.php");
}

if (isset($_GET["id"]) === false) {
    header("Location: http://localhost/training-project/training/profil/exercise/index.php");
}

require_once("../utils/databaseManager.php");

$pdo = connectDB();

$id = $_GET["id"];

$exercise = findExerciseById($pdo, $id);

if ($exercise === false) {
    header("Location: http://localhost/training-project/training/profil/exercise/index.php");
}

if ($_SERVER["REQUEST_METHOD"] === "POST")
   {
    deleteExercise($pdo,$id);
    header("Location: index.php");
   }

?>
<h1>delete</h1>
