## Laravel App Project


### How to get started:
- Run `composer update` to update your packages
- Start `mysql` by running `brew services start mysql`
- Run the app in your local by running `php artisan serve`

### Tips:
- `php artisan make:model Task -m`
    - This creates the model `Task`, but also creates a migration table
- `composer dump-autoload` refreshes the migration 
- `php artisan migrate:refresh` rollsback the migration, and re-executes migration from scratch
- `php artisan make:model Post -mc` creates the Post model, migration, and controller at the same time

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
Continue from here:
[https://laracasts.com/series/laravel-from-scratch-2017/episodes/10](https://laracasts.com/series/laravel-from-scratch-2017/episodes/10)