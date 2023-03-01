<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ProductItem;
use App\Models\ProductType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function getProductTypes(Request $request)
    {
        $productTypes = ProductType::with('items')->get();
        return response()->json([
            'productTypes' => $productTypes
        ]);
    }

    public function addProductType(Request $request)
    {


        $product = new  ProductType();
        $product->name = $request->name;
        $product->description = $request->description;

        if ($request->file('image')) {
            $picture =  $request->file('image');
            $imageName = $picture->getClientOriginalName();
            $imagePath = storage_path('app/public/product_images/');
            $picture->move($imagePath, $imageName);
            $path = "storage/product_images/" . $imageName;
            $product->image = $path;
        }
        $product->save();

        session()->flash('success', 'product type created successfully');
        return redirect()->back();
    }

    public function updateProductType(Request $request)
    {

        $product = ProductType::where('id', $request->id)->first();
        $product->name = $request->name;
        $product->description = $request->description;


        if ($request->file('image')) {
            $picture =  $request->file('image');
            $imageName = $picture->getClientOriginalName();
            $imagePath = storage_path('app/public/product_images/');
            $picture->move($imagePath, $imageName);
            $path = "storage/product_images/" . $imageName;
            $product->image = $path;
        }

        $product->save();
        session()->flash('success', 'product type updated successfully');
        return redirect()->back();
    }

    public function deleteProductType(Request $request)
    {
        $product = ProductType::where('id', $request->id)->delete();
        session()->flash('success', 'product type deleted successfully');
        return redirect()->back();
    }

    public function getProductItems(Request $request)
    {
        $productItems = ProductItem::where('product_type_id', $request->product_type_id)->get();
        return response()->json([
            '$productItems' => $productItems
        ]);
    }

    public function addProductItems(Request $request)
    {

        foreach ($request->serial_number as $number) {
            $productItem = new  ProductItem();
            $productItem->serial_number = $number;
            $productItem->product_type_id = $request->product_type_id;
            $productItem->save();
        }


        session()->flash('success', 'product items added successfully');
        return redirect()->back();
    }

    public function updateProductItem(Request $request)
    {


        $item = ProductItem::where('id', $request->id)->first();
        $item->serial_number = $request->serial_number;
        $item->save();

        session()->flash('success', 'product item updated successfully');
        return redirect()->back();
    }

    public function deleteProductItem(Request $request)
    {
        $product = ProductItem::where('id', $request->id)->delete();
        session()->flash('success', 'product items deleted successfully');
        return redirect()->back();
    }

    public function productItemSold(Request $request)
    {
        $item = ProductItem::where('id', $request->id)->first();
        if ($item->is_sold) {
            $item->is_sold = false;
        } else {
            $item->is_sold = true;
        }

        $item->save();

        return response()->json([
            'success' => 'Product Item updated Successfully',
        ]);
    }
}
