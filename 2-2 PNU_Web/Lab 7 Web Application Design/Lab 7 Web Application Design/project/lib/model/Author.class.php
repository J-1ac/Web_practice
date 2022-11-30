<?php
/*
   Represents a single row for the Author table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class Author extends DomainObject
{  
   
   static function getFieldNames() {
      return array('ID','FirstName','LastName','Institution');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   
   // implement any setters that need input checking/validation
   
   public function getFullName($commaDelimited)
   {
      if ($commaDelimited)
         return $this->LastName . ', ' . $this->FirstName;
      else
         return $this->FirstName . ' ' . $this->LastName;
   }
}

?>