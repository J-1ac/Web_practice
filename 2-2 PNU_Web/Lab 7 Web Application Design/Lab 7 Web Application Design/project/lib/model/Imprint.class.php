<?php
/*
   Represents a single row for the Imprint table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class Imprint extends DomainObject
{  
   
   static function getFieldNames() {
      return array('ID','Imprint');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   
   // Active Record pattern methods
   
   // Note: to simplify development, we will make use of our gateway classes and
   //       also not implement every active record method. That task is left to
   //       the reader!
   
   
}

?>