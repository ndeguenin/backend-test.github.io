<?php
abstract class Robot {

    /**
     * Unique Name of a robot
     * @var string
     */
    protected $_name = '';

    abstract public function move() ;

    /**
     * Return the name (unique & identifier) of this robot
     * @return string
     */
    public function getName() : string {
        return $this->_name;
    }

    /**
     * To give a practical meaning to this exercice
     */
    public function report() {
        echo "Hello I'm robot [{$this->_name}] and I ";
        $this->move();
        echo PHP_EOL;
    }
}