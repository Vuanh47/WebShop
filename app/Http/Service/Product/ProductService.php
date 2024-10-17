<?php

namespace App\Http\Service\Product;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

 class ProductService {

    function store(){
        
    }
    public function up()
   {
      Schema::create('products', function (Blueprint $table) {
         $table->id();

         $table->string('thumb'); 
         $table->timestamps();
      });
   }

 }


 



