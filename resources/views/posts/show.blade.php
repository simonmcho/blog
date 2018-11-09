@extends ('layout')

@section ('content')
    <div class="col-sm-8 blog-main">
        <h1>{{ $post_id->username }}</h1>
        <p>{{ $post_id->email }}</p>

        <hr>

        @if (count($post_id->reviews))
            <div class="reviews">
                <ul class="list-group">
                    @foreach ($post_id->reviews as $review)
                        <li class="list-group-item">
                            <strong>
                                Review posted: {{ $review->created_at->diffFOrHUmans() }}
                            </strong>
                            <article>
                                {{ $review->body }}
                            </article>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <br />
        <div class="card">
            <div class="card-block">
            <form method="POST" action="/posts/{{ $post_id->id }}/comments">
                    {{ method_field('PATCH') }}
                    <div class="form-group">
                        <textarea class="form-control" name="body" placeholder="Your review here"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add Review!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection