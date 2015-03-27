<?php
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/brand.php";
  require_once __DIR__."/../src/store.php";

  $app = new Silex\Application();

  $app['debug'] = true;

  use Symfony\Component\HttpFoundation\Request;
  Request::enableHttpMethodParameterOverride();

  $DB = new PDO('pgsql:host=localhost;dbname=shoes');

  $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
  ));

  //Three basic pages-- one main page, one for stores, one for brands
  $app->get("/", function() use($app) {
    return $app['twig']->render('index.twig', array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
  });

  $app->get("/stores", function() use($app) {
    return $app['twig']->render('stores.twig', array('stores' => Store::getAll()));
  });

  $app->get("/brands", function() use($app) {
    return $app['twig']->render('brands.twig', array('brands' => Brand::getAll()));
  });

  /* Two pages for each class: view all, view one
     view all: stores.twig
               brands.twig
     view one: store.twig
               brand.twig
  */
  $app->post("/stores", function() use ($app) {
    $store = new Store($_POST['name'], $_POST['address'], $id = null);
    $store->save();
    return $app['twig']->render('stores.twig', array('stores' => Store::getAll()));
  });

  $app->post("/brands", function() use ($app) {
    $brand = new Brand($_POST['brand_name'], $id = null);
    $brand->save();
    return $app['twig']->render('brands.twig', array('brands' => Brand::getAll()));
  });

  $app->get("/stores/{id}", function($id) use ($app) {
    $current_store = Store::find($id);
    return $app['twig']->render('store.twig', array('store' => $current_store, 'brands' => $current_store->getBrands(), 'all_brands' => Brand::getAll()));
  });

  $app->get("/brands/{id}", function($id) use ($app) {
    $current_brand = Brand::find($id);
    return $app['twig']->render('brand.twig', array('brand' => $current_brand, 'stores' => $current_brand->getStores(), 'all_stores' => Store::getAll()));
  });

  //One route per class to add the other
  $app->post("/add_stores", function() use ($app) {
    $current_brand = Brand::find($_POST['brand_id']);
    $store = Store::find($_POST['store_id']);
    $current_brand->addStore($store);
    return $app['twig']->render('brand.twig', array('brand' => $current_brand, 'brands' => Brand::getAll(), 'stores' => $current_brand->getStores(), 'all_stores' => Store::getAll()));
  });

  $app->post("/add_brands", function() use ($app) {
    $current_store = Store::find($_POST['store_id']);
    $brand = Brand::find($_POST['brand_id']);
    $current_store->addBrand($brand);
    return $app['twig']->render('store.twig', array('store' => $current_store, 'stores' => Store::getAll(), 'brands' => $current_store->getBrands(), 'all_brands' => Brand::getAll()));
  });

  //Two delete routes per class: one class-wide, one singular
  $app->post("/delete_stores", function() use ($app) {
    Store::deleteAll();
    return $app['twig']->render('stores.twig', array('stores' => Store::getAll()));
  });

  $app->post("/delete_brands", function() use ($app) {
    Brand::deleteAll();
    return $app['twig']->render('brands.twig', array('brands' => Brand::getAll()));
  });

  $app->delete("/stores/{id}/delete", function($id) use ($app) {
    $current_store = Store::find($id);
    $current_store->delete();
    return $app['twig']->render('stores.twig', array('stores' => Store::getAll()));
  });

  $app->delete("/brands/{id}/delete", function($id) use ($app) {
    $current_brand = Brand::find($id);
    $current_brand->delete();
    return $app['twig']->render('brands.twig', array('brands' => Brand::getAll()));
  });

  /** Three edit routes for the Store class: one to the page
                                             one from the page updating name
                                             one from the page updating address
  * (Brands didn't require full CRUD functionality, so they can only be deleted.)
  */
  $app->get("/stores/{id}/edit", function($id) use ($app) {
    $current_store = Store::find($id);
    return $app['twig']->render('store_edit.twig', array('store' => $current_store));
  });

  $app->patch("/stores/{id}/name", function($id) use ($app) {
    $current_store = Store::find($id);
    $new_name = $_POST['new_name'];
    $current_store->updateStoreName($new_name);
    return $app['twig']->render('store.twig', array('store' => $current_store, 'brands' => $current_store->getBrands(), 'all_brands' => Brand::getAll()));
  });

  $app->patch("/stores/{id}/address", function($id) use ($app) {
    $current_store = Store::find($id);
    $new_address = $_POST['new_address'];
    $current_store->updateStoreAddress($new_address);
    return $app['twig']->render('store.twig', array('store' => $current_store, 'brands' => $current_store->getBrands(), 'all_brands' => Brand::getAll()));
  });

  return $app;

 ?>
