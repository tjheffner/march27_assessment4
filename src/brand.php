<?php

class Brand
{
  private $brand_name;
  private $id;

  function __construct($brand_name, $id)
  {
    $this->brand_name = $brand_name;
    $this->id = $id;
  }

//getters
  function getBrandName()
  {
    return $this->brand_name;
  }

  function getId()
  {
    return $this->id;
  }

//setters
  function setBrandName($new_brand_name)
  {
    $this->brand_name = (string) $new_brand_name;
  }

  function setId($new_id)
  {
    $this->id = (int) $new_id;
  }

//save
  function save()
  {
    $statement = $GLOBALS['DB']->query("INSERT INTO brands (brand_name) VALUES ('{$this->getBrandName()}') RETURNING id;");
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $this->setId($result['id']);
  }

//static functions
  static function getAll()
  {
    $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
    $brands = array();
    foreach ($returned_brands as $brand) {
      $brand_name = $brand['brand_name'];
      $id = $brand['id'];
      $new_brand = new Brand($brand_name, $id);
      array_push($brands, $new_brand);
    }
    return $brands;
  }

  static function find($search_id)
  {
    $found_brand = null;
    $brands = Brand::getAll();
    foreach($brands as $brand) {
      $brand_id = $brand->getId();
      if ($brand_id == $search_id) {
        $found_brand = $brand;
      }
    }
    return $found_brand;
  }

//delete functions
  static function deleteAll()
  {
    $GLOBALS['DB']->exec("DELETE FROM brands *;");
  }

  function deleteBrand()
  {
    $GLOBALS['DB']->exec("DELETE FROM brands WHERE id = {$this->getId()};");
  }

  function delete()
  {
    $GLOBALS['DB']->exec("DELETE FROM brands WHERE id = {$this->getId()};");
    $GLOBALS['DB']->exec("DELETE FROM sold_by WHERE brand_id = {$this->getId()};");
  }

//join stores to brands
  function addStore($store)
  {
    $GLOBALS['DB']->exec("INSERT INTO sold_by (store_id, brand_id) VALUES ({$store->getId()}, {$this->getId()});");
  }

  function getStores()
  {
    $query = $GLOBALS['DB']->query("SELECT stores.* FROM
        brands JOIN sold_by ON (brands.id = sold_by.brand_id)
               JOIN stores ON (sold_by.store_id = stores.id)
               WHERE brands.id = {$this->getId()};");
    $store_ids = $query->fetchAll(PDO::FETCH_ASSOC);

    $stores = array();
    foreach ($store_ids as $store) {
      $name = $store['name'];
      $id = $store['id'];
      $address = $store['address'];
      $new_store = new Store($name, $address, $id);
      array_push($stores, $new_store);
    }
    return $stores;
  }

}

 ?>
