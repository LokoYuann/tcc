<?php
    if(isset($_GET['page'])){
        switch ($_GET['page']) {

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
            
            case 'addue':
                include "contents/instituição/addue.php";
                break;

            case 'edit_ue':
                include "contents/instituição/edit_ue.php";
                break;

            case 'lista_ue':
                 include "contents/instituição/lista_ue.php";
                break;

            case 'atualiza_ue':
                include "contents/instituição/atualiza_ue.php";
                break;
            
            case 'excluir_ue':
                include "contents/instituição/excluir_ue.php";
                break;

            case 'view_ue':
                include "contents/instituição/view_ue.php";
                break;

            case 'insere_ue':
                include "contents/instituição/insere_ue.php";
                break;

            //  legenda

            case 'addleg':
                include "contents/legenda/addleg.php";
                break;

            case 'edit_leg':
                include "contents/legenda/edit_leg.php";
                break;

            case 'lista_leg':
                 include "contents/legenda/lista_leg.php";
                break;

            case 'atualiza_leg':
                include "contents/legenda/atualiza_leg.php";
                break;
            
            case 'excluir_leg':
                include "contents/legenda/excluir_leg.php";
                break;

            case 'view_leg':
                include "contents/legenda/view_leg.php";
                break;

            case 'insere_leg':
                include "contents/legenda/insere_leg.php";
                break;
            
            // usuários
            
            case 'addusu':
                include "contents/usuário/addusu.php";
                break;

            case 'edit_usu':
                include "contents/usuário/edit_usu.php";
                break;

            case 'lista_usu':
                 include "contents/usuário/lista_usu.php";
                break;

            case 'atualiza_usu':
                include "contents/usuário/atualiza_usu.php";
                break;
            
            case 'excluir_usu':
                include "contents/usuário/excluir_usu.php";
                break;

            case 'view_usu':
                include "contents/usuário/view_usu.php";
                break;

            case 'insere_usu':
                include "contents/usuário/insere_usu.php";
                break;

                            
            // Funcionários
            
            case 'addfunc':
                include "contents/funcionario/addfunc.php";
                break;

            case 'edit_func':
                include "contents/funcionario/edit_func.php";
                break;

            case 'lista_func':
                 include "contents/funcionario/lista_func.php";
                break;

            case 'atualiza_func':
                include "contents/funcionario/atualiza_func.php";
                break;
            
            case 'excluir_func':
                include "contents/funcionario/excluir_func.php";
                break;

            case 'view_func':
                include "contents/funcionario/view_func.php";
                break;

            case 'insere_func':
                include "contents/funcionario/insere_func.php";
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