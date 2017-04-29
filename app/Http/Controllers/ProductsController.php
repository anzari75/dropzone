<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// nk panggil model products
use App\Product;
use App\Area;
use App\brands;
use App\Category;
use App\Subcategory;
use App\State;
use App\Http\Requests\CreateProductRequest;




class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $products = Product::with('brand','subcategory','area','user');

        if(!empty($request->search_anything)){

            $search_anything = $request->search_anything;

            $products = $products->where(function ($query) use ($search_anything) {
                $query->orWhere('product_name','like','%'.$search_anything.'%')
                ->orWhere('product_discription','like','%'.$search_anything.'%');

            });
        }



        $products = $products->paginate(5);
        $brands = brands::pluck('brand_name','id');
        $categories = Category::pluck('category_name','id');
        $states = State::pluck('state_name','id');

        return view ('products.index',compact('products','brands','categories','states'));







    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //variable baru = nama model::pluck('id', 'brand_name');
        $states = State::pluck('state_name', 'id');
        $areas = Area::pluck('area_name', 'id');
        $brands = brands::pluck('brand_name', 'id');
        $categories = Category::pluck('category_name', 'id');
        $subcategories = Subcategory::pluck('subcategory_name', 'id');

        //tolong paparkan create.blade.php
        return view('products.create', compact('brands' , 'areas' , 'subcategories', 'states', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $product = new Product;
        $product->product_name = $request->product_name;
        $product->product_discription = $request->product_desc;
        $product->product_price = $request->price;
        $product->brand_id = $request->brand_id;
        $product->area_id = $request->area_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->condition = $request->condition;

        //dapatkan current user id
        $product->user_id = auth()->id();

        // if have file to upload 
        if ($request->hasFile('product_image')) {

            $path = $request->product_image->store('images');

            //save product image name
            $product->product_image = $request->product_image->hashName();
    
        }
        $product->save();


        flash ('Your Product Submitted')->success();

        //selepas berjaya simpan kembali ke senarai product 

        return redirect()->route('products.index');




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dapatkan maklumat product
        $product = Product::find($id);
        $states = State::pluck('state_name', 'id');
        $areas = Area::pluck('area_name', 'id');
        $brands = brands::pluck('brand_name', 'id');
        $categories = Category::pluck('category_name', 'id');
        $subcategories = Subcategory::pluck('subcategory_name', 'id');
        // get area based on previous 
        $areas= $this->getStateAreas($product->area->state_id);
        $subcategories= $this->getSubcategory($product->subcategory->category_id);



        //tolong paparkan create.blade.php
        return view('products.edit', compact('brands' , 'areas' , 'subcategories', 'states', 'categories','product','areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);



        $product->product_name = $request->product_name;
        $product->product_discription = $request->product_desc;
        $product->product_price = $request->price;
        $product->brand_id = $request->brand_id;
        $product->area_id = $request->area_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->condition = $request->condition;

        //dapatkan current user id
        

        // if have file to upload 
        if ($request->hasFile('product_image')) {

            $path = $request->product_image->store('images');

            //save
           $product->product_image = $request->product_image->hashName();
    
        }
        $product->save();


        flash ('Your Product Updated')->success();

        //selepas berjaya simpan kembali ke senarai product 

        return redirect()->route('products.edit',$product->id);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function getStateAreas($state_id){

        $areas = Area::whereStateId($state_id)->pluck('area_name','id');
        return $areas;
        //echo 'dah sampai daaa ke controller'.$state_id;
    }

     public function getSubcategory($category_id){

        $subcategories = Subcategory::whereCategoryId($category_id)->pluck('subcategory_name','id');
        return $subcategories;
        //echo 'dah sampai daaa ke controller'.$state_id;
    }


}
