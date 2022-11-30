<?php


/*
   Represents a collection of Customers. 
   
   This a concrete implementation of the Active Record pattern.
 */
class CustomerCollection  extends DomainObjectCollection
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
      Static method to return a populated collection of customers
   */
   public static function findAll()
   {
      // Goal 2.1 - dbAdapter, TableGateway를 작성, 사용하여 retrieve를 위한 코드를 작성하시오.  (findAllSorted(true);로 정렬)
      // *CategoryCollection.class 참고 하여 작성

      //$dbadpter 제작 (수업 자료 내 listing 14.3 참고)
      //data retrieve를 위해 customer gateway 사용 (수업 자료 내 listing 14.10 참고)
      $dbAdapter = ActiveRecordHelper::getDatabaseAdapter();
      $customerGate = new CustomerTableGateway($dbAdapter); 
      $data = $customerGate->findAllSorted(true);
      
      return new CustomerCollection($data);
   }
   
   
   public static function findBy($whereClause, $parameterValues = array())
   {
      // Goal 2.2 - dbAdapter, TableGateway를 작성, 사용하여 retrieve를 위한 코드를 작성하시오.  (참고: findBy($whereClause, $parameterValues, 'LastName');)
      
      //$dbadpter 제작 (수업 자료 내 listing 14.3 참고)
      //data retrieve를 위해 customer gateway 사용 (수업 자료 내 listing 14.10 참고)
      //findBy - 파라미터로 제공된 WHERE에서 지정한 값과 일치하는 모든 레코드를 반환하도록 작성
      $dbAdapter = ActiveRecordHelper::getDatabaseAdapter();
      $customerGate = new CustomerTableGateway($dbAdapter); 
      $data = $customerGate->findBy($whereClause,$parameterValues,'LastName');
      
      return new CustomerCollection($data);
   }
   /*
      Returns all the records that match the criteria specified by the passed WHERE clause
      
      $whereClause - the WHERE clause [e.g., 'ID=? or Name Like ?' or 'price>?' ]
      $parameterValues - an array of parameter values [e.g., Array(6,'Fred') or Array(6) ]
   */
}
