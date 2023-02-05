<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validate;
use App\Models\product;
use App\Models\categorys;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = product::all();
        return view('admin.Products.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $categorys = categorys::all();
        return view('admin.Products.create',compact('categorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required'

        ]);

        $data = product::UpdateOrCreate([
            'id' => $request->id,
        ],[
              'category_id' => $request->category_id,
              'name' => $request->name,
              'description' => $request->description,
              'status' => $request->status
        ]);

        if($request->hasFile('image'))
        {
            $img = $request->File('image');
            $name  =  $img->getClientOriginalName();
            $path = 'images';
            $img->move($path,$name);
            product::where('id',$data->id)
            ->update(['image' => $name]);
        }

        if($data->id)
        {
            return redirect()->route('products.index')->with('success',"product is successfully updated");
        }
        else
        {
            return redirect()->route('products.index')->with('success',"product is successfully added");
        }
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
        $categorys =  categorys::all();  
        $datas = product::find($id);
        return view('admin.products.create',compact('datas','categorys'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = product::find($id);
        $destroy->delete();

        return redirect()->route('products.index');
        
    }
    public function changeStatuss(Request $request)
    {
         $products = product::find($request->id);
         $products->status = $request->status;
         $products->save();

         return response()->json('success',"status successfully updated");
    }
}
