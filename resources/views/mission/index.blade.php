@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('menu')
        </div>
        <div class="col-md-9">
            
            <mission-component></mission-component>
        </div>
    </div>
</div>
@endsection
