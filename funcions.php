<?php

function mostrar_index()
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
        die('Error JSON: ' . json_last_error_msg());
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

function assigna_codi($id_maxim)
{
    $jsonString = file_get_contents('games.json');
    $arrayAsociatiu = json_decode($jsonString, true);

    foreach ($arrayAsociatiu as &$columna) {
        if (!isset($columna['ID'])) {
            $id_maxim++;
            $columna['ID'] = $id_maxim;
        }
    }

    $newJsonString = json_encode(array_values($arrayAsociatiu), JSON_PRETTY_PRINT | JSON_INVALID_UTF8_IGNORE);
    file_put_contents('games.json', $newJsonString);
}

function eliminar_videojocs()
{
    $jsonString = file_get_contents('games.json');
    $arrayAsociatiu = json_decode($jsonString, true);

    $nuevosJuegos = array();
    foreach ($arrayAsociatiu as $columna) {
        if (!empty($columna['ID'])) {
            $nuevosJuegos[$columna['ID']] = $columna;
        }
    }

    // Ordenar por ID
    ksort($nuevosJuegos);

    // Eliminar videojuegos
    foreach ($nuevosJuegos as $key => $columna) {
        if ($columna['Plataforma'] == 'PC' && $columna['Llançament'] < '2019-01-01') {
            unset($nuevosJuegos[$key]);
        }
    }

    $newJsonString = json_encode(array_values($nuevosJuegos), JSON_PRETTY_PRINT | JSON_INVALID_UTF8_IGNORE);
    file_put_contents('games.json', $newJsonString);
}

function data_expiracio()
{
    $jsonString = file_get_contents('games.json');
    $arrayAsociatiu = json_decode($jsonString, true);

    foreach ($arrayAsociatiu as &$columna) {
        $data_expiracio = date('Y-m-d', strtotime($columna['Llançament'] . ' + 5 years'));
        $columna['Data expiracio'] = $data_expiracio;
    }

    $newJsonString = json_encode($arrayAsociatiu, JSON_PRETTY_PRINT | JSON_INVALID_UTF8_IGNORE);
    file_put_contents('JSON_Resultat_Data_Expiració.json', $newJsonString);
}
?>
