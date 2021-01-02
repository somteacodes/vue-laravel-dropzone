<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    //

    public function store(Request $request){
        //use the request to do what we want
        
        // Check if the request has files
        if($request->file('file')){
            //get name of file
            // $file = $request->file('file');
            // $filename = $file->getClientOriginalName();
            // //strip out all spaces
            // $filename = str_replace(' ', '', $filename);

            // $path = $file->storeAs('uploads', $filename);
            // // $path = $request->file('file')->store('uploads');
            // if($path){
            //     return response()->json(['message'=>'file uploaded'], 200);
            // }


            /* Multiple file upload */
            $files = $request->file('file');
            if(!is_array($files)){
                $files = [$files];
            }

            //loop throu the array 
            for($i=0; $i<count($files); $i++){
                $file = $files[$i];
                $filename = $file->getClientOriginalName();
                $filename= str_replace(' ', '', $filename);
                $file->storeAs('uploads', $filename);

            }
            return response()->json(['message'=>'file uploaded', 'data'=>$request->email], 200);
        }
        else{
            return response()->json(['message'=>'error uploading file'], 503);
        }

    }
}