<?php 
	function conecta(){
		return $con = mysqli_connect("localhost",'root','','agenda-g');
	}
	
	function x($nome_tarefa, $prioridade, $data_inicio, $data_fim, $descricao){
		echo($nome_tarefa."<br>");
		echo($prioridade."<br>");
		echo($data_inicio."<br>");
		echo($data_fim."<br>");
		echo($descricao.'<br>');
	}

	//$stmt = $con->prepare("INSERT INTO `atividades` (`titulo`, `prioridade`, `inicio`, `termino`, `descricao`,`id`) VALUES (?, ?, ?, ?, ?, NULL); ");

	function salvar_dados_no_banco($nome_tarefa, $prioridade, $data_inicio, $data_fim, $descricao){
		x($nome_tarefa, $prioridade, $data_inicio, $data_fim, $descricao);
		$con = conecta();
		//if (mysqli_connect_errno())
		//	echo "Failed to connect to MySQL: " . mysqli_connect_error();
		$stmt = $con->prepare("INSERT INTO atividades (titulo, prioridade, inicio, termino, descricao,  id) VALUES (?, ?, ?, ?, ?, NULL); ");
		$stmt->bind_param("sisss",$nome_tarefa, $prioridade, $data_inicio, $data_fim, $descricao);
		$result = $stmt->execute();

		printf("Error: %s.\n", $stmt->error);

		$stmt->close();
		$con-> close();

		return $result > 0; //melhor lançar exceçao!
	}

	class DbConnect {

    private $conn;

    function __construct(){ }

	function connect(){
			include_once dirname(__FILE__) . '/Config.php';
			$this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to Mysql: " . mysqli_connect_error();
		}
			return $this->conn;
		}
	}
 ?>