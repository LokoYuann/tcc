<?php
	//include "base\conexao.php";
	$mat_func = (int) $_GET['mat_func'];
	
	$sql = mysqli_query($con, "select * from usuarios where mat_func = '".$mat_func."';");
	$row = mysqli_fetch_array($sql);
?>
<div id="main" class="container-fluid">
	<br><h3 class="page-header">Editar registro de Usuário : <?php echo $mat_func;?></h3>

	<!-- Área de campos do formulário de edição-->

	<!-- 1ª LINHA -->	
	<div class="row"> 
		<div class="form-group col-md-4">
			<label for="mat_func">Matricula do Funcionário</label>
			<input type="text" class="form-control" name="mat_func" value="<?php echo $row["mat_func"];?>" readonly>
		</div>
		<div class="form-group col-md-4">
			<label for="usuario">Nome do Usuário</label>
			<input type="text" name="usuario" class="form-control" id="usuario" value="<?php echo $row["usuario"];?>" readonly>
		</div>
		<div class="form-group col-md-4">
			<label for="senha">Senha do Usuário</label>
			<input type="password" class="form-control" name="senha" value="<?php echo $row["senha"];?>" readonly>
		</div>
	</div>

	<!-- 2ª LINHA  -->
		<div class="row">
			<div class="form-group col-md-4">
				<label for="nivel">Nível do usuário</label><br>
				<label class="radio-inline">
				<input  type="radio" name="nivel" value="2" <?php if($row["nivel"]==1){echo "checked";}else{}?>  disabled>Supervisão
				</label>
				<label class="radio-inline">
				<input  type="radio" name="nivel" value="3" <?php if($row["nivel"]==2){echo "checked";}else{}?> disabled >Admnistraddor
				</label>
			</div>
		</div>

	<hr/>

		<div id="actions" class="row">
		<div class="col-md-12">
			<a href="?page=lista_usu" class="btn btn-default">Voltar</a>
				<?php echo "<a href=?page=edit_lusu&mat_func=".$row['mat_func']." class='btn btn-primary'>Editar</a>";?>
				<?php echo "<a href=?page=excluir_usu&mat_func=".$row['mat_func']." class='btn btn-danger'>Excluir</a>";?>
		</div>
		</div>
	</div>