
<script>
	
function botina() {
    var x = document.getElementsByClassName("sidebar js-sidebar");
    if (x === "sidebar js-sidebar collapsed") {
      return  "sidebar js-sidebar";
    } else {
        return "sidebar js-sidebar collapsed";
    }
  }
</script>
<nav id="sidebar" class="sidebar js-sidebar" >
			<div class="sidebar-content js-simplebar">
				<ul class="sidebar-nav">
					<a class="sidebar-brand" href="?page=home">
					  <span class="align-middle">Faetec</span>
				</a>
					<li class="sidebar-item <?php if(isset($_GET['page']) && $_GET['page'] == 'home')echo "active";?>">
						<a class="sidebar-link" href="?page=home">
              			<i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Calendário</span>
            			</a>
					</li>

					

					
					<li class="sidebar-item <?php if(isset($_GET['page']) && $_GET['page'] == 'lista_eve')echo "active";?>">
						<a class="sidebar-link" href="?page=lista_eve">
              			<i class="align-middle" data-feather="list"></i> <span class="align-middle">Eventos</span>
            			</a>
					</li>

					<li class="sidebar-item <?php if(isset($_GET['page']) && $_GET['page'] == 'lista_leg')echo "active";?>">
						<a class="sidebar-link" href="?page=lista_leg">
              			<i class="align-middle" data-feather="list"></i> <span class="align-middle">Legenda</span>
            			</a>
					</li>

					<?php 
					if ($_SESSION['UsuarioNivel'] == 2){ 
						echo"<li class='sidebar-item ".(isset($_GET['page']) && ($_GET['page'] == 'lista_ue')?"active":"")."'>
							<a class='sidebar-link' href='?page=lista_ue'>
							<i class='align-middle' data-feather='list'></i> <span class='align-middle'>Instituição</span>
							</a>
						</li>";
						echo"<li class='sidebar-item ".(isset($_GET['page']) && ($_GET['page'] == 'lista_usu')?"active":"")."'>
							<a class='sidebar-link' href='?page=lista_usu'>
							<i class='align-middle' data-feather='list'></i> <span class='align-middle'>Usuários</span>
							</a>
						</li>";
						echo"<li class='sidebar-item ".(isset($_GET['page']) && ($_GET['page'] == 'lista_func')?"active":"")."'>
						<a class='sidebar-link' href='?page=lista_func'>
						<i class='align-middle' data-feather='list'></i> <span class='align-middle'>Funcionários</span>
						</a>
					</li>";
					}
					
					?>
					<li class="sidebar-item <?php if(isset($_GET['page']) && $_GET['page'] == 'perfil')echo "active";?>" style="position: fixed;bottom: 0;">
						<a class="sidebar-link" href="?page=perfil">
              			<i class="align-middle" data-feather="user"></i> <span class="align-middle">Perfil</span>
            			</a>
					</li>
				</ul>
				
			</div>
		</nav>
		
<?php // echo $_SESSION['UsuarioNivel'] ;?>