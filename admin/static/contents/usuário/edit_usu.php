<?php
	//include "base\conexao.php";
	$id_func = (int) $_GET['id_func'];
	
	$sql = mysqli_query($con, "select * from usuarios where id_func = '".$id_func."';");
	$row = mysqli_fetch_array($sql);
?>
<div id="main" class="titulo container-fluid">
 	<div id="top" class="row">
		<div class="td-titulo col-md-11">
			<h2 class="page-header">Editar registro de Usuário : <?php echo $id_func;?></h2>
		</div>
	</div>
	<hr>
	<br>

	<!-- Área de campos do formulário de edição-->

	<form action="?page=atualiza_usu&id_func=<?php echo $row['id_func']; ?>" method="post">

	<!-- 1ª LINHA -->	
	<div class="row"> 
		<div class="form-group col-md-4">
			<label class="font-info" for="id_func">ID do Funcionário</label>
			<input type="text" class="form-control" name="id_func" value="<?php echo $row["id_func"];?>" readonly>
		</div>
		<div class="form-group col-md-4">
			<label class="font-info" for="usuario">Nome do Usuário</label>
			<input type="text" name="usuario" class="form-control" id="usuario" value="<?php echo $row["usuario"];?>">
		</div>
		<div class="form-group col-md-4">
			<label class="font-info" for="senha">Senha do Usuário</label>
			<input type="password" class="form-control" name="senha" value="<?php echo $row["senha"];?>">
		</div>
	</div>

	<!-- 2ª LINHA  -->
		<div class="row">
			<div class="form-group col-md-4">
				<label class="font-info" for="nivel">Nível do usuário</label><br>
				<label class="font-info" class="radio-inline">
				<input  type="radio" name="nivel" value="2" <?php if($row["nivel"]==1){echo "checked";}else{}?>  >Supervisão
				</label>
				<label class="font-info" class="radio-inline">
				<input  type="radio" name="nivel" value="3" <?php if($row["nivel"]==2){echo "checked";}else{}?>  >Admnistraddor
				</label>
			</div>
		</div>

	<hr/>

		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary ">Salvar Alterações</button>
				<a href="?page=lista_usu" class="btn btn-secondary">Voltar</a>
			</div>
		</div>
	</div>