<?php 
Class WorkerAnt extends AbstractAnt {
    const CLASS_NAME = "worker";

    public function __construct($iteration){
        $this->hp = 50;
        $this->takeDamage = 10;
        $this->className = self::CLASS_NAME;
        $this->asset = "worker.png";
        $this->positionX = rand(10,750);
        $this->positionY = rand(10,550);
        $this->name = self::CLASS_NAME .strval($iteration);

    }

}

