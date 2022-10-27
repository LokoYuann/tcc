<?php
	//include "base\conexao.php";
	$id_evento = (int) $_GET['id_evento'];
	
	$sql = mysqli_query($con, "select * from eventos where id_evento = '".$id_evento."';");
	$row = mysqli_fetch_array($sql);
	$cal_sql = mysqli_query($con, "select id_ue from calendario where id_calendario = '".$row['id_calendario']."';");
	$cal = mysqli_fetch_array($cal_sql);
	$cal_inst_sql = mysqli_query($con, "select sigla_ue from ue where id_ue = '".$cal[0]."';");
	$cal_inst = mysqli_fetch_array($cal_inst_sql);
?>
<div id="main" class="container-fluid">

	<br><h3 class="page-header">Editar registro do Evento : <?php echo $id_evento;?></h3>

	<!-- Área de campos do formulário de edição-->

	<form action="?page=atualiza_eve&id_evento=<?php echo $row['id_evento']; ?>" method="post">

	<!-- 1ª LINHA -->	
	<div class="row"> 
		<div class="form-group col-md-2">
			<label for="id_evento">ID</label>
			<input type="text" class="form-control"  name="id_evento" value="<?php echo $row["id_evento"];?>" >
		</div>
		<div class="form-group col-md-2">
			<label for="id_evento"><strong>Calendário</strong></label>
			<select class="form-control " id="id_calendario" name="id_calendario" <?php if ($_SESSION['UsuarioNivel'] == 1)echo 'readonly="readonly" tabindex="-1" aria-disabled="true"' ?>>
				<option> --------- </option>
					<?php
					
					for($i = 0; $i < count($inst); $i++)
					{
					$cal_tmp_sql = mysqli_query($con, "select id_calendario from calendario where id_ue = '".$id_ue[$i]."';");
					$cal_tmp = mysqli_fetch_array($cal_tmp_sql);
					echo '<option value="'.$cal_tmp[0].'" '.((!(strcmp($cal_inst[0], $inst[$i])))?"SELECTED":"").'>'.$inst[$i].'</option>';
						
					}
															
					?>	

			</select>
		</div>
		<div class="form-group col-md-2">
			<label for="id_leg"><strong>Tipo de Evento</strong></label>
			<select class="form-control" id="id_leg" name="id_leg">
				<option> --------- </option>
					<?php
															
					for($i = 0; $i < count($tipo_evento); $i++)
					{
					echo '<option value="'.$id_leg[$i].'" '.((strcmp($i+1, $row['id_leg']))?"SELECTED":"").'>'.$tipo_evento[$i].'</option>';

					}
															
					?>	

			</select>

		</div>
	</div>
	<!-- 2ª LINHA -->
	<div class="row"> 
		<div class="form-group col-md-3">
			<label for="dt_ini_ev"><strong> Data de Início </strong></label>
			<input type="date" class="form-control" name="dt_ini_ev" value="<?php echo $row["dt_ini_ev"]; ?>">
		</div>

		<div class="form-group col-md-3">
			<label for="dt_fim_ev"><strong> Data de Fim </strong></label>
			<input type="date" class="form-control" name="dt_fim_ev" value="<?php echo $row["dt_fim_ev"]; ?>">
		</div>
	</div>

	<hr/>

		<div id="actions" class="row">
			<div class="col-md-12">
				<a href="?page=lista_eve" class="btn btn-secondary">Voltar</a>
				<button type="submit" class="btn btn-primary ">Salvar Alterações</button>
			</div>
		</div>
	</div>