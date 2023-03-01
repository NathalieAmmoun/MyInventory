<?php

namespace App\Http\Controllers;

use App\Models\ProductItem;
use App\Models\ProductType;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

   public function dashboard()
   {
      $productTypes = ProductType::with('items')->paginate(5);
      View::share(['productTypes' => $productTypes, 'action' => 'product']);
      return view('dashboard');
   }

   public function productItems(Request $request)
   {
      if ($request->keyword) {
         $items = ProductItem::where('product_type_id', $request->product_type_id)->where('serial_number', 'like', "%$request->keyword%")->paginate(5);
      } else {
         $items = ProductItem::where('product_type_id', $request->product_type_id)->paginate(5);
      }

      View::share(['items' => $items, 'action' => 'item', 'productId' => $request->product_type_id]);
      return view('dashboard');
   }
}
