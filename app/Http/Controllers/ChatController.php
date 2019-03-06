<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;
use PDF;
class ChatController extends Controller
{
   public function index()
   {
       $chats=Chat::get();
       return view('chat',compact('chats'));
   }
   public function store(Request $request)
   {
       $chat=new Chat();
       $chat->message=$request->msg;
       $chat->check=0;
       $chat->save();

   }
   public function ajax()
   {
       ini_set('max_execution_time', 7200);
      while (Chat::where('check',0)->count()<1)
       {
           usleep(1000);
       }
       if(chat::where('check',0)->count()>0)
       {
           $data=Chat::where('check',0)->first();
           $id=$data->id;
           $edit=Chat::find($id);
           $edit->check=1;
           $edit->save();
           dd($data);
           return response()->json([
               'msg'=>$data->message
           ]);

       }

   }
    public function GeneratePdf()
    {

        $pdf = PDF::loadView('file');
        return $pdf->download('invoice.pdf');
    }
    public function createWordDocx()
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();


        $section = $phpWord->addSection();

         $data=Chat::find(5);
        //dd($data->message);



        $section->addImage("http://itsolutionstuff.com/frontTheme/images/logo.png");
        $section->addText($data->message);

        $section->addText($data->id);
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objWriter->save(storage_path('helloWorld.docx'));
        } catch (Exception $e) {
        }


        return response()->download(storage_path('helloWorld.docx'));
    }
}
