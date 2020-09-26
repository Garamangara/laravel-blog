@extends('layouts.admin')
@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h1 class="h2">Добавить категорию</h1>
        <br>
        <form method="POST">
            {!! csrf_field() !!}
            <p>Введите наименование категории:<br><input type="text" name="title" class="form-control" required> </p>
            <p>Введите текст категории:<br><textarea name="description" class="form-control"></textarea> </p>
            <button type="submit" class="btn btn-success" style="cursor: pointer">Добавить</button>
        </form>

    </main>
@stop