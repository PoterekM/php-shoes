<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Shoe.php";
    require_once __DIR__."/../src/Store.php";

    $server = 'mysql:host=localhost:8889;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app['debug'] = true;

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll(), 'shoes' => Shoe::getAll()));
    });

    $app->get("/stores", function() use ($app) {
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    $app->post("/stores", function() use ($app) {
        $location = $_POST['store'];
        $store = new Store($location);
        $store->save();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    $app->get("/stores_empty", function() use ($app) {
        Store::deleteAll();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    $app->get("store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'shoes' => $store->getShoes(), 'all_shoes' => Shoe::getAll()));
    });

    $app->patch("/store/{id}", function ($id) use ($app) {
        $location = $_POST['location'];
        $store = Store::find($id);
        $store->update($location);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'shoes' => $store->getShoes(), 'all_shoes' => Shoe::getAll()));
    });

    $app->get("store/{id}/modify", function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render('modify_store.html.twig', array('store' => $store, 'shoes' => $store->getShoes(), 'all_shoes' => Shoe::getAll()));
    });

    $app->delete("/store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store->delete();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    $app->post("/add_shoes", function() use ($app) {
        $store = Store::find($_POST['store_id']);
        $shoe = Shoe::find($_POST['shoe_id']);
        $store->addShoe($shoe);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'stores' => Store::getAll(), 'shoes' => $store->getShoes(), 'all_shoes' => Shoe::getAll()));
    });

// doin the shoes thang
    $app->get("/shoes", function() use ($app) {
        return $app['twig']->render('shoes.html.twig', array('shoes' => Shoe::getAll()));
    });

    $app->post("/shoes", function() use ($app) {
        $brand = $_POST['brand'];
        $price = $_POST['price'];
        $shoe = new Shoe($brand, $price);
        $shoe->save();
        return $app['twig']->render('shoes.html.twig', array('shoes' => Shoe::getAll(), 'shoe' => $shoe));
    });

    $app->get("/remove_shoes", function() use ($app) {
        Shoe::deleteAll();
        return $app['twig']->render('shoes.html.twig', array('shoes' => Shoe::getAll()));
    });

    $app->get("shoe/{id}", function($id) use ($app) {
        $shoe = Shoe::find($id);
        return $app['twig']->render('shoe.html.twig', array('shoe' => $shoe, 'stores' => $shoe->getStores(), 'all_stores' => Store::getAll()));
    });

    $app->post("/add_stores", function() use ($app) {
        $shoe = Shoe::find($_POST['shoe_id']);
        $store = Store::find($_POST['store_id']);
        $shoe->addStore($store);
        return $app['twig']->render('shoe.html.twig', array('shoe' => $shoe, 'shoes' => Shoe::getAll(), 'stores' => $shoe->getStores(), 'all_stores' => Store::getAll()));
    });

    return $app;
?>
