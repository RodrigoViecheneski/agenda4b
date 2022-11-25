<?php 
		include 'inc/header.inc.php';
		include 'classes/contatos.class.php';
		$contatos = new Contatos();
		$fn = new Funcoes();
	?>
	<hr>
	<h1>Corpo da Agenda</h1>
	<hr>
	<br>
		<button><a href="adicionar_contato.php">ADICIONAR</a></button>
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
				<button><a href="excluir_contato.php?id=<?php echo $item['id']; ?>">DELETAR</a></button>
			</td>
		</tr>
		<?php
		   endforeach;
		?>	
	</table>

	<?php include 'inc/footer.inc.php'?>
	