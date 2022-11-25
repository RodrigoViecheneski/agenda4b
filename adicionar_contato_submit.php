<?php
include 'classes/contatos.class.php';
$contato = new Contatos();

if(!empty($_POST['email'])){
	$nome = $_POST['nome'];
	$telefone = $_POST['telefone'];
	$email = $_POST['email'];
	$endereco = $_POST['endereco'];
	$data_nasc = $_POST['data_nasc'];

	$contato->adicionar($email, $nome, $telefone, $endereco, $data_nasc);
	header('Location: index.php');
}else{
	?>
	<script type="text/javascript">alert("Email já cadastrado!");</script>;
	<?php
}
?>