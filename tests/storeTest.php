<?php

  /**
  * @backupGlobals disabled
  * @backupStaticAttributes disabled
  */

  require_once "src/Store.php";
  require_once "src/Brand.php";

  $DB = new PDO ('pgsql:host=localhost;dbname=shoes_test');

  class StoreTest extends PHPUnit_Framework_TestCase
  {
    protected function tearDown()
    {
      Store::deleteAll();
      Brand::deleteAll();
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

    function test_save()
    {
      //Arrange
      $name = "Shoe Emporium";
      $address = "678 Street Rd.";
      $id = 1;
      $test_store = new Store($name, $address, $id);

      //Act
      $test_store->save();

      //Assert
      $result = Store::getAll();
      $this->assertEquals([$test_store], $result);
    }

    function test_getAll()
    {
      //Arrange
      $name = "Kicks R Us";
      $address = "456 Mall";
      $id = 1;
      $test_store = new Store($name, $address, $id);
      $test_store->save();

      $name2 = "Kicks Kicks Kicks";
      $address2 = "789 Rodeo Drive";
      $id2 = 2;
      $test_store2 = new Store($name2, $address2, $id2);
      $test_store2->save();

      //Act
      $result = Store::getAll();

      //Assert
      $this->assertEquals([$test_store, $test_store2], $result);
    }

    function test_deleteAll()
    {
      //Arrange
      $name = "Kicks R Us";
      $address = "456 Mall";
      $id = 1;
      $test_store = new Store($name, $address, $id);
      $test_store->save();

      //Act
      Store::deleteAll();

      //Assert
      $result = Store::getAll();
      $this->assertEquals([], $result);
    }

    function test_find()
    {
      //Arrange
      $name = "Boots n Cats";
      $address = "123 drive rd.";
      $id = 1;
      $test_store = new Store($name, $address, $id);
      $test_store->save();

      $name2 = "For Your Feet";
      $address2 = "Washington Sq. Mall";
      $id2 = 2;
      $test_store2 = new Store($name2, $address2, $id2);
      $test_store2->save();

      //Act
      $result = Store::find($test_store->getId());

      //Assert
      $this->assertEquals($test_store, $result);
    }

    function test_updateStoreName()
    {
      //Arrange
      $name = "Kicks R Us";
      $address = "456 Mall";
      $id = 1;
      $test_store = new Store($name, $address, $id);
      $test_store->save();
      $new_name = "We Sell Shoes";

      //Act
      $test_store->updateStoreName($new_name);

      //Assert
      $this->assertEquals($test_store->getName(), $new_name);
    }

    function test_updateStoreAddress()
    {
      //Arrange
      $name = "Kicks R Us";
      $address = "456 Mall";
      $id = 1;
      $test_store = new Store($name, $address, $id);
      $test_store->save();
      $new_address = "567 Next Door";

      //Act
      $test_store->updateStoreAddress($new_address);

      //Assert
      $this->assertEquals($test_store->getAddress(), $new_address);
    }

    function test_deleteStore()
    {
      //Arrange
      $name = "Kicks R Us";
      $address = "456 Mall";
      $id = 1;
      $test_store = new Store($name, $address, $id);
      $test_store->save();

      $name2 = "Kicks Kicks Kicks";
      $address2 = "789 Rodeo Drive";
      $id2 = 2;
      $test_store2 = new Store($name2, $address2, $id2);
      $test_store2->save();

      //Act
      $test_store->deleteStore();
      $result = Store::getAll();

      //Assert
      $this->assertEquals([$test_store2], $result);
    }

    function test_addBrand()
    {
      //Arrange
      $name = "Sandals";
      $id = 1;
      $address ="the beach";
      $test_store = new Store($name, $address, $id);
      $test_store->save();

      $brand_name = "Rainbow";
      $id2 = 2;
      $test_brand = new Brand($brand_name, $id2);
      $test_brand->save();

      //Act
      $test_store->addBrand($test_brand);

      //Assert
      $this->assertEquals($test_store->getBrands(), [$test_brand]);
    }

    function test_getBrands()
    {
      $name = "Shoe Store";
      $address = "online";
      $id = 1;
      $test_store = new Store($name, $address, $id);
      $test_store->save();

      $brand_name = "nike";
      $id2 = 2;
      $test_brand = new Brand($brand_name, $id2);
      $test_brand->save();

      $brand_name2 = "adidas";
      $id3 = 3;
      $test_brand2 = new Brand($brand_name2, $id3);
      $test_brand2->save();

      //Act
      $test_store->addBrand($test_brand);
      $test_store->addBrand($test_brand2);

      //Assert
      $result = $test_store->getBrands();
      $this->assertEquals([$test_brand, $test_brand2], $result);
    }

    function test_delete()
    {
      //Arrange
      $name = "Sandals";
      $id = 1;
      $address ="the beach";
      $test_store = new Store($name, $address, $id);
      $test_store->save();

      $brand_name = "Rainbow";
      $id2 = 2;
      $test_brand = new Brand($brand_name, $id2);
      $test_brand->save();

      //Act
      $test_store->addBrand($test_brand);
      $test_store->delete();

      //Assert
      $this->assertEquals([], $test_store->getBrands());
    }

  }

 ?>
