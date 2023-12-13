<?php

// Funció per mostrar l'índex
function mostrar_index()
{
    echo "<h1>PROJECTE 1ª AVALUACIÓ</h1>
    <h2>Víctor / Pau</h2>";
    echo "<a href='index.php'>Index</a>";
    echo "<a href='projecte.php?funcio=1'>Funcio 1</a>";
    echo "<a href='projecte.php?funcio=2'>Funcio 2</a>";
    echo "<a href='projecte.php?funcio=3'>Funcio 3</a>";
    echo "<a href='projecte.php?funcio=4'>Funcio 4</a>";
    echo "<a href='projecte.php?funcio=5'>Funcio 5</a>";
    echo "<a href='projecte.php?funcio=6'>Funcio 6</a>";
    echo "<a href='projecte.php?funcio=7'>Funcio 7</a>";
    echo "<a href='projecte.php?funcio=8'>Funcio 8</a>";
    echo "<a href='projecte.php?funcio=9'>Funcio 9</a>";
    echo "<a href='projecte.php?funcio=10'>Funcio 10</a>";
}

// Carrega de fitxer JSON
function carrega_fitxer($fitxer)
{
    $jsonString = file_get_contents($fitxer);

    $arrayAssociatiu = json_decode($jsonString, true);

    // Verifica si hi ha errors en la decodificació JSON
    if (json_last_error() !== JSON_ERROR_NONE) {
        die('Error JSON: ' . json_last_error_msg());
    }
    return $arrayAssociatiu;
}

// Mostra la taula de videojocs
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

// Funcionalitat 1: mostra de videojocs
function mostrar_videojocs($videojocs)
{
    echo "<table border='black'>";

    // Imprimir la taula d'encapçalament
    echo "<tr>";
    foreach (array_keys($videojocs[0]) as $header) {
        echo "<th>$header</th>";
    }
    echo "</tr>";

    // Imprimir el contingut de la taula
    foreach ($videojocs as $videojoc) {
        echo "<tr>";
        foreach ($videojoc as $valor) {
            echo "<td>$valor</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
}

// Funcionalitat 2: obtenir l'ID màxim
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

// Funcionalitat 2: assignar codi
function assigna_codi($id_maxim)
{
    $jsonString = file_get_contents('games.json');
    $arrayAssociatiu = json_decode($jsonString, true);

    foreach ($arrayAssociatiu as &$columna) {
        if (!isset($columna['ID'])) {
            $id_maxim++;
            $columna = ['ID' => $id_maxim] + $columna;
        }
    }

    $newJsonString = json_encode(array_values($arrayAssociatiu), JSON_PRETTY_PRINT | JSON_INVALID_UTF8_IGNORE);
    file_put_contents('games.json', $newJsonString);
}

// Funcionalitat 3: eliminar videojocs
function eliminar_videojocs()
{
    $jsonString = file_get_contents('games.json');

    // Verificar si es pot llegir el fitxer correctament
    if ($jsonString === false) {
        die('Error: No s\'ha pogut llegir el fitxer games.json.');
    }

    $arrayAssociatiu = json_decode($jsonString, true);

    // Verificar si la decodificació JSON ha estat exitosa
    if (json_last_error() !== JSON_ERROR_NONE) {
        die('Error JSON en el fitxer games.json: ' . json_last_error_msg());
    }

    $nousJocs = array();
    foreach ($arrayAssociatiu as $columna) {
        if (!empty($columna['ID'])) {
            $nousJocs[$columna['ID']] = $columna;
        }
    }

    // Ordenar per ID
    ksort($nousJocs);

    // Eliminar videojocs
    foreach ($nousJocs as $key => $columna) {
        if ($columna['Plataforma'] == 'PC' && $columna['Llançament'] < '2019-01-01') {
            unset($nousJocs[$key]);
        }
    }

    $newJsonString = json_encode(array_values($nousJocs), JSON_PRETTY_PRINT | JSON_INVALID_UTF8_IGNORE);

    // Verificar si es pot sobreescriure el JSON
    if ($newJsonString === false) {
        die('Error: No s\'ha pogut escriure en el fitxer JSON_Resultat_Eliminar.json.');
    }

    file_put_contents('JSON_Resultat_Eliminar.json', $newJsonString);
}

// Funcionalitat 4: Afegir data d'expiració
function data_expiracio()
{
    $jsonString = file_get_contents('games.json');
    $arrayAssociatiu = json_decode($jsonString, true);

    foreach ($arrayAssociatiu as &$columna) {
        $data_expiracio = date('Y-m-d', strtotime($columna['Llançament'] . ' + 5 years'));
        $columna['Data expiracio'] = $data_expiracio;
    }

    $newJsonString = json_encode($arrayAssociatiu, JSON_PRETTY_PRINT | JSON_INVALID_UTF8_IGNORE);
    file_put_contents('JSON_Resultat_Data_Expiració.json', $newJsonString);
}

// Funcionalitat 5: Comprovar duplicats
function comprovar_repetits($videojocs, $campDuplicats) {
    $vistos = [];

    foreach ($videojocs as $videojoc) {
        $valorCamp = $videojoc[$campDuplicats];

        if (in_array($valorCamp, $vistos)) {
            return 1;  
        }

        $vistos[] = $valorCamp;
    }

    return 0; 
}

// Funcionalitat 6: Comprovar duplicats ampliada
function comprovarDuplicatsAmpliada($videojocs, $campDuplicats) {
    $vistos = [];

    foreach ($videojocs as $videojoc) {
        $valorCamp = $videojoc[$campDuplicats];

        if (isset($vistos[$valorCamp])) {
            echo "Hi ha registres repetits pel camp $campDuplicats: $valorCamp.\n";
        }

        $vistos[$valorCamp] = true;
    }

    echo "No hi ha registres repetits pel camp $campDuplicats.\n";
}

// Funcionalitat 7: Eliminar duplicats
function eliminarDuplicats($videojocs) {
    $repetits = [];

    foreach ($videojocs as $videojoc) {
        $id = $videojoc['ID'];

        if (isset($repetits[$id])) {
            unset($repetits[$id]);
        } else {
            $repetits[$id] = $videojoc;
        }
    }

    $newJsonString = json_encode(array_values($repetits), JSON_PRETTY_PRINT | JSON_INVALID_UTF8_IGNORE);
    file_put_contents('JSON_Resultat_Eliminar_Duplicats.json', $newJsonString);
}

// Funcionalitat 8: Videojoc més modern i més antic
function videojoc_mes_modern_i_mes_antic($videojocs) {
    echo "<table border='1'>";
    echo "<tr><th>Videojoc més modern</th></tr>";
    echo "<tr><td>";
    echo "<table>";
    echo "<tr><th>Nom</th><th>Desenvolupador</th><th>Plataforma</th><th>Llançament</th></tr>";
    $videojoc_mes_modern = $videojocs[0];
    foreach ($videojocs as $videojoc) {
        if ($videojoc['Llançament'] > $videojoc_mes_modern['Llançament']) {
            $videojoc_mes_modern = $videojoc;
        }
    }
    echo "<tr>";
    echo "<td>".$videojoc_mes_modern['Nom']."</td>";
    echo "<td>".$videojoc_mes_modern['Desenvolupador']."</td>";
    echo "<td>".$videojoc_mes_modern['Plataforma']."</td>";
    echo "<td>".$videojoc_mes_modern['Llançament']."</td>";
    echo "</tr>";
    echo "</table>";
    echo "</td></tr>";

    echo "<tr><th>Videojoc més antic</th></tr>";
    echo "<tr><td>";
    echo "<table>";
    echo "<tr><th>Nom</th><th>Desenvolupador</th><th>Plataforma</th><th>Llançament</th></tr>";
    $videojoc_mes_antic = $videojocs[0];
    foreach ($videojocs as $videojoc) {
        if ($videojoc['Llançament'] < $videojoc_mes_antic['Llançament']) {
            $videojoc_mes_antic = $videojoc;
        }
    }
    echo "<tr>";
    echo "<td>".$videojoc_mes_antic['Nom']."</td>";
    echo "<td>".$videojoc_mes_antic['Desenvolupador']."</td>";
    echo "<td>".$videojoc_mes_antic['Plataforma']."</td>";
    echo "<td>".$videojoc_mes_antic['Llançament']."</td>";
    echo "</tr>";
    echo "</table>";
    echo "</td></tr>";
    echo "</table>";
}

// Funcionalitat 9: Ordenació alfabètica de videojocs
function ordenacioAlfabetica($videojocs) {
    usort($videojocs, function ($a, $b) {
        return $a['Nom'] <=> $b['Nom'];
    });

    echo "<table border='1'>";
    echo "<tr><th>Videojocs ordenats alfabèticament</th></tr>";
    echo "<tr><td>";
    echo "<table>";
    echo "<tr><th>Nom</th><th>Desenvolupador</th><th>Plataforma</th><th>Llançament</th></tr>";
    foreach ($videojocs as $videojoc) {
        echo "<tr>";
        echo "<td>".$videojoc['Nom']."</td>";
        echo "<td>".$videojoc['Desenvolupador']."</td>";
        echo "<td>".$videojoc['Plataforma']."</td>";
        echo "<td>".$videojoc['Llançament']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</td></tr>";
    echo "</table>";
}

// Funcionalitat 10: Comptar videojocs per any
function comptar_videojocs_per_any($videojocs) { 
    $anys = array(); 
    foreach ($videojocs as $videojoc) { 
        $llancament = $videojoc['Llançament']; 
        $any = date('Y', strtotime($llancament)); 
        if (isset($anys[$any])) { 
            $anys[$any]++; 
        } else { 
            $anys[$any] = 1; 
        } 
    } 

    // Ordenar l'array per any de forma ascendent
    ksort($anys);

    echo "<table border='1'>"; 
    echo "<tr><th>Any</th><th>Nombre de videojocs</th></tr>"; 
    foreach ($anys as $any => $nombre_videojocs) { 
        echo "<tr>"; 
        echo "<td>".$any."</td>"; 
        echo "<td>".$nombre_videojocs."</td>"; 
        echo "</tr>"; 
    } 
    echo "</table>"; 
}

?>
