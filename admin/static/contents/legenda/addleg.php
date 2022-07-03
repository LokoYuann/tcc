<div id="main" class="container-fluid">
 	<div id="top" class="row">
		<div class="col-md-11">
			<h2>Adicionar Legenda</h2>
		</div>

	</div>
	<form enctype="multipart/form-data" action="?page=insere_leg" method="post">
		<!-- 1ª LINHA -->	
		<div class="row"> 
			<div class="form-group col-md-3">
				<label for="id_leg">ID Legenda</label>
				<input type="text" class="form-control" name="id_leg" readonly>
			</div>
			<div class="form-group col-md-3">
				<label for="id_calendario">Tipo Evento</label>
				<input type="text" name="tipo_evento" class="form-control" id="tipo_evento">
			</div>
			<div class="form-group col-md-6">
				<label for="desc_leg">Descrição evento</label>
				<input type="textbox" name="desc_leg" class="form-control" id="desc_leg">
			</div>
		</div>
		<!-- 2ª LINHA -->
		<div class="row">
			<div class="form-group col-md-6">
				<label for="simbolo_leg">Símbolo</label>
				<input type="file" class="form-control" name="simbolo_leg">
			</div>
			<div class="form-group col-md-4">
				<label for="sigla_leg">Sigla</label><br>
				<input type="text" name="sigla_leg" class="form-control" id="sigla_leg">
			</div>
			<div class="form-group col-md-2 ">
				<label for="cor_leg">Cor</label><br>
				<input type="color" name="cor_leg" id="cor_leg" style="width:100%"	>
			</div>
		</div>
		<hr />
		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="?page=lista_leg" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</form> 
</div>
