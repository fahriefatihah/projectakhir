<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class KomentarController extends Controller
{
    public function QuestionComments(Request $request, $id)
    {
        // dd($request->all(), $id);
        DB::table('comments')->insert([
            'isi_pertanyaan'   => $request['komentar'],
            'question_id'   => $id,
        ]);

        Alert::success('Berhasil', 'Komentar anda berhasil ditambahkan');
        return redirect()->back();
    }


    public function AnswerComments(Request $request, $id)
    {
        DB::table('answer_comments')->insert([
            'isi_jawaban'   => $request['komentar'],
            'answer_id'   => $id,
        ]);

        Alert::success('Berhasil', 'Komentar anda berhasil ditambahkan');
        return redirect()->back();
    }
}
