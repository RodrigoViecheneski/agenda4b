	<?php 
		session_start();
		include 'inc/header.inc.php';
		include 'classes/contatos.class.php';
		include 'classes/usuarios.class.php';

		if(!isset($_SESSION['logado'])){
			header("Location: login.php");
			exit;
		}

		$contatos = new Contatos();
		$usuarios = new Usuarios();
		$usuarios->setUsuario($_SESSION['logado']);

		$fn = new Funcoes();
	?>
	<hr>
	<h1>Corpo da Agenda</h1>
	<hr>
	<br>
		<?php if($usuarios->temPermissao('ADD')): ?><button><a href="adicionar_contato.php">ADICIONAR</a></button>
		<?php endif;?>
		<button><a href="sair.php">SAIR</a></button>
	<br>
	<br>
	<?php if($usuarios->temPermissao('SUPER')):?><button><a href="gestao_usuarios.php">GESTÃO DE USUÁRIOS</a></button>
<?php endif;?>
	<br>
	<br>
	<table border="5" width="100%">
		<tr>
			<th>ID</th>
			<th>Nome</th>
			<th>Telefone</th>
			<th>Email</th>
			<th>Endereço</th>
			<th>Data Nascimento</th>
			<th>Ações</th>
		</tr>
		<?php
			$lista = $contatos->listar();
			foreach ($lista as $item):	
		?>
		<tr>
			<td><?php echo $item['id'];?></td>
			<td><?php echo $item['nome'];?></td>
			<td><?php echo $item['telefone'];?></td>
			<td><?php echo $item['email'];?></td>
			<td><?php echo $item['endereco'];?></td>
			<td><?php echo $fn->dtNasc($item['data_nasc'], 2);?></td>
			<td>
				<button><a href="editar_contato.php?id=<?php echo $item['id']; ?>">EDITAR</a></button> |
				<button><a href="excluir_contato.php?id=<?php echo $item['id']; ?>" onclick="return confirm('Tem certeza que quer excluir área?')">DELETAR</a></button>
			</td>
		</tr>
		<?php
		   endforeach;
		?>	
	</table>

	<?php include 'inc/footer.inc.php'?>
	