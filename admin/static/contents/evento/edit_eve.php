<?php
	//include "base\conexao.php";
	$id_evento = (int) $_GET['id_evento'];
	
	$sql = mysqli_query($con, "select * from eventos where id_evento = '".$id_evento."';");
	$row = mysqli_fetch_array($sql);
?>
<div id="main" class="container-fluid">
	<br><h3 class="page-header">Editar registro do Evento : <?php echo $id_evento;?></h3>

	<!-- Área de campos do formulário de edição-->

	<form action="?page=atualiza_eve&id_evento=<?php echo $row['id_evento']; ?>" method="post">

	<!-- 1ª LINHA -->	
	<div class="row"> 
		<div class="form-group col-md-2">
			<label for="id_evento">ID</label>
			<input type="text" class="form-control" readonly name="id_evento" value="<?php echo $row["id_evento"];?>">
		</div>
		<div class="form-group col-md-2">
			<label for="id_evento">Calendário</label>
			<select class="form-control" id="id_calendario" name="id_calendario">
				<option value="1"<?php if (!(strcmp(1, htmlentities($row['id_calendario'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>ETER</option>
				<option value="2"<?php if (!(strcmp(2, htmlentities($row['id_calendario'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>ETEVM</option>
				<option value="3"<?php if (!(strcmp(3, htmlentities($row['id_calendario'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>ETEOT</option>		
				<option value="4"<?php if (!(strcmp(3, htmlentities($row['id_calendario'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>ETEMMMT</option>		

			</select>
		</div>
		<div class="form-group col-md-2">
			<label for="id_leg">Tipo de Evento</label>
			<select class="form-control" id="id_leg" name="id_leg">
				<option value="1"<?php if (!(strcmp(1, htmlentities($row['id_leg'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Avaliação</option>
				<option value="2"<?php if (!(strcmp(2, htmlentities($row['id_leg'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Teste</option>
				<option value="3"<?php if (!(strcmp(3, htmlentities($row['id_leg'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Feriado</option>		
				<option value="4"<?php if (!(strcmp(3, htmlentities($row['id_leg'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Coc</option>			

			</select>

		</div>
	</div>

	<!-- 2ª LINHA -->
	<div class="row"> 
		<div class="form-group col-md-3">
			<label for="dt_ini_ev"> Data de Início </label>
			<input type="date" class="form-control" name="dt_ini_ev" value="<?php echo $row["dt_ini_ev"]; ?>">
		</div>

		<div class="form-group col-md-3">
			<label for="dt_fim_ev"> Data de Fim </label>
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