<?php

namespace App\Http\Controllers;

use App\Website;
use App\WebsiteCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trash=false;
        $websites=Website::orderBy('created_at','Desc')->get();

        $count=$websites->count();
        $published=Website::where('status','1')->count();
        $draft=Website::where('status','0')->count();
        $deleted=Website::onlyTrashed()->count();
        $product_categories=WebsiteCategory::all();

        Session::put('count',$count);
        Session::put('published',$published);
        Session::put('draft',$draft);
        Session::put('deleted',$deleted);

        $i=0;
        foreach ($product_categories as $category)
        {
            $count=Website::where('product_category',$category->id)->count();
            $category->setAttribute('count',$count);
            $product_categories[$i]=$category;
            $i++;
        }




        return view('websites.index',compact('websites','product_categories','trash'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $website_categories=WebsiteCategory::all();
        return view('websites.create',compact('website_categories'));
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
            'website_title'=>'required',
            'regular_price'=>'required',
            'status'=>'required',
            'tax_class'=>'required',
            'primary_image'=>'required',
            'secondary_image'=>'required',
        ]);
        $website=new Website();
        $website->website_title=$request->get('website_title');
        $website->regular_price=$request->get('regular_price');
        $website->promotional_price=$request->get('promotional_price');
        $website->status=$request->get('status');
        $website->tax_class=$request->get('tax_class');


        // FOR PRIMARY IMAGE
        if($request->hasFile('primary_image')){
            $image = $request->primary_image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $image->move('public/img/websites/primary/',$filename);
            $website->primary_image = $filename;

            /*$image = $request->file('primary_image');
            $img = time().'.'.$image->getClientOriginalExtension();
            $website->primary_image = $img; */
//            $destinationPath = public_path('/img/websites/primary');
//            $img = Image::make($image->getRealPath());
//            $img->resize(100, 100, function ($constraint) {
//                $constraint->aspectRatio();
//            })->save($destinationPath.'/'.$input['imagename']);
//
//            $destinationPath = public_path('/img/websites/primary');
//            $image->move($destinationPath, $input['imagename']);

        }



        // FOR SECONDARY IMAGE
        if($request->hasFile('secondary_image')){
            $image = $request->secondary_image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $image->move('public/img/websites/secondary/',$filename);
            $website->secondary_image = $filename;

            /*$image = $request->file('secondary_image');
            $img = time().'.'.$image->getClientOriginalExtension();
            $website->secondary_image = $img; */
//            $destinationPath = public_path('/img/websites/secondary');
//            $img = Image::make($image->getRealPath());
//            $img->resize(100, 100, function ($constraint) {
//                $constraint->aspectRatio();
//            })->save($destinationPath.'/'.$input['imagename']);
//
//            $destinationPath = public_path('/img/websites/secondary');
//            $image->move($destinationPath, $input['imagename']);

        }



        if ($request->get('new_category')==null) {
            $website->product_category = $request->get('category');

        }
        else
        {
            $website_category=new WebsiteCategory();
            $website_category->name=$request->get('new_category');
            $website_category->save();
            $website->product_category =$website_category->id;
        }
        $website->save();
        return redirect(url('/websites'));
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
    public function edit(Website $website)
    {
        $website_categories=WebsiteCategory::all();
        return view('websites.edit',compact('website','website_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Website $website)
    {
        $request->validate([
            'website_title'=>'required',
            'regular_price'=>'required',
            'status'=>'required',
            'tax_class'=>'required',
        ]);
        $website->website_title=$request->get('website_title');
        $website->regular_price=$request->get('regular_price');
        $website->promotional_price=$request->get('promotional_price');
        $website->status=$request->get('status');
        $website->tax_class=$request->get('tax_class');


        // FOR PRIMARY IMAGE
        if($request->hasFile('primary_image')){
            $path = public_path()."/img/websites/primary/".$website->primary_image;
            unlink($path);
            $image = $request->primary_image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $image->move('public/img/websites/primary/',$filename);
            $website->primary_image = $filename;

            /*$image = $request->file('primary_image');
            $img = time().'.'.$image->getClientOriginalExtension();
            $website->primary_image = $img; */
//            $destinationPath = public_path('/img/websites/primary');
//            $img = Image::make($image->getRealPath());
//            $img->resize(100, 100, function ($constraint) {
//                $constraint->aspectRatio();
//            })->save($destinationPath.'/'.$input['imagename']);
//
//            $destinationPath = public_path('/img/websites/primary');
//            $image->move($destinationPath, $input['imagename']);

        }



        // FOR SECONDARY IMAGE
        if($request->hasFile('secondary_image')){
            $path = public_path()."/img/websites/secondary/".$website->secondary_image;
            unlink($path);
            $image = $request->secondary_image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $image->move('public/img/websites/secondary/',$filename);
            $website->secondary_image = $filename;

            /*$image = $request->file('secondary_image');
            $img = time().'.'.$image->getClientOriginalExtension();
            $website->secondary_image = $img; */
//            $destinationPath = public_path('/img/websites/secondary');
//            $img = Image::make($image->getRealPath());
//            $img->resize(100, 100, function ($constraint) {
//                $constraint->aspectRatio();
//            })->save($destinationPath.'/'.$input['imagename']);
//
//            $destinationPath = public_path('/img/websites/secondary');
//            $image->move($destinationPath, $input['imagename']);

        }



        if ($request->get('new_category')==null) {
            $website->product_category = $request->get('category');

        }
        else
        {
            $website_category=new WebsiteCategory();
            $website_category->name=$request->get('new_category');
            $website_category->save();
            $website->product_category =$website_category->id;
        }
        $website->save();

        return redirect(url('/websites'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Website $website)
    {
        /*$path = public_path()."/img/websites/primary/".$website->primary_image;
        unlink($path);
        $path = public_path()."/img/websites/secondary/".$website->secondary_image;
        unlink($path);*/
        $website->delete();
        return redirect(url('/websites'));

    }


    public function delete($id){
        Website::where('id',$id)->delete();
         return redirect(url('/websites'));
    }

    public function search(Request $request)
    {
        $trash=false;
        $product_categories=WebsiteCategory::all();
        $i=0;
        foreach ($product_categories as $category)
        {
            $count=Website::where('product_category',$category->id)->count();
            $category->setAttribute('count',$count);
            $product_categories[$i]=$category;
            $i++;
        }



        switch ($request->input('action'))
        {

            case 'all':
                $websites=Website::orderBy('created_at','Desc')->get();
                break;
            case 'published':
                $websites=Website::where('status','1')->orderBy('created_at','Desc')->get();

                break;
            case 'draft':
                $websites=Website::where('status','0')->orderBy('created_at','Desc')->get();
                break;
            case 'deleted':
                $websites=Website::onlyTrashed()->get();
                $trash=true;
                break;


        }
        return view('websites.index',compact('websites','product_categories','trash'));


    }


    public function searchCategory(Request $request)
    {

        $trash=false;
        $product_categories=WebsiteCategory::all();
        $i=0;
        foreach ($product_categories as $category)
        {
            $count=Website::where('product_category',$category->id)->count();
            $category->setAttribute('count',$count);
            $product_categories[$i]=$category;
            $i++;
        }


        $category=$request->get('category');
        $websites=Website::where('product_category',$category)->orderBy('created_at','Desc')->get();
        return view('websites.index',compact('websites','product_categories','trash'));
    }



}
