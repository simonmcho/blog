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
 public function show (Task $task) // $task is same as Task::find($id);
    {        
        return view('tasks.show', compact('task'));
    }
```
Continue from here: https://laracasts.com/series/laravel-from-scratch-2017/episodes/11?autoplay=true

### Form Submissions
- Remember your `csrf` protection that Laravel provides. Prevents cross-site request foregeries so that unauthorized commands will not be performed while behind the mask of an authenticated user. [Read this](https://laravel.com/docs/5.7/csrf)
- Remember your `MassAssignment` error. Submitting request information by using the static method create (`Post::create([ 'name' => request('name')])`) simply allows users to open up the form beyond the front end and submit other information by manipulating the form, thereby injecting malicious commands into the database
    - To help prevent this, create a protected instance variable called `$fillable` in the model and define the values that can be mass assigned.
    - Eg: `protected $fillable = ['name', 'email']`
    - Creating a `$guarded` variable is the inverse of fillable, which blacklists which values should not be accepted
    - The third way to do this is to create our own parent `Model` class, and declare either of the instance variables in there. That way, any classes that inherit `Model` will have that
- In the `PostsController`, there is some minor validation using the `validate` method. However, we should not be validating submissions in the controller. TODO: Decouple form validation