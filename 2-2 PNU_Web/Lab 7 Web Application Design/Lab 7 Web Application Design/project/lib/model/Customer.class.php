<?php
/*
   Represents a single row for the Customer table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class Customer extends DomainObject
{  
   
   static function getFieldNames() {
      return array('ID','FirstName','LastName','Email','University','Address','City','Region','Country','Postal','Phone');
   }
   
   // because PHP doesn't allow method or constructor overloading, we have to do it
   // in the following manner:
   
   public function __construct() 
   { 
       $a = func_get_args(); 
       $i = func_num_args(); 
       if (method_exists($this,$f='__construct'.$i)) { 
           call_user_func_array(array($this,$f),$a); 
       } 
       
       // if here then no parameters, this means we are creating an empty customer
    }    

   public function __construct1(array $data)
   {
      parent::__construct($data, false);
   }    
   public function __construct2(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   
   // implement any setters that need input checking/validation
   
   public function getFullName($commaDelimited)
   {
      if ($commaDelimited)
         return $this->LastName . ', ' . $this->FirstName;
      else
         return $this->FirstName . ' ' . $this->LastName;
   }
   
   
   // Active Record pattern methods
   
   // Note: to simplify development, we will make use of our gateway classes and
   //       also not implement every active record method. That task is left to
   //       the reader!

   /*
     Returns a populated Customer object
   */
   public static function findByKey($key) {
   
      $dbAdapter = ActiveRecordHelper::getDatabaseAdapter();
      
      $customerGate = new CustomerTableGateway($dbAdapter);
      return $customerGate->findById($key);
   }
   
   /*
     Updates the underlying existing customer record based on current values
   */
   public function update() {
      
      $dbAdapter = ActiveRecordHelper::getDatabaseAdapter();
      $customerGate = new CustomerTableGateway($dbAdapter);
      
      $parameters = Array('FirstName' => $this->FirstName,
                          'LastName' => $this->LastName,
                          'Email' => $this->Email,
                          'University' => $this->University,
                          'Address' => $this->Address,
                          'City' => $this->City,
                          'Region' => $this->Region,
                          'Country' => $this->Country,
                          'Country' => $this->Country,
                          'Phone' => $this->Phone);
      
      $customerGate->update($parameters, 'ID=:id', Array(':id' => $this->ID));
   
   }
}

?>