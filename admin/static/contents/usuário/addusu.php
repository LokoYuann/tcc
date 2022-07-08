<div id="main" class="container-fluid">
 	<div id="top" class="row">
		<div class="col-md-11">
			<h2>Adicionar Usuário</h2>
		</div>

	</div>
	<form enctype="multipart/form-data" action="?page=insere_usu" method="post">
		<!-- 1ª LINHA -->	
		<div class="row"> 
			<div class="form-group col-md-4">
				<label for="mat_func">Matricula do Funcionário</label>
				<input type="text" class="form-control" name="mat_func" readonly>
			</div>
			<div class="form-group col-md-4">
				<label for="usuario">Nome do Usuário</label>
				<input type="text" name="usuario" class="form-control" id="usuario">
			</div>
			<div class="form-group col-md-4">
				<label for="senha">Senha do Usuário</label>
				<input type="password" class="form-control" name="senha" id="senha">
			</div>
			
		</div>
		<!-- 2ª LINHA -->
		<div class="row">
			<div class="form-group col-md-4">
				<label for="nivel">Nível do usuário</label><br>
				<label class="radio-inline">
				<input  type="radio" name="nivel" value="2">Supervisão
				</label>
				<label class="radio-inline">
				<input  type="radio" name="nivel" value="3">Admnistraddor
				</label>
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
