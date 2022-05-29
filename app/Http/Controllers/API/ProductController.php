<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ["data" => Product::select('*')->paginate(10)];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
    		$request = $request->validated();
    		if(array_key_exists('image', $request) && $request['image'] != null){
		  		$name = $request['title'].".".$request['image']->getClientOriginalExtension();
		      $path = Storage::putFileAs(
							'public/products', $request['image'], $name
					);
					$location = Storage::url('public/products/'.$name);
				}
				else{
					$location = null;
				}
				
        return Product::create([
        		'title' => $request['title'],
            'description' => $request['description'],
            'color' => $request['color'],
            'height' => $request['height'],
            'width' => $request['width'],
            'length' => $request['length'],
            'image_url' => $location
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request)
    {
    		$request = $request->validated();
    		$product = Product::where('id', $request['id'])->first();
        
        if(array_key_exists('image', $request) && $request['image'] != null){
        	$status = Storage::delete(str_replace("storage", "public", $product->image_url));
		  		$name = $request['title'].".".$request['image']->getClientOriginalExtension();
		      $path = Storage::putFileAs(
							'public/products', $request['image'], $name
					);
					$location = Storage::url('public/products/'.$name);
					$product->image_url = $location;
				}
				
        
        $product->title = $request['title'];
        $product->description = $request['description'];
        $product->color = $request['color'];
        $product->height = $request['height'];
        $product->width = $request['width'];
        $product->length = $request['length'];
        
        $product->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
    		$product = Product::where('id', $request->get('id'))->first();
        
        $status = Storage::delete(str_replace("storage", "public", $product->image_url));
        
        if($status == 1)
        	$product->delete();
    }
}
