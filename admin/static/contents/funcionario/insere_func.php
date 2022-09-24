<?php
//insere informações da localidade do funcionário
    $cep_tmp = str_replace("-", "", $_POST["cep"]);
  
    $json = file_get_contents('https://viacep.com.br/ws/'. $cep_tmp . '/json/');

    $jsonToArray = json_decode($json);
    $uf = $jsonToArray->uf;
    $cidade = $jsonToArray->localidade;
    $bairro = $jsonToArray->bairro;
    $log = $jsonToArray->logradouro;
    $comp = $jsonToArray->complemento;
    
    $cep            = str_replace("-", "", $_POST["cep"]);
    $num = $_POST['numero'];

    $sql = "insert into localidade values ";
    $sql .= "('$cep','$uf','$cidade','$bairro','$log','$num','$comp');";
    $resultado_loc = mysqli_query($con, $sql)or die(mysqli_error());


//insere informações do funcionário
    $id_func      = $_POST["id_func"];
    $mat_func      = $_POST["mat_func"];
    $funcao_func   = $_POST["funcao_func"];
    $nome_func     = $_POST["nome_func"];
    $nasc_func     = $_POST["nasc_func"];
    $sexo_func     = $_POST["sexo_func"];
    $tel_func      = $_POST["tel_func"];
    $cpf_func      = $_POST["cpf_func"];
    
    $id_ue         = $_POST["id_ue"];

   $sql = "insert into funcionario values ";
    $sql .= "('0','$mat_func','$funcao_func','$nome_func','$nasc_func','$sexo_func','$tel_func','$cpf_func','$cep','$id_ue');";
    $resultado_func = mysqli_query($con, $sql)or die(mysqli_error());

    if($resultado_loc&&$resultado_func){
        header('Location: dash.php?page=lista_func&msg=1');
        mysqli_close($con);
    }else{
        header('Location: dash.php?page=lista_func&msg=4');
        mysqli_close($con);
    }
?>