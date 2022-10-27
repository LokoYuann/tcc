<?php
	if($_SESSION['UsuarioNivel'] == 2){
		$id_cal = mysqli_query($con, "select id_calendario from calendario  ORDER BY id_calendario ASC") or die(mysqli_error());}
	else{
		$id_cal = mysqli_query($con, "select id_calendario from calendario where id_ue = '".$func_inst[0]."' ORDER BY id_calendario ASC") or die(mysqli_error());}
	


	$ids = array();
	while($row = mysqli_fetch_array($id_cal))
	{
		$ids[] = $row['id_calendario'];
	}
?>
<div id="main" class="titulo container-fluid">
 	<div id="top" class="row">
		<div class="td-titulo col-md-11">
			<h2>Adicionar Evento</h2>
			<hr>
			</div>
	<br>

	</div>
	<form action="?page=insere_eve" method="post">
		<!-- 1ª LINHA -->	
		<div class="row"> 
			<div class="form-group col-md-2">
				<label for="id_evento">ID Evento</label>
				<input type="text" class="form-control" name="id_evento" readonly>
			</div>
			
			<div class="form-group col-md-2">
				<label for="id_calendario"><strong>UE</strong></label>
				<?php
				if ($_SESSION['UsuarioNivel'] == 1){
					echo '<input type="hidden" class="form-control readonly" name="id_calendario" value="'.$func_inst[0].'" readonly>';
					echo '<input type="text" class="form-control readonly" name="" value="'.$func_inst_sigla[0].'" readonly required>';
				}
				else{
				?>
				
					<select class="form-control " id="" name="" onchange='formreact(this.value,"addeve")' required>
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
				<label for="id_calendario"><strong>Calendário</strong></label>
				<select class="form-control " id="reactive" name="id_calendario" required>
				<?php 
					for($i = 0; $i < count($ids); $i++)
					{
						
						echo '<option value="'.$ids[$i].'">'.$ids[$i].'</option>';
						

					}
				?>
				</select>
			</div>

			<div class="form-group col-md-2">
				<label for="id_leg"><strong>Tipo Evento</strong></label>
			<select class="form-control" id="id_leg" name="id_leg" required>
				<option> --------- </option>
					<?php
															
					for($i = 0; $i < count($tipo_evento); $i++)
					{
					echo '<option value="'.$id_leg[$i].'" >'.$tipo_evento[$i].'</option>';

					}
															
					?>	

			</select>
			</div>
		</div>
		<!-- 2ª LINHA -->
		<div class="row">
			<div class="form-group col-md-3">
				<label for="dt_nasc"><strong>Data Início</strong></label>
				<input type="date" class="form-control" name="dt_ini_ev" required>
			</div>
			<div class="form-group col-md-3">
				<label for="dt_nasc"><strong>Data Fim</strong></label>
				<input type="date" class="form-control" name="dt_fim_ev" required>
			</div>
		</div>
		<br>
		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="?page=lista_eve" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</form> 
</div>
