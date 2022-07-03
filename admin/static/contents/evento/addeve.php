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
				<select class="form-control" name="id_calendario">
					<option> --------- </option>
					<option value="1">ETER</option>
					<option value="2">ETEVM</option>
					<option value="3">ETEOT</option>
					<option value="4">ETEMMMT</option>
				</select>
			</div>
			<div class="form-group col-md-2">
				<label for="id_leg">Tipo Evento</label>
				<select class="form-control" name="id_leg">
					<option> --------- </option>
					<option value="1">Avaliação</option>
					<option value="2">Teste</option>
					<option value="3">Feriado</option>
					<option value="4">Férias</option>
					<option value="5">Coc</option>
					<option value="6">Feira Técnica</option>
					<option value="7">Feira Literária</option>
					<option value="8">Feira de Ciências</option>
				</select>
			</div>
		</div>
		<!-- 2ª LINHA -->
		<div class="row">
			<div class="form-group col-md-3">
				<label for="dt_nasc">Data Início</label>
				<input type="date" class="form-control" name="dt_ini_ev">
			</div>
			<div class="form-group col-md-3">
				<label for="dt_nasc">Data Fim</label>
				<input type="date" class="form-control" name="dt_fim_ev">
			</div>
		</div>
		<hr />
		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="?page=home" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</form> 
</div>
