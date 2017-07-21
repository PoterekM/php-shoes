<?php
class Store
{
    private $store;
    private $id;

    function __construct($store, $id = null)
    {
        $this->store = $store;
        $this->id = $id;
    }


    function getStore()
    {
        return $this->store;
    }

    function setStore($new_store)
    {
        $this->store = (string) $new_store;
    }


    function getId()
    {
        return $this->id;
    }

    function save()
    {
        $executed = $GLOBALS['DB']->exec("INSERT INTO stores (store) VALUES ('{$this->getStore()}')");
        if ($executed) {
            $this->id = $GLOBALS['DB']->lastInsertId();
            return true;
        } else {
            return false;
        }
    }

    static function getAll()
    {
        $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
        $stores = array();
        foreach($returned_stores as $store) {
            $store_name = $store['store'];
            $id = $store['id'];
            $new_store = new Store($store_name, $id);
            array_push($stores, $new_store);
        }
        return $stores;
    }

    static function deleteAll()
    {
        $executed = $GLOBALS['DB']->exec("DELETE FROM stores;");
        if ($executed) {
            return true;
        } else {
            return false;
        }
    }

    static function find($search_id)
    {
        $found_store = null;
        $returned_stores = $GLOBALS['DB']->prepare("SELECT * FROM stores WHERE id = :id");
        $returned_stores->bindParam(':id', $search_id, PDO::PARAM_STR);
        $returned_stores->execute();
        foreach($returned_stores as $store) {
            $store_name = $store['store'];
            $id = $store['id'];
            if ($id == $search_id) {
                $found_store = new Store($store_name, $id);
            }
        }
        return $found_store;
    }





}
?>
