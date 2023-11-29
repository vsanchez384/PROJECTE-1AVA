<?php
function assignarCodiNumerat($videojocs) {
    $compte = 1;

    foreach ($videojocs as &$videojoc) {
        if (!isset($videojoc['codi'])) {
            $videojoc['codi'] = $compte;
            $compte++;
        }
    }

    return $videojocs;
}

$jsonString = file_get_contents('games.json');
$videojocs = json_decode($jsonString, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die('Error JSON: ' . json_last_error_msg());
}

$videojocsAmbCodi = assignarCodiNumerat($videojocs);

$json_rewrite = json_encode($videojocsAmbCodi, JSON_PRETTY_PRINT);
file_put_contents('games.json', $json_rewrite 	);

echo "Fitxer original actualitzat amb codis assignats.\n";
# print_r($videojocs);
?>