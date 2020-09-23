<?php
require "RobotFactory.php";

// Little program to demonstrate the required possible actions
$oFactory = new RobotFactory();
// Generating 50 random robots
for ($r=0; $r<50; $r++){
    $oFactory->generateNewRobot(RobotFactory::ROBOT_TYPE_RANDOM);
}
// Generating 5 Walking Robots
for ($r=0; $r<5; $r++){
    $oFactory->generateNewRobot(RobotFactory::ROBOT_TYPE_WALKING);
}
// Generating 5 Flying Robots
for ($r=0; $r<5; $r++){
    $oFactory->generateNewRobot(RobotFactory::ROBOT_TYPE_FLYING);
}


// Make them do something
$robots = $oFactory->getAllRobost();
foreach ($robots as $r) {
    $r->report();
}

// Delete specific robot 
$backLuckRobot = array_shift($robots);
$oFactory->deleteRobot($backLuckRobot->getName());

// DELETE THEM ALL :'( 
$oFactory->deleteAllRobots();
