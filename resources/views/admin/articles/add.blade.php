@extends('layouts.admin')
@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h1 class="h2">Добавить статью</h1>
        <br>
        <form method="POST">
            {!! csrf_field() !!}
            <p>Выбор категорий:</p><br>
                <select name="categories[]" class="form-control" multiple>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select></p>
            <p>Введите название статьи:<br><input type="text" name="title" class="form-control" required> </p>
            <p>Автор статьи:<br><input type="text" name="author" class="form-control" required> </p>
            <p>Краткое описание:<br><textarea name="short_text" class="form-control"></textarea> </p>
            <p>Полный текст:<br><textarea name="full_text" class="form-control full-text"></textarea> </p>
            <button type="submit" class="btn btn-success" style="cursor: pointer">Добавить</button>
        </form>
    </main>
@stop