<?php
namespace maia;

class Mapper {
    private $con;

    function __construct($host, $user, $pass, $base) {        
        $this->con = mysqli_connect($host, $user, $pass, $base);
    }

}