<?php
/*
  Table Data Gateway for the Category table.
 */
class CategoryTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "Category";
   } 
   protected function getTableName()
   {
      return "Categories";
   }
   protected function getOrderFields() 
   {
      return 'CategoryName';
   }

}

?>