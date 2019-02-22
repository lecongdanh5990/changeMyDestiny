@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('menu')
        </div>
        <div class="col-md-9">
            <form action="/action_page.php">
                <div class="form-group">
                    <label for="email">Name of mission:</label>
                    <input type="email" class="form-control" id="email">
                </div>
                {{-- <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="pwd">
                </div>
                <div class="checkbox">
                    <label><input type="checkbox"> Remember me</label>
                </div> --}}
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
