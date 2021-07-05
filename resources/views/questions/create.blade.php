@extends('layouts.app')
@section('title', 'Ask Question | Stack Overflow Clone')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2>Ask a Question!</h2></div>
                        <div class="card-body">
                            <form action="{{ route('questions.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control  @error('title') is-invalid @enderror">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="question">Enter Question</label>
                                    <input type="hidden" id="body" name="body" value="{{ old('body') }}">
                                    <trix-editor input="body" class="form-control  @error('body') is-invalid @enderror " ></trix-editor>
                                    @error('body')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-outline-success" >Submit</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
               </div>
         </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js" integrity="sha512-2RLMQRNr+D47nbLnsbEqtEmgKy67OSCpWJjJM394czt99xj3jJJJBQ43K7lJpfYAYtvekeyzqfZTx2mqoDh7vg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
