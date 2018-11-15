## Laravel App Project

### How to get started:
- Run `composer update` to update your packages
- Start `mysql` by running `brew services start mysql`
- Run the app in your local by running `php artisan serve`

### WIP:
- Checkout form to handle submissions

### Tips:
- `php artisan make:model Task -m`
    - This creates the model `Task`, but also creates a migration table
- `composer dump-autoload` refreshes the migration 
- `php artisan migrate:refresh` rollsback the migration, and re-executes migration from scratch
- `php artisan make:model Post -mc` creates the Post model, migration, and controller at the same time
- `php artisan tinker` allows you to tinker around your php application using php. (Eg. `App\Post::all()` will retrieve all data from the db)

### Good to knows for beginners:
- Continue from 13:39[here](https://laracasts.com/series/laravel-from-scratch-2017/episodes/19):
- Using `Eloquent` allows us to extend the `Model` class, which has methods wrapped around query builders.
Eg. `$task = Task::find($id);` - The `find($id)` comes from the inheritance of the `Model` class
- We also added a static function by using a keyword `scope` in our function, rather than `static`. This lets Laravel know that the function is within the scope of the class:
Eg. `public function scopeGetIncompleted ($query)`. This allows `App\Task::getIncompleted()->where('id','>','2')->get();`
- Route Model Binding: Naming your wildcard in your route the same as the argument passed in the method used for the route allows Laravel to call specific query builder methods. **YOUR WILDCARD FOR YOUR MODEL OBJECT NEEDS TO BE APPENDED WITH AN UNDERSCORE** (eg. `post_id`, `service_id`): 
eg. 
```
// Route
Route::get('/posts/{post_id}, 'PostsController@show');

// Controller
 public function show(Post $post_id) 
 {
     return view('posts.show', compact('post_id'));
 }

// They would be the id that's incremental in the db
```
- Eloquent gives us methods such as `hasMany()`. You want to pass in the path of the Model that has the relationship to the Model you are calling the function from. Options are:
    - Typing in the Model as a string: `App\Review`;
    - Using static property: `Review::class`;
- EG: 
```
    public function reviews() 
    {
        return $this->hasMany(Review::class);
    }
```
- HTML form elements only understand `GET` and `POST` requests. So with laravel, you will need to to have a `method_field` method call within the element, and specify the specific request type that way:
```
<form method="POST" action="/posts/{{ $post->id }}/review">
    {{ method_field('PATCH') }}
</form>
```
- Understand the difference between calling methods on an instance of a some model class and retrieving the property with the same method name:
- EG: `$someModel->reviews()` vs `$someModel->reviews`
- The first returns the relationship object (eg. hasMany, etc)
- The second returns the result of the relationship.
- See [this](https://stackoverflow.com/questions/28223289/difference-between-method-calls-model-relation-and-model-relation) for explanation
- [For user auth](https://laracasts.com/series/laravel-from-scratch-2017/episodes/17)
- To update migrations, create a new migration using `php artisan make:migration name_of_updating_migration`
    - Migrate the new migration files to update your database
- We need to start adding user registration and login authentication
    - This means we need more controllers and methods
    - One good best practice is to feel out/determine whether your controller is getting too big and create unique controllers. A good indicator of this is if the controller has more than the usual methods of `create`, `store`, `show`, `delete`, `update`, etc


### Form Submissions
- Remember your `csrf` protection that Laravel provides. Prevents cross-site request foregeries so that unauthorized commands will not be performed while behind the mask of an authenticated user. [Read this](https://laravel.com/docs/5.7/csrf)
- Remember your `MassAssignment` error. Submitting request information by using the static method create (`Post::create([ 'name' => request('name')])`) simply allows users to open up the form beyond the front end and submit other information by manipulating the form, thereby injecting malicious commands into the database
    - To help prevent this, create a protected instance variable called `$fillable` in the model and define the values that can be mass assigned.
    - Eg: `protected $fillable = ['name', 'email']`
    - Creating a `$guarded` variable is the inverse of fillable, which blacklists which values should not be accepted
    - The third way to do this is to create our own parent `Model` class, and declare either of the instance variables in there. That way, any classes that inherit `Model` will have that
- In the `PostsController`, there is some minor validation using the `validate` method. However, we should not be validating submissions in the controller. TODO: Decouple form validation

### Adding Reviews
- Every Post can have one or many reviews. In other words, **A post has many reviews**.
- Inversely, A review will belong to a post.
#### How do these reviews work?
- Going to `/posts/{post_id}` in the URL returns `show.blade.php` due to the controller
- This view contains the form that has a `post` method and has actions to `/posts/{post_id}/reviews`
- This is managed by the `ReviewsController`'s `store` method. It takes the `post_id` param (How does this become the post object of that specific post?)
- It calls the `addReview` method that lives in the `Post` model.
- This in turn allows the review associated with the post to be created

### Users
- users table already migrated due to boilerplate
- Manually saved a user...use `bcrypt` method to encapsulate password in order to save it as an encrypted password in the db
- Created views for the view layer
- Validated, created, saved, and logged in user upon successful registration in the `RegistrationController@store` method
- Logged out user in the `SessionsController@destroy` method

### Connecting Posts to its users. Reviews to its posts. Attaching review's users to reviews.
#### Upon creating reviews
1. Create review on a post. We know the post id due to the wild card passed in the endpoint.
    - eg: `Route::post('/posts/{post_id}/reviews', 'ReviewsController@store');`
2. The store method in `ReviewsController` does the following:
    - Validates the inputs using Eloquent's `validate` method
    - Call the `addReview` method that exists in `Post` model
    - After review is added to the `Post` model, takes user back a page to where the review is
3. The `addReview` method is important here.
    - It grabs the logged in user's id via `Auth::user()->id` (`Illuminate\Support\Facade\Auth`)
    - Calls its own class' `reviews` method, which returns the `hasMany` relationship object.
    - Because the relationship object is available, it can call the inherited method `create` from `Model` 
4. In the views of `show.blade.php`, we can accurately present post, the user of the post, reviews associated with the post, and the user who wrote the review:
    - post ID comes from the wildcard from the routes. 
        - When showing all posts, it loops through each post and adds it to the link href, so we get the post_id this way
    - In the `Post` model, we defined a `user` method that returns the `belongsTo` relationship. We can accurately grab the user associated to the post
    - In the `Review` model, we defined a `user` method that returns the `belongsTo` relationship. We can accurately grab the user associated to the review
        - Because we have assigned a foreign key of the logged in user's id who is creating the review, we know that is the correct user for the review
