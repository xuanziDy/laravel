<?php

namespace App\Providers;

use App\Exceptions\CustomValidator;
use App\Logics\UserLogic;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //注册自定义验证
        $this->app['validator']->resolver(function($translator, $data, $rules, $messages)
        {
            return new CustomValidator($translator, $data, $rules, $messages);
        });



    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //用户逻辑
        $this->app->singleton('user.logic', function($app){
            return new UserLogic();
        });

    }
}
