<!-- <?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    require_once "src/Shoe.php";


    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
            Shoe::deleteAll();
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
            $store = "Boblob";
            $store_2 = "Lobobo";
            $test_store = new Store($store);
            $test_store->save();
            $test_store_2 = new Store($store_2);
            $test_store_2->save();

            $result = Store::find($test_store->getId());

            $this->assertEquals($test_store, $result);
        }

        // function testAddShoe()
        // {
        //     $store = "HKJKDJD";
        //     $test_store = new Store($store);
        //     $test_store->save();
        //
        //     $brand = "ok";
        //     $price = "88";
        //     $test_brand = new Shoe($brand, $price);
        //     $test_brand->save();
        //
        //     $test_store->addShoe($test_brand);
        //
        //     $this->assertEquals($test_store->getShoes(), [$test_brand]);
        // }
        //
        // function testGetShoes()
        // {
        //     $store = "Boblob";
        //     $test_store = new Store($store);
        //     $test_store->save();
        //
        //     $brand = "eegads";
        //     $brand_2 = "wow";
        //     $price = "244";
        //     $price_2 = "3";
        //     $test_brand = new Shoe($brand, $price);
        //     $test_brand->save();
        //     $test_brand_2 = new Shoe($brand_2, $price_2);
        //     $test_brand_2->save();
        //
        //     $test_store->addShoe($test_brand);
        //     $test_store->addShoe($test_brand_2);
        //
        //     $this->assertEquals($test_store->getShoes(), [$test_brand, $test_brand_2]);
        // }
    }
?> -->
