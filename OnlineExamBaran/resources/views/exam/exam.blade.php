@extends('layouts.app')

@section('content')

    <form action="{{ route('save_submission', [$course,$exam]) }}" method="post" class="container">
        @csrf
            <h3>{{ $question->question }}</h3>

                <input type="hidden" name="multiple_choice[{{ $question->id }}][question_id]" class="form-check-input" value="{{ $question->id }}">
                <input type="radio" name="multiple_choice[{{ $question->id }}][answer_value]" class="form-check-input" value="{{ $answer->value }}" autocomplete="off">
                <label for="multiple_choice[]" class="form-check-label">{{ $answer->value }}) {{ $answer->answer }}</label>
                <br>

                <input type="hidden" name="text[{{ $question->id }}][question_id]" class="form-check-input" value="{{ $question->id }}">
                <label>
                    <input type="text" name="text[{{ $question->id }}][answer]" class="form-control" autocomplete="off">
                </label>

        <button type="submit" class="btn btn-primary my-4">Submit</button>
    </form>

@endsection
