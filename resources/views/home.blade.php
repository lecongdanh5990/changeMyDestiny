@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <menu-component></menu-component>
        </div>
        <div class="col-md-9">
            <router-view></router-view>
        </div>
    </div>
</div>
@endsection
