<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Shoe.php";
    require_once __DIR__."/../src/Store.php";

    $server = 'mysql:host=localhost:8889;dbname=shoe_store';
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
        return $app['twig']->render('stores.html.twig', array('stores' => $location, 'stores' => Store::getAll()));
    });

    $app->get("/stores_empty", function() use ($app) {
        Store::deleteAll();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    ///not sure if get is appropriate here in the stores empty

    $app->get("store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'shoes' => $store->getShoes(), 'stores' => Store::getAll(), 'all_shoes' => Shoe::getAll()));
    });

    $app->post("/add_shoes", function() use ($app) {
        $store = Store::find($_POST['store_id']);
        $shoe = Shoe::find($_POST['shoe_id']);
        $store->addShoe($shoe);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'stores' => Store::getAll(), 'stores' => Store::getAll(), 'shoes' => $store->getShoes(), 'all_shoes' => Shoe::getAll()));
    });

    $app->get("/shoes", function() use ($app) {
        return $app['twig']->render('shoes.html.twig', array('shoes' => Shoe::getAll()));
    });

    $app->post("/shoes", function() use ($app) {
        $brand = $_POST['brand'];
        $price = $_POST['price'];
        $shoe = new Shoe($brand, $price);
        $shoe->save();
        return $app['twig']->render('shoes.html.twig', array('shoes' => Shoe::getAll(), 'shoe' => $brand));
    });



    // $app->post("store/{id}", function() use ($app) {
    //     $store = $_POST['store'];
    //     return $app['twig']->render('store.html.twig', array('stores' => Store::getAll(), 'store' => $store));
    // });

    // $app->post("/add_shoe")



    // $app->post("/stores", function() use ($app) {
    //     $brand = $_POST['brand'];
    //     $price = $_POST['price'];
    //     $shoe = new Shoe($brand, $price);
    //     $shoe->save();
    //     return $app['twig']->render('stores.html.twig', array('stores' => $store));
    // });


    return $app;
?>
