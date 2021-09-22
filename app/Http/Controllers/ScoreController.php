<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scores=Score::join('students',"score.student_id",'=','students.id')
                          ->join('subjects','score.subject_id','=','subjects.id')
                          ->select('score.*','subjects.name as subject_name','students.name')
                          ->orderBy('subjects.name','asc')
                          ->orderBy('score.score',"desc")
                          ->get();
        return view('score.index',compact('scores'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects=Subject::get();
        $students=Student::get();
        return view('score.create',compact('subjects','students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student=Student::with('subjects')->findOrFail($request->student_id);
        $this->validate($request,[
            'student_id' => 'required',
            'subject_id'=> 'required',
            'score'=>'required|max:100',
        ]);
        $data=[
            'subject_id'=> $request->subject_id,
            'score'=>$request->score
        ];
        if (Score::where('subject_id',$request->subject_id)->where('student_id',$request->student_id)->exists()) {
            return redirect()->route('score.index')->withSuccess('Data score sudah ada');
        }
        $student->subjects()->attach($request->student_id, $data);
        return redirect()->route('score.index')->withSuccess('Data score berhasil ditambah');
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
    public function edit(Request $request,$id)
    {
        if ($request->ajax()) {
            $subjects=Subject::get();
            $students=Student::get();
            $score=Score::findOrFail($id);
            
            return view('score.edit',compact('students','subjects','score'));
        }
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
        $this->validate($request,[
            'student_id' => 'required',
            'subject_id'=> 'required',
            'score'=>'required|max:100',
        ]);
        $score=Score::findOrFail($id);
        $score->update($request->all());
        return redirect()->route('score.index')->withSuccess('Data score berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Score $score )
    {
        $score->delete();
        return redirect()->route('score.index')->withSuccess('Data berhasil di hapus');
    }
}
