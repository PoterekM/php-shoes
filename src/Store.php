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




        
}
?>
