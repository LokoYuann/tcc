<?php
	$id_evento = (int) $_GET['id_evento'];
	
	$sql = mysqli_query($con, "select * from ".(($_GET['status'] != 'edit')? 'eventos':'tmp_eve')." where id_evento = '".$id_evento."';");
	$row = mysqli_fetch_array($sql);
	$a_sql = mysqli_query($con, "select id_ue from calendario where id_calendario = '".$row["id_calendario"]."';");
	$inst_cal_sql =mysqli_query($con, "select sigla_ue from ue where id_ue = '".mysqli_fetch_array($a_sql)[0]."';");


?>
<div id="main" class="titulo container-fluid">
 	<div id="top" class="row">
		<div class="titulo-pos col-md-5">
			<h2 class="td-titulo">Visualizar registro do Evento - <?php echo $id_evento; ?> </h2>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="form-group col-md-3">
			<label class="font-info" for="id_evento">ID</label>
			<input type="text" class="form-control" name="id_evento" value="<?php echo $row["id_evento"];?>" readonly>
		</div>
		<div class="form-group col-md-2">
			<label class="font-info" for="id_ue">UE</label>
			<input type="text" class="form-control" name="id_ue" value="<?php echo mysqli_fetch_array($inst_cal_sql)[0];?>" readonly>
		</div>
		<div class="form-group col-md-2">
			<label class="font-info" for="id_calendario">Calendário</label>
			<input type="text" class="form-control" name="id_calendario" value="<?php echo $row["id_calendario"];?>" readonly>
		</div>
		<div class="form-group col-md-2">
			<label class="font-info" for="id_leg">Tipo de Evento</label>
			<input type="text" class="form-control" name="id_leg" value="<?php echo $row["id_leg"];?>" readonly>
		</div>
	</div>
	<div class="row">
	<div class="form-group col-md-3">
			<label class="font-info" for="dt_ini_ev">Data de Início</label>
			<input type="text" class="form-control" name="dt_ini_ev" value="<?php echo $row[1];?>" readonly>
		</div>
		<div class="form-group col-md-3">
			<label class="font-info" for="dt_fim_ev">Data de Fim</label>
			<input type="text" class="form-control" name="dt_fim_ev" value="<?php echo $row[2];?>" readonly>
		</div>
	</div>
	<hr/>
	<div id="actions" class="row">
		<div class="col-md-12">
			<a href="?page=lista_eve" class="btn btn-default">Voltar</a>
				<?php 
				echo "<a href=?page=edit_eve&id_evento=".$row['id_evento']."&status=".$_GET['status']." class='btn btn-primary'>Editar</a>";
				if($_GET['status'] == 'active'){
					echo "<a href=?page=excluir_eve&id_evento=".$row['id_evento']."&status=active class='btn btn-danger'>Excluir</a>";
				}else{
					echo "<a href=?page=excluir_eve&id_evento=".$row['id_evento']."&status=".$_GET['status']." class='btn btn-danger'>Cancelar Edição</a>";}
				?>
		</div>
	</div>
</div>
