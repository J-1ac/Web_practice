<?php
/*
  Table Data Gateway for the Author table. 
 */
class AuthorTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "Author";
   } 
   protected function getTableName()
   {
      return "Authors";
   }
   protected function getOrderFields() 
   {
      return 'LastName,Firstname';
   }
   
   public function getSQLwithJoins()
   {
      $SQLwithJoins = "SELECT FirstName, LastName, Institution FROM Books INNER JOIN (Authors INNER JOIN BookAuthors ON Authors.ID = BookAuthors.AuthorId) ON Books.ID = BookAuthors.BookId ";  
      
      return $SQLwithJoins;
   }   

   public function getForBookId($bookId)
   {
      $sql = $this->getSQLwithJoins() .  " WHERE Books.ID=?" ;          
      $result = $this->dbAdapter->fetchAsArray($sql, Array($bookId));   
      return $this->convertRecordsToObjects($result);     
   }
   
}

?>