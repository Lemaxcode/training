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
    foreach ($session as $sessions) {
    ?>
        <div>

            <p><?php echo ($sessions["name"]) ?></p>
            <p><?php echo ($sessions["id"]) ?></p>
            <a href="detailSession.php?id=<?php echo ($sessions["id"]) ?>">Détail</a>
        </div>
    <?php
    }
    ?>
</div>



<?php
include("../../block/footer.php");
?>