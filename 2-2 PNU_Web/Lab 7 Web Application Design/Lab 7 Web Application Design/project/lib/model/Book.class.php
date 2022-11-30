<?php
/*
   Represents a single row for the Book table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class Book extends DomainObject implements JsonSerializable 
{  
   
   static function getFieldNames() {
      return array('ID','ISBN10','ISBN13','Title','CopyrightYear','SubcategoryID','ImprintID','ProductionStatusID','BindingTypeID','TrimSize','PageCountsEditorialEst','LatestInstockDate','Description','CoverImage','Subcategory', 'Category', 'Imprint', 'BindingType', 'ProductionStatus');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   
   
   // implement any setters that need input checking/validation
   
   public function jsonSerialize() {
      return [
         'id' => $this->ID,      
         'title' => $this->Title
      ];
   }
}

?>