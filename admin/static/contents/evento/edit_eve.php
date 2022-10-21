<?php
	//include "base\conexao.php";
	$id_evento = (int) $_GET['id_evento'];
	
	$sql = mysqli_query($con, "select * from ".(($_GET['status'] != 'edit')? 'eventos':'tmp_eve')." where id_evento = '".$id_evento."';");
	$row = mysqli_fetch_array($sql);
	$cal_sql = mysqli_query($con, "select id_ue from calendario where id_calendario = '".$row['id_calendario']."';");
	$cal = mysqli_fetch_array($cal_sql);
	$cal_inst_sql = mysqli_query($con, "select sigla_ue from ue where id_ue = '".$cal[0]."';");
	$cal_inst = mysqli_fetch_array($cal_inst_sql);

	if($_SESSION['UsuarioNivel'] == 2){
		$id_cal = mysqli_query($con, "select id_calendario from calendario  ORDER BY id_calendario ASC") or die(mysqli_error());}
	else{
		$id_cal = mysqli_query($con, "select id_calendario from calendario where id_ue = '".$func_inst[0]."' ORDER BY id_calendario ASC") or die(mysqli_error());}
	


	$ids = array();
	while($row_id = mysqli_fetch_array($id_cal))
	{
		$ids[] = $row_id['id_calendario'];
	}
?>
<div id="main" class="titulo container-fluid">
	<div id="top" class="row">
		<div class="titulo-pos col-md-5">
			<br><h2 class="td-titulo">Editar registro do Evento : <?php echo $id_evento;?></h2>
		</div>
	</div>
	<hr>
	<br>
	<form action="?page=atualiza_eve&id_evento=<?php echo $row['id_evento']; ?>" method="post">

	<!-- 1ª LINHA -->	
	<div class="row"> 
		<input type="hidden" name="status" class="form-control" value="<?php echo $_GET['id_evento'];?>" readonly>
		<div class="form-group col-md-3">
			<label class="font-info" for="id_evento">ID Evento</label>
			<input type="text" class="form-control"  name="id_evento" value="<?php echo $id_evento;?>" readonly>
		</div>
		
		<div class="form-group col-md-2">
				<label for="id_calendario">UE</label>
				<?php
				if ($_SESSION['UsuarioNivel'] == 1){
					echo '<input type="hidden" class="form-control readonly" name="id_calendario" value="'.$func_inst[0].'" readonly>';
					echo '<input type="text" class="form-control readonly" name="" value="'.$func_inst_sigla[0].'" readonly>';
				}
				else{
				?>
				
					<select class="form-control " id="" name="" onchange='formreact(this.value,"addeve")'>
							<?php
							echo "<option value='none'>Todas</option>";
							for($i = 0; $i < count($inst); $i++)
							{
							echo '<option value="'.$id_ue[$i].'" '.((!(strcmp($func_inst[0], $id_ue[$i]))&&$_SESSION['UsuarioNivel'] == 1)?"SELECTED":"").'>'.$inst[$i].'</option>';
								
							}
																	
							?>	

					</select>
				<?php } ?>
			</div>

			<div class="form-group col-md-2">
				<label for="id_calendario">Calendário</label>
				<select class="form-control " id="reactive" name="id_calendario" >
				<?php 
					for($i = 0; $i < count($ids); $i++)
					{
						
						echo '<option value="'.$ids[$i].'">'.$ids[$i].'</option>';
						

					}
				?>
				</select>
			</div>

		<div class="form-group col-md-2">
			<label for="id_leg">Tipo de Evento</label>
			<select class="form-control" id="id_leg" name="id_leg">
				<option> --------- </option>
					<?php
															
					for($i = 0; $i < count($tipo_evento); $i++)
					{
					echo '<option value="'.$id_leg[$i].'" '.((!(strcmp($i+1, $row['id_leg'])))?"SELECTED":"").'>'.$tipo_evento[$i].'</option>';

					}
															
					?>	

			</select>

		</div>
	</div>
	<!-- 2ª LINHA -->
	<div class="row"> 
		<div class="form-group col-md-3">
			<label class="font-info" for="dt_ini_ev"> Data de Início </label>
			<input type="date" class="form-control" name="dt_ini_ev" value="<?php echo $row[1]; ?>">
		</div>

		<div class="form-group col-md-3">
			<label class="font-info" for="dt_fim_ev"> Data de Fim </label>
			<input type="date" class="form-control" name="dt_fim_ev" value="<?php echo $row[2]; ?>">
		</div>
	</div>


		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary ">Salvar Alterações</button>
				<a href="?page=lista_eve" class="btn btn-secondary">Voltar</a>
			</div>
		</div>
	</div>