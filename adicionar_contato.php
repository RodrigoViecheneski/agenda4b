<?php require 'inc/header.inc.php'?>
<h1>Adicionar Contato</h1>
<form action="adicionar_contato_submit.php" method="POST">
	<label>Nome:</label><br><br>
	<input type="text" name="nome" required="required"><br><br>
	<label>Telefone:</label><br><br>
	<input type="text" name="telefone" required="required"><br><br>
	<label>Email:</label><br><br>
	<input type="Email" name="email" required="required"><br><br>
	<label>Endereço:</label><br><br>
	<input type="text" name="endereco" required="required"><br><br>
	<label>Data Nascimento:</label><br><br>
	<input type="date" name="data_nasc" required="required"><br><br>
	<input type="submit" name="btCadastrar" value="Cadastrar">
</form>

<?php require 'inc/footer.inc.php'?>