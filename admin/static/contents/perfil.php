<?php
	$sql = mysqli_query($con, "select * from funcionario where id_func = '".$_SESSION['UsuarioID']."';");
	$row = mysqli_fetch_array($sql);
    $instsql = mysqli_query($con, "select * from ue where id_ue = '".$row["id_ue"]."';");
    $instrow = mysqli_fetch_array($instsql);

    $fotosql = mysqli_query($con, "select * from usuarios where id_func = '".$_SESSION['UsuarioID']."';");
    $fotow = mysqli_fetch_array($fotosql)
?>



</strong></h1>

<div id="main" class="container-fluid">
    <div class="row row-cols-auto" row-cols-auto> 
                <div class="form-group col-md-4">
                <img src="/admin/static/img/<?php if(!empty($fotow["foto"])){echo $fotow["foto"].".jpg";}else{echo "profile.webp";} ?> " alt="" style="max-width: 700px; max-height:500px;">
                <form action="?page=insere_perfil" method="post" enctype="multipart/form-data">
                    <input type="file" name="foto" action="post" class="form-control" onchange='this.form.submit()';>
                </form>
                </div>
                <div class="form-group col">

                    </div>
                    <div class="form-group col">
                        <?php echo $row["nome_func"]; ?>
                    </div>
                    <div class="form-group col">
                        <?php echo $row["funcao_func"]; ?>
                    </div>
                    <div class="form-group col">
                        <?php echo $instrow["nome_ue"]; ?>
                    </div>

                    <div class="form-group col"></div>
                    <div class="form-group col">
                                    <h1 class="h3 mb-3"> <strong>
                            <?php
                            switch($_SESSION['UsuarioNivel']){
                            case 1: echo "Você está como: supervisor";break;
                            case 2: echo "Você está como: administrador";break;
                            };
                            ?>
                    </div>
                </div>
            </div>