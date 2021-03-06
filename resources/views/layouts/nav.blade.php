<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">Company name</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="/posts">Find Profiles</a>
        <a class="p-2 text-dark" href="/posts/create">Create Account</a>
        <a class="p-2 text-dark" href="/register">Register</a>
        @if (Auth::check())
            <a class="p-2 text-dark" href="#" style="text-transform: uppercase">{{ Auth::user()->name }}</a>
            <a class="p2 text-dark" href="/logout">Log out</a>
        @else
            <a class="p-2 text-dark" href="/login">Log in</a>
        @endif
        <a class="p-2 text-dark" href="#">Pricing</a>
    </nav>
    <a class="btn btn-outline-primary" href="#">Sign up</a>
</div>
  