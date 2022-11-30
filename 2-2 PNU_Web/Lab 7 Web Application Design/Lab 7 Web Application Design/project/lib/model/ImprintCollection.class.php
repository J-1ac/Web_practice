<?php


/*
   Represents a collection of Imprints. 
   
   This a concrete implementation of the Active Record pattern.
 */
class ImprintCollection  extends DomainObjectCollection
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
      Static method to return a populated collection of imprints
   */
   public static function findAll()
   {

      //Goal 3 - dbAdapter, TableGateway를 작성 및 사용 retrieve를 위한 코드를 작성하시오. 
      // CategoryCollection.class 참고
      $dbAdapter = ActiveRecordHelper::getDatabaseAdapter();
      $imprintGate = new ImprintTableGateway($dbAdapter); 
      $imprints = $imprintGate->findAllSorted(true);

      return $imprints;
   }
}
