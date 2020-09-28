<h2>Добро пожаловать, {{\Auth::user()->email}}</h2>
<br>
@if(\Auth::user()->isAdmin == 1)
    <a href="{{route('admin')}}">В админку</a></br>
@endif
<hr>
<a href="/">К статьям!</a>
<hr>
<br>
<br>
<br>
<a href="{{route('logout')}}">Выйти</a>