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
        // protected function tearDown()
        // {
        //     Shoe::deleteAll();
        //     // Store::deleteAll();
        // }

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


    }
?>
