<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Shoe.php";
    require_once "src/Store.php";

    $server = 'mysql:host=localhost:8889;dbname=shoe_store_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Shoe::deleteAll();
            Store::deleteAll();
        }

        function testGetStore()
        {
            //Arrange
            $store = "Boring";
            $test_store = new Store($store);
            //Act
            $result = $test_store->getStore();
            //Assert
            $this->assertEquals($store, $result);
        }

        function testSetStore()
        {
            $store = "Break a leg";
            $test_store = new Store($store);
            $new_store = "Shoes or hotdogs?";
            $test_store->setStore($new_store);
            $result = $test_store->getStore();
            $this->assertEquals($new_store, $result);
        }

        function testGetId()
        {
            $store = "Lolli gaggers";
            $test_store = new Store($store);
            $test_store->save();
            $result = $test_store->getId();
            $this->assertTrue(is_numeric($result));
        }

        function testSave()
        {
            $store = "Lolli doodle";
            $test_store = new Store($store);
            $test_store->save();
            $executed = $test_store->save();
            $this->assertTrue($executed, "Store not successfully saved to database");
        }

        function testGetAll()
        {
            $store = "Yippie";
            $store_2 = "Yuppie";
            $test_store = new Store($store);
            $test_store->save();
            $test_store_2 = new Store($store_2);
            $test_store_2->save();

            $result = Store::getAll();

            $this->assertEquals([$test_store, $test_store_2], $result);
        }

        function testDeleteAll()
       {
           $store = "Boblob";
           $store_2 = "Lobobo";
           $test_store = new Store($store);
           $test_store->save();
           $test_store_2 = new Store($store_2);
           $test_store_2->save();
           Store::deleteAll();
           $result = Store::getAll();
           $this->assertEquals([], $result);
       }

       function testFind()
        {
            $store_name = "Boblob";
            $store_name_2 = "Lobobo";
            $test_store = new Store($store_name);
            $test_store->save();
            $test_store_2 = new Store($store_name_2);
            $test_store_2->save();
            $result = Store::find($test_store->getId());
            $this->assertEquals($test_store, $result);
        }

/////new additon ///// not working
        function testAddShoe()
        {
            $store = "Boblob";
            $test_store = new Store($store);
            $test_store->save();

            $brand = "ana tomic";
            $price = "888";
            $test_brand = new Shoe($brand, $price);
            $test_brand->save();

            $test_store->addShoe($test_brand);

            $this->assertEquals($test_store->getShoes(), [$test_brand]);
        }

        function testGetShoes()
        {
            $store = "Boblob";
            $test_store = new Store($store);
            $test_store->save();

            $brand = "Whatever";
            $brand_2 = "Go Barefoot";
            $price = "24";
            $price_2 = "999";
            $test_brand = new Shoe($brand, $price);
            $test_brand->save();
            $test_brand_2 = new Shoe($brand_2, $price_2);
            $test_brand_2->save();

            $test_store->addShoe($test_brand);
            $test_store->addShoe($test_brand_2);

            $this->assertEquals($test_store->getShoes(), [$test_brand, $test_brand_2]);
        }




    }
?>
