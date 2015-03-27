<?php

class Store
{
  private $name;
  private $address;
  private $id;

  function __construct($name, $address, $id)
  {
    $this->name = $name;
    $this->address = $address;
    $this->id = $id;
  }

//getters
  function getName()
  {
    return $this->name;
  }

  function getAddress()
  {
    return $this->address;
  }

  function getId()
  {
    return $this->id;
  }

//setters
  function setName($new_name)
  {
    $this->name = (string) $new_name;
  }

  function setAddress($new_address)
  {
    $this->address = (string) $new_address;
  }

  function setId($new_id)
  {
    $this->id = (int) $new_id;
  }

//save + update
  function save()
  {
    $statement = $GLOBALS['DB']->query("INSERT INTO stores (name, address) VALUES ('{$this->getName()}', '{$this->getAddress()}') RETURNING id;");
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $this->setId($result['id']);
  }

  function updateStore()
  {

  }


//static functions
  static function getAll()
  {
    $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
    $stores = array();
    foreach ($returned_stores as $store) {
      $name = $store['name'];
      $address = $store['address'];
      $id = $store['id'];
      $new_store = new Store($name, $address, $id);
      array_push($stores, $new_store);
    }
    return $stores;
  }

  static function deleteAll()
  {
    $GLOBALS['DB']->exec("DELETE FROM stores *;");
  }

  static function find()
  {

  }

//join brands to stores
  function addBrand()
  {

  }

  function getBrands()
  {

  }

}

 ?>
