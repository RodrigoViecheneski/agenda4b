<?php
	session_start();
	require_once 'inc/header.inc.php';
	require 'classes/usuarios.class.php';

	if(!empty($_POST['email'])){
		$email = addslashes($_POST['email']);
		$senha = md5($_POST['senha']);

		$usuario = new Usuarios();
		if($usuario->fazerLogin($email, $senha)){
			header("Location: index.php");
			exit;
		}else{
			echo "Usuário e/ou senha estão errados!";
		}
	}

?>
<h1>LOGIN</h1>
<form method="POST">
	Email: <br>
	<input type="email" name="email">
	<br><br>
	Senha: <br>
	<input type="password" name="senha">
	<br><br>
	<input type="submit" value="Entrar">
</form>
<?php
	require_once 'inc/footer.inc.php';
?>
