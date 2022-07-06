<?php
	//include "base\conexao.php";
	$id_ue = (int) $_GET['id_ue'];
	
	$sql = mysqli_query($con, "select * from ue where id_ue = '".$id_ue."';");
	$row = mysqli_fetch_array($sql);
?>
<div id="main" class="container-fluid">
	<br><h3 class="page-header">Editar registro da Instituição : <?php echo $id_ue;?></h3>

	<!-- Área de campos do formulário de edição-->

	<form action="?page=atualiza_ue&id_ue=<?php echo $row['id_ue']; ?>" method="post">

	<!-- 1ª LINHA -->	
	<div class="row"> 
		<div class="form-group col-md-2">
			<label for="id_ue">ID Instituição</label>
			<input type="text" class="form-control" name="id_ue" value="<?php echo $row["id_ue"];?>" readonly>
		</div>
		<div class="form-group col-md-7">
			<label for="nome_ue">Nome Instituição</label>
			<input type="text" name="nome_ue" class="form-control" id="nome_ue" value="<?php echo $row["nome_ue"];?>">
		</div>
		<div class="form-group col-md-3">
			<label for="logo_ue">Logo</label>
			<input type="file" class="form-control" name="logo_ue" value="<?php echo $row["logo_ue"];?>">
		</div>
	</div>

	<!-- 2ª LINHA -->
		<div class="row">
			<div class="form-group col-md-2">
				<label for="sigla_ue">Sigla Instituição</label>
				<input type="text" name="sigla_ue" class="form-control" id="sigla_ue" value="<?php echo $row["sigla_ue"];?>">
			</div>
			<div class="form-group col-md-4">
				<label for="email_ue">Email</label><br>
				<input type="text" name="email_ue" class="form-control" id="email_ue" value="<?php echo $row["email_ue"];?>">
			</div>
			<div class="form-group col-md-3 ">
				<label for="tel_ue">Telefone</label><br>
				<input type="text" name="tel_ue" id="tel_ue" class="form-control" style="width:100%" value="<?php echo $row["tel_ue"];?>">
			</div>
			<div class="form-group col-md-3 ">
				<label for="cep">CEP</label><br>
				<input type="text" name="cep" id="cep" class="form-control" style="width:100%" value="<?php echo $row["cep"];?>">
			</div>
		</div>

	<hr/>

		<div id="actions" class="row">
			<div class="col-md-12">
				<a href="?page=lista_ue" class="btn btn-secondary">Voltar</a>
				<button type="submit" class="btn btn-primary ">Salvar Alterações</button>
			</div>
		</div>
	</div>