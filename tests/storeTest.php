<?php

  /**
  * @backupGlobals disabled
  * @backupStaticAttributes disabled
  */

  require_once "src/Store.php";

  $DB = new PDO ('pgsql:host=localhost;dbname=shoes_test');

  class StoreTest extends PHPUnit_Framework_TestCase
  {
    protected function tearDown()
    {

    }

    function test_getName()
    {
      //Arrange
      $name = "Shoes Shoes Shoes";
      $address = "123 Fake St.";
      $id = 1;
      $test_store = new Store($name, $address, $id);

      //Act
      $result = $test_store->getName();

      //Assert
      $this->assertEquals($name, $result);
    }

    function test_getAddress()
    {
      //Arrange

      //Act

      //Assert
    }

    function test_getId()
    {
      //Arrange

      //Act

      //Assert
    }

    function test_setName()
    {
      //Arrange

      //Act

      //Assert
    }

    function test_setAddress()
    {
      //Arrange

      //Act

      //Assert
    }

    function test_setId()
    {
      //Arrange

      //Act

      //Assert
    }



  }


 ?>
