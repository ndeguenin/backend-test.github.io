<?php
require "Robot.php";
require "WalkingRobot.php";
require "FlyingRobot.php";

class RobotFactory {

    const ROBOT_TYPE_RANDOM = 2;
    const ROBOT_TYPE_FLYING = 0;
    const ROBOT_TYPE_WALKING = 1;

    /**
     * Actual list of robots created by the factory
     * @var array of {Robot}
     */
    private $_robots = [];

    public function __construct(){}


    /**
     * Main factory method, generate a new unique robot
     * @param int $robot_type
     * @throws InvalidArgumentException
     */
    public function generateNewRobot($robot_type = 2){

        // Only 3 possible values
        if (!in_array($robot_type, [self::ROBOT_TYPE_RANDOM, self::ROBOT_TYPE_FLYING, self::ROBOT_TYPE_WALKING])) {
            throw new \http\Exception\InvalidArgumentException("Expected ROBOTFACTORY::VALUE from ROBOT_TYPE_RANDOM, ROBOT_TYPE_WALKING, ROBOT_TYPE_FLYING ");
        }

        // Determining robot type
        $robotFinalType = ($robot_type != self::ROBOT_TYPE_RANDOM)? $robot_type : rand(0,1);

        // triple random digit + double random UPPERCASE letter
        $rd = "" . rand(0,9) . rand(0,9) . rand(0,9) . chr(rand(65,90)) . chr(rand(65,90));

        // Keep generating when collision
        while( isset($this->_robots[$rd]) ) {
            $rd = "" . rand(0,9) . rand(0,9) . rand(0,9) . chr(rand(65,90)) . chr(rand(65,90));
        }

        // Instanciating & referencing Robot
        if ($robotFinalType == self::ROBOT_TYPE_WALKING) {
            $robot = new WalkingRobot($rd);
        } else {
            $robot = new FlyingRobot($rd);
        }
        $this->_robots[$rd] = $robot;
    }

    /**
     * Delete robot by name
     * @param string $name
     */
    public function deleteRobot(string $name){
        echo "Deleting poor robot [$name]" . PHP_EOL;
        if (isset($this->_robots[$name])) {
            unset($this->_robots[$name]);
        }
    }

    /**
     * Delete ALL ROBOTS - SAD but True
     */
    public function deleteAllRobots(){
        echo "Deleteting ALL robots :'( " . PHP_EOL;
        $this->_robots = [];
    }

    /**
     * Return an array containing all Robot instanciated (generated)
     * @return array
     */
    public function getAllRobost() : array {
        return $this->_robots;
    }

    /**
     * Return the robot answering to the name $name or null if the robot does not exist
     * @param $name
     * @return Robot|null
     */
    public function getRobot($name) : Robot {
        if (isset($this->_robots[$name])) {
            return $this->_robots[$name];
        }
        return null;
    }
}