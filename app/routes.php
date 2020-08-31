<?php

use App\Middleware\AuthMiddleware;

$app->get('/', 'HomeController:index')->setName('home');

$app->group('/postagem', function($app){
    $app->map(['GET','POST'],'/criar', 'PostController:create')->setName('post.create');
    
    $app->get('/deletar', 'PostController:delete')->setName('post.delete');
    
    $app->get('/edit/{id}', 'PostController:edit')->setName('post.edit');
    $app->post('/edit/{id}', 'PostController:update');
})->add(new AuthMiddleware($container));

$app->group('/usuario', function($app){
    $app->map(['GET','POST'],'/avatar', 'UserController:avatar')->setName('user.avatar');
});

$app->group('/auth', function($app){
    $app->map(['GET','POST'],'/login', 'AuthController:login')->setName('auth.login');
    $app->map(['GET','POST'],'/registrar', 'AuthController:register')->setName('auth.register');
    $app->get('/confirmacao', 'AuthController:confirmation')->setName('auth.confirmation');
    $app->get('/reenviar', 'AuthController:resend')->setName('auth.resend');
    $app->get('/logout', 'AuthController:logout')->setName('auth.logout');
});

