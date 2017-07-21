<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Shoe.php";
    // require_once "src/Store.php";


    $server = 'mysql:host=localhost:8889;dbname=shoe_store_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class ShoeTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Shoe::deleteAll();
        }

        function testGetBrand()
        {
            //Arrange
            $brand = "Adidas";
            $price = "50";
            $test_shoe = new Shoe($brand, $price);

            //Act
            $result = $test_shoe->getBrand();

            //Assert
            $this->assertEquals($brand, $result);
        }

        function testSetBrand()
        {
            $brand = "Saucany";
            $price = "35";
            $test_shoe = new Shoe($brand, $price);
            $new_brand = "Paws";

            $test_shoe->setBrand($new_brand);
            $result = $test_shoe->getBrand();

            $this->assertEquals($new_brand, $result);
        }

        function testGetPrice()
        {
            $brand = "Nike";
            $price = "666";
            $test_shoe = new Shoe($brand, $price);

            $result = $test_shoe->getPrice();

            $this->assertEquals($price, $result);
        }

        function testSetNumber()
        {
            $brand = "Bans";
            $price = "39";
            $test_shoe = new Shoe($brand, $price);
            $new_price = "Jo Boi Day";

            $test_shoe->setPrice($new_price);
            $result = $test_shoe->getPrice();

            $this->assertEquals($new_price, $result);
        }

        function testGetId()
        {
            $brand = "Converse";
            $price = "34";
            $test_shoe = new Shoe($brand, $price);
            $test_shoe->save();

            $result = $test_shoe->getId();

            $this->assertTrue(is_numeric($result));
        }

        function testSave()
        {
            $brand = "Kiks";
            $price = "78";
            $test_shoe = new Shoe($brand, $price);
            $test_shoe->save();

            $executed = $test_shoe->save();

            $this->assertTrue($executed, "Brand not successfully saved to database");
        }

        function testGetAll()
        {
            $brand = "Flippers";
            $brand_2 = "Floppers";
            $price = "23";
            $price_2 = "32";
            $test_shoe = new Shoe($brand, $price);
            $test_shoe->save();
            $test_shoe_2 = new Shoe($brand_2, $price_2);
            $test_shoe_2->save();

            $result = Shoe::getAll();

            $this->assertEquals([$test_shoe, $test_shoe_2], $result);
        }

        function testDeleteAll()
        {
            $brand = "Flippers";
            $brand_2 = "Floppers";
            $price = "23";
            $price_2 = "32";
            $test_shoe = new Shoe($brand, $price);
            $test_shoe->save();
            $test_shoe_2 = new Shoe($brand_2, $price_2);
            $test_shoe_2->save();

            Shoe::deleteAll();

            $result = Shoe::getAll();
            $this->assertEquals([], $result);
        }

        function testFind()
        {
            $brand = "Grrrkiks";
            $brand_2 = "MeowKicks";
            $price = "24";
            $price_2 = "34";
            $test_shoe = new Shoe($brand, $price);
            $test_shoe->save();
            $test_shoe_2 = new Shoe($brand_2, $price_2);
            $test_shoe_2->save();

            $result = Shoe::find($test_shoe->getId());

            $this->assertEquals($test_shoe, $result);
        }




    }
?>
