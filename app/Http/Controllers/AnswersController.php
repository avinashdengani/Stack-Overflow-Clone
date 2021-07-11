<?php

namespace App\Http\Controllers;

use App\Http\Requests\Answers\CreateAnswerRequest;
use App\Http\Requests\Answers\UpdateAnswerRequest;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswersController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, CreateAnswerRequest $request)
    {
       $question->answers()->create([
            'body' => $request->body,
            'user_id' => auth()->id()
       ]);
       session()->flash('success', 'Yor answer has been submitted successfully!');
       return redirect($question->url);
    }

    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);
        return view('answers.edit', compact(['question', 'answer']));
    }

    public function update(UpdateAnswerRequest $request, Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);
        $answer->update([
            'body' => $request->body
        ]);
        session()->flash('success', 'Yor answer has been edited successfully!');
       return redirect($question->url);
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
