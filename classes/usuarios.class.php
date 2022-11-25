<?php
//chamada da classe de conexão
require_once 'conexao.class.php';
require_once 'funcoes.class.php';
//crir a classe contatos
class Usuarios {
	//criar os atributos (variáveis)
	private $con; // variável que recebe a conexao
	//variáveis do banco de dados
	private $fn;
	private $id;
	private $nome;
	private $email;
	private $senha;
	private $permissao;//add,edit,del,super

	//criar os métodos da classe Contatos
	public function __construct(){
		$this->con = new Conexao();
		$this->fn = new Funcoes();
	}
	public function __set($atributo, $valor){
		$this->atributo = $valor;
	}
	public function __get($atributo){
		return $this->atributo;
	}
	public function adicionar($email, $nome, $senha, $permissao){
		$emailExistente = $this->existeEmail($email);
		if(count($emailExistente) == 0){
			try{
				$this->nome = $nome;
				$this->email = $email;
				$this->senha = $senha;
				$this->permissao = $permissao;
				$sql = $this->con->conectar()->prepare("INSERT INTO usuarios(nome, email, senha, permissao) VALUES (:nome, :email, :senha, :permissao)");
				$sql->bindParam(":nome", $this->nome, PDO::PARAM_STR);
				$sql->bindParam(":email", $this->email, PDO::PARAM_STR);
				$sql->bindParam(":senha", $this->senha, PDO::PARAM_STR);
				$sql->bindParam(":permissao", $this->permissao, PDO::PARAM_STR);
				$sql->execute();
				return TRUE;
			}catch(PDOException $ex){//gera uma mensagem de erro caso o try não funcione.
				return 'Erro: '.$ex->getMessage();
			}
			}else{
				return FALSE;
		}
	}
	public function existeEmail($email){
		$sql = $this->con->conectar()->prepare("SELECT id FROM usuarios WHERE email = :email");
		$sql->bindParam(":email", $email, PDO::PARAM_STR);
		$sql->execute();
		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}else{
			$array = array();
		}
		return $array;
	}

	public function listar(){
		try{
			$sql = $this->con->conectar()->prepare("SELECT id, nome, telefone, email, endereco, data_nasc FROM contatos");
			$sql->execute();
			return $sql->fetchAll();
		}catch(PDOException $ex){
			return 'ERRO: '.$ex->getMessage();
		}
	}

	public function buscar($id){
		try{
			$sql = $this->con->conectar()->prepare("SELECT * FROM contatos WHERE id = :id");
			$sql->bindValue(':id', $id);
			$sql->execute();
			if($sql->rowCount() > 0){
				return $sql->fetch();
			}else{
				return array();
			}
		}catch(PDOException $ex){
			echo "ERRO: ".$ex->getMessage();
		}
	}
	public function editar($nome, $telefone, $email, $endereco, $data_nasc, $id){
		$emailExistente = $this->existeEmail($email);
		if(count($emailExistente) > 0 && $emailExistente['id'] != $id){
			return FALSE;
		}else{
			try{
			$sql = $this->con->conectar()->prepare("UPDATE contatos SET nome = :nome, telefone = :telefone, email = :email, endereco = :endereco, data_nasc = :data_nasc WHERE id = :id");
			$sql->bindValue(':nome', $nome);
			$sql->bindValue(':telefone', $telefone);
			$sql->bindValue(':email', $email);
			$sql->bindValue(':endereco', $endereco);
			$sql->bindValue(':data_nasc', $data_nasc);
			$sql->bindValue(':id', $id);
			$sql->execute();
			return TRUE;
		}catch(PDOException $ex){
			echo 'ERRO: '.$ex->getMessage();
		}
		}
	}
	public function deletar($id){
		$sql = $this->con->conectar()->prepare("DELETE FROM contatos WHERE id = :id");
		$sql->bindValue(':id', $id);
		$sql->execute();
	}

	//funções referentes ao login
	public function fazerLogin($email, $senha){
		$sql = $this->con->conectar()->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
		$sql->bindValue(":email", $email);
		$sql->bindValue(":senha", $senha);
		$sql->execute();

		if($sql->rowCount() > 0){
			$sql = $sql->fetch();

			$_SESSION['logado'] = $sql['id'];
			return true;
		}
		return false;
	}
	public function setUsuario($id){
		$this->id = $id;
		$sql = $this->con->conectar()->prepare("SELECT * FROM usuarios WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0){
			$sql = $sql->fetch();

			$this->permissao = explode(',', $sql['permissao']); //transforma em array.
		}
	}
	public function getPermissao(){
		return $this->permissao;
	}	
	public function temPermissao($p){
		if(in_array($p, $this->permissao)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}
?>