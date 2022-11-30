<?php
/*
  Table Data Gateway for the ProductionStatus table.
 */
class ProductionStatusTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "ProductionStatus";
   } 
   protected function getTableName()
   {
      return "ProductionStatuses";
   }
   protected function getOrderFields() 
   {
      return 'ProductionStatus';
   }

}

?>