﻿<?php
	//include "base\conexao.php";
	$mat_func = (int) $_GET['mat_func'];
	
	$sql = mysqli_query($con, "select * from funcionario where mat_func = '".$mat_func."';");
	$row = mysqli_fetch_array($sql);
?>
<div id="main" class="container-fluid">
	<br><h3 class="page-header">Editar registro de Funcionário : <?php echo $mat_func;?></h3>

	<!-- Área de campos do formulário de edição-->

	<div class="row"> 
			<div class="form-group col-md-4">
				<label for="mat_func">Matricula do Funcionário</label>
				<input type="text" class="form-control" name="mat_func" value="<?php echo $row["mat_func"];?>" readonly>
			</div>
			<div class="form-group col-md-4">
				<label for="funcao_func">Função do Funcionário</label>
				<input type="text" name="funcao_func" class="form-control" value="<?php echo $row["funcao_func"];?>" id="funcao_func" readonly>
			</div>
			<div class="form-group col-md-4">
				<label for="nome_func">Nome do Funcionário</label>
				<input type="text" class="form-control" name="nome_func" value="<?php echo $row["nome_func"];?>" id="nome_func" readonly>
			</div>
			
		</div>
		<!-- 2ª LINHA -->
		<div class="row">
			<div class="form-group col-md-4">
				<label for="nasc_func">Data de nascimento do Funcionário</label>
				<input type="date" name="nasc_func" class="form-control" id="nasc_func" value="<?php echo $row["nasc_func"];?>" readonly>
			</div>
			<div class="form-group col-md-4">
				<label for="sexo_func">Sexo do Funcionário</label><br>
				<label class="radio-inline">
				<input  type="radio" name="sexo_func" value="m" <?php if($row["sexo_func"]=='m'){echo "checked";}else{}?> disabled>Masculino
				</label>
				<label class="radio-inline">
				<input  type="radio" name="sexo_func" value="f" <?php if($row["sexo_func"]=='f'){echo "checked";}else{}?> disabled>Feminino
				</label>
			</div>
			<div class="form-group col-md-4">
				<label for="tel_func">Telefone do Funcionário</label>
				<input type="text" name="tel_func" class="form-control" id="tel_func" value="<?php echo $row["tel_func"];?>" readonly>
			</div>
		</div>
		<!-- 3º linha -->
		<div class="row"> 
			<div class="form-group col-md-4">
				<label for="cpf_func">CPF do Funcionário</label>
				<input type="text" class="form-control" name="cpf_func" id="cpf__func" value="<?php echo $row["cpf_func"];?>" readonly>
			</div>
			<div class="form-group col-md-4">
				<label for="cep">CEP do Funcionário</label>
				<input type="text" name="cep" class="form-control" id="cep" value="<?php echo $row["cep"];?>" readonly>
			</div>
			<div class="form-group col-md-4">
				<label for="id_ue">Instituição do Funcionário</label>
				<input type="text" class="form-control" name="id_ue" id="id_ue" value="<?php echo $row["id_ue"];?>" readonly>
			</div>
			
		</div>
	<hr/>

		<div id="actions" class="row">
		<div class="col-md-12">
			<a href="?page=lista_func" class="btn btn-default">Voltar</a>
				<?php echo "<a href=?page=edit_func&mat_func=".$row['mat_func']." class='btn btn-primary'>Editar</a>";?>
				<?php echo "<a href=?page=excluir_func&mat_func=".$row['mat_func']." class='btn btn-danger'>Excluir</a>";?>
		</div>
		</div>
	</div>