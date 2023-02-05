<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Mail;

class ApiController extends Controller
{
    public function categoryshare(Request $request)
    {
    
        $validate = $request->validate([
            'name' => 'required',
            'description' => 'required',

        ]);
    
        $data['email'] = "anoopsinghchouhan1000@gmail.com";
        $data['title'] = "CATEGORY INFORMATION  ";
        
        $data['data'] = [
            'name' => $request->name,
            'description' => $request->description,
        ];
    
        $pdf = PDF::loadView('pdffrontend/pdf_file',$data);
        $pfname = time()."category.pdf";
        $pdfname = public_path('pdf/'.$pfname);
        $pdf->save($pdfname);
        $files = [
            $pdfname,
        ];

        Mail::send('pdffrontend/pdf_file',$data,function($message)use($data,$files){
            $message->to($data['email'])->subject($data['title']);

            foreach($files as $fils)
            {
                $message->attach($fils);
            }

           
        });

        $datas = $pdf->download($pfname);

        return response()->json(['message'=>"mail is send successfully",'data'=>url('pdf/'.$pfname)]);
        
        
    }
}
