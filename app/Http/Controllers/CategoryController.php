<?php

namespace App\Http\Controllers;

use App\Design;
use App\DesignCategory;
use App\Product;
use App\ProductCategory;
use App\Website;
use App\WebsiteCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $products = ProductCategory::all();
        $i = 0;
        foreach ($products as $product) {
            if (!Product::where('product_category', $product->id)->exists()) {
                $products[$i]->setAttribute('delete', true);
            } else {
                $products[$i]->setAttribute('delete', false);

            }

            $i++;

        }


        $designs = DesignCategory::all();
        $j = 0;
        foreach ($designs as $design) {
            if (!Design::where('product_category', $design->id)->exists()) {
                $designs[$j]->setAttribute('delete', true);
            } else {
                $designs[$j]->setAttribute('delete', false);

            }
            $j++;

        }
        $websites = WebsiteCategory::all();
        $k = 0;
        foreach ($websites as $website) {
            if (!Website::where('product_category', $website->id)->exists()) {
                $websites[$k]->setAttribute('delete', true);
            } else {
                $websites[$k]->setAttribute('delete', false);

            }
            $k++;

        }

        return view('categories.index', compact('products', 'designs', 'websites'));
    }

    public function create()
    {
        return view('categories.create');

    }

    public function store(Request $request)
    {

        if ($request->get('category')==1)
        {
            $request->validate([
                'name'=>'required|unique:product_categories',
                'category'=>'required',
            ]);

            $product_category=new ProductCategory();
            $product_category->name=$request->get('name');
            $product_category->save();

        }
        if ($request->get('category')==2)
        {
            $request->validate([
                'name'=>'required|unique:design_categories',
                'category'=>'required',
            ]);
            $design_category=new DesignCategory();
            $design_category->name=$request->get('name');
            $design_category->save();
        }
        if ($request->get('category')==3)
        {
            $request->validate([
                'name'=>'required|unique:website_categories',
                'category'=>'required',
            ]);
            $website_category=new WebsiteCategory();
            $website_category->name=$request->get('name');
            $website_category->save();
        }


        return redirect('/categories');

    }


    public function edit($id,$flag)
    {
        if ($flag==1)
        {
            $data=ProductCategory::find($id);
        }
        if ($flag==2)
        {
            $data=DesignCategory::find($id);
        }
        if ($flag==3)
        {
            $data=WebsiteCategory::find($id);
        }

      return view('categories.edit',compact('data','flag'));

    }
    public function update(Request $request,$id,$flag)
    {
        $request->validate([
            'name'=>'required'
        ]);
        if ($flag==1)
        {
            $data=ProductCategory::find($id);
            $data->name=$request->get('name');
        }
        if ($flag==2)
        {
            $data=DesignCategory::find($id);
            $data->name=$request->get('name');
        }
        if ($flag==3)
        {
            $data=WebsiteCategory::find($id);
            $data->name=$request->get('name');
        }

        $data->save();

        return redirect('/categories');

    }


    public function destroy($id,$flag)
    {


        if ($flag==1)
        {
            $data=ProductCategory::where('id',$id)->delete();

        }
        if ($flag==2)
        {
            $data=DesignCategory::where('id',$id)->delete();
        }
        if ($flag==3)
        {
            $data=WebsiteCategory::where('id',$id)->delete();
        }

        return redirect('/categories');

    }

}
