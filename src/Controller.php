<?php
namespace maia;

abstract class Controller
{
    protected $ci;

    public function __construct($ci) {
        $this->ci = $ci;
    }
    
    #abstract public function __invoke(Request $request, Response $response, $args = []);
}