<?php

use App\http\Request;
use Controllers\BlogController;
use Controllers\TagsController;
use Dotenv\Dotenv;
use eftec\bladeone\BladeOne;
use Model\Database;
use Model\Posts;
use Model\PostTags;
use Model\Tags;
use Src\Router;

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__ . "/../vendor/autoload.php";

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$blade = new BladeOne(__DIR__ . "/../views", __DIR__ . "/../cache");
$dbConn = (new Database())->getConnection();

$request = Request::getFromGlobal();

Router::get("/home", function() use ($blade, $dbConn, $request) {
    $response = (new BlogController(
        new Posts($dbConn),
        new PostTags($dbConn),
        $request
    ))->getAllBlogs();

    $view = $response->getContent();

    echo $blade->run($view->template, $view->data);
});

Router::get("/home/delete", function() use ($dbConn, $request) {
    $response = (new BlogController(
        new Posts($dbConn),
        new PostTags($dbConn),
        $request
    ))->deleteBlog();

    $response->send();
});

Router::get("/add", function() use ($blade, $dbConn, $request) {
    $response = (new TagsController(
        new Tags($dbConn),
        $request
    ))->getAllTags();

    $view = $response->getContent();
    echo $blade->run($view->template, $view->data);
});

Router::post("/add/newtag", function() use ($dbConn, $request) {
    $response = (new TagsController(
        new Tags($dbConn),
        $request
    ))->addTag();

    $response->send();
});

Router::post("/add/post", function() use ($dbConn, $request) {
    $response = (new BlogController(
        new Posts($dbConn),
        new PostTags($dbConn),
        $request
    ))->saveNewBlog();

    $response->send();
});

Router::get("/home/search", function() use ($blade, $dbConn, $request) {
    $response = (new BlogController(
        new Posts($dbConn),
        new PostTags($dbConn),
        $request
    ))->search();

    $view = $response->getContent();
    echo $blade->run($view->template, $view->data);
});

Router::get("/edit", function() use ($blade, $request, $dbConn) {
    $response = (new BlogController(
        new Posts($dbConn),
        new PostTags($dbConn),
        $request
    ))->getBlog();

    $view = $response->getContent();
    echo $blade->run($view->template, $view->data);
});

Router::get("/home/edit", function() use ($request, $dbConn) {
    $response = (new BlogController(
        new Posts($dbConn),
        new PostTags($dbConn),
        $request
    ))->edit();

    $response->send();
});

Router::run();