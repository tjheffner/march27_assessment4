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

  function updateStoreName($new_name)
  {
    $GLOBALS['DB']->exec("UPDATE stores SET name = '{$new_name}' WHERE id = {$this->getId()};");
    $this->setName($new_name);
  }

  function updateStoreAddress($new_address)
  {
    $GLOBALS['DB']->exec("UPDATE stores SET address = '{$new_address}' WHERE id = {$this->getId()};");
    $this->setAddress($new_address);
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

  static function find($search_id)
  {
    $found_store = null;
    $stores = Store::getAll();
    foreach($stores as $store) {
      $store_id = $store->getId();
      if ($store_id == $search_id) {
        $found_store = $store;
      }
    }
    return $found_store;
  }

//delete functions
  static function deleteAll()
  {
    $GLOBALS['DB']->exec("DELETE FROM stores *;");
  }

  function deleteStore()
  {
    $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");

  }

//join brands to stores
  function addBrand($brand)
  {
    $GLOBALS['DB']->exec("INSERT INTO sold_by (store_id, brand_id) VALUES ({$this->getId()}, {$brand->getId()});");
  }

  function getBrands()
  {
    $query = $GLOBALS['DB']->query("SELECT brands.* FROM
        stores JOIN sold_by ON (stores.id = sold_by.store_id)
               JOIN brands ON (sold_by.brand_id = brands.id)
               WHERE stores.id = {$this->getId()};");
    $store_ids = $query->fetchAll(PDO::FETCH_ASSOC);

    $stores = array();
    foreach ($store_ids as $store) {
      $name = $store['name'];
      $address = $store['address'];
      $id = $store['id'];
      $new_store = new Store($name, $address, $id);
      array_push($stores, $new_store)
    }
    return $stores;
  }

}

 ?>
