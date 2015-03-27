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

  }

  function updateStore()
  {

  }


//static functions
  static function getAll()
  {

  }

  static function deleteAll()
  {

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
