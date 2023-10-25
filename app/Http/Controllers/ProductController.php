<?php

namespace App\Http\Controllers;
use App\Models\Product;
// use Illuminate\Http\Request;        [Part-2]
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;



class ProductController extends Controller  
{
    /**
     * Display a listing of the resource.
     */
    public function index() //Request $request [Part-2] no need
    {
        // return Product::orderBy('id', 'desc')->paginate(5);

    /* ----------------------------------------------------------------------------------------------------- */
                                                                                            //[ Part-1 ]

        // if($request->search) {
        //     return Product::where('name', 'like', '%' . $request->search . '%')
        //     ->orderBy('id', 'desc')->paginate(5);
        // } else {
        //     return Product::orderBy('id', 'desc')->paginate(5);
        // }

    /* ------------------------------------------------------------------------------------------------------ */
                                                                                                //[ Part-2 ]

        // if(request('search')) {
        //     return Product::where('name', 'like', '%' . request('search') . '%')
        //     ->orderBy('id', 'desc')->paginate(5);
        // } else {
        //     return Product::orderBy('id', 'desc')->paginate(5);
        // }

    /* ------------------------------------------------------------------------------------------------------ */
                                                                                                //[Part-3] Part2 short-form

        // $products = Product::query();
        // if(request('search')) {
        //     return $products->where('name', 'like', '%' . request('search') . '%')
        //     ->orderBy('id', 'desc')->paginate(5);
        // } else {
        //     return $products->orderBy('id', 'desc')->paginate(5);
        // }

    /* ---------------------------------------------------------------------------------------------------------- */
                                                                                                //[Part-4] Part3 short form [1 line]

        return Product::when(request('search'), function($query){
            $query->where('name', 'like', '%' . request('search') . '%');
        })->orderBy('id', 'desc')->paginate(5);





    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        // $post = new product();
        // $post->name = $request->name;
        // // $post->name = $request['name'];
        // $post->name = $request->price;
        // // $post->name = $request['price'];
        // $post->save();

        // product::create([
        //     'name' => $request->name,
        //     'price' => $request->price
        // ]);

        /*---------------------------------------------------------------------------------    */

        // $validator = Validator::make(
        //     $request->all(),
        //     [
        //         'name' => 'required|string',
        //         'price' => 'required|numeric',
        //     ]
        // );
    
        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()], 400);
        // }

        // $product = Product::create($request->only('name', 'price'));
        // return response()->json($product, 200);

        /* --------------------------------------------------------------------------------------*/
        

        // // Create and store the product using the create method
        // $product = Product::create($request->only('name', 'price'));

        // // You can return the created product as a JSON response
        // return response()->json($product, 200);
    
        // $product = Product::create($request->only('name', 'price'));
        // return response()->json($product, 200);


        /*  Old Laravel code from YouTube not work   */ 

        // $request->validate([
        //     'name' => 'required|string',
        //     'price' => 'required|numeric'
        // ]);
 
        // $product = Product::create($request->only('name','price'));
        // return $product;
        /* ------------------------------------------------------------------------------------------- */

        $product = Product::create($request->only('name', 'price'));
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {


        // $product = Product::find($id);
        return $product;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {

        /*  Correct  */
        // $validator = Validator::make($request->all(), [
        //     'name' => 'string',
        //     'price' => 'numeric',
        // ]);
    
        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()], 400);
        // }
    
        // $product = Product::find($id);
    
        // if (!$product) {
        //     return response()->json(['error' => 'Product not found'], 404);
        // }
    
        // // Update the product if it exists
        // $product->fill($request->only('name', 'price'));
        // $product->save();
    
        // return response()->json($product, 200);
        /* -------------------------------------------------------------------------------------------- */

        // $product = Product::find($id);

            if (!$product) {
                return response()->json(['error' => 'Product not found'], 404);
            }
        
            $product->update($request->only('name', 'price'));
        
            return response()->json($product, 200);


        /* ----------------------------------------------- */
        // $product = Product::find($id);
        // $product->update();

        //  OR

        // $product = Product::find($id);
        // $product->name = $request->name;
        // $product->price = $request->price;
        // $product-save();


        //    OR
        $product = Product::find($id);
        $product->update($request->only('name','price'));
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // $product = Product::find($id);
        $product->delete();
        return $product;
    }
}
