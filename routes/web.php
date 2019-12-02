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
    'uses' => 'UsuariosController@delete'
]);

$router->post('/update',[
    'uses' => 'UsuariosController@update'
]);
$router->post('/userswhere',[
    'uses' => 'UsuariosController@userwhere'
]);

//Rutes Obras

$router->get('/obras', 'ObrasController@allObras');
$router->post('/obras', 'ObrasController@addWorks');
$router->post('/obrasUpdate', 'ObrasController@updateWorks');
$router->get('/obrasQR', 'ObrasController@QrWorks');
$router->post('/obrasDelete', 'ObrasController@deleteWorks');
$router->post('/obrasWhere', 'ObrasController@whereWorks');
$router->post('/obrasAutor', 'ObrasController@AutorObras');
$router->get('/obrasLimit', 'ObrasController@LimitObras');
$router->post('/search', 'ObrasController@searchObras');

//Rutes Esculptures
$router->get('/esculturas', 'EsculturasController@allEsculturas');
$router->post('/addesculturas', 'EsculturasController@addEsculturas');
$router->post('/esculturasclave', 'EsculturasController@keyEsculturas');
$router->post('/esculturasupdate', 'EsculturasController@updateEsculturas');
$router->post('/esculturasdelete', 'EsculturasController@deleteEsculturas');
$router->post('/esculturasAutor', 'EsculturasController@AutorEsculturas');

//rutes Notices
$router->get('/ultimasnoticias', 'NoticesController@ultimateNotices');
$router->post('/noticiaAdd', 'NoticesController@addNotices');
$router->post('/noticiaUpdate', 'NoticesController@updateNotices');
$router->post('/noticiaDelete', 'NoticesController@DeleteNotices');

//rutes Events
$router->get('/ultimoseventos', 'EventosController@ultimateEvents');
$router->post('/addEventos', 'EventosController@addEvents');
$router->post('/updateEventos', 'EventosController@updateEvents');
$router->post('/deleteEventos', 'EventosController@deleteEvents');

//firmas
$router->get('/firmas', 'FirmasController@allFirmas');

//Autores
$router->get('/autores', 'AutoresController@allAutores');
$router->post('/addautores', 'AutoresController@allAutoresAdd');
$router->post('/artistUpdate', 'AutoresController@AutoresUpdate');
$router->post('/artistDelete', 'AutoresController@AutoresDelete');

//Comments
$router->get('/comments', 'CommentsController@comments');
$router->post('/AddComments', 'CommentsController@commentsAdd');
$router->post('/DeleteComments', 'CommentsController@commentsDelete');

//Productos
$router->get('/products', 'ProductsController@ProductsAll');
$router->post('/AddProducts', 'ProductsController@ProductsAdd');
$router->post('/UpdateProducts', 'ProductsController@ProductsUpdate');
$router->post('/DeleteProducts', 'ProductsController@ProductsDelete');

//Galeria Virtuaal
$router->get('/galeriav', 'GalleryController@GaleriavAll');
$router->post('/AddGallery', 'GalleryController@GalleryAdd');
$router->post('/UpdateGallery', 'GalleryController@GalleryUpdate');
$router->post('/DeleteGallery', 'GalleryController@GalleryDelete');