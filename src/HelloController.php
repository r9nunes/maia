<?php
//require_once('Controller.php');
namespace maia;

class HelloController extends Controller
{
	//$app->get('/[{name}]', 'HelloController:hello1');
	public function hello1($request, $response, $args) {
    	// Sample log message
    	$this->ci->logger->info("maia-hello '/' route");
    	// Render index view
    	return $this->ci->renderer->render($response, 'index.phtml', $args);
	}
	
    //$app->get('/hello/{name}', '\HelloController:hello2');
    public function hello2($request, $response, $args = []){
		$this->ci->logger->info("maia-hello '/hello{name}' route");
	    $name = $request->getAttribute('name');
	    $response->getBody()->write("Hello, $name");
	    return $response;
	}


}