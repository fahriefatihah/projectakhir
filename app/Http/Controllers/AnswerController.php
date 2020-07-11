<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upvote(Request $request)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function downvote(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        Answer::create([
            'isi'   => $request->jawaban,
            'question_id'   => $request->id_question,
            'user_id'   => Auth()->user()->id
        ]);
        Alert::success('Berhasil', 'Pertanyaan berhasil disimpan');
        return redirect('question');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function benar($id)
    {
        Answer::where('id', $id)->update([
            'selected' => 1
        ]);
        Alert::success('Berhasil', 'Jawaban ini berhasil ditandai benar');
        return redirect('question/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        //
    }
}
