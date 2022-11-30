<?php

/*
   Represents an abstract collection of active record objects. 
   
   This a concrete implementation of the Active Record pattern.
 */
class DomainObjectCollection implements IteratorAggregate, Countable
{
   protected $collection;
   
   public function __construct(array $data)
   {
      $this->collection = $data;
   }   

   // This allows our collection to be iterated in a foreach loop
   public function getIterator()
   {
      return new ArrayIterator($this->collection);
   }   
   
   // This returns the number of items in our collection
   public function count()
   {
      return sizeof($this->collection);
   } 
   
}

?>