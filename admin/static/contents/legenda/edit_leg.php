<?php
	//include "base\conexao.php";
	$id_leg = (int) $_GET['id_leg'];
	
	$sql = mysqli_query($con, "select * from legenda where id_leg = '".$id_leg."';");
	$row = mysqli_fetch_array($sql);
?>
<div id="main" class="container-fluid">
	<br><h3 class="page-header">Editar registro da legenda : <?php echo $id_leg;?></h3>

	<!-- Área de campos do formulário de edição-->

	<form action="?page=atualiza_leg&id_leg=<?php echo $row['id_leg']; ?>" method="post">

	<!-- 1ª LINHA -->	
	<div class="row"> 
		<div class="form-group col-md-3">
			<label for="id_leg">ID da Legenda</label>
			<input type="text" class="form-control" name="id_leg" value="<?php echo $row["id_leg"];?>" readonly>
		</div>
		<div class="form-group col-md-3">
			<label for="id_calendario">Tipo de Evento</label>
			<input type="text" name="tipo_evento" class="form-control" id="tipo_evento" value="<?php echo $row["tipo_evento"];?>">
		</div>
		<div class="form-group col-md-6">
			<label for="desc_leg">Descrição do evento</label>
			<input type="text" name="desc_leg" class="form-control" id="desc_leg" value="<?php echo $row["desc_leg"];?>">
		</div>
	</div>

	<!-- 2ª LINHA -->
	<div class="row"> 
		<div class="form-group col-md-4">
			<label for="simbolo_leg">Símbolo</label>
			<input type="text" class="form-control" name="simbolo_leg" value="<?php echo $row["simbolo_leg"];?>" readonly>
		</div>
		<div class="form-group col-md-4">
			<label for="sigla_leg">Sigla</label><br>
			<input type="text" name="sigla_leg" class="form-control" id="sigla_leg" value="<?php echo $row["sigla_leg"];?>">
		</div>
		<div class="form-group col-md-4">
			<label for="cor_leg">Cor</label><br>
			<input type="color" name="cor_leg" style="width:100%" id="cor_leg" value="<?php echo $row["cor_leg"];?>">
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