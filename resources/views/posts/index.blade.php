@extends ('layout')

@section ('content')
    <div class="col-sm-8">
        @foreach ($posts as $post)
            @include ('posts.account')
        @endforeach
    </div>
@endsection