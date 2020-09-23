<?php
require_once 'Robot.php';

class WalkingRobot extends Robot {
    
    public function __construct(string $nameTag){
        $this->_name = 'WK' . $nameTag;
    }
    
    public function move(){
        echo "WALK";
    }
    
}