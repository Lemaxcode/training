<?php
    require_once("../../utils/databaseManager.php");
    check_session();
    $pdo = connectDB();
    $response = $pdo->prepare("SELECT * FROM exercise");
        $response->execute();

        $exerciseBdd = $response->fetchAll();
        // var_dump($sessionsBdd);
    include("../../block/header.php");
    include("../../block/navbar.php");
    
    ?>
<h1>Exercice</h1>
<a href="addExercise.php">Nouvel exercice</a>
<a href="deleteExercise.php?id=">delete exercise</a>
<div>

    <?php
    foreach ($exerciseBdd as $exercises) {
    ?>
        <div class="bordel">

            <p><?php echo ($exercises["name"]) ?></p>
            
            <a href="detailExercise.php?id=<?php echo ($exercises["id"]) ?>">Détail</a>
        </div>
    <?php
    }
    ?>
</div>

<?php 
include("../../block/footer.php");
?>