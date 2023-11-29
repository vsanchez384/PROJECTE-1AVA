<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 1 IAW</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php
require('funcions.php');

mostrar_index();

if (isset($_GET['funcio'])) {
    if ($_GET['funcio'] == 1) {
        mostrar_videojocs(carrega_fitxer('games.json'));
    } elseif ($_GET['funcio'] == 2) {
        $id_maxim = id_maxim(carrega_fitxer('games.json'));
        assigna_codi($id_maxim);
        mostrar_videojocs(carrega_fitxer('games.json'));
    } elseif ($_GET['funcio'] == 3) {
        eliminar_videojocs();
        mostrar_videojocs(carrega_fitxer('JSON_Resultat_Eliminar.json'));
    } elseif ($_GET['funcio'] == 4) {
        data_expiracio();
        mostrar_videojocs(carrega_fitxer('JSON_Resultat_Data_Expiració.json'));
    }
}
?>
</body>

</html>