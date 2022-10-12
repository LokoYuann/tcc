<?php
	if($_SESSION['UsuarioNivel'] == 1){
		header('Location: ?page=home');
	}
	$id_ue = (int) $_GET['id_ue'];
	$sql = mysqli_query($con, "select * from ue where id_ue = '".$id_ue."';");
	$row = mysqli_fetch_array($sql);
	$num = mysqli_query($con, "select numero from localidade where cep = ".$row["cep"].";");
	
?>
<div id="main" class="titulo container-fluid">
 	<div id="top" class="row">
		<div class="td-titulo col-md-11">
		<h2 class="page-header">Visualizar registro da Legenda - <?php echo $id_ue; ?> </h2>
		</div>
	</div>
	<hr>
	<br>
	
	
	
	<!-- 1ª LINHA -->	
	<div class="row"> 
		<div class="form-group col-md-2">
			<label class="font-info" for="id_ue">ID Instituição</label>
			<input type="text" class="form-control" name="id_ue" value="<?php echo $row["id_ue"];?>" readonly>
		</div>
		<div class="form-group col-md-4">
			<label class="font-info" for="nome_ue">Nome Instituição</label><br>
			<input type="text" name="nome_ue" class="form-control" id="nome_ue" value="<?php echo $row["nome_ue"];?>" readonly>
		</div>
		<div class="form-group col-md-3">
			<label class="font-info" for="sigla_ue">Sigla Instituição</label>
			<input type="text" name="sigla_ue" class="form-control" id="sigla_ue" value="<?php echo $row["sigla_ue"];?>" readonly>
		</div>
		<div class="form-group col-md-3">
			<label class="font-info" for="logo_ue">Logo</label>
			<img src='<?php echo $row["logo_ue"];?>' style='width:70px'>
		</div>
	</div>

	<!-- 2ª LINHA -->
	<div class="row">
		
		<div class="form-group col-md-4">
			<label class="font-info" for="email_ue">Email</label><br>
			<input type="text" name="email_ue" class="form-control" id="email_ue" value="<?php echo $row["email_ue"];?>" readonly>
		</div>
		<div class="form-group col-md-3 ">
			<label class="font-info" for="tel_ue">Telefone</label><br>
			<input type="text" name="tel_ue" id="tel_ue" class="form-control" style="width:100%" value="<?php echo $row["tel_ue"];?>" readonly>
		</div>
		<div class="form-group col-md-3 ">
			<label class="font-info" for="cep">CEP</label><br>
			<input type="text" name="cep" id="cep" class="form-control" style="width:100%" value="<?php echo $row["cep"];?>" readonly>
		</div>
		<div class="form-group col-md-2">
				<label class="font-info" for="numero">Número</label>
				<input type="text" name="numero" class="form-control" id="numero" value="<?php echo mysqli_fetch_array($num)[0];?>" readonly>
		</div>
	</div>


	<hr/>
	<div id="actions" class="row">
		<div class="col-md-12">
			<a href="?page=lista_ue" class="btn btn-default">Voltar</a>
				<?php echo "<a href=?page=edit_ue&id_ue=".$row['id_ue']." class='btn btn-primary'>Editar</a>";?>
				<?php echo "<a href=?page=excluir_ue&id_ue=".$row['id_ue']." class='btn btn-danger'>Excluir</a>";?>
		</div>
	</div>
</div>
