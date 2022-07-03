<?php
	$id_evento = (int) $_GET['id_evento'];
	
	$sql = mysqli_query($con, "select * from eventos where id_evento = '".$id_evento."';");
	$row = mysqli_fetch_array($sql);
	
?>
<div id="main" class="container-fluid">
	<h3 class="page-header">Visualizar registro do Evento - <?php echo $id_evento; ?> </h3>
	<div class="row">
		<div class="form-group col-md-2">
			<label for="id_evento">ID</label>
			<input type="text" class="form-control" name="id_evento" value="<?php echo $row["id_evento"];?>" readonly>
		</div>
		<div class="form-group col-md-2">
			<label for="id_calendario">Calendário</label>
			<input type="text" class="form-control" name="id_calendario" value="<?php echo $row["id_calendario"];?>" readonly>
		</div>
		<div class="form-group col-md-2">
			<label for="id_leg">Tipo de Evento</label>
			<input type="text" class="form-control" name="id_leg" value="<?php echo $row["id_leg"];?>" readonly>
		</div>
	</div>
	<div class="row">
	<div class="form-group col-md-2">
			<label for="dt_ini_ev">Data de Início</label>
			<input type="text" class="form-control" name="dt_ini_ev" value="<?php echo $row["dt_ini_ev"];?>" readonly>
		</div>
		<div class="form-group col-md-2">
			<label for="dt_fim_ev">Data de Fim</label>
			<input type="text" class="form-control" name="dt_fim_ev" value="<?php echo $row["dt_fim_ev"];?>" readonly>
		</div>
	</div>
	<hr/>
	<div id="actions" class="row">
		<div class="col-md-12">
			<a href="?page=lista_eve" class="btn btn-default">Voltar</a>
				<?php echo "<a href=?page=edit_eve&id_evento=".$row['id_evento']." class='btn btn-primary'>Editar</a>";?>
				<?php echo "<a href=?page=excluir_eve&id_evento=".$row['id_evento']." class='btn btn-danger'>Excluir</a>";?>
		</div>
	</div>
</div>
