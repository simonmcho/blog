@extends ('layouts.layout')

@section ('content')
<form class="form-signin" method="POST" action="/posts">
    {{ csrf_field() }}

    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <label for="name" class="sr-only">Name</label>
    <input type="text" id="name" class="form-control" placeholder="Name" name="name" required>

    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required autofocus>

    <button class="btn btn-lg btn-primary btn-block" type="submit">CREATE!</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
</form>
@endsection