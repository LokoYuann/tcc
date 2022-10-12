<?php
	$sql = mysqli_query($con, "select * from funcionario where id_func = '".$_SESSION['UsuarioID']."';");
	$row = mysqli_fetch_array($sql);
    $instsql = mysqli_query($con, "select * from ue where id_ue = '".$row["id_ue"]."';");
    $instrow = mysqli_fetch_array($instsql);

    $fotosql = mysqli_query($con, "select * from usuarios where id_func = '".$_SESSION['UsuarioID']."';");
    $fotow = mysqli_fetch_array($fotosql)
?>



</strong></h1>
<hr>
<div id="bloco-list-pag">
<div id="main" class="container-fluid">
    <div class="table-all row row-cols-auto" style="padding:20px;"> 
                <div class="form-group col-md-6">
                    <header>
                    <h1 class="h3 mb-"> <strong>
                            <?php
                            switch($_SESSION['UsuarioNivel']){
                            case 1: echo "Você está como: supervisor";break;
                            case 2: echo "Você está como: administrador";break;
                            };
                            ?></strong>
                    </header>
                <img src="/admin/static/img/<?php if(!empty($fotow["foto"])){echo $fotow["foto"].".jpg";}else{echo "profile.webp";} ?> " alt="" style="max-width: 700px; max-height:500px;">
                <form action="?page=insere_perfil" method="post" enctype="multipart/form-data"><br>
                    <input type="file" name="foto" action="post" class="form-control" onchange='this.form.submit()';>
                </form>
                </div>
                <div class="form-group col-md-6">
                    Nome: <br>
                    <input type="text" value="<?php echo $row["nome_func"]; ?>" class="col-md-12 form-control" style="background-color:#ffffff00;" readonly> <br>
                    Funcão do funcionário: <br>
                    <input type="text" value="<?php echo $row["funcao_func"]; ?>" class="col-md-12 form-control" style="background-color:#ffffff00;" readonly><br>
                    Nome da Unidade de ensino: <br>
                    <input type="text" value="<?php echo $instrow["nome_ue"]; ?>" class="col-md-12 form-control" style="background-color:#ffffff00;" readonly>
                </div>

                    <div class="form-group col"></div>
                    <div class="form-group col">

                    </div>
                </div>
            </div>
        </div>