﻿<style>
	.centro {
		text-align:center;
	}
</style>

<div class="container-fluid">
	<div id="top" class="row">
		<div class="col-md-11">
			<h2>Funcionários</h2>
		</div>
		<div class="col-md-1">
			<a href="?page=addfunc" class="btn btn-primary pull-right h2">Novo Funcionário</a> 
		</div>
	
	</div>
	<div> <?php include "mensagens.php"; ?> </div>
	<!--top - Lista dos Campos-->
	<hr/>
	<?php
	$data = mysqli_query($con, "select * from funcionario ORDER BY mat_func ASC") or die(mysqli_error());
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
					echo "<td class='centro'><strong>Matricula do funcionário</strong></td>"; 
					echo "<td class='centro'><strong>Função do Funcionário</strong></td>";
					echo "<td class='centro'><strong>Nome do funcionário</strong></td>";
					echo "<td class='centro'><strong>Data de Nascimento do Funcionário</strong></td>";
					echo "<td class='centro'><strong>Sexo do Funcionário</strong></td>";
					echo "<td class='centro'><strong>Telefone do Funcionário</strong></td>";
					echo "<td class='centro'><strong>CPF do Funcionário</strong></td>";
					echo "<td class='centro'><strong>Cep do Funcionário</strong></td>";
					echo "<td class='centro'><strong>Unidade de Ensino do Funcionário</strong></td>";
					echo "<td class='actions d-flex justify-content-center'><strong>Ações</strong></td>"; 
					echo "</tr></thead><tbody>";
					while($info = mysqli_fetch_array($data)){ 
						echo "<tr>";
						echo "<td class='centro'>".$info['mat_func']."</td>";
						echo "<td class='centro'>".$info['funcao_func']." </td>";
						echo "<td class='centro'>".$info['nome_func']." </td>";
						echo "<td class='centro'>".$info['nasc_func']." </td>";
						echo "<td class='centro'>".$info['sexo_func']." </td>";
						echo "<td class='centro'>".$info['tel_func']." </td>";
						echo "<td class='centro'>".$info['cpf_func']." </td>";
						echo "<td class='centro'>".$info['cep']." </td>";
						echo "<td class='centro'>".$info['id_ue']." </td>";


						echo "<td class='actions btn-group-sm d-flex justify-content-center'>";
						echo "<a class='btn btn-success btn-xs' href=?page=view_func&mat_func=".$info['mat_func']."> Visualizar </a>";
						echo "<a class='btn btn-warning btn-xs' href=?page=edit_func&mat_func=".$info['mat_func']."> Editar </a>"; 
						echo "<a href=?page=excluir_func&mat_func=".$info['mat_func']." class='btn btn-danger btn-xs'> Excluir </a></td>";
					}
				echo "</tr></tbody></table>";
			?>				
		</div><!-- Div Table -->
	</div><!--list-->

	
	<!-- PAGINAÇÃO -->
	<div id="bottom" class="row">
			<div class="col-md-12">
				<?php
					$sqlTotal 		= "select mat_func from funcionario;";
					$qrTotal  		= mysqli_query($con, $sqlTotal) or die (mysqli_error());
					$numTotal 		= mysqli_num_rows($qrTotal);
					$totalpagina = (ceil($numTotal/$quantidade)<=0) ? 1 : ceil($numTotal/$quantidade);

					$exibir = 3;

					$anterior = (($pagina-1) <= 0) ? 1 : $pagina - 1;
					$posterior = (($pagina+1) >= $totalpagina) ? $totalpagina : $pagina+1;

					echo "<ul class='pagination'>";
					echo "<li class='page-item'><a class='page-link' href='?page=lista_func&pagina=1'> Primeira</a></li> "; 
					echo "<li class='page-item'><a class='page-link' href=\"?page=lista_func&pagina=$anterior\"> Anterior</a></li> ";

					echo "<li class='page-item'><a class='page-link' href='?page=lista_func&pagina=".$pagina."'><strong>".$pagina."</strong></a></li> ";

					for($i = $pagina+1; $i < $pagina+$exibir; $i++){
						if($i <= $totalpagina)
						echo "<li class='page-item'><a class='page-link' href='?page=lista_func&pagina=".$i."'> ".$i." </a></li> ";
					}

					echo "<li class='page-item'><a class='page-link' href=\"?page=lista_func&pagina=$posterior\"> Pr&oacute;xima</a></li> ";
					echo "<li class='page-item'><a class='page-link' href=\"?page=lista_func&pagina=$totalpagina\"> &Uacute;ltima</a></li></ul>";

				?>	
			</div>
		</div><!--bottom-->
	</div>
</div><!--main-->

