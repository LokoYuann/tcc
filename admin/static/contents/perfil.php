<h1 class="h3 mb-3"> <strong>
<?php
switch($_SESSION['UsuarioNivel']){
case 1: echo "Você está como: visitante";exit;break;
case 2: echo "Você está como: supervisor";exit;break;
case 3: echo "Você está como: administrador";exit;break;
};
?>


</strong></h1>

