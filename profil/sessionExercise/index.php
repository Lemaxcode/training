<?php
require_once("../../utils/databaseManager.php");
check_session();
$pdo = connectDB();
$sessionsBdd = findAllSessions($pdo);
var_dump($sessionsBdd);
include("../../block/header.php");
include("../../block/navbar.php");

?>
<h1>Séances</h1>
<a href="addSession.php">Nouvelle séance</a>
<div>

    <?php
    foreach ($sessionExercise as $sessionExercises) {
    ?>
        <div>

            <p><?php echo ($sessionExercises["name"]) ?></p>
            <p><?php echo ($sessionExercises["id"]) ?></p>
            <a href="detailSessionExercise.php?id=<?php echo ($sessionExercises["id"]) ?>">Détail</a>
        </div>
    <?php
    }
    ?>
</div>



<?php
include("../../block/footer.php");
?>