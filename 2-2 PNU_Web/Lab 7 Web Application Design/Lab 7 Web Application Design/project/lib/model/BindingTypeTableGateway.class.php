<?php
/*
 * Table Data Gateway for the BindingType table.
 *
 */
class BindingTypeTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "BindingType";
   } 
   protected function getTableName()
   {
      return "BindingTypes";
   }
   protected function getOrderFields() 
   {
      return 'BindingType';
   }

}

?>