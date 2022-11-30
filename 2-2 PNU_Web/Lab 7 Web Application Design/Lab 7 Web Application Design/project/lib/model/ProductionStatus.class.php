<?php
/*
   Represents a single row for the ProductionStatus table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class ProductionStatus extends DomainObject
{  
   
   static function getFieldNames() {
      return array('ID','ProductionStatus');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   
   // implement any setters that need input checking/validation
}

?>