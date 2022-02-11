<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::orderBy('created_at','Desc')->get();
        $count=$products->count();
        $published=Product::where('status','1')->count();
        $draft=Product::where('status','0')->count();
        $deleted=Product::onlyTrashed()->count();
        $product_categories=ProductCategory::all();

        Session::put('count',$count);
        Session::put('published',$published);
        Session::put('draft',$draft);
        Session::put('deleted',$deleted);
        $trash=false;

        $i=0;
        foreach ($product_categories as $category)
        {
            $count=Product::where('product_category',$category->id)->count();
            $category->setAttribute('count',$count);
            $product_categories[$i]=$category;
            $i++;
        }



        return view('products.index',compact('products','product_categories','trash'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product_categories=ProductCategory::all();
        return view('products.create',compact('product_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_title'=>'required',
            'subtitle'=>'required',
            'regular_price'=>'required',
            'status'=>'required',
            'tax_class'=>'required',
            'language'=>'required',
            'popular'=>'required',
            'product_description'=>'required',
            'product_image'=>'required',
        ]);
        $product=new Product();
        $product->product_title=$request->get('product_title');
        $product->product_subtitle=$request->get('subtitle');
        $product->regular_price=$request->get('regular_price');
        $product->promotional_price=$request->get('promotional_price');
        $product->status=$request->get('status');
        $product->tax_class=$request->get('tax_class');
        $product->language=$request->get('language');
        $product->popular=$request->get('popular');
        $product->product_description=$request->get('product_description');
        if($request->hasFile('product_image')){
            $image = $request->product_image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $image->move('public/img/products',$filename);
            $product->product_image = $filename;

            /*$image = $request->file('product_image');
            $img = time().'.'.$image->getClientOriginalExtension();
            $product->product_image = $img; */
//            $destinationPath = public_path('/img/products');
//            $img = Image::make($image->getRealPath());
//            $img->resize(100, 100, function ($constraint) {
//                $constraint->aspectRatio();
//            })->save($destinationPath.'/'.$input['imagename']);
//
//            $destinationPath = public_path('/img/products');
//            $image->move($destinationPath, $input['imagename']);

        }


        if ($request->get('new_category')==null) {
            $product->product_category = $request->get('category');

        }
        else
        {
            $category=new ProductCategory();
            $category->name=$request->get('new_category');
            $category->save();
            $product->product_category =$category->id;
        }
        $product->save();
        return redirect(url('/products'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $product_categories=ProductCategory::all();
        return view('products.edit',compact('product','product_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_title'=>'required',
            'subtitle'=>'required',
            'regular_price'=>'required',
            'status'=>'required',
            'tax_class'=>'required',
            'language'=>'required',
            'popular'=>'required',
            'product_description'=>'required',
        ]);
        $product->product_title=$request->get('product_title');
        $product->product_subtitle=$request->get('subtitle');
        $product->regular_price=$request->get('regular_price');
        $product->promotional_price=$request->get('promotional_price');
        $product->status=$request->get('status');
        $product->tax_class=$request->get('tax_class');
        $product->language=$request->get('language');
        $product->popular=$request->get('popular');
        $product->product_description=$request->get('product_description');
        if($request->hasFile('product_image')){
            $path = public_path()."/img/products/".$product->product_image;
            unlink($path);
            $image = $request->product_image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $image->move('public/img/products',$filename);
            $product->product_image = $filename;

            /*$image = $request->file('product_image');
            $img = time().'.'.$image->getClientOriginalExtension();
            $product->product_image = $img; */
//            $destinationPath = public_path('/img/products');
//            $img = Image::make($image->getRealPath());
//            $img->resize(100, 100, function ($constraint) {
//                $constraint->aspectRatio();
//            })->save($destinationPath.'/'.$input['imagename']);
//
//            $destinationPath = public_path('/img/products');
//            $image->move($destinationPath, $input['imagename']);

        }


        if ($request->get('new_category')==null) {
            $product->product_category = $request->get('category');

        }
        else
        {
            $category=new ProductCategory();
            $category->name=$request->get('new_category');
            $category->save();
            $product->product_category =$category->id;
        }
        $product->save();

        return redirect(url('/products'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
       /* $path = public_path()."/img/products/".$product->product_image;
        unlink($path); */
     $product->delete();
        return redirect(url('/products'));

    }


    public function delete($id){
        Product::where('id',$id)->delete();
         return redirect(url('/products'));
    }

// Custom function defined for showing limited data on the index page

    public function search(Request $request)
    {   


        $trash=false;
        $product_categories=ProductCategory::all();
        $i=0;
        foreach ($product_categories as $category)
        {
            $count=Product::where('product_category',$category->id)->count();
            $category->setAttribute('count',$count);
            $product_categories[$i]=$category;
            $i++;
        }

        switch ($request->input('action'))
        {

            case 'all':
                $products=Product::orderBy('created_at','Desc')->get();
                break;
            case 'published':
                $products=Product::where('status','1')->orderBy('created_at','Desc')->get();
                break;
            case 'draft':
                $products=Product::where('status','0')->orderBy('created_at','Desc')->get();
                break;
            case 'deleted':
                $products=Product::onlyTrashed()->get();
                $trash=true;
                break;
            case 'category':
                $products=Product::where('product_category',$request->category)->get();
                $trash=true;
                break;


        }
        return view('products.index',compact('products','product_categories','trash'));


    }


    public function searchCategory(Request $request)
    {

        $trash=false;
        $product_categories=ProductCategory::all();
        $i=0;
        foreach ($product_categories as $category)
        {
            $count=Product::where('product_category',$category->id)->count();
            $category->setAttribute('count',$count);
            $product_categories[$i]=$category;
            $i++;
        }


        $category=$request->get('category');
        $products=Product::where('product_category',$category)->orderBy('created_at','Desc')->get();
        return view('products.index',compact('products','product_categories','trash'));
    }




}
