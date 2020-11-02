<?php 
 class QueenAnt extends AbstractAnt {
    const CLASS_NAME = "queen";

    public function __construct($iteration){
        $this->hp = 100;
        $this->takeDamage = 8;
        $this->className = self::CLASS_NAME;
        $this->asset = "queen.png";
        $this->positionX = rand(10,750);
        $this->positionY = rand(10,550);
        $this->name = self::CLASS_NAME .strval($iteration);

    }
}

