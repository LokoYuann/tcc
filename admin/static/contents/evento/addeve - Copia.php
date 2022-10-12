<div id="main" class="container-fluid">
 	<div id="top" class="row">
		<div class="col-md-11">
			<h2>Adicionar Evento</h2>
		</div>

	</div>
	<form action="?page=insere_eve" method="post">
		<!-- 1ª LINHA -->	
		<div class="row"> 
			<div class="form-group col-md-2">
				<label for="id_evento">ID Evento</label>
				<input type="text" class="form-control" name="id_evento" readonly>
			</div>
			<div class="form-group col-md-2">
				<label for="id_calendario">Calendário</label>
				<?php
				if ($_SESSION['UsuarioNivel'] == 1){
					$cal_tmp_sql = mysqli_query($con, "select id_calendario from calendario where id_ue = '".$func_inst[0]."';");
					$cal_tmp = mysqli_fetch_array($cal_tmp_sql);
					echo '<input type="text" class="form-control readonly" name="'.$cal_tmp[0].'" value="'.$func_inst_sigla[0].'" readonly>';

				}
				else{
				?>
				
			<select class="form-control " id="id_calendario" name="id_calendario" required>
				<option> --------- </option>
					<?php
					
					for($i = 0; $i < count($inst); $i++)
					{
					$cal_tmp_sql = mysqli_query($con, "select id_calendario from calendario where id_ue = '".$id_ue[$i]."';");
					$cal_tmp = mysqli_fetch_array($cal_tmp_sql);
					echo '<option value="'.$cal_tmp[0].'" '.((!(strcmp($func_inst[0], $id_ue[$i]))&&$_SESSION['UsuarioNivel'] == 1)?"SELECTED":"").'>'.$inst[$i].'</option>';
						
					}
															
					?>	

			</select>
			<?php } ?>
			</div>
			<div class="form-group col-md-2">
				<label for="id_leg">Tipo Evento</label>
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
				<label for="dt_nasc">Data Início</label>
				<input type="date" class="form-control" name="dt_ini_ev" required>
			</div>
			<div class="form-group col-md-3">
				<label for="dt_nasc">Data Fim</label>
				<input type="date" class="form-control" name="dt_fim_ev" required>
			</div>
		</div>
		<hr />
		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="?page=lista_eve" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</form> 
</div>
