@extends('layout')


@section('HTMLContent')
    <div class="container">
        <div class="col-md-6">
            @include('activitiesList.index')
        </div>

        <div class="col-md-6">
            @include('todoTask.index')
        </div>
    </div>
@endsection