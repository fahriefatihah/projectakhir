<?php

namespace App\Http\Controllers;

use App\Answer;
use App\User;
use App\Tag;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $users = User::withCount('questions')->where('id', Auth()->user()->id)->get();
        $questions = Question::withCount('answers')->get();
        $upvotePertanyaan = DB::table('up_vote')->join('questions', 'up_vote.question_id', '=', 'questions.id')->count();
        $downvotePertanyaan = DB::table('down_vote')->join('questions', 'down_vote.question_id', '=', 'questions.id')->count();
        $vote = $upvotePertanyaan - $downvotePertanyaan;
        // dd($upvotePertanyaan, $downvotePertanyaan, $vote);
        return view('content.dashboard', compact('users', 'questions', 'vote'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('content.create-pertanyaan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $slug = Str::slug($data['judul']);
        $create = Question::create([
            'judul' => $data['judul'],
            'isi' => $data['pertanyaan'],
            'slug' => $slug,
            'tag'   => $request['tag'],
            'user_id' => Auth()->user()->id
        ]);


        $tagArr = explode(',', $request->tag);
        $tagsMulti  = [];
        foreach($tagArr as $strTag){
            $tagArrAssc["tag"] = $strTag;
            $tagsMulti[] = $tagArrAssc;
        }
        // Create Tags baru
        foreach($tagsMulti as $tagCheck){
            $tag = Tag::firstOrCreate($tagCheck);
            $create->tags()->attach($tag->id);
        }

        Alert::success('Berhasil', 'Pertanyaan berhasil disimpan');
        return redirect('/question');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $questions = Question::withCount('answers')->where('id', $question->id)->first();  
        // $answer = Answer::with('questions')->where('question_id', $question->id)->get();
        // dd($questions);
        $comments = DB::table('comments')->where('question_id', $question->id)->select('isi_pertanyaan')->get();
        $Komentar = DB::table('answer_comments')->get();
        $upvotePertanyaan = DB::table('up_vote')->where('question_id', $question->id)->count();
        $downvotePertanyaan = DB::table('down_vote')->where('question_id', $question->id)->count();
        $upvote = $upvotePertanyaan - $downvotePertanyaan;
        // dd($upvote);
        return view('content.show', compact('questions', 'comments', 'Komentar', 'upvote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $question = Question::where('id', $question->id)->first();
        return view('content.edit-pertanyaan', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        // dd($request->all());
        // $question = Question::where('id', $question->id)->update([
        //     'judul' => $request['judul'],
        //     'isi' => $request['pertanyaan'],
        //     'slug' => Str::slug($request['judul']),
        //     'tag'   => $request['tag'],
        //     'user_id' => Auth()->user()->id
        // ]);
        // dd($question->id);
        $update = Question::where('id', $question->id)->first();
        $update->judul = $request['judul'];
        $update->isi = $request['pertanyaan'];
        $update->slug = Str::slug($request['judul']);
        $update->user_id = Auth()->user()->id;
        $update->tag = $request['tag'];
        $update->save();
        // dd($update);

        // dd($question->id);

        $tagArr = explode(',', $request->tag);
        $tagsMulti  = [];
        foreach($tagArr as $strTag){
            $tagArrAssc["tag"] = $strTag;
            $tagsMulti[] = $tagArrAssc;
        }
        // Create Tags baru
        foreach($tagsMulti as $tagCheck){
            $tags = Tag::firstOrCreate($tagCheck)->pluck('id');
            $update->tags()->sync($tags);
        }

        Alert::success('Berhasil', 'Pertanyaan berhasil diupdate');
        return redirect('question');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $data = Question::where('id', $question->id)->first();
        $data->delete();
        Alert::success('Berhasil', 'Pertanyaan berhasil dihapus');
        return redirect('question');
    }
}
