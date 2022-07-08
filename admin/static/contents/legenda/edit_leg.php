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
		<div class="form-group col-md-2">
			<label for="id_leg">ID da Legenda</label>
			<input type="text" class="form-control" name="id_leg" value="<?php echo $row["id_leg"];?>" readonly>
		</div>
		<div class="form-group col-md-2">
			<label for="id_calendario">Tipo de Evento</label>
			<input type="text" name="tipo_evento" class="form-control" id="tipo_evento" value="<?php echo $row["tipo_evento"];?>">
		</div>
		<div class="form-group col-md-6">
			<label for="desc_leg">Descrição do evento</label>
			<input type="text" name="desc_leg" class="form-control" id="desc_leg" value="<?php echo $row["desc_leg"];?>">
		</div>
		<div class="form-group col-md-2">
			<label for="sigla_leg">Sigla</label><br>
			<input type="text" name="sigla_leg" class="form-control" id="sigla_leg" value="<?php echo $row["sigla_leg"];?>">
		</div>
	</div>

	<!-- 2ª LINHA -->
	<div class="row"> 
		<div class="form-group col-md-3">
			<label for="cor_leg">Cor</label><br>
			<input type="color" name="cor_leg" style="width:100%" id="cor_leg" value="<?php echo $row["cor_leg"];?>">
		</div>
			<div class="form-group col-md-2">
				<br>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
  					Escolher Símbolo
				</button>
			</div>
	</div>

	<hr/>

		<div id="actions" class="row">
			<div class="col-md-12">
				<a href="?page=lista_leg" class="btn btn-secondary">Voltar</a>
				<button type="submit" class="btn btn-primary ">Salvar Alterações</button>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Símbolos</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close" >
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
						<div class="container-fluid">
						<div class="row">
						<label class="switch">
							<input  type="radio" name="simbolo_leg" value="fa-home">
							<span class="slider round"><i class="fa fa-home" style="font-size:190%;"></i></span>
						</label>
						<label class="switch" >
							<input  type="radio" name="simbolo_leg" value="fa-glass" >
							<span class="slider round"><i class="fa fa-glass" style="font-size:160%;"></i></span>
						</label>
						<label class="switch" >
							<input  type="radio" name="simbolo_leg" value="fa-book" >
							<span class="slider round"><i class="fa fa-book" style="font-size:160%;"></i></span>
						</label>
							<!-- <input  type="radio" name="simbolo_leg" value="fa-home" class="col-md-1 "><i class="fa fa-home"></i>
							<input  type="radio" name="simbolo_leg" value="fa-book" class="col-md-1"><i class="fa fa-book"></i>
							<input  type="radio" name="simbolo_leg" value="fa-glass" class="col-md-1"><i class="fa fa-glass"></i>
							<input  type="radio" name="simbolo_leg" value="fa-home" class="col-md-1"><i class="fa fa-home"></i>
							<input  type="radio" name="simbolo_leg" value="fa-home" class="col-md-1"><i class="fa fa-home"></i> -->
							<!-- <button type="button" class="btn col-md-1 legbutton" value="fa-home"><i class="fa fa-home"></i></button>
                            <button type="button" class="btn col-md-1 legbutton" value="fa-book"><i class="fa fa-book"></i></button> -->
						</div>
					</div>
						<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Selecionar</button>
						</div>	
					</div>
				</div>
			</div>
				<!-- Modal -->