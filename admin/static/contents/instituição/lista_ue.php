<div class="container-fluid">
	<div id="top" class="row">
		<div class="col-md-11">
			<h2>Instituições</h2>
		</div>
		<div class="col-md-1">
			<a href="?page=addue" class="btn btn-primary pull-right h2">Nova Instituição</a> 
		</div>
	
	</div>
	<div> <?php include "mensagens.php"; ?> </div>
	<!--top - Lista dos Campos-->
	<hr/>
	<?php
	$data = mysqli_query($con, "select * from ue ORDER BY id_ue ASC") or die(mysqli_error());
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
					echo "<td><strong>ID</strong></td>"; 
					echo "<td><strong>Logo</strong></td>"; 
					echo "<td><strong>Nome</strong></td>"; 
					echo "<td><strong>Sigla</strong></td>";
					echo "<td><strong>Email</strong></td>";
					echo "<td><strong>Telefone</strong></td>";
					echo "<td><strong>CEP</strong></td>";
					echo "<td class='actions d-flex justify-content-center'><strong>Ações</strong></td>"; 
					echo "</tr></thead><tbody>";
					while($info = mysqli_fetch_array($data)){ 
						echo "<tr>";
						echo "<td>".$info['id_ue']."</td>";
						echo "<td>".$info['logo_ue']."</td>";
						echo "<td>".$info['nome_ue']." </td>";
						echo "<td>".$info['sigla_ue']." </td>";
						echo "<td>".$info['email_ue']." </td>";
						echo "<td>".$info['tel_ue']." </td>";
						echo "<td>".$info['cep']." </td>";

						echo "<td class='actions btn-group-sm d-flex justify-content-center'>";
						echo "<a class='btn btn-success btn-xs' href=?page=view_ue&id_ue=".$info['id_ue']."> Visualizar </a>";
						echo "<a class='btn btn-warning btn-xs' href=?page=edit_ue&id_ue=".$info['id_ue']."> Editar </a>"; 
						echo "<a href=?page=excluir_ue&id_ue=".$info['id_ue']." class='btn btn-danger btn-xs'> Excluir </a></td>";
					}
				echo "</tr></tbody></table>";
			?>				
		</div><!-- Div Table -->
	</div><!--list-->

	
	<!-- PAGINAÇÃO -->
	<div id="bottom" class="row">
			<div class="col-md-12">
				<?php
					$sqlTotal 		= "select id_ue from ue;";
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


