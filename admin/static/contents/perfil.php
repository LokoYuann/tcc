
<?php
	$sql = mysqli_query($con, "select * from funcionario where id_func = '".$_SESSION['UsuarioID']."';");
	$row = mysqli_fetch_array($sql);
    $instsql = mysqli_query($con, "select * from ue where id_ue = '".$row["id_ue"]."';");
    $instrow = mysqli_fetch_array($instsql);
?>



</strong></h1>

<div id="bloco-list-pag">
<div id="main" class="container-fluid">
    <div class="table-all row row-cols-auto" style="padding:20px;"> 
                <div class="form-group col-md-6">
                   
                    <br>
                <img class="imagem-perfil" src="/admin/static/img/perfil/<?php if(!empty($fotow["foto"])){echo $fotow["foto"].".jpg";}else{echo "profile.webp";} ?> " alt="" style="max-width:100%;">
                <form action="?page=insere_perfil" method="post" enctype="multipart/form-data"><br>
                    <div class="form-group col-md-9">
                    <input type="file" name="foto" action="post" class="form-control" onchange='this.form.submit()';>
                        </div>
                </form>
                </div>
                <div class="perfil-alo form-group col-md-6">
                   
                    <strong>Nome: <br>
                    <input type="text" value="<?php echo $row["nome_func"]; ?>" class="td-info col-md-11 form-control" style="background-color:#ffffff00;" readonly> <br>
                    Funcão do funcionário: <br>
                    <input type="text" value="<?php echo $row["funcao_func"]; ?>" class="td-info col-md-11 form-control" style="background-color:#ffffff00;" readonly><br>
                    Nome da Unidade de ensino: <br>
                    <input type="text" value="<?php echo $instrow["nome_ue"]; ?>" class="td-info col-md-11 form-control" style="background-color:#ffffff00;" readonly><br>
                    Nível:
                    <input type="text" value="<?php
                            switch($_SESSION['UsuarioNivel']){
                            case 1: echo "supervisor";break;
                            case 2: echo "administrador";break;
                            };
                            ?>"class="td-info col-md-11 form-control" style="background-color:#ffffff00;" readonly>

                </div>
                </strong>
                    <div class="form-group col"></div>
                    <div class="form-group col">

                    </div>
                </div>
            </div>
        </div>