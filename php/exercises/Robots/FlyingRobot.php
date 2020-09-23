<?php
require_once 'Robot.php';

class FlyingRobot extends Robot {

    public function __construct(string $nameTag){
        $this->_name = 'FL' . $nameTag;
    }

    public function move(){
        echo "FLY";
    }
    
}