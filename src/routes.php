<?php
// Routes

$app->get('/[{name}]', HelloController::class.':hello1');
# 1
$app->get('/hello/{name}', 'HelloController:hello2');

##################################################

$app->get( '/tarefa/',      'TarefaController:nova_tarefa');
$app->get( '/tarefa/nova',  'TarefaController:nova_tarefa');
$app->post('/tarefa/nova',  'TarefaController:salva_tarefa');
$app->get( '/tarefa/todas', 'TarefaController:lista_tarefas');
$app->get( '/tarefa/anotacoes', 'TarefaController:lista_anotacoes');
$app->get( '/tarefa/{id}',  'TarefaController:mostra_tarefa');