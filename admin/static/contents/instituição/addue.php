<div id="main" class="titulo container-fluid">
 	<div id="top" class="row">
		<div class="td-titulo col-md-5">
			<h2 >Adicionar Instituição</h2>
		</div>
	</div>
	<hr>
	<br>
	<form enctype="multipart/form-data" action="?page=insere_ue" method="post">
		<!-- 1ª LINHA -->	
		<div class="row"> 
			<div class="form-group col-md-2">
				<label class="font-info" for="id_ue">ID Instituição</label>
				<input type="text" class="form-control" name="id_ue" readonly>
			</div>
			<div class="form-group col-md-7">
				<label class="font-info" for="nome_ue">Nome Instituição</label>
				<input type="text" name="nome_ue" class="form-control" id="nome_ue">
			</div>
			<div class="form-group col-md-3">
				<label class="font-info" for="logo_ue">Logo</label>
				<input type="file" class="form-control" name="logo_ue">
			</div>
			
		</div>
		<!-- 2ª LINHA -->
		<div class="row">
			<div class="form-group col-md-2">
				<label class="font-info" for="sigla_ue">Sigla Instituição</label>
				<input type="text" name="sigla_ue" class="form-control" id="sigla_ue">
			</div>
			<div class="form-group col-md-4">
				<label class="font-info" for="email_ue">Email</label><br>
				<input type="text" name="email_ue" class="form-control" id="email_ue">
			</div>
			<div class="form-group col-md-3 ">
				<label class="font-info" for="tel_ue">Telefone</label><br>
				<input type="text" name="tel_ue" id="tel_ue" class="form-control" style="width:100%">
			</div>
			<div class="form-group col-md-3 ">
				<label class="font-info" for="cep">CEP</label><br>
				<input type="text" name="cep" id="cep" class="form-control" style="width:100%">
			</div>
		</div>
		<hr />
		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="?page=lista_ue" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</form> 
</div>
