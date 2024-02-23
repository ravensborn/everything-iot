<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Post;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

   public function show(Order $order) {

       return view('pages.print-invoice-1', [
           'order' => $order
       ]);
   }
}
