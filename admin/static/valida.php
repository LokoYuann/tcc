<?php
// Verifica se houve POST e se o usuário ou a senha estão vazios
if (!empty($_POST) and (empty($_POST['usuario']) or empty($_POST['senha']))) {
	header("Location: index.php"); exit;
}
// Tenta se conectar ao servidor MySQL e ao DB
$con = mysqli_connect('localhost', 'root', '', 'dailyevent') or trigger_error(mysqli_error());

$usuario = mysqli_real_escape_string($con, $_POST['usuario']);
$senha = mysqli_real_escape_string($con, $_POST['senha']);

// Validação do usuário/senha digitados
$sql  = "select mat_func, usuario, nivel from usuarios where (usuario = '". $usuario ."') ";
$sql .= "and (senha = '". $senha ."')";

$query = mysqli_query($con, $sql);

//echo "mysql_query($sql)"; exit;	

if (mysqli_num_rows($query) != 1) {
	// Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
	header('Content-Type: text/html; charset=utf-8');
	echo "Login invalido!"; exit;
} else {
	// Salva os dados encontados na variável $resultado
	$resultado = mysqli_fetch_assoc($query);

	
	
////// 4.0 - Salvando os dados na sessão do PHP ////////

	// Se a sessão não existir, inicia uma
	if (!isset($_SESSION)) session_start();

	// Salva os dados encontrados na sessão
	$_SESSION['UsuarioID'] = $resultado['mat_func'];
	$_SESSION['UsuarioNome'] = $resultado['usuario'];
	$_SESSION['UsuarioNivel'] = $resultado['nivel'];
	
    // Redireciona o visitante
	switch($_SESSION['UsuarioNivel']){
		case 1: header("Location: dash.php");exit;break;

		case 2: header("Location: dash.php");exit;break;

		case 3: header("Location: dash.php");exit;break;
	}
}

?>