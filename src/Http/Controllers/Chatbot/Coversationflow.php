<?php

namespace ChatBot\Blueprint\Http\Controllers\Chatbot;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
class Coversationflow extends Controller{
    public function index(){
        $errors=[];
        return view('chatbotBluePrint::chatbot.conversation_flow.create',compact('errors'));
    }

    public function create(){

    }


    public function store(Request $request){

    }

    public function edit($id){

    }

    public function update(Request $request,$id){

    }

    public function delete($id){

    }
}






?>
