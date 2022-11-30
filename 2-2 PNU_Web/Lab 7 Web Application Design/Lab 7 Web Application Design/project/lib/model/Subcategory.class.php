<?php
/*
   Represents a single row for the Subcategories table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class Subcategory extends DomainObject
{  
   
   static function getFieldNames() {
      return array('ID','CategoryId','SubcategoryName');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   
   // implement any setters that need input checking/validation
}

?>