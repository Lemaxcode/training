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
<a href="deleteSession.php">delete séance</a>
<div>

    <?php
    foreach ($sessionsBdd as $sessions) {
    ?>
        <div>

            <p><?php echo ($sessions["name"]) ?></p>
            <a href="detailSession.php?id=<?php echo ($sessions["id"]) ?>">Détail</a>
        </div>
    <?php
    }
    ?>
</div>


<ul>
    <li><a href="http://localhost/training-project/training/profil/session/index.php">Accueil</a></li>
    <li><a href="http://localhost/training-project/training/profil/session/addSession.php">Add session</a></li>
    <li><a href="http://localhost/training-project/training/profil/session/deleteSession.php">Delete session</a></li>
    <li><a href="http://localhost/training-project/training/profil/session/updateSession.php">Update session</a></li>
</ul>

<?php
//http://localhost/training-project/training/profil/session/
include("../../block/footer.php");
?>