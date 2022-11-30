<?php
/*
  Table Data Gateway for the Subcategory table.
 */
class SubcategoryTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "Subcategory";
   } 
   protected function getTableName()
   {
      return "Subcategories";
   }
   protected function getOrderFields() 
   {
      return 'CategoryID, SubcategoryName';
   }

}

?>