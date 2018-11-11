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
- Using `Eloquent` allows us to extend the `Model` class, which has methods wrapped around query builders.
Eg. `$task = Task::find($id);` - The `find($id)` comes from the inheritance of the `Model` class
- We also added a static function by using a keyword `scope` in our function, rather than `static`. This lets Laravel know that the function is within the scope of the class:
Eg. `public function scopeGetIncompleted ($query)`. This allows `App\Task::getIncompleted()->where('id','>','2')->get();`
- Route Model Binding: Naming your wildcard in your route the same as the argument passed in the method used for the route allows Laravel to call specific query builder methods:
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
- 


Continue from here: https://laracasts.com/series/laravel-from-scratch-2017/episodes/15