<style>
	.centro {
		text-align:center;
	}
</style>

<div class="container-fluid">
	<div id="top" class="row">
		<div class="col-md-11">
			<h2 style="font-family: 'Roboto', sans-serif;">Usuários</h2>
		</div>
		<div class="col-md-1">
			<a href="?page=addusu" class="btn btn-primary pull-right h2">Novo Usuário</a> 
		</div>
	
	</div>
	<div> <?php include "mensagens.php"; ?> </div>
	<!--top - Lista dos Campos-->
	<hr/>
	<?php
		if($_SESSION['UsuarioNivel'] == 1){
			header('Location: ?page=home');
		}
	?>
	<div id="bloco-list-pag">
		<div id="list" class="row">
			<div class="table-all table-responsive col-md-12">
				<?php
					$quantidade = 5;
					$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
					$inicio = ($quantidade * $pagina) - $quantidade;
					
					
					$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
					$inicio = ($quantidade * $pagina) - $quantidade;
					$data = mysqli_query($con, "select * from usuarios ORDER BY id_func ASC limit $inicio, $quantidade;");
					
					echo "<table class='table table-striped' cellspacing='0' cellpading='0'>";
					echo "<thead><tr>";
					echo "<td class='centro'><strong>ID do funcionário</strong></td>"; 
					echo "<td class='centro'><strong>Usuário</strong></td>"; 
					echo "<td class='centro'><strong>Senha</strong></td>"; 
					echo "<td class='centro'><strong>Nível</strong></td>";
					echo "<td class='actions d-flex justify-content-center'><strong>Ações</strong></td>"; 
					echo "</tr></thead><tbody>";
					while($info = mysqli_fetch_array($data)){ 
						echo "<tr>";
						echo "<td class='centro'>".$info['id_func']."</td>";
						echo "<td class='centro'>".$info['usuario']."</td>";
						echo "<td class='centro'>".$info['senha']." </td>";
						echo "<td class='centro'>".(($info['nivel'] == 1)?"SUP":"ADMIN")." </td>";

						echo "<td class='actions btn-group-sm d-flex justify-content-center'>";
						echo "<a class='btn btn-success btn-xs' href=?page=view_usu&id_func=".$info['id_func']."> Visualizar </a>";
						echo "<a class='btn btn-warning btn-xs' href=?page=edit_usu&id_func=".$info['id_func']."> Editar </a>"; 
						echo "<a href=?page=excluir_usu&id_func=".$info['id_func']." class='btn btn-danger btn-xs'> Excluir </a></td>";
					}
				echo "</tr></tbody></table>";
			?>				
		</div><!-- Div Table -->
	</div><!--list-->
	<br>			
	
	<!-- PAGINAÇÃO -->
	<div id="bottom" class="row">
			<div class="col-md-12">
				<?php
					$sqlTotal 		= "select id_func from usuarios;";
					$qrTotal  		= mysqli_query($con, $sqlTotal) or die (mysqli_error());
					$numTotal 		= mysqli_num_rows($qrTotal);
					$totalpagina = (ceil($numTotal/$quantidade)<=0) ? 1 : ceil($numTotal/$quantidade);

					$exibir = 3;

					$anterior = (($pagina-1) <= 0) ? 1 : $pagina - 1;
					$posterior = (($pagina+1) >= $totalpagina) ? $totalpagina : $pagina+1;

					echo "<ul class='pagination'>";
					echo "<li class='page-item'><a class='page-link' href='?page=lista_usu&pagina=1'> Primeira</a></li> "; 
					echo "<li class='page-item'><a class='page-link' href=\"?page=lista_usu&pagina=$anterior\"> Anterior</a></li> ";

					echo "<li class='page-item'><a class='page-link' href='?page=lista_usu&pagina=".$pagina."'><strong>".$pagina."</strong></a></li> ";

					for($i = $pagina+1; $i < $pagina+$exibir; $i++){
						if($i <= $totalpagina)
						echo "<li class='page-item'><a class='page-link' href='?page=lista_usu&pagina=".$i."'> ".$i." </a></li> ";
					}

					echo "<li class='page-item'><a class='page-link' href=\"?page=lista_usu&pagina=$posterior\"> Pr&oacute;xima</a></li> ";
					echo "<li class='page-item'><a class='page-link' href=\"?page=lista_usu&pagina=$totalpagina\"> &Uacute;ltima</a></li></ul>";

				?>	
			</div>
		</div><!--bottom-->
	</div>
</div><!--main-->


