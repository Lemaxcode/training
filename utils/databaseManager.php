<?php

function connectDB(): PDO
{

    try {

        $host = "localhost";
        $databaseName = "pokedexpe9";
        $user = "root";
        $password = "";

        $pdo = new PDO("mysql:host=" . $host . ";port=3306;dbname=" . $databaseName . ";charset=utf8", $user, $password);

        configPdo($pdo);

        return $pdo;
    } catch (Exception $e) {

        //Lancer l'erreur
        //throw $e;

        echo ("Erreur à la connexion: " .  $e->getMessage());

        exit();
    }
}
?>
// function configPdo(PDO $pdo): void
// {
//     // Recevoir les erreurs PDO ( coté SQL )
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     // Choisir les indices dans les fetchs
//     $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
// }

// function findAllPokemons(PDO $pdo): array
// {
//     $reponse = $pdo->query('SELECT * FROM pokemon LIMIT 50 OFFSET 1');
//     // Plusieurs resultat fetchAll
//     return $reponse->fetchAll();
// }


// function findPokemonById(PDO $pdo, int $id): array
// {
//     $query = $pdo->prepare('SELECT * FROM pokemon WHERE id = :id');
//     $query->execute([
//         ":id" => $id
//     ]);
//     // Un seul resultat attendu fetch
//     return $query->fetch();
// }

// function findPokemonByName(PDO $pdo, string $name): array
// {
//     $query = $pdo->prepare('SELECT * FROM pokemon WHERE name = :name');
//     $query->execute([
//         ":name" => $name
//     ]);
//     return $query->fetchAll();
// }

// function getUserByUsername(PDO $pdo,string $username){
//         // Recuperer User avec les memes identifiants
//         $response = $pdo->prepare("SELECT username, password FROM utilisateur WHERE username = :username");
//         $response->execute([
//             ":username" => $username
//         ]);

//         return $response->fetch();
// }


// function insertPokemon(PDO $pdo,array $pokemon){
    

// // Préparer la requête
// $response = $pdo->prepare("INSERT INTO pokemon (pokedexId, nameFr, nameJp, generation, category, image, imageShiny, height, weight, catchRate) 
// VALUES (:pokedexId, :nameFr, :nameJp, :generation, :category, :image, :imageShiny, :height, :weight, :catchRate)");

// // Exécution de la requête avec le tableau de paramètres
// $response->execute([
//     ':pokedexId' => $pokemon["pokedexId"],
//     ':nameFr' => $pokemon["nameFr"],
//     ':nameJp' => $pokemon["nameJp"],
//     ':generation' => $pokemon["generation"],
//     ':category' => $pokemon["category"],
//     ':image' => $pokemon["image"],
//     ':imageShiny' => $pokemon["imageShiny"],
//     ':height' => $pokemon["height"],
//     ':weight' => $pokemon["weight"],
//     ':catchRate' => $pokemon["catchRate"]
//     ]
// );

//     return $response->fetch();
// }