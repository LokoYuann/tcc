<div id="main" class="container-fluid">
 	<div id="top" class="row">
		<div class="col-md-11">
			<h2>Adicionar Legenda</h2>
		</div>

	</div>
	<form enctype="multipart/form-data" action="?page=insere_leg" method="post">
		<!-- 1ª LINHA -->	
		<div class="row"> 
			<div class="form-group col-md-2">
				<label for="id_leg">ID Legenda</label>
				<input type="text" class="form-control" name="id_leg" readonly>
			</div>
			<div class="form-group col-md-2">
				<label for="id_calendario">Tipo Evento</label>
				<input type="text" name="tipo_evento" class="form-control" id="tipo_evento">
			</div>
			<div class="form-group col-md-6">
				<label for="desc_leg">Descrição evento</label>
				<input type="textbox" name="desc_leg" class="form-control" id="desc_leg">
			</div>
			<div class="form-group col-md-2">
				<label for="sigla_leg">Sigla</label><br>
				<input type="text" name="sigla_leg" class="form-control" id="sigla_leg">
			</div>
		</div>
		<!-- 2ª LINHA -->
		<div class="row">
			<div class="form-group col-md-3 ">
				<label for="cor_leg">Cor</label><br>
				<input type="color" name="cor_leg" id="cor_leg" style="width:100%"	>
			</div>	

			<div class="form-group col-md-2">
				<br>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
  					Escolher Símbolo
				</button>
			</div>
			<!-- Modal -->
			<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Escolha o símbolo</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close" >
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
						<div class="container-fluid">
						<div class="row">
							<input class="col-md-1" type="radio" name="simbolo_leg" value="fa-home"><i class="fa fa-home"></i>
							<input class="col-md-1" type="radio" name="simbolo_leg" value="fa-house"><i class="fa fa-book"></i>
							<input class="col-md-1" type="radio" name="simbolo_leg" value="fa-glass"><i class="fa fa-glass"></i>
							<input class="col-md-1" type="radio" name="simbolo_leg" value="fa-home"><i class="fa fa-home"></i>
							<input class="col-md-1" type="radio" name="simbolo_leg" value="fa-home"><i class="fa fa-home"></i>
						</div>
					</div>
						<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Selecionar</button>
						</div>	
					</div>
				</div>
			</div>
				<!-- Modal -->
			
			
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

