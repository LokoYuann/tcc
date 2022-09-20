<div id="main" class="container-fluid">
 	<div id="top" class="row">
		<div class="col-md-11">
			<h2>Adicionar Funcionário</h2>
		</div>

	</div>
	<form enctype="multipart/form-data" action="?page=insere_func" method="post">
		<!-- 1ª LINHA -->	
		<div class="row"> 
			<div class="form-group col-md-2">
				<label for="id_func">ID</label>
				<input type="text" class="form-control" name="id_func" readonly>
			</div>
			<div class="form-group col-md-2">
				<label for="mat_func">Matricula</label>
				<input type="text" class="form-control" name="mat_func" >
			</div>
			<div class="form-group col-md-4">
				<label for="funcao_func">Função do Funcionário</label>
				<input type="text" name="funcao_func" class="form-control" id="funcao_func">
			</div>
			<div class="form-group col-md-4">
				<label for="nome_func">Nome do Funcionário</label>
				<input type="text" class="form-control" name="nome_func" id="nome_func">
			</div>
			
		</div>
		<!-- 2ª LINHA -->
		<div class="row">
			<div class="form-group col-md-4">
				<label for="nasc_func">Data de nascimento do Funcionário</label>
				<input type="date" name="nasc_func" class="form-control" id="nasc_func">
			</div>
			<div class="form-group col-md-4">
				<label for="sexo_func">Sexo do Funcionário</label><br>
				<label class="radio-inline">
				<input  type="radio" name="sexo_func" value="m">Masculino
				</label>
				<label class="radio-inline">
				<input  type="radio" name="sexo_func" value="f">Feminino
				</label>
			</div>
			<div class="form-group col-md-4">
				<label for="tel_func">Telefone do Funcionário</label>
				<input type="text" name="tel_func" class="form-control" id="tel_func" placeholder="(00) 00000-0000">
			</div>
		</div>
		<!-- 3º linha -->
		<div class="row"> 
			<div class="form-group col-md-4">
				<label for="cpf_func">CPF do Funcionário</label>
				<input type="text" class="form-control" name="cpf_func" id="cpf__func" placeholder="000.000.000-00">
			</div>
			<div class="form-group col-md-4">
				<label for="cep">CEP do Funcionário</label>
				<input type="text" name="cep" class="form-control" id="cep">
			</div>
			<div class="form-group col-md-4">
				<label for="id_ue">Instituição do Funcionário</label>
				<select name="id_ue" id="" class="form-control">
					<?php
					for($i = 0;$i<sizeof($id_ue);$i++){
						echo "<option value='".$id_ue[$i]."'>".$inst[$i]."</option>";
					}
					?>
				</select>
			</div>
			
		</div>
		<hr />
		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="?page=lista_func" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</form> 
</div>
