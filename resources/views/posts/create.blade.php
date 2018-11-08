@extends ('layout')

@section ('content')

<div class="col-sm-8 blog-main">
    <p>Create an account!</p>
    
    <hr>

    <form method="POST" action="/posts">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name ="username" class="form-control" id="userName" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="emailAddress">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="email@gmail.com" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
        </div>
        <div class="form-group">
            <label for="passwordConfirm">Confirm Password</label>
            <input type="password" name="passwordConfirm" class="form-control" id="passwordConfirm" placeholder="Password" required>
        </div>
        {{-- <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <input type="file" id="exampleInputFile">
            <p class="help-block">Example block-level help text here.</p>
        </div> --}}
        {{-- <div class="checkbox">
            <label>
            <input type="checkbox"> Check me out
            </label>
        </div> --}}
        <select>
            <option value="buyer">Buyer</option>
            <option value="seller">Seller</option>
        </select>

        @include ('layouts.errors')

        <button type="submit" class="btn">Create account!</button>
    </form>
</div>

@endsection