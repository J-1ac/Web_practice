<?php


/*
   Represents a collection of Categories. 
   
   This a concrete implementation of the Active Record pattern.
 */
class CategoryCollection  extends DomainObjectCollection
{  

   public function __construct(array $data)
   {
      parent::__construct($data);
   }   
   
   // Active Record pattern methods
   
   // Note: to simplify development, we will make use of our gateway classes and
   //       also not implement every active record method. That task is left to
   //       the reader!
   
   
   /*
      Static method to return a populated collection of categories
   */
   public static function findAll() {
      $dbAdapter = ActiveRecordHelper::getDatabaseAdapter();
      
      $categoryGate = new CategoryTableGateway($dbAdapter); 
      $data = $categoryGate->findAllSorted(true);
    
      $categories = new CategoryCollection($data);      
      return $categories;
   }
   


}

?>