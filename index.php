<?php

class A{
    public $name;
    public $first;

   public function  __construct($name, $first){
        $this->name = $name;
        $this->first = $first;
    }
}

// function search($filters)
// {

// $firstname = $filters[‘firstname’];
// $lastname = $filters[‘lastname’];
 
//   $users = A::where(‘firstname’, $firstname)->where(‘lastname’, $lastname);
 
//   return $users;

// }
// $a = new A('toto', 'tata');
// $classname ='User';
// $filters['lastname'] = 'toto';
// $filters['firstname'] = 'janus';

// function search($classname, $filters){
//     if(!class_exists($classname)){
//         throw new Exception("not an entity", 1); 

//     }
//     $query = $classname.'::';
//     foreach($filters as $filter ){
//         $query.='->where('.(key($filters)).'->'.$filter.')';
//     }
//     return eval($query);
// }
// search( $classname, $filters);

class UserController
{
public function delete(Request $request, User $user)
{
  $user->delete();
  event(new UserDeleteEvent($user));
}
}
 
class UserDeleteEvent
{
/** @var User */
public $user;
 
/**
* Create a new event instance
* @param User $user
*/
public function __construct(User $user)
{
  $this->user = $user;
}
public function userDeleted(User $user)
{
    Log::info("Item Deleted Event Fire: ".$user));
}
}
 
class UserDeleteListener
{
/**
* Handle the event.
*
* @param  \App\Events\UserDelete  $event
* @return void
*/
public function handle(UserDeleteEvent $event)
{
    	$utilisateur = $event->user;
    	$utilisateur->delete();
    	Log::info(‘Utilisateur supprimé’);
}
}
