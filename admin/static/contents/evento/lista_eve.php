<link rel="stylesheet" href="../static/css/content.css">
<link rel="stylesheet" href="../static/css/crud.css">
<div id="main" class="container-fluid">
	<div id="top" class="row">
		<div class="col-md-11">
			<h2 class="evento">Eventos</h2>
		
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
			
			<div class="td-indicador form-group col-md-6">
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
		<div class="table-all    row">
			<div class="table-responsive col-md-12">
				<?php
					$quantidade = 5;
					$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
					$inicio = ($quantidade * $pagina) - $quantidade;
					
					if(isset($_POST['calendario']) && $_POST['calendario'] !== 'none'){
						$eventos = mysqli_query($con, "select * from eventos where id_calendario ='".$_POST['calendario']."' ORDER BY id_calendario asc limit $inicio, $quantidade;") or die(mysqli_error());
						$eventos_tmp = mysqli_query($con, "select * from tmp_eve where id_calendario ='".$_POST['calendario']."' and (act_tmp = 'add' or act_tmp = 'edit') ORDER BY id_calendario asc limit $inicio, $quantidade;") or die(mysqli_error());
						$edits_sql = mysqli_query($con, "select act_tmp as action, id_evento, id_tmp from tmp_eve where id_calendario = '".$_POST['calendario']."' and (act_tmp = 'del' or act_tmp = 'edit') order by id_calendario ;");
					}
					else{
						if($_SESSION['UsuarioNivel'] == 2){$eventos = mysqli_query($con, "select * from eventos ORDER BY id_calendario asc limit $inicio, $quantidade;") or die(mysqli_error());
						$eventos_tmp = mysqli_query($con, "select * from tmp_eve where (act_tmp = 'add' or act_tmp = 'edit') ORDER BY id_calendario asc limit $inicio, $quantidade;") or die(mysqli_error());
						$edits_sql = mysqli_query($con, "select act_tmp as action, id_evento, id_tmp from tmp_eve where (act_tmp = 'del' or act_tmp = 'edit') order by id_calendario ;");}

						else if(!empty($ids)){$eventos = mysqli_query($con, "select * from eventos where id_calendario IN (" . implode(",", array_map('intval', $ids)) . ") ORDER BY id_calendario asc limit $inicio, $quantidade;");
						$eventos_tmp = mysqli_query($con, "select * from tmp_eve where id_calendario IN (" . implode(",", array_map('intval', $ids)) . ") and (act_tmp = 'add' or act_tmp = 'edit') ORDER BY id_calendario asc limit $inicio, $quantidade;");
						$edits_sql = mysqli_query($con, "select act_tmp as action, id_evento, id_tmp from tmp_eve where id_calendario IN (" . implode(",", array_map('intval', $ids)) . ") and (act_tmp = 'del' or act_tmp = 'edit') order by id_calendario ;");}
					}
					$edits = array();
					$del= array();
					if(!empty($edits_sql)){
					while($row = mysqli_fetch_array($edits_sql))
					{
						if($row['action'] == "edit"){
							$edits[$row['id_evento']] = $row['id_tmp'];}
						else{ 
							$del[$row['id_evento']] = $row['id_tmp'];
						}
					}}
				
					echo "<table class='table table-striped' cellspacing='0' cellpading='0'>";
					echo "<thead><tr>";
					echo "<td class='td-indicador'><strong>ID</strong></td>"; 
					echo "<td class='td-indicador'><strong>Calendário</strong></td>"; 
					echo "<td class='td-indicador'><strong>Tipo</strong></td>";
					echo "<td class='td-indicador'><strong>Data de Início</strong></td>";
					echo "<td class='td-indicador'><strong>Data de Fim</strong></td>";
					echo "<td class='td-center'><strong>Ações</strong></td>"; 
					echo "</tr></thead><tbody>";
				if(!empty($eventos)){
					$count = 0;
					while(($info = mysqli_fetch_array($eventos))){
						if(!empty($cal_atual) && $cal_atual != $info['id_calendario']){$count = 0;}
						$cal_atual= $info['id_calendario'];
						$eventos_tmp = mysqli_query($con, "select * from tmp_eve where id_calendario = '".$info['id_calendario']."' and (act_tmp = 'add');");
						if(!empty($edits[$info['id_evento']])){
							$sla = mysqli_query($con, "select * from tmp_eve where id_evento = '".$info['id_evento']."'");
							$info = mysqli_fetch_array($sla);}
						if(!empty($info)){
							$tipo_evento = mysqli_query($con, "select tipo_evento from legenda where id_leg = '".$info['id_leg']."';");
							echo "<tr>";
							echo "<td>".$info['id_evento']." <span style='float:right;' class='badge badge-pill badge-";
							if(!empty($del[$info['id_evento']])){
								echo "danger'>Exclusão</span>";
							}else if(!empty($edits[$info['id_evento']])){
								echo "warning'>Edição</span>";
							} else {
								echo "'></span>";
							}
							
							echo "</td>";
							echo "<td class='teste'>".$info['id_calendario']."</td>";
							echo "<td class='td-info'>".mysqli_fetch_array($tipo_evento)[0]." </td>";
							echo "<td>".date('d/m/Y',strtotime($info[1]))."</td>"; //Funções para converter formato da data do MySQL
							echo "<td>".date('d/m/Y',strtotime($info[2]))."</td>"; //Funções para converter formato da data do MySQL
							echo "<td class='actions btn-group-sm td-center'>";
							
							
							if(!empty($edits[$info['id_evento']])){
								echo "<a class='btn btn-success btn-xs' href=?page=view_eve&id_tmp=".$edits[$info['id_evento']]."&status=edit&id_evento=".$info['id_evento']."> Visualizar </a>";
								echo "<a class='btn btn-warning btn-xs' href=?page=edit_eve&id_tmp=".$edits[$info['id_evento']]."&status=edit&id_evento=".$info['id_evento']."> Editar </a>"; 
								echo "<a href=?page=excluir_eve&id_tmp=".$edits[$info['id_evento']]."&status=edit&id_evento=".$info['id_evento']." class='btn btn-danger btn-xs'>Cancelar</a></td></tr>";
							}

							elseif(!empty($del[$info['id_evento']])){
								echo "<a class='btn btn-success btn-xs' href=?page=view_eve&id_tmp=".$del[$info['id_evento']]."&status=del&id_evento=".$info['id_evento']."> Visualizar </a>";
								echo "<a class='btn btn-warning btn-xs' href=?page=edit_eve&id_tmp=".$del[$info['id_evento']]."&status=del&id_evento=".$info['id_evento']."> Editar </a>"; 
								echo "<a href=?page=excluir_eve&id_tmp=".$del[$info['id_evento']]."&status=del&id_evento=".$info['id_evento']." class='btn btn-danger btn-xs'>Cancelar</a></td></tr>";
							}
							
							else{
								echo "<a class='btn btn-success btn-xs' href=?page=view_eve&id_evento=".$info['id_evento']."&status=active> Visualizar </a>";
								echo "<a class='btn btn-warning btn-xs' href=?page=edit_eve&id_evento=".$info['id_evento']."&status=active> Editar </a>"; 
							echo "<a href=?page=excluir_eve&id_evento=".$info['id_evento']."&status=active class='btn btn-danger btn-xs'> Excluir </a></td></tr>";}}

					if($count == 0 && $inicio==0){
						while($info_tmp = mysqli_fetch_array($eventos_tmp)){
							$tipo_evento = mysqli_query($con, "select tipo_evento from legenda where id_leg = '".$info_tmp['id_leg']."';");
							echo "<tr>";
							echo "<td><span style='float:right;' class='badge badge-pill badge-info'>Adição</span></td>";
							echo "<td class='teste'>".$info_tmp['id_calendario']."</td>";
							echo "<td class='td-info'>".mysqli_fetch_array($tipo_evento)[0]." </td>";
							echo "<td>".date('d/m/Y',strtotime($info_tmp[1]))."</td>"; //Funções para converter formato da data do MySQL
							echo "<td>".date('d/m/Y',strtotime($info_tmp[2]))."</td>"; //Funções para converter formato da data do MySQL
							echo "<td class='actions btn-group-sm td-center'>";
							echo "<a class='btn btn-success btn-xs' href=?page=view_eve&id_tmp=".$info_tmp['id_tmp']."&status=add> Visualizar </a>";
							echo "<a class='btn btn-warning btn-xs' href=?page=edit_eve&id_tmp=".$info_tmp['id_tmp']."&status=add> Editar </a>"; 
							echo "<a href=?page=excluir_eve&id_tmp=".$info_tmp['id_tmp']."&status=add class='btn btn-danger btn-xs'> Excluir </a></td></tr>";}}
							$count++;
					}
				}
				else{
					echo "Este calendário não possui eventos";
				}
				echo "</tbody></table>";
			?>				
		</div><!-- Div Table -->
	</div><!--list-->

	<br>

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