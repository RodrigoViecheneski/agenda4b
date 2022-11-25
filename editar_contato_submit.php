<?php
include 'classes/contatos.class.php';
$contato = new Contatos();

if(!empty($_POST['id'])){
	$nome = $_POST['nome'];
	$telefone = $_POST['telefone'];
	$email = $_POST['email'];
	$endereco = $_POST['endereco'];
	$data_nasc = $_POST['data_nasc'];
	$id = $_POST['id'];

	if(!empty($email)){
		$contato->editar($nome, $telefone, $email, $endereco, $data_nasc, $id);
	}
	header("Location: /agenda4b2");
}