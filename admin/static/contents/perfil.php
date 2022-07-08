<h1 class="h3 mb-3"> <strong>
<?php
switch($_SESSION['UsuarioNivel']){
case 1: echo "Você está como: supervisor";break;
case 2: echo "Você está como: administrador";break;
};
?>


</strong></h1>

