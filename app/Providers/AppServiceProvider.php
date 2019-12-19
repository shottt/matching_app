<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //<head>の中身
        Blade::component('components.head.head', 'head');

        //<header>の中身 変数を渡してifつかなかったのでコメントアウト　
        //@if ({{ $patter}} === 1)　これはできない  <?php if (<?php となるため
        //Blade::component('components.header.header', 'header');
        Blade::include('includes.header.header', 'header');


        Blade::include('includes.footer.footer', 'footer');

        // 商用環境以外だった場合、SQLログを出力させる
        // if(config('app.env') !== 'production'){
        //     \DB::listen(function ($query){
        //         \Log::info("Query Time:{$query->time}s] $query->sql");
        //     });
        // }
    }
}
