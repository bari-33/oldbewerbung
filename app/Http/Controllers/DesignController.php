<?php

namespace App\Http\Controllers;

use App\Design;
use App\DesignCategory;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DesignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trash=false;
        $designs=Design::orderBy('created_at','Desc')->get();
        $count=$designs->count();
        $published=Design::where('status','1')->count();
        $draft=Design::where('status','0')->count();
        $deleted=Design::onlyTrashed()->count();
        $product_categories=DesignCategory::all();

        Session::put('count',$count);
        Session::put('published',$published);
        Session::put('deleted',$deleted);
        $i=0;
        foreach ($product_categories as $category)
        {
            $count=Design::where('product_category',$category->id)->count();
            $category->setAttribute('count',$count);
            $product_categories[$i]=$category;
            $i++;
        }



        //$color=DesignCategory::find($designs->product_category);

        return view('designs.index',compact('designs','product_categories','trash'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $design_categories=DesignCategory::all();
        return view('designs.create',compact('design_categories'));

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
            'design_title'=>'required',
            'regular_price'=>'required',
            'status'=>'required',
            'tax_class'=>'required',
            'service'=>'required',
            'primary_image'=>'required',
            'secondary_image'=>'required',
        ]);
        $design=new Design();
        $design->design_title=$request->get('design_title');
        $design->regular_price=$request->get('regular_price');
        $design->promotional_price=$request->get('promotional_price');
        $design->status=$request->get('status');
        $design->tax_class=$request->get('tax_class');
        $design->service=$request->get('service');


        // FOR PRIMARY IMAGE
        if($request->hasFile('primary_image')){
            $image = $request->primary_image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $image->move('public/img/designs/primary',$filename);
            $design->primary_image = $filename;

            /*$image = $request->file('primary_image');
            $img = time().'.'.$image->getClientOriginalExtension();
            $design->primary_image = $img; */
//            $destinationPath = public_path('/img/designs');
//            $img = Image::make($image->getRealPath());
//            $img->resize(100, 100, function ($constraint) {
//                $constraint->aspectRatio();
//            })->save($destinationPath.'/'.$input['imagename']);
//
//            $destinationPath = public_path('/img/designs');
//            $image->move($destinationPath, $input['imagename']);

        }



        // FOR SECONDARY IMAGE
        if($request->hasFile('secondary_image')){
            $image = $request->secondary_image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $image->move('public/img/designs/secondary/',$filename);
            $design->secondary_image = $filename;

            /*$image = $request->file('secondary_image');
            $img = time().'.'.$image->getClientOriginalExtension();
            $design->secondary_image = $img; */
//            $destinationPath = public_path('/img/designs');
//            $img = Image::make($image->getRealPath());
//            $img->resize(100, 100, function ($constraint) {
//                $constraint->aspectRatio();
//            })->save($destinationPath.'/'.$input['imagename']);
//
//            $destinationPath = public_path('/img/designs');
//            $image->move($destinationPath, $input['imagename']);

        }



        if ($request->get('new_category')==null) {
            $design->product_category = $request->get('category');

        }
        else
        {
            $design_category=new DesignCategory();
            $design_category->name=$request->get('new_category');
            $design_category->save();
            $design->product_category =$design_category->id;
        }
        $design->save();
        return redirect(url('/designs'));


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function show(Design $design)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function edit(Design $design)
    {
        $design_categories=DesignCategory::all();
        return view('designs.edit',compact('design','design_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Design $design)
    {

        $request->validate([
            'design_title'=>'required',
            'regular_price'=>'required',
            'status'=>'required',
            'tax_class'=>'required',
            'service'=>'required',
        ]);

        $design->design_title=$request->get('design_title');
        $design->regular_price=$request->get('regular_price');
        $design->promotional_price=$request->get('promotional_price');
        $design->status=$request->get('status');
        $design->tax_class=$request->get('tax_class');
        $design->service=$request->get('service');


        // FOR PRIMARY IMAGE
        if($request->hasFile('primary_image')){
            $path = public_path()."/img/designs/primary/".$design->primary_image;
            unlink($path);
            $image = $request->primary_image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $image->move('public/img/designs/primary/',$filename);
            $design->primary_image = $filename;

            /*$image = $request->file('primary_image');
            $img = time().'.'.$image->getClientOriginalExtension();
            $design->primary_image = $img; */
//            $destinationPath = public_path('/img/designs/primary');
//            $img = Image::make($image->getRealPath());
//            $img->resize(100, 100, function ($constraint) {
//                $constraint->aspectRatio();
//            })->save($destinationPath.'/'.$input['imagename']);
//
//            $destinationPath = public_path('/img/designs/primary');
//            $image->move($destinationPath, $input['imagename']);

        }



        // FOR SECONDARY IMAGE
        if($request->hasFile('secondary_image')){
            $path = public_path()."/img/designs/secondary/".$design->secondary_image;
            unlink($path);
            $image = $request->secondary_image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $image->move('public/img/designs/secondary/',$filename);
            $design->secondary_image = $filename;

            /*$image = $request->file('secondary_image');
            $img = time().'.'.$image->getClientOriginalExtension();
            $design->secondary_image = $img; */
//            $destinationPath = public_path('/img/designs/secondary');
//            $img = Image::make($image->getRealPath());
//            $img->resize(100, 100, function ($constraint) {
//                $constraint->aspectRatio();
//            })->save($destinationPath.'/'.$input['imagename']);
//
//            $destinationPath = public_path('/img/designs/secondary');
//            $image->move($destinationPath, $input['imagename']);

        }



        if ($request->get('new_category')==null) {
            $design->product_category = $request->get('category');

        }
        else
        {
            $design_category=new DesignCategory();
            $design_category->name=$request->get('new_category');
            $design_category->save();
            $design->product_category =$design_category->id;
        }
        $design->save();
        return redirect(url('/designs'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function destroy(Design $design)
    {
        /*$path = public_path()."/img/designs/primary/".$design->primary_image;
        unlink($path);
        $path = public_path()."/img/designs/secondary/".$design->secondary_image;
        unlink($path);*/
        $design->delete();
        return redirect(url('/designs'));
    }


    public function delete($id){
        Design::where('id',$id)->delete();
         return redirect(url('/designs'));
    }

    public function search(Request $request)
    {
        $trash=false;
        $product_categories=DesignCategory::all();
        $i=0;
        foreach ($product_categories as $category)
        {
            $count=Design::where('product_category',$category->id)->count();
            $category->setAttribute('count',$count);
            $product_categories[$i]=$category;
            $i++;
        }



        switch ($request->input('action'))
        {

            case 'all':
                $designs=Design::orderBy('created_at','Desc')->get();
                break;
            case 'published':
                $designs=Design::where('status','1')->orderBy('created_at','Desc')->get();

                break;
            case 'draft':
                $designs=Design::where('status','0')->orderBy('created_at','Desc')->get();
                break;
            case 'deleted':
                $designs=Design::onlyTrashed()->get();
                $trash=true;
                break;


        }
        return view('designs.index',compact('designs','product_categories','trash'));


    }


    public function searchCategory(Request $request)
    {
        $trash=false;
        $product_categories=DesignCategory::all();
        $i=0;
        foreach ($product_categories as $category)
        {
            $count=Design::where('product_category',$category->id)->count();
            $category->setAttribute('count',$count);
            $product_categories[$i]=$category;
            $i++;
        }


        $category=$request->get('category');
        $designs=Design::where('product_category',$category)->orderBy('created_at','Desc')->get();
        return view('designs.index',compact('designs','product_categories','trash'));
    }




}


