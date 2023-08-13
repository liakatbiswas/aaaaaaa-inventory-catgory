<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    function productPage()
    {
        return view('pages.dashboard.product-page');
    }


    function productList(Request $request)
    {
        $user_id = $request->header('id');
        return Product::where('user_id', '=', $user_id)->get();
    }


    function productCreate(Request $request)
    {
        $user_id = $request->header('id');


        // Creating file name & path
        $thumb = $request->file('thumbnail');
        $t = time();
        $file_name = $thumb->getClientOriginalName();
        $thumb_name = "{$user_id}-{$t}-{$file_name}";
        $thumb_url = "uploads/{$thumb_name}";

        // Upload file
        $thumb->move(public_path('uploads'), $thumb_name);


        return Product::create([
            'user_id' => $user_id,
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'unit' => $request->input('unit'),
            'thumbnail' => $thumb_url
        ]);
    }

    function productDelete(Request $request)
    {
        $user_id = $request->header('id');
        $product_id = $request->input('id');
        $filePath = $request->input('file_path');
        File::delete($filePath);
        return Product::where('id', '=', $product_id)
            ->where('user_id', '=', $user_id)->delete();
    }

    function productUpdate(Request $request)
    {
        $user_id = $request->header('id');
        $product_id = $request->input('id');

        if ($request->hasFile('thumbnail')) {
            // Creating file name & path
            $thumb = $request->file('thumbnail');
            $t = time();
            $file_name = $thumb->getClientOriginalName();
            $thumb_name = "{$user_id}-{$t}-{$file_name}";
            $thumb_url = "uploads/{$thumb_name}";
            $thumb->move(public_path('uploads'), $thumb_name);

            $filePath = $request->input('file_path');
            File::delete($filePath);

            return Product::where('id', '=', $product_id)->where('user_id', '=', $user_id)->update([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'unit' => $request->input('unit'),
                'thumbnail' => $thumb_url,
                'category_id' => $request->input('category_id'),
            ]);
        }else{
            return Product::where('id', '=', $product_id)->where('user_id', '=', $user_id)->update([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'unit' => $request->input('unit'),
                'category_id' => $request->input('category_id'),
            ]);
        }
    }

    function productByID(Request $request)
    {
        $product_id = $request->input('id');
        $user_id = $request->header('id');
        return Product::where('id', '=', $product_id)->where('user_id', '=', $user_id)->first();
    }
}
