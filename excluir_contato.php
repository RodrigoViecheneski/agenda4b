<?php
include 'classes/contatos.class.php';
$contato = new Contatos();

if(!empty($_GET['id'])){
	$id = $_GET['id'];
	$contato->deletar($id);
	header("Location: /agenda4b2");
}else{
	echo '<script type="text/javascript">alert("Erro ao excluir contato!");</script>';
	header("Location: /agenda4b2");
}