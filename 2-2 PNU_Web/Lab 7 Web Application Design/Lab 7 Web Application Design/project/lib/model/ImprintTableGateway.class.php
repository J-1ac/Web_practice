<?php
/*
  Table Data Gateway for the Imprint table.
 */
class ImprintTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "Imprint";
   } 
   protected function getTableName()
   {
      return "Imprints";
   }
   protected function getOrderFields() 
   {
      return 'Imprint';
   }

}

?>