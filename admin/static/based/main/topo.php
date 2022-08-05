<nav class="navbar navbar-expand navbar-light navbar-bg">
	<a class="sidebar-toggle js-sidebar-toggle" style="padding-left: 5px;" onclick="botina()">
        <i class="hamburger align-self-center"></i>
    </a>

	<div class="navbar-collapse collapse">
		<ul class="navbar-nav navbar-align">
			<li class="nav-item dropdown">
				<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" data-bs-toggle="dropdown">
				<i class="align-middle" data-feather="settings"></i></a>
				<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="?page=perfil" data-bs-toggle="dropdown">
				<img src="img/profile.webp" class="avatar img-fluid rounded me-1" alt="<?php echo $_SESSION['UsuarioNome']?>" /> <span class="text-dark"><?php echo $_SESSION['UsuarioNome']?></span></a>
				<div class="dropdown-menu dropdown-menu-end">
					<a class="dropdown-item" href="?page=perfil"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
					<a class="dropdown-item" href="index.php">Log out</a>
				</div>
				
			</li>
		</ul>
	</div>
</nav>