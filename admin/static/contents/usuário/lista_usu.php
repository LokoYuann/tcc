<div class="container-fluid">
	<div id="top" class="row">
		<div class="col-md-11">
			<h2>Usuários</h2>
		</div>
		<div class="col-md-1">
			<a href="?page=addusu" class="btn btn-primary pull-right h2">Novo Usuário</a> 
		</div>
	
	</div>
	<div> <?php include "mensagens.php"; ?> </div>
	<!--top - Lista dos Campos-->
	<hr/>
	<?php
	$data = mysqli_query($con, "select * from usuarios ORDER BY mat_func ASC") or die(mysqli_error());
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
					
					echo "<table class='table table-striped' cellspacing='0' cellpading='0'>";
					echo "<thead><tr>";
					echo "<td><strong>Matricula do funcionário</strong></td>"; 
					echo "<td><strong>Usuário</strong></td>"; 
					echo "<td><strong>Senha</strong></td>"; 
					echo "<td><strong>Nível</strong></td>";
					echo "<td class='actions d-flex justify-content-center'><strong>Ações</strong></td>"; 
					echo "</tr></thead><tbody>";
					while($info = mysqli_fetch_array($data)){ 
						echo "<tr>";
						echo "<td>".$info['mat_func']."</td>";
						echo "<td>".$info['usuario']."</td>";
						echo "<td>".$info['senha']." </td>";
						echo "<td>".$info['nivel']." </td>";

						echo "<td class='actions btn-group-sm d-flex justify-content-center'>";
						echo "<a class='btn btn-success btn-xs' href=?page=view_ue&id_ue=".$info['mat_func']."> Visualizar </a>";
						echo "<a class='btn btn-warning btn-xs' href=?page=edit_ue&id_ue=".$info['mat_func']."> Editar </a>"; 
						echo "<a href=?page=excluir_ue&id_ue=".$info['mat_func']." class='btn btn-danger btn-xs'> Excluir </a></td>";
					}
				echo "</tr></tbody></table>";
			?>				
		</div><!-- Div Table -->
	</div><!--list-->

	
	<!-- PAGINAÇÃO -->
	<div id="bottom" class="row">
			<div class="col-md-12">
				<?php
					$sqlTotal 		= "select mat_func from usuarios;";
					$qrTotal  		= mysqli_query($con, $sqlTotal) or die (mysqli_error());
					$numTotal 		= mysqli_num_rows($qrTotal);
					$totalpagina = (ceil($numTotal/$quantidade)<=0) ? 1 : ceil($numTotal/$quantidade);

					$exibir = 3;

					$anterior = (($pagina-1) <= 0) ? 1 : $pagina - 1;
					$posterior = (($pagina+1) >= $totalpagina) ? $totalpagina : $pagina+1;

					echo "<ul class='pagination'>";
					echo "<li class='page-item'><a class='page-link' href='?page=lista_ue&pagina=1'> Primeira</a></li> "; 
					echo "<li class='page-item'><a class='page-link' href=\"?page=lista_ue&pagina=$anterior\"> Anterior</a></li> ";

					echo "<li class='page-item'><a class='page-link' href='?page=lista_ue&pagina=".$pagina."'><strong>".$pagina."</strong></a></li> ";

					for($i = $pagina+1; $i < $pagina+$exibir; $i++){
						if($i <= $totalpagina)
						echo "<li class='page-item'><a class='page-link' href='?page=lista_ue&pagina=".$i."'> ".$i." </a></li> ";
					}

					echo "<li class='page-item'><a class='page-link' href=\"?page=lista_ue&pagina=$posterior\"> Pr&oacute;xima</a></li> ";
					echo "<li class='page-item'><a class='page-link' href=\"?page=lista_ue&pagina=$totalpagina\"> &Uacute;ltima</a></li></ul>";

				?>	
			</div>
		</div><!--bottom-->
	</div>
</div><!--main-->


