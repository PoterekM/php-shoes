<?php
class Shoe
{
    private $brand;
    private $price;
    private $id;
    function __construct($brand, $price, $id = null)
    {
        $this->brand = $brand;
        $this->price = $price;
        $this->id = $id;
    }
    function getBrand()
    {
        return $this->brand;
    }
    function setBrand($new_brand)
    {
        $this->brand = (string) $new_brand;
    }
    function getPrice()
    {
        return $this->price;
    }
    function setPrice($new_price)
    {
        $this->price = (string) $new_price;
    }
    function getId()
    {
        return $this->id;
    }
    function save()
    {
        $executed = $GLOBALS['DB']->exec("INSERT INTO shoes (brand, price) VALUES ('{$this->getBrand()}', '{$this->getPrice()}')");
        if ($executed) {
            $this->id = $GLOBALS['DB']->lastInsertId();
            return true;
        } else {
            return false;
        }
    }
    static function getAll()
    {
        $returned_shoes = $GLOBALS['DB']->query("SELECT * FROM shoes;");
        $shoes = array();
        foreach($returned_shoes as $shoe) {
            $brand = $shoe['brand'];
            $price = $shoe['price'];
            $id = $shoe['id'];
            $new_shoe= new Shoe($brand, $price, $id);
            array_push($shoes, $new_shoe);
        }
        return $shoes;
    }
    static function deleteAll()
    {
        $executed = $GLOBALS['DB']->exec("DELETE FROM shoes;");
        if ($executed) {
            return true;
        } else {
            return false;
        }
    }
    static function find($search_id)
    {
        $found_shoe = null;
        $returned_shoes = $GLOBALS['DB']->prepare("SELECT * FROM shoes WHERE id = :id");
        $returned_shoes->bindParam(':id', $search_id, PDO::PARAM_STR);
        $returned_shoes->execute();
        foreach($returned_shoes as $shoe) {
            $brand = $shoe['brand'];
            $price = $shoe['price'];
            $id = $shoe['id'];
            if ($id == $search_id) {
                $found_shoe = new Shoe($brand, $price, $id);
            }
        }
        return $found_shoe;
    }
    function update($new_brand)
    {
        $executed = $GLOBALS['DB']->exec("UPDATE shoes SET brand = '{$new_brand}' WHERE id = {$this->getId()};");
        if ($executed) {
            $this->setBrand($new_brand);
            return true;
        } else {
            return false;
        }
    }

    // function addStore($store_name)
    // {
    //     $executed = $GLOBALS['DB']->exec("INSERT INTO shoes_stores (shoe_id, store_id) VALUES ({$this->getId()}, {$store->getId()});");
    //     if ($executed) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
    //
    // function getStores()
    // {
    //     $returned_stores = $GLOBALS['DB']->query("SELECT stores.* FROM shoes JOIN shoes_stores ON (shoes_stores.shoes_id = shoes.id) JOIN students ON (stores.id = shoes_stores.store_id) WHERE store.id = {$this->getId()};");
    //     $stores = array();
    //     foreach($returned_stores as $store) {
    //         $store_name = $store['store'];
    //         $id = $store['id'];
    //         $new_store = new Store($store_name, $id);
    //         array_push($stores, $new_store);
    //     }
    //     return $stores;
    // }



}
?>
