<?php
    require('funcions.php');

    imprimir_index();

    if($_GET['funcio'] == 1) {
        mostrar_videojocs(carrega_fitxer('games.json'));
    } 
    if($_GET['funcio'] == 2) {
        $id_maxim = id_maxim(carrega_fitxer('games.json'));
        assigna_codi($id_maxim);
        mostrar_videojocs(carrega_fitxer('games.json'));
    }
    if($_GET['funcio'] == 3) {
        eliminar_videojocs();
        mostra_videojocs(carrega_fitxer('JSON_Resultat_Eliminar.json'));
    }
    if($_GET['funcio'] == 4) {
        data_expiracio();
        //mostra_videojocs(carrega_fitxer('JSON_Resultat_Data_Expiració.json'));
    }
?>