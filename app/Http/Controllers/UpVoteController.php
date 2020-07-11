<?php

namespace App\Http\Controllers;

use App\UpVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class UpVoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function voteQuestion(Request $request)
    { 
        // cek apakah user sudah vote questionnya atau belum
        $user = DB::table('up_vote')->where([
            ['user_id', Auth()->user()->id],
            ['question_id', $request->quest_id]
        ])->count();
            // dd($user);
        if($user == FALSE){
            DB::table('up_vote')->insert([
                'user_id'   => Auth()->user()->id,
                'question_id'   => $request->quest_id
            ]);
            Alert::success('Vote', 'Terima kasih telah upvote pertanyaan ini.');
            return redirect()->back();
        }else{
            Alert::warning('Vote', 'Anda sudah pernah vote pertanyaan ini.');
            return redirect()->back();
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function voteAnswer(Request $request, $answer)
    {
        // dd($request->all());
        // cek apakah user sudah vote questionnya atau belum
        $user = DB::table('up_vote')->where([
            ['user_id', Auth()->user()->id],
            ['answer_id', $answer]
        ])->count();
            // dd($user);
        if($user == FALSE){
            DB::table('up_vote')->insert([
                'user_id'   => Auth()->user()->id,
                'answer_id'   => $request->answer_id
            ]);
            Alert::success('Vote', 'Terima kasih telah upvote jawaban ini.');
            return redirect()->back();
        }else{
            Alert::warning('Vote', 'Anda sudah pernah vote jawaban ini.');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }
}
