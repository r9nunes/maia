<?php
namespace maia;
//require_once('controller.php');

class TarefaMapper{
    private $con;

    function __construct($con) {        
        $this->con = $con;
    }

    public function getTodasAsAtividades() {
        $stmt = $this->con->prepare("SELECT a.* FROM atividades a");
        $stmt->execute();
        $result_set_atividades = $stmt->get_result();
        $array_atividades = $this->converte_resultset_to_array($result_set_atividades);
        $stmt->close();
        return $array_atividades;
    }

    public function getTodasAsAnotacoes() {
        $stmt = $this->con->prepare("SELECT a.titulo, a.data, a.anotacoes FROM atividades a where a.anotacoes <> '' ");
        $stmt->execute();
        $result_set_anotacoes = $stmt->get_result();
        $array_anotacoes = $this->converte_resultset_to_array($result_set_anotacoes);
        $stmt->close();
        return $array_anotacoes;
    }


    public function getTarefa($id){
        $stmt = $this->con->prepare("SELECT a.* FROM atividades a where a.id=$id");
        $stmt->execute();
        $result_set = $stmt->get_result();
        $row = mysqli_fetch_assoc($result_set); 
        $stmt->close();
        return $row;
    }

    public function salvar_tarefa($id, $nome_tarefa, $prioridade, $data, $hora_inicio, 
        $hora_fim, $descricao, $anotacoes){

        $prioridade = $this->valor_prioridade($prioridade);
        $query1 = "INSERT INTO atividades (titulo, prioridade, data, hora_inicio, hora_fim, descricao, anotacoes) VALUES (?, ?, ?, ?, ?, ?, ?) ";
        $query2 = "UPDATE atividades SET titulo = ? , prioridade = ?, data = ?, hora_inicio = ?, hora_fim = ?, descricao = ?, anotacoes = ? where id = $id";
        
        //$this->con->stmt_init();

        if($id) $stmt = $this->con->prepare($query2);
        else    $stmt = $this->con->prepare($query1);

        $stmt->bind_param("sisssss", $nome_tarefa, $prioridade, $data, $hora_inicio, 
                    $hora_fim, $descricao, $anotacoes);
        $result = $stmt->execute();     
        $result = $id?$id:$this->con->insert_id;
        $stmt->close();
        return $result ;
    }

    private function converte_resultset_to_array($result_set){
        $result_array = array();

        while($row = mysqli_fetch_assoc($result_set)) {
            $result_array[] = $row;
        }
        return $result_array;
    }


	private function valor_prioridade($prioridade){
		if ($prioridade == 'baixa')
			return 1;
		elseif ($prioridade == 'media')
			return 2;
		else  //alta
			return 3;
	}

	private function data_formatada($data_string){
		$date = date_create($data_string);
		return date_format($date, 'Y-m-d H:i:s');
	}

   function temp(){
        $query2 = "INSERT INTO atividades (titulo, prioridade, data, hora_inicio, hora_fim, descricao, anotacoes, id) VALUES ($nome_tarefa, $prioridade, $data, $hora_inicio, $hora_fim, $descricao, $anotacoes, NULL) ";


        $prioridade = $this->valor_prioridade($prioridade);
        $query = "INSERT INTO atividades (titulo, prioridade, data, hora_inicio, hora_fim, descricao, anotacoes, id) VALUES (?, ?, ?, ?, ?, ?, ?, NULL) ";
        
        $this->con->stmt_init();
        $stmt = $this->con->prepare($query);
        if($stmt){
            $stmt->bind_param("sisssss", $nome_tarefa, $prioridade, 
                $data, $hora_inicio, $hora_fim, $descricao, $anotacoes);
            
            $result = $stmt->execute();     //$result = $con->insert_id();
            $stmt->close();
        }else{
            $e = $statement->error;
            echo"Error executing MySQL query: $e";
        }
        return $result ;
    

    }

}