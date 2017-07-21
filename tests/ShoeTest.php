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
        function testGetBrand()
        {
            //Arrange
            $brand = "Adidas";
            $price = "50";
            $test_brand = new Shoe($brand, $price);

            //Act
            $result = $test_brand->getBrand();

            //Assert
            $this->assertEquals($brand, $result);
        }

        function testSetBrand()
        {
            $brand = "Saucany";
            $price = "35";
            $test_brand = new Shoe($brand, $price);
            $new_brand = "Paws";

            $test_brand->setBrand($new_brand);
            $result = $test_brand->getBrand();

            $this->assertEquals($new_brand, $result);
        }

        function testGetPrice()
        {
            $brand = "Nike";
            $price = "666";
            $test_brand = new Shoe($brand, $price);

            $result = $test_brand->getPrice();

            $this->assertEquals($price, $result);
        }

        function testSetNumber()
        {
            $brand = "Bans";
            $price = "39";
            $test_brand = new Shoe($brand, $price);
            $new_price = "Jo Boi Day";

            $test_brand->setPrice($new_price);
            $result = $test_brand->getPrice();

            $this->assertEquals($new_price, $result);
        }

        function testGetId()
        {
            $brand = "Converse";
            $price = "34";
            $test_brand = new Shoe($brand, $price);
            $test_brand->save();

            $result = $test_brand->getId();

            $this->assertTrue(is_numeric($result));
        }

        function testSave()
        {
            $brand = "Kiks";
            $price = "78";
            $test_brand = new Shoe($brand, $price);
            $test_brand->save();

            $executed = $test_brand->save();

            $this->assertTrue($executed, "Brand not successfully saved to database");
        }
    }
?>
