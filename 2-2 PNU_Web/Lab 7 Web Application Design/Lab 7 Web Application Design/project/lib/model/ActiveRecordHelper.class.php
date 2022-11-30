<?php

class ActiveRecordHelper {


   public static function getDatabaseAdapter() {
      return DatabaseAdapterFactory::create('PDO', array(DBCONNECTION, DBUSER, DBPASS));
   }

}


?>