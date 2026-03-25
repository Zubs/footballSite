@extends('layouts.app')

@section('content')
    <div class="date-nav">
        @include('partials.date-nav', ['date' => $date])
    </div>

    <div class="content">
        @include('partials.match-list', ['completed' => $completed, 'upcoming' => $upcoming])
    </div>
@endsection
