<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categorys;
use File;
use validate;
use PDF;
use Storage;
use Mail;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = categorys::all();
        return view('admin.Categorys.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Categorys.create');
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
            'name' => 'required',
            'description' => 'required',

        ]);

        $data = categorys::UpdateOrCreate([
            'id' => $request->id,
        ],[
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status
        ]);

        if($request->hasFile('image'))
        {
            
            $img = $request->file('image');
            $name = $img->getClientOriginalName();
            $path = "image";
            $img->move($path,$name);
            categorys::where('id',$data->id)
            ->update(['image'=>$name]);
        }        
        
        if($data->id)
        {
          return redirect()->route('category.index')->with('success',"Category is successfully Updated");
        }
        else
        {
            return redirect()->route('category.index')->with('success',"Category is successfully Inserted");
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
        $datas = categorys::find($id);
        return view('admin.Categorys.create',compact('datas'));
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
        $destroy = categorys::find($id);
        $destroy->delete();
        return redirect()->route('category.index');
    }
    // public function createpdf()
    // {
    //     // $data = [
    //     //     'title' => 'Welcome to ItSolutionStuff.com',
    //     //     'date' => date('m/d/Y')
    //     // ];
    //     $data = categorys::all();
    //     // view()->share('employee',$data);
    //     $pdf = PDF::loadview('pdfforntend/pdf_file',compact('data'))->save(public_path('image/detail.pdf'));
    //     //download PDF File with download method
    //     return $pdf->download('pdf_file.pdf');

    // }
    public function categoryshare(Request $request)
    {
    
        // $validate = $request->validate([
        //     'name' => 'required',
        //     'description' => 'required',

        // ]);
    
        $data['email'] = "anoopsinghchouhan1000@gmail.com";
        $data['title'] = "This is category list";
        
        $data['data'] = [
            'name' => "apple",
            'description' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
        ];
    
        $pdf = PDF::loadView('pdffrontend/pdf_file',$data);
        $pfname = time()."category.pdf";
        $pdfname = public_path('pdf/'.$pfname);
        $pdf->save($pdfname);
        $files = [
            $pdfname,
        ];

        Mail::send('pdffrontend/pdf_file',$data,function($message)use($data){
            $message->to($data['email'])->subject($data['title']);

           
        });
        return $pdf->download($pfname);
        
        
    }
}
