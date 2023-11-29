<?php

function imprimir_index()
{
    echo '<link rel="stylesheet" href="style.css">';
    echo "<h1>PROJECTE 1A AVALUACIÓ</h1>
    <h2>Víctor / Pau</h2>";

    echo "<a href='projecte.php'>Index</a>";
    echo "<a href='projecte.php?funcio=1'>Funcio 1</a>";
    echo "<a href='projecte.php?funcio=2'>Funcio 2</a>";
    echo "<a href='projecte.php?funcio=3'>Funcio 3</a>";
    echo "<a href='projecte.php?funcio=4'>Funcio 4</a>";
}
function carrega_fitxer($fitxer)
{
    $jsonString = file_get_contents($fitxer);

    $arrayAsociatiu = json_decode($jsonString, true);

    // Verifica si hay errores durante la decodificación
    if (json_last_error() !== JSON_ERROR_NONE) {
        die('Error  JSON: ' . json_last_error_msg());
    }
    return $arrayAsociatiu;
}

function mostra_videojocs($videojocs)
{
    echo "<table border='black'>";
    echo "<th>ID</th><th>Nom</th><th>Desenvolupador</th><th>Plataforma</th><th>Llançament</th>";
    foreach ($videojocs as $videojoc) {
        echo "<tr>";
        foreach ($videojoc as $valor) {
            echo "<td>$valor</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
}

function mostrar_videojocs($videojocs)
{
    echo "<table border='black'>";

    // Imprimir la taula
    echo "<tr>";
    foreach (array_keys($videojocs[0]) as $header) {
        echo "<th>$header</th>";
    }
    echo "</tr>";

    // Contingut de la taula
    foreach ($videojocs as $videojoc) {
        echo "<tr>";
        foreach ($videojoc as $valor) {
            echo "<td>$valor</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
}

// id_maxim troba el codi mes gran al fitxer json i l'emmagtzema. L'utilitzarem a assignae_codi per començar a assignar codis a partir d'aquest.
function id_maxim($videojocs)
{
    $id_maxim = 0;
    $id = 0;
    foreach ($videojocs as $valor) {
        if ($valor["ID"] != 0) {
            $id = $valor["ID"];
            if ($id > $id_maxim) {
                $id_maxim = $id;
            }
        }
    }
    return $id_maxim;
}


//Queda arreglar que escrigui el nom de la columna 'ID: ' seguit del nou codi. Ara per ara imprimeix '0: ' i el nou codi.
function assigna_codi($id_maxim)
{
    $jsonString = file_get_contents('games.json');
    $arrayAsociatiu = json_decode($jsonString, true);
    foreach ($arrayAsociatiu as $columna => $valor) {
        if (!$arrayAsociatiu[$columna]['ID']) {
            $id_maxim++;
            array_unshift($arrayAsociatiu[$columna], $id_maxim);
            $newJsonString = json_encode($arrayAsociatiu, JSON_PRETTY_PRINT, JSON_INVALID_UTF8_IGNORE);
            file_put_contents('games.json', $newJsonString);
        }
    }
}


function eliminar_videojocs()
{
    $date1 = "2017-03-02";
    $date2 = "2017-03-04";

    $jsonString = file_get_contents('games.json');
    $arrayAsociatiu = json_decode($jsonString, true);

    foreach ($arrayAsociatiu as $columna => $valor) {
        if ($arrayAsociatiu[$columna]["Llançament"] > $date1 && $arrayAsociatiu[$columna]["Llançament"] < $date2) {
            unset($arrayAsociatiu[$columna]);
            $newJsonString = json_encode($arrayAsociatiu, JSON_PRETTY_PRINT);
            file_put_contents("JSON_Resultat_Eliminar.json", $newJsonString);
        }
    }
}

//NO afegeix els registres al json pero l'array esta modificat de forma correcta
function data_expiracio()
{
    $jsonString = file_get_contents('games.json');
    $arrayAsociatiu = json_decode($jsonString, true);

    foreach ($arrayAsociatiu as $columna => $valor) {
        $data_expiracio = date('Y-m-d', strtotime($valor['Llançament'] . ' + 5 years'));
        $array_expiracio = array('Data expiracio' => $data_expiracio);
        $arrayAsociatiu = array_merge($valor, $array_expiracio);
        print_r ($arrayAsociatiu);
        echo "<br>";  
        $newJsonString = json_encode($arrayAsociatiu, JSON_PRETTY_PRINT);
        file_put_contents('JSON_Resultat_Data_Expiració.json', $newJsonString);   
    }
}
?>