<div id="main" class="container-fluid">
	<div id="top" class="row">
		<div class="col-md-11">
			<h2>Eventos</h2>
		
		</div>
		<div class="col-md-1">
			<a href="?page=addeve" class="btn btn-primary pull-right h2">Novo Evento</a> 
		</div>

	</div>
	<div> <?php include "mensagens.php"; ?> </div>
	<!--top - Lista dos Campos-->
	<hr/>
	<?php
	if($_SESSION['UsuarioNivel'] == 2){
		if(isset($_POST['ue']) && $_POST['ue'] !== 'none'){
			$id_cal = mysqli_query($con, "select id_calendario from calendario where id_ue = '".$_POST['ue']."' ORDER BY id_calendario ASC") or die(mysqli_error());}
		else{
			$id_cal = mysqli_query($con, "select id_calendario from calendario  ORDER BY id_calendario ASC") or die(mysqli_error());}}
	else{
		$id_cal = mysqli_query($con, "select id_calendario from calendario where id_ue = '".$func_inst[0]."' ORDER BY id_calendario ASC") or die(mysqli_error());}
	


	$ids = array();
	while($row = mysqli_fetch_array($id_cal))
	{
		$ids[] = $row['id_calendario'];
	}
	?>
	<form action="?page=lista_eve" method="post" >
		<div class="d-flex row justify-content-between" >
			<?php if($_SESSION['UsuarioNivel'] == 2){ ?>
			<div class="form-group col-md-6">
				Filtrar por Instituição:
				<select name="ue" class="form-control " action="post" onchange='formreact(this.value,"lista_eve")';>
				<option value="none">Todas</option>
				<?php 
				for($i = 0; $i < count($inst); $i++)
				{
					
					echo '<option value="'.$id_ue[$i].'" '.(($_POST['ue']==$id_ue[$i])?'selected="selected"':"").'>'.$inst[$i].'</option>';

				}

			    echo "</select>
				</div>";}
				?> 
			
			<div class="form-group col-md-6">
				Filtrar por calendário:
				<select name="calendario" class="form-control " id="reactive" action="post" onchange='this.form.submit()';>
				<option value="none">Todos</option>
				<?php 
				for($i = 0; $i < count($ids); $i++)
				{
					
					echo '<option value="'.$ids[$i].'" '.(($_POST['calendario']==$ids[$i])?'selected="selected"':"").'>'.$ids[$i].'</option>';
					

				}

				
				echo "</select>
			</div>
		</div>";
	echo "</form>";
	?>
	<div id="bloco-list-pag">
		<div id="list" class="row">
			<div class="table-responsive col-md-12">
				<?php
					$quantidade = 5;
					$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
					$inicio = ($quantidade * $pagina) - $quantidade;
					$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
					$inicio = ($quantidade * $pagina) - $quantidade;
					
					
					if(isset($_POST['calendario']) && $_POST['calendario'] !== 'none'){
						$eventos = mysqli_query($con, "select * from eventos where id_calendario ='".$_POST['calendario']."' ORDER BY id_calendario asc limit $inicio, $quantidade;") or die(mysqli_error());
					}
					else{
						if($_SESSION['UsuarioNivel'] == 2){$eventos = mysqli_query($con, "select * from eventos ORDER BY id_calendario asc limit $inicio, $quantidade;") or die(mysqli_error());}
						else{$eventos = mysqli_query($con, "select * from eventos where id_calendario IN (" . implode(",", array_map('intval', $ids)) . ") ORDER BY id_calendario asc limit $inicio, $quantidade;") /* or die(mysqli_error()) */;}
					}
					
					
					echo "<table class='table table-striped' cellspacing='0' cellpading='0'>";
					echo "<thead><tr>";
					echo "<td><strong>ID</strong></td>"; 
					echo "<td><strong>Calendário</strong></td>"; 
					echo "<td><strong>Tipo</strong></td>";
					echo "<td><strong>Data de Início</strong></td>";
					echo "<td><strong>Data de Fim</strong></td>";
					echo "<td class='actions d-flex justify-content-center'><strong>Ações</strong></td>"; 
					echo "</tr></thead><tbody>";
				if(!empty($info)){
					while($info = mysqli_fetch_array($eventos)){ 
						echo "<tr>";
						echo "<td>".$info['id_evento']."</td>";
						echo "<td>".$info['id_calendario']."</td>";
						echo "<td>".$info['id_leg']." </td>";
						echo "<td>".date('d/m/Y',strtotime($info['dt_ini_ev']))."</td>"; //Funções para converter formato da data do MySQL
						echo "<td>".date('d/m/Y',strtotime($info['dt_fim_ev']))."</td>"; //Funções para converter formato da data do MySQL
						echo "<td class='actions btn-group-sm d-flex justify-content-center'>";
						echo "<a class='btn btn-success btn-xs' href=?page=view_eve&id_evento=".$info['id_evento']."> Visualizar </a>";
						echo "<a class='btn btn-warning btn-xs' href=?page=edit_eve&id_evento=".$info['id_evento']."> Editar </a>"; 
						echo "<a href=?page=excluir_eve&id_evento=".$info['id_evento']." class='btn btn-danger btn-xs'> Excluir </a></td>";
					}
				}
				else{
					echo "Este calendário não possui eventos";
				}
				echo "</tr></tbody></table>";
			?>				
		</div><!-- Div Table -->
	</div><!--list-->

	
	<!-- PAGINAÇÃO -->
	<div id="bottom" class="row">
			<div class="col-md-12">
				<?php
					$sqlTotal 		= "select id_evento from eventos;";
					$qrTotal  		= mysqli_query($con, $sqlTotal) or die (mysqli_error());
					$numTotal 		= mysqli_num_rows($qrTotal);
					$totalpagina = (ceil($numTotal/$quantidade)<=0) ? 1 : ceil($numTotal/$quantidade);

					$exibir = 3;

					$anterior = (($pagina-1) <= 0) ? 1 : $pagina - 1;
					$posterior = (($pagina+1) >= $totalpagina) ? $totalpagina : $pagina+1;

					echo "<ul class='pagination'>";
					echo "<li class='page-item'><a class='page-link' href='?page=lista_eve&pagina=1'> Primeira</a></li> "; 
					echo "<li class='page-item'><a class='page-link' href=\"?page=lista_eve&pagina=$anterior\"> Anterior</a></li> ";

					echo "<li class='page-item'><a class='page-link' href='?page=lista_eve&pagina=".$pagina."'><strong>".$pagina."</strong></a></li> ";

					for($i = $pagina+1; $i < $pagina+$exibir; $i++){
						if($i <= $totalpagina)
						echo "<li class='page-item'><a class='page-link' href='?page=lista_eve&pagina=".$i."'> ".$i." </a></li> ";
					}

					echo "<li class='page-item'><a class='page-link' href=\"?page=lista_eve&pagina=$posterior\"> Pr&oacute;xima</a></li> ";
					echo "<li class='page-item'><a class='page-link' href=\"?page=lista_eve&pagina=$totalpagina\"> &Uacute;ltima</a></li></ul>";
				?>	
			</div>
		</div><!--bottom-->
	</div>
	<?php mysqli_close($con); ?>
</div><!--main-->


