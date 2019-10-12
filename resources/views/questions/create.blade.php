@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3>Ask question</h3>
                        <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">
                            Go back to questions
                        </a>
                    </div>
                </div>

                <div class="card-body">
                   <form action="{{ route('questions.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                      <label for="title">Question title</label>
                      <input
                      type="text"
                      name="title"
                      id="title"
                      value="{{ old('title') }}"
                      class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                      placeholder="Enter the title of the question..."
                      aria-describedby="questionHelpId">
                      <small id="questionHelpId" class="text-muted">
                          Enter a valid question title
                      </small>
                      @if ($errors->has('title'))
                          <div class="invalid-feedback">
                              <strong>{{ $errors->first('title') }}</strong>
                          </div>
                      @endif
                    </div>
                    <div class="form-group">
                        <label for="body">Explain the question</label>
                        <textarea
                        type="text"
                        name="body"
                        id="body"
                        rows="10"
                        value="{{ old('body') }}"
                        class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"
                        placeholder="Enter the body of the question..."
                        aria-describedby="questionHelpId"></textarea>
                        <small id="questionHelpId" class="text-muted">
                            Explain the question entered above
                        </small>
                        @if ($errors->has('body'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('body') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-outline-success">
                            Ask this question
                        </button>
                    </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
