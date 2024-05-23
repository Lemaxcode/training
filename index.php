<?php

// J'ai validé le formulaire en method post
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo ("Le form est validé");
    // est ce que les champs du formulaires sont remplits 
    if (!empty($_POST["name"]) && !empty($_POST["password"])) {
        $name = $_POST["name"];
        $password = $_POST["password"];
        require_once("utils/databaseManager.php");
        $pdo = connectDB();
        // Recuperer User avec les memes identifiants
        $response = $pdo->prepare("SELECT name, password FROM user WHERE name = :name ");
        $response->execute([
            ":name" => $name
            
        ]);

        $user = $response->fetch();
        var_dump($user);
        if ($user != false && password_verify($password, $user["password"]))  {
        session_start();
            $_SESSION["name"] = $name;
            header("location: training-project/training/profil/session/index.php");

        }
    }

}

include ("block/header.php");
include ("block/navbar.php");

?>
<h1>Bienvenue sur votre plateforme d'entainement</h1>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe numquam, nostrum quisquam dolores perferendis
    officiis culpa, nisi ratione, pariatur distinctio minus nulla recusandae fugiat nobis unde placeat delectus ad
    possimus?Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam deserunt itaque animi pariatur quisquam
    sint aliquid voluptatibus dignissimos iure voluptate alias, iste consequatur adipisci molestiae quo aliquam
    doloremque corrupti recusandae?Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam tenetur
    distinctio a laudantium vitae corporis, facere sit saepe odio soluta praesentium enim ab nobis sunt, excepturi
    commodi. Suscipit, eius cupiditate!</p>

<div class="form">

    <!-- Formulaire de connexion  -->
    <form method="POST" action="index.php">

        <label for="name">Username</label>
        <input type="text" name="name" id="name">
        <label for="password">Password</label>
        <input type="text" name="password" id="password">

        <?php
        if (isset($errors["global"])) {
            echo ("<p>" . $errors["global"] . "</p>");
        }
        ?>

        <input type="submit" value="Valider">
    </form>

</div>
<?php
include ("block/footer.php");
?>