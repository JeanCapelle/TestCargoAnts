<?php

class Score{
    public $name;
    public $score;
    public $rank;

    public function __construct(string $name, int $score){
        $this->name     = $name;
        $this->score    = (int)$score;
    }

    public function saveScore(Score $score): bool{
        if(!is_null($score->rank)){
            $_SESSION['scoreList'][$score->rank] = $score;
            return true;
        }
        return false;
    }

    public static function getAllScore(){
        if(isset($_SESSION['scoreList'])){
            return $_SESSION['scoreList'];
        }
        return null;
    }

    public function getRank(Score $score){
        if(!isset($_SESSION['scoreList'])){
            $_SESSION['scoreList'] = [];
            $score->rank = 1;
        }elseif(count($_SESSION['scoreList']) <=2 ){
            end($_SESSION['scoreList']);        
            $key = key($_SESSION['scoreList']);
            $score->rank = intval($key+1);
        }else{
            foreach($_SESSION['scoreList'] as $scoreSession){
                if($score->score > $scoreSession->score){
                    $score->rank =key($scoreSession); 
                }
            }

        }
        return $score;
    }




    



}