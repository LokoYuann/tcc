<?php
    if(isset($_POST['tipo'])){
        switch ($_POST['tipo']) {

            // eventos

            case 'addeve':
                include "contents/evento/addeve.php";
                break;

            case 'edit_eve':
                include "contents/evento/edit_eve.php";
                break;

            case 'lista_eve':
                 include "contents/evento/lista_eve.php";
                break;

            case 'atualiza_eve':
                include "contents/evento/atualiza_eve.php";
                break;
            
            case 'excluir_eve':
                include "contents/evento/excluir_eve.php";
                break;

            case 'view_eve':
                include "contents/evento/view_eve.php";
                break;

            case 'insere_eve':
                include "contents/evento/insere_eve.php";
                break;

            // instituição
            
            case 'addinst':
                include "contents/instituição/addinst.php";
                break;
        
            case 'editinst':
                include "contents/instituição/editinst.php";
                break;

            // home

            case 'perfil':
                include "contents/perfil.php";
                break;

            case 'home':
                include "contents/home.php";
                break;

            case 'index':
                include "index.php";
                break;
                    
                    



            // include "contents/home.php";
            // break;
    }
}
?>