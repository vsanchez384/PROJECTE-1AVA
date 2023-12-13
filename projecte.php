<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 1 PHP</title>
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
    } elseif ($_GET['funcio'] == 5) {
        comprovar_repetits(carrega_fitxer('games.json'), 'ID');
        mostrar_videojocs(carrega_fitxer('games.json'));
    } elseif ($_GET['funcio'] == 6) {
        comprovarDuplicatsAmpliada(carrega_fitxer('games.json'), 'ID');
        mostrar_videojocs(carrega_fitxer('games.json'));
    } elseif ($_GET['funcio'] == 7) {
        eliminarDuplicats(carrega_fitxer('games.json'));
        mostrar_videojocs(carrega_fitxer('JSON_Resultat_Eliminar_Duplicats.json'));
    } elseif ($_GET['funcio'] == 8) {
        videojoc_mes_modern_i_mes_antic(carrega_fitxer('games.json'));
    } elseif ($_GET['funcio'] == 9) {
        ordenacioAlfabetica(carrega_fitxer('games.json'));
    } elseif ($_GET['funcio'] == 10) {
        comprovarDuplicatsAmpliada(carrega_fitxer('games.json'), 'ID');
        comprovarDuplicatsAmpliada(carrega_fitxer('games.json'), 'Nom');
        comprovarDuplicatsAmpliada(carrega_fitxer('games.json'), 'Desenvolupador');
        comprovarDuplicatsAmpliada(carrega_fitxer('games.json'), 'Plataforma');
        comprovarDuplicatsAmpliada(carrega_fitxer('games.json'), 'Llançament');
    }
}
?>
</body>

</html>
