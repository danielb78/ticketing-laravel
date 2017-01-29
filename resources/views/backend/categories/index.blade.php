@extends('layouts.master')
@section('title', 'All categories')
@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> All categories </h2>
            </div>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if ($categories->isEmpty())
                <p> There is no category.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <td>Nr</td>
                            <td>Name</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $number = 1 ?>
                    @foreach($categories as $category)
                        <tr>
                            <td>{!! $number++ !!}</td>
                            <td>{!! $category->name !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection