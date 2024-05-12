<?php
    require_once("../../utils/databaseManager.php");
    check_session();
    $pdo = connectDB();
    $response = $pdo->prepare("SELECT * FROM exercise");
        $response->execute();

        $sessionsBdd = $response->fetchAll();
        var_dump($sessionsBdd);
    include("../../block/header.php");
    include("../../block/navbar.php");
    
    ?>
<h1>Exercice</h1>

<div>

    <?php
    foreach ($exercise as $exercises) {
    ?>
        <div>

            <p><?php echo ($exercises["name"]) ?></p>
            <p><?php echo ($exercises["id"]) ?></p>
            <a href="detailExercise.php?id=<?php echo ($exercises["id"]) ?>">Détail</a>
        </div>
    <?php
    }
    ?>
</div>

<?php 
include("../../block/footer.php");
?>