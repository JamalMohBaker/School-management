<?php

use App\Http\Middleware\EnuserUserType;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        
    )
    ->withMiddleware(function ($middleware) {
    $middleware->alias([
        'auth.type' => \App\Http\Middleware\EnuserUserType::class,
        'check.user.exam' => \App\Http\Middleware\CheckUserExam::class,
    ]);
    })
    // ->withMiddleware(function ($middleware) {
    //     $middleware->append(\App\Http\Middleware\EnuserUserType::class);
    // })
    // ->withMiddleware([  
    //     //
    //     'auth.type' => EnuserUserType::class,
        
    // ])
    ->withExceptions(function (Exceptions $exceptions) {
        //
        
    })->create();
