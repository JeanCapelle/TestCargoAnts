<?php 

// class Game{
//   private static $singleton = null;
//   private $queenNumber;
//   private $soldierNumber;
//   private $workerNumber;
//   public $playerName;
//   public $ants;
//   public $attackNumber;

//   public function __construct(string $player){
//     $this->queenNumber    = 1;
//     $this->soldierNumber  = 5;
//     $this->workerNumber   = 8;
//     $this->playerName     = $player;
//     $this->attackNumber   = 75;
//     $this->ants = $this->generateObjects($this->queenNumber,$this->soldierNumber,$this->workerNumber);
//   }

//   private function generateObjects(string $queenNumber, string $soldierNumber, string $workerNumber){
//     $antsCollection= [];
//     $antsCollection = $this->InstantiateAnts($antsCollection);
//     return $antsCollection;
//   }

//   private function InstantiateAnts(array $antsCollection){

//     $reflection  = new ReflectionMethod('Game', 'generateObjects');
//     $params      = $reflection->getParameters();
//     foreach ($params as $param) {
//       $antType   = $param->getName();
//       $antNumber = $this->$antType;
//       $antType   = str_replace('Number', 'Ant', $antType);
//       $antType   = sprintf(ucfirst($antType));
//       if( class_exists($antType)){
//         for ($i=0; $i < $antNumber ; $i++) { 
//           $ant = new $antType($i);
//           $antsCollection[] = $ant; 
//         }
//       }else{
//         throw new Exception("Class doesn't exist". $antType);
//       }
//     }
//     return $antsCollection; 
  
//   }

//   public static function getInstance(string $player) {
//     if(is_null(self::$singleton)) {
//       self::$singleton = new Game($player);
//     }
//     return self::$singleton;
//   }

// } 

// // Class User extends Eloquent
// // {
// /**
// * Recherche des utilisateurs suivant les critères données
// * @param array $filters
// */
// public function search($filters)
{
foreach( $filters as $filter){

}

$firstname = $filters[‘firstname’];
$lastname = $filters[‘lastname’];
 
  $users = User::where(‘firstname’, $firstname)->where(‘lastname’, $lastname);
 
  return $users;
}
}
