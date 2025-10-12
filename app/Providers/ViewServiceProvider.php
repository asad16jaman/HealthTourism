<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Service;
use App\Models\Wishlist;
use Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //

         View::composer('*', function ($view) {

                $data =  Company::all()->first();
                if($data){
                    $view->with('company',$data);
                }else{
                    $view->with('company',false);
                }


                // $allCategories = Category::where('is-active',true)->get();
                // if($allCategories){
                //     $view->with('categories',$allCategories);
                // }else{
                //     $view->with('categories',false);
                // }

                // $allservice = Service::latest()->get();
                // $view->with('allservices',$allservice);
                

                
                
            });
    }

    public function cartJson()
    {
        return session()->get('cart', []);
    }

    public function totalPrice()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        return $total;
    }

     public function totalItems()
    {
        $cart = session()->get('cart', []);
        $count = 0;

        foreach ($cart as $item) {
            $count += $item['qty'];
        }

        return $count;
    }








}
