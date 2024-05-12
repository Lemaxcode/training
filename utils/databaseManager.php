<?php
// Création d'une fonction pour vérifier la connexion
function check_session()
{
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!isset($_SESSION["name"])) {
        header("Location: https://http://localhost/training-project/training/index.php");
        exit();
    }
}


// Hashage du mot de passe
// $password = "rambo";
// var_dump(password_hash($password, PASSWORD_DEFAULT));

// Création d'une fonction pour se connecter à la base de donnée
function connectDB()
{
    try {

        $host = "localhost";
        $databaseName = "training";
        $user = "root";
        $password = "";

        $pdo = new PDO("mysql:host=" . $host . ";port=3306;dbname=" . $databaseName . ";charset=utf8", $user, $password);

        configPdo($pdo);

        return $pdo;
    } catch (Exception $error) {

        //Lancer l'erreur
        //throw $error;

        echo ("Erreur à la connexion: " .  $error->getMessage());

        exit();
    }
}



// Création d'une fonction pour gérer les erreurs
function configPdo(PDO $pdo): void
{
    // Recevoir les erreurs PDO ( coté SQL )
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Choisir les indices dans les fetchs
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}


//------------------------------------------------------//
// --------------------- FONCTIONS SESSION --------------- //
// --------------------------------------------------------//

function findAllSessions($pdo)
{
    $response = $pdo->prepare("SELECT * FROM session");
    $response->execute();

    return $response->fetchAll();
}
function findSessionById(PDO $pdo, int $id): array
{
    $query = $pdo->prepare('SELECT * FROM session WHERE id = :id');
    $query->execute([
        ":id" => $id
    ]);
    // Un seul resultat attendu fetch
    return $query->fetch();
}

function findSessionByName(PDO $pdo, string $name): array
{
    $query = $pdo->prepare('SELECT * FROM session WHERE name = :name');
    $query->execute([
        ":name" => $name
    ]);
    return $query->fetchAll();
}

function getUserByName(PDO $pdo, string $username)
{
    // Recuperer User avec les memes identifiants
    $response = $pdo->prepare("SELECT name, password FROM user WHERE name = :name");
    $response->execute([
        ":name" => $username
    ]);

    return $response->fetch();
}

function validateSessionRequiredFields(array $data) {
    $errors = [];

    // Validation de l'identifiant de la Session
    if (empty(trim($data['id'] ?? ''))) {
        $errors[] = "Le champ 'id' est manquant.";
    } elseif (!is_numeric(trim($data['id']))) {
        $errors[] = "Le champ 'id' doit être un entier.";
    }

    // Validation du nom de la session
    if (empty(trim($data['name'] ?? ''))) {
        $errors[] = "Le champ 'name' est manquant.";
    }

    // Validation de la description de la session
    if (empty(trim($data['date'] ?? ''))) {
        $errors[] = "Le champ 'date' est manquant.";
    }
    
}
function insertSession($pdo, $session)
{
    $response = $pdo->prepare(("INSERT INTO session (name, description, date) 
    VALUES (:name, :description, :date)"));
    $response->execute(
        [
            ':name' => $session["name"],
            ':description' => $session["description"],
            ':date' => $session["date"]
        ]

    );

    $response->fetch();
}
function updateSession(PDO $pdo, array $session)
{


    // Préparer la requête
    $response = $pdo->prepare("UPDATE session SET(name = :name, description = :description, date = :date) WHERE id = :id");

    // Exécution de la requête avec le tableau de paramètres
    $response->execute(
        [
            ':name' => $session["name"],
            ':description' => $session["description"],
            ':date' => $session["date"],
            ':id' => $session["id"]
        ]
    );

    return $response->fetch();
}
function deleteSession(PDO $pdo, int $id)
{

    $query = $pdo->prepare("DELETE FROM session WHERE id = :id");

    $query->execute([
        ':id' => $id
    ]);

    return $query->fetch();
}
//  ---------------------------------------------------------//
// --------------------- FONCTIONS EXERCISE --------------- //
// --------------------------------------------------------//

function validateExerciseRequiredFields(array $data) {
    $errors = [];

    // Validation de l'identifiant de l'exercice
    if (empty(trim($data['id'] ?? ''))) {
        $errors[] = "Le champ 'id' est manquant.";
    } elseif (!is_numeric(trim($data['id']))) {
        $errors[] = "Le champ 'id' doit être un entier.";
    }

    // Validation du nom de l'exercice'
    if (empty(trim($data['name'] ?? ''))) {
        $errors[] = "Le champ 'name' est manquant.";
    }

    // Validation de la description de l'exercice'
    if (empty(trim($data['description'] ?? ''))) {
        $errors[] = "Le champ 'desription' est manquant.";
    }
}
function findAllExercise($pdo)
{
    $response = $pdo->prepare("SELECT * FROM exercise");
    $response->execute();

    return $response->fetchAll();
}
function findExerciseById(PDO $pdo, int $id): array
{
    $query = $pdo->prepare('SELECT * FROM exercise WHERE id = :id');
    $query->execute([
        ":id" => $id
    ]);
    // Un seul resultat attendu fetch
    return $query->fetch();
}

function findExerciseByName(PDO $pdo, string $name): array
{
    $query = $pdo->prepare('SELECT * FROM exercise WHERE name = :name');
    $query->execute([
        ":name" => $name
    ]);
    return $query->fetchAll();
}



function insertExercise($pdo, $exercise)
{
    $response = $pdo->prepare(("INSERT INTO exercise (name, description, execution) 
    VALUES (:name, :description, :execution)"));
    $response->execute(
        [
            ':name' => $exercise["name"],
            ':description' => $exercise["description"],
            ':date' => $exercise["execution"]
        ]

    );

    $response->fetch();
}
function updateExercise(PDO $pdo, array $exercise)
{


    // Préparer la requête
    $response = $pdo->prepare("UPDATE exercise SET(name = :name, description = :description, execution = :execution) WHERE id = :id");

    // Exécution de la requête avec le tableau de paramètres
    $response->execute(
        [
            ':name' => $exercise["name"],
            ':description' => $exercise["description"],
            ':execution' => $exercise["execution"],
            ':id' => $exercise["id"]
        ]
    );

    return $response->fetch();
}
function deleteExercise(PDO $pdo, int $id)
{

    $query = $pdo->prepare("DELETE FROM exercise WHERE id = :id");

    $query->execute([
        ':id' => $id
    ]);

    return $query->fetch();
}

//  ---------------------------------------------------------//
// --------------------- FONCTIONS SESSION EXERCISE --------------- //
// --------------------------------------------------------//

function validateSessionExerciseRequiredFields(array $data) {
    $errors = [];

    // Validation de l'identifiant de sessionExercise
    if (empty(trim($data['id'] ?? ''))) {
        $errors[] = "Le champ 'id' est manquant.";
    } elseif (!is_numeric(trim($data['id']))) {
        $errors[] = "Le champ 'id' doit être un entier.";
    }

    // Validation du nom de sessionExercise
    if (empty(trim($data['name'] ?? ''))) {
        $errors[] = "Le champ 'name' est manquant.";
    }

    // Validation de la description de sessionExercise
    if (empty(trim($data['nbSeries'] ?? ''))) {
        $errors[] = "Le champ 'nbSeries' est manquant.";
    }
    if (empty(trim($data['nbReps'] ?? ''))) {
        $errors[] = "Le champ 'nbReps' est manquant.";
    }
    if (empty(trim($data['weight'] ?? ''))) {
        $errors[] = "Le champ 'weight' est manquant.";
    }
    if (empty(trim($data['id_session'] ?? ''))) {
        $errors[] = "Le champ 'id_session' est manquant.";
    }
    if (empty(trim($data['id_exercise'] ?? ''))) {
        $errors[] = "Le champ 'id_exercise' est manquant.";
    }
}
function findAllSessionExercise($pdo)
{
    $response = $pdo->prepare("SELECT * FROM sessionExercise");
    $response->execute();

    return $response->fetchAll();
}
function findSessionExerciseById(PDO $pdo, int $id): array
{
    $query = $pdo->prepare('SELECT * FROM sessionExercise WHERE id = :id');
    $query->execute([
        ":id" => $id
    ]);
    // Un seul resultat attendu fetch
    return $query->fetch();
}

function findSessionExerciseByName(PDO $pdo, string $name): array
{
    $query = $pdo->prepare('SELECT * FROM sessionExercise WHERE name = :name');
    $query->execute([
        ":name" => $name
    ]);
    return $query->fetchAll();
}



function insertSessionExercise($pdo, $sessionExercise)
{
    $response = $pdo->prepare(("INSERT INTO sessionExercise (name, description, execution) 
    VALUES (:name, :description, :execution)"));
    $response->execute(
        [
            ':name' => $sessionExercise["name"],
            ':nbSeries' => $sessionExercise["nbSeries"],
            ':nbReps' => $sessionExercise["nbReps"],
            ':weight' => $sessionExercise["weight"],
            ':id_session' => $sessionExercise["id_session"],
            "id_exercise"=> $sessionExercise["id_exercise"],
            ':id' => $sessionExercise["id"]
        ]

    );

    $response->fetch();
}
function updateSessionExercise(PDO $pdo, array $sessionExercise)
{


    // Préparer la requête
    $response = $pdo->prepare("UPDATE sessionExercise SET(name = :name, nbSeries = :nbSeries, nbReps = :nbReps, weight = :weight, id_session = :id_session, id_exercise = :id_exercise ) WHERE id = :id");

    // Exécution de la requête avec le tableau de paramètres
    $response->execute(
        [
            ':name' => $sessionExercise["name"],
            ':nbSeries' => $sessionExercise["nbSeries"],
            ':nbReps' => $sessionExercise["nbReps"],
            ':weight' => $sessionExercise["weight"],
            ':id_session' => $sessionExercise["id_session"],
            "id_exercise"=> $sessionExercise["id_exercise"],
            ':id' => $sessionExercise["id"]
        ]
    );

    return $response->fetch();
}
function deleteSessionExercise(PDO $pdo, int $id)
{

    $query = $pdo->prepare("DELETE FROM sessionExercise WHERE id = :id");

    $query->execute([
        ':id' => $id
    ]);

    return $query->fetch();
}
?>
