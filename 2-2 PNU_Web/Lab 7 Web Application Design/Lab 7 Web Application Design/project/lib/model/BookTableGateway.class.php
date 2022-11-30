<?php
/*
  Table Data Gateway for the Book table.
 */
class BookTableGateway extends TableDataGateway  {    
   
   public function __construct($dbAdapter)    {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()     {
      return "Book";
   } 
   protected function getTableName()   {
      return "Books";
   }
   protected function getOrderFields()    {
      return 'Title';
   }
   
   protected function getSelectStatement()
   {
      return $this->getSQLwithJoins();
   }
   
   public function getSQLwithJoins()
   {
      $SQLwithJoins = "SELECT Books.*, BindingTypes.BindingType as BindingType, Imprints.Imprint As Imprint, Subcategories.SubcategoryName As Subcategory, Categories.CategoryName As Category, ProductionStatuses.ProductionStatus As ProductionStatus FROM ProductionStatuses INNER JOIN (Categories INNER JOIN (Subcategories INNER JOIN (Imprints INNER JOIN (BindingTypes INNER JOIN Books ON BindingTypes.ID = Books.BindingTypeID) ON Imprints.ID = Books.ImprintID) ON Subcategories.ID = Books.SubcategoryID) ON Categories.ID = Subcategories.CategoryID) ON ProductionStatuses.ID = Books.ProductionStatusID ";  
      
      return $SQLwithJoins;
   }

   // ADDITIONAL FUNCTIONALITY
   
   
   public function findByFromJoins($criteria, $parameterValues)
   {
      $sql = $this->getSQLwithJoins() .  " WHERE " . $criteria;        
      $result = $this->dbAdapter->fetchAsArray($sql, $parameterValues);    

      return $this->convertRecordsToObjects($result);   
   }
}  
?>