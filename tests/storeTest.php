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
      $name = "More Shoes";
      $address = "234 Runner's Way";
      $id = 1;
      $test_store = new Store($name, $address, $id);

      //Act
      $result = $test_store->getAddress();

      //Assert
      $this->assertEquals($address, $result);
    }

    function test_getId()
    {
      $name = "Shoes on Shoes on Shoes";
      $address = "345 Couch St.";
      $id = 1;
      $test_store = new Store($name, $address, $id);

      //Act
      $result = $test_store->getId();

      //Assert
      $this->assertEquals(1, $result);
    }

    function test_setName()
    {
      //Arrange
      $name = "Kicks R Us";
      $address = "456 Mall";
      $id = 1;
      $test_store = new Store($name, $address, $id);
      $new_name = "Kicks For All";

      //Act
      $test_store->setName($new_name);

      //Assert
      $result = $test_store->getName();
      $this->assertEquals($new_name, $result);
    }

    function test_setAddress()
    {
      //Arrange
      $name = "Kicks R Us";
      $address = "456 Mall";
      $id = 1;
      $test_store = new Store($name, $address, $id);
      $new_address = "567 Next Door";

      //Act
      $test_store->setAddress($new_address);

      //Assert
      $result = $test_store->getAddress();
      $this->assertEquals($new_address, $result);
    }

    function test_setId()
    {
      //Arrange
      $name = "Kicks R Us";
      $address = "456 Mall";
      $id = 1;
      $test_store = new Store($name, $address, $id);
      $new_id = 2;

      //Act
      $test_store->setId(2);

      //Assert
      $result = $test_store->getId();
      $this->assertEquals(2, $result);
    }



  }


 ?>
