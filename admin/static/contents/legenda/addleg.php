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

			<div class="form-group col-md-2 d-flex flex-column align-items-center simbico" id="reactive" >
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
  					Escolher Símbolo
				</button>
			</div>
			
			<!-- Modal -->
			<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Símbolos</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close" >
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
						<div class="container-fluid">
						<div class="row d-flex justify-content-center ">
						<?php 
							foreach ($dir as $fileinfo) {
								if (!$fileinfo->isDot()) {
									echo '<label class="switch">
										<input  type="radio" name="simbolo_leg" value="'.$fileinfo.'">
										<span class="slider round" "><img src="/admin/static/img/simbolos/'.$fileinfo.'" class="simbico" alt=""></span>
									</label>';
								}
							}
						?>
						</div>
					</div>
						<div class="modal-footer d-flex justify-content-between">
						<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal2">
  							Novo Símbolo
						</button>
						<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="formreact(document.querySelector('input[name=simbolo_leg]:checked').value,'addleg')">Selecionar</button>
						</div>	
					</div>
				</div>
			</div>
		</div>
				<!-- Modal -->
				<!-- Modal Arquivo-->
				<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-body">
						<div class="container-fluid">
						<div class="form-group">
							<label for="tit_simb">Nome do Símbolo</label>
							<input type="text" class="form-control" name="tit_simb" placeholder="">
						</div>
						<div class="row d-flex">
							<div class="form-group ">
								<label for="local_simb">Escolher Arquivo</label>
								<input type="file" class="form-control " name="local_simb" onchange="sla(this.value)">
							</div>
						</div>
					</div>
						<div class="modal-footer d-flex justify-content-between">
						<button type="button" class="btn btn-danger" data-dismiss="modal" >Cancelar</button>
						<button type="submit" class="btn btn-primary">Salvar</button>
						</div>	
					</div>
				</div>
			</div>
		</div>
							<!-- Modal Arquivo-->

			
		
		<hr />
		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="?page=lista_leg" class="btn btn-secondary">Cancelar</a>
				
			</div>
		</div>
	</form> 
</div>