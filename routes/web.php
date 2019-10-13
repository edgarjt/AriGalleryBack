<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    //return $router->app->version();
    return "AryGallery";
});
$router->get('/users', [
    'uses' => 'UsuariosController@getUsers'
]);

$router->post('/addUsers', [
    'uses' => 'UsuariosController@addUsers'
]);

$router->post('/login', [
   'uses' => 'UsuariosController@login'
]);

$router->post('/delete', [
    'uses' => 'UsersController@delete'
]);

$router->post('/update',[
    'uses' => 'UsersController@update'
]);

//Rutes Obras

$router->get('/obras', 'ObrasController@allObras');
$router->post('/obras', 'ObrasController@addWorks');
$router->post('/obrasUpdate', 'ObrasController@updateWorks');

//Rutes Esculptures
$router->get('/esculturas', 'EsculturasController@allEsculturas');
$router->post('/esculturasclave', 'EsculturasController@keyEsculturas');

//rutes Notices
$router->get('/ultimasnoticias', 'NoticesController@ultimateNotices');

//Tutes Events
$router->get('ultimoseventos', 'EventosController@ultimateEvents');