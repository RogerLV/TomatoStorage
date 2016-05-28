@extends('layout')


@section('HTMLContent')
    <div class="container">
        <div class="col-md-6">
            @include('activitiesList.index')
        </div>

        <div class="col-md-6">
            <h2>Today's task</h2>
        </div>
    </div>
@endsection


@section('JavascriptContent')

@endsection