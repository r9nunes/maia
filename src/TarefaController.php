<?php 
namespace maia;

class TarefaController extends Controller{
	//$app->get('/tarefa/',  '\TarefaController:nova_tarefa');
	//$app->get('/tarefa/nova',  '\TarefaController:nova_tarefa');
    public function nova_tarefa( $request,  $response, $args = []){
		$this->ci->logger->info("Maia '/tarefa/nova' nova_tarefa route");
	    return $this->ci->renderer->render($response, 'tarefa-nova.phtml', $args);
    }
	
	//$app->get('/tarefa/todas',  '\TarefaController:lista_tarefas');
    public function lista_tarefas( $request,  $response, $args = []){
		$this->ci->logger->info("Maia '/tarefa/todas' lista_tarefas route");

		//$db = $this->ci['DbHandler'];
		$mapper = $this->ci['TarefaMapper'];
		$atividades = $mapper->getTodasAsAtividades();
	 	return $this->ci->renderer->render(
	 		$response, 'lista-tarefas.phtml', ['atividades' => $atividades]);
	 }

	//$app->get('/tarefa/anotacoes',  '\TarefaController:lista_anotacoes');
    public function lista_anotacoes( $request,  $response, $args = []){
		$this->ci->logger->info("Maia '/tarefa/anotacoes' lista_anotacoes route");

		//$db = $this->ci['DbHandler'];
		$mapper = $this->ci['TarefaMapper'];
		$anotacoes = $mapper->getTodasAsAnotacoes();
	 	return $this->ci->renderer->render(
	 		$response, 'lista-anotacoes.phtml', ['anotacoes' => $anotacoes]);
	 }

	//$app->get('/tarefa/{id}}',  '\TarefaController:mostra_tarefa');
    public function mostra_tarefa( $request,  $response, $args = []){
		$id = $args['id'];
		$this->ci->logger->info("Maia '/tarefa/{$id}' mostra_tarefa route");

		$mapper = $this->ci['TarefaMapper'];
		$atividade = $mapper->getTarefa($id);
	 		return $this->ci->renderer->render(
	 			$response, 'tarefa-nova.phtml', ['atividade' => $atividade]);
	 }


	//$app->post('/tarefa/nova', '\TarefaController:salva_tarefa');
    public function salva_tarefa( $request,  $response, $args = []){
		$this->ci->logger->info("Maia '/tarefa/nova' salva_tarefa route");

		$dados = $request->getParsedBody();

		$id          = $dados['id'];
		$nome_tarefa = $dados['nome-tarefa'];
		$prioridade  = $dados['prioridade'];
		$data        = $dados['data'];
		$hora_inicio = $dados['hora-inicio'];
		$hora_fim    = $dados['hora-fim'];
		$descricao   = $dados['descricao'];
		$anotacoes   = $dados['anotacoes'];

		$mapper = $this->ci['TarefaMapper'];

		$id = $mapper->salvar_tarefa($id,$nome_tarefa, $prioridade, $data, $hora_inicio, $hora_fim, 
			$descricao, $anotacoes);

		if ($id)
	    	//return $response->getBody()->write("Inserido no BD; $id");
	    	return $response->withHeader('Location',"/tarefa/$id");
	    else
	    //return $response->getBody()->write("ERRo ao inserir no BD; $id");
	    	return $this->ci->renderer->render($response, 'erro.phtml', ['mensagem'=> 'erro ao inserir']);
    }
}