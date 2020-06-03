@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header font-weight-bold">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in! Below are some terms and conditions:

                    <p class="mt-5 font-weight-bold">
                        This website is made available by the counselor to share and discuss
                        ideas concerning the challenges students are facing.
                        By using this website, you understand that not every content
                        found here is applicable to a particular situation.
                        You’re advised to look out for comments and posts approved
                        or shared by the counselor. Doing otherwise is at your own risk.
                    </p>
                </div>
            </div>
            @if (Auth::user()->is_counsellor)
                <div class="col-md-12 my-5">
                    {!! $line_chart->container() !!}
                </div>
                <div class="col-md-12 my-5">
                    {!! $bar_chart->container() !!}
                </div>
            @endif
        </div>
    </div>
</div>
@if (Auth::user()->is_counsellor)
    @push('charts')
        {!! $line_chart->script() !!}
        {!! $bar_chart->script() !!}
    @endpush
@endif
@endsection
