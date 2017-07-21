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

    // use Symfony\Component\HttpFoundation\Request;
    // Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll(), 'shoes' => Shoe::getAll()));
    });

    $app->get("/stores", function() use ($app) {
        $locations = Store::getAll();
        $location_check = array();

        foreach ($locations as $location) {
            if ($location->getStore() !== $_GET['store']) {
                array_push($location_check, $location);
            } else {
                alert("Thist store has already been entered!");
            }
        }

        return $app['twig']->render('stores.html.twig', array('stores' => $location_check));
    });

    $app->post("/stores", function() use ($app) {
        $location = $_POST['store'];
        $store = new Store($location);
        $store->save();
        return $app['twig']->render('stores.html.twig', array('stores' => $location, 'stores' => Store::getAll()));
    });


    // $app->post("/stores", function() use ($app) {
    //     $brand = $_POST['brand'];
    //     $price = $_POST['price'];
    //     $shoe = new Shoe($brand, $price);
    //     $shoe->save();
    //     return $app['twig']->render('stores.html.twig', array('stores' => $store));
    // });


    return $app;
?>
