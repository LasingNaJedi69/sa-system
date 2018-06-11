<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SendController extends Controller
{
    public function index(){
        $sent = Transaction::join('transact', 'transaction_id', '=', 'transactions.id')
            ->leftjoin('users', 'users.id', '=', 'receiver_id')
            ->where('sender_id', '=', Auth::user()->id)
            ->select('*', 'transact.created_at')
            ->get();
        // return $received;
        return view('sent', compact('sent'));
    }

    public function createSend(Request $request){
        $document = 0;
        if ($request->hasFile('file')){
            $document = 1;
        }
        // Create new row in Transaction Table
        $transaction = Transaction::create([
            'title' => $request->title,
            'has_documents' => $document,
            'comment' => "None",
            'description' => $request->description,
            'status' => "pending",
        ]);
        DB::table('transact')->insert([
            'transaction_id' => $transaction->id,
            'sender_id' => Auth::user()->id,
            'receiver_id' => null,
            'note' => "Sent to: ".$request->recipient,
            'created_at' =>  \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        return redirect('/sent');
    }

    public function sendTransaction(){
        
    }
}
