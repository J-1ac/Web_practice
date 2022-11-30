<?php
/*
  Table Data Gateway for the Customer table. 
 */
class CustomerTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "Customer";
   } 
   protected function getTableName()
   {
      return "Customers";
   }
   protected function getOrderFields() 
   {
      return 'LastName,Firstname';
   }
   
   public function update($parameters, $whereCondition, $whereParameters) {
   
      $rowsUpdated = $this->dbAdapter->update($this->getTableName(), $parameters, $whereCondition, $whereParameters);      

   }
   
}

?>