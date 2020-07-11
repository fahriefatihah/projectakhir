<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class DownVoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function voteQuestion(Request $request)
    {
        // cek reputasi user downvote
        $UpVote = DB::table('up_vote')->where('user_id', Auth()->user()->id)->count();
        $DownVote = DB::table('down_vote')->where('user_id', Auth()->user()->id)->count();
        $JawabanBenar = DB::table('answers')->where([
            ['user_id', Auth()->user()->id],
            ['selected', 1]
        ])->count();

        // hitung total reputasi
        $totalReputasi = ($UpVote)*10 + ($JawabanBenar*15) - $DownVote;
        // dd($totalReputasi);
        
        // cek apakah user sudah pernah downvote atau belum
        $user = DB::table('down_vote')->where([
            ['user_id', Auth()->user()->id],
            ['question_id', $request->quest_id]
        ])->count();
        // dd($user);
        if($user == FALSE){
            if($totalReputasi < 15)
            {
                Alert::warning('Down Vote', 'Reputasi anda tidak cukup. Minimal reputasi adalah 15.');
                return redirect()->back();
            }else{
            DB::table('down_vote')->insert([
                'user_id'   => Auth()->user()->id,
                'question_id'   => $request->quest_id
            ]);
            Alert::success('Vote', 'Terima kasih telah downvote pertanyaan ini.');
            return redirect()->back();
            }
        }else{
            Alert::warning('Vote', 'Terima kasih anda telah pernah melakukan downvote pertanyaan ini.');
            return redirect()->back();
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function voteAnswer(Request $request)
    {
        // cek reputasi user downvote
        $UpVote = DB::table('up_vote')->where('user_id', Auth()->user()->id)->count();
        $DownVote = DB::table('down_vote')->where('user_id', Auth()->user()->id)->count();
        $JawabanBenar = DB::table('answers')->where([
            ['user_id', Auth()->user()->id],
            ['selected', 1]
        ])->count();

        // hitung total reputasi
        $totalReputasi = ($UpVote)*10 + ($JawabanBenar*15) - $DownVote;
        // dd($totalReputasi);
        
        // cek apakah user sudah pernah downvote atau belum
        $user = DB::table('down_vote')->where([
            ['user_id', Auth()->user()->id],
            ['answer_id', $request->answer_id]
        ])->count();
        // dd($user);
        if($user == FALSE){
            if($totalReputasi < 15)
            {
                Alert::warning('Down Vote', 'Reputasi anda tidak cukup. Minimal reputasi adalah 15.');
                return redirect()->back();
            }else{
            DB::table('down_vote')->insert([
                'user_id'   => Auth()->user()->id,
                'answer_id'   => $request->answer_id
            ]);
            Alert::success('Vote', 'Terima kasih telah downvote jawbaan ini.');
            return redirect()->back();
            }
        }else{
            Alert::warning('Vote', 'Terima kasih anda telah pernah melakukan downvote jawaban ini.');
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
