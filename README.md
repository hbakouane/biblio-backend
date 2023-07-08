![biblio-rounded](https://github.com/hbakouane/biblio-backend/assets/57842491/602ef1d5-553e-4107-9031-a08c2b270b33)
<br /><br />
![Work  - In Progress](https://img.shields.io/badge/Work_-In_Progress-blue?style=for-the-badge)

# Introduction
<p>Biblio is a web app for managing the work flow of a library, coming with an API as a microservice which you can use in a separate frontend project.</p>

<div align="center">

</div>

# Links:
[Frontend](https://github.com/hbakouane/biblio-frontend) <br />
[Backend](https://github.com/hbakouane/biblio-backend) <br />
[Postman API collection](https://universal-flare-482543.postman.co/workspace/New-Team-Workspace~2bcc94e9-0cca-41bf-b213-a9e38e7ed8d8/collection/15623240-8015b659-401c-4476-9912-7aa1c76904a6?action=share&creator=15623240)


# Installation:

### Backend:

Clone the repo first:
```
$ git clone https://github.com/hbakouane/biblio-backend && cd biblio-backend 
```

Install composer dependecies:
```
composer i
```

Create .env file
```
cp .env.example .env
```

Generate a key:
```
php artisan key:generate
```

Go to your .env and add your database credentials then run the migration
```
php artisan migrate
```

Are you on Mac? and using Valet? make sure you run this command so you can access the app via: biblio-backend.test
```
valet park
```

So far the project is good to go.

# Project architecture:
The whole project is located at the Modules folder, you can find there models, controllers, factories & seeders, migrations, observers, mails and ... <br />
Each module has a folder, let's take the Book module for example:
```
| Modules
    | Book
        | Config
        | Console
        | Database
            | factories
            | Migrations
            | Seeders
        | Entities
            Book.php
        | Http
            | Controllers
            | Middlewares
            | Requests
            | Traits
        | Providers
        | Resources
            | views
        | Routes
            books.php
        | Tests
        | Transformers
            BookResource
        composer.json
        module.json
        package.json
        vite.config.js
    | Order
    | Category
    | User
    | Profile
    ...
```

General information are located in the ```Core.php``` file, it has information like:
```
class Core
{
    /**
     * Items to return per page in a pagination
     */
    const ITEMS_PER_PAGE = 10;

    /**
     * Allowed image extensions
     *
     * @var array|string[]
     */
    public static array $allowedImageExtension = ['png', 'jpg', 'jpeg', 'svg'];

    /**
     * All media collections
     */
    const COLLECTION_PROFILE_IMAGES = 'profile_images';
}
```

# Mechanism:
We are gonna be using the command with the namespace ```module``` all over the application in order to create any Model, controller or whatever.
## Create a new Module:
```
php artisan module:make Customer
```
This creates our module folder which will hold all the files inside the Modules folder.

## Create a new Model
```
php artisan module:make-model Customer Customer
```
This will create a file in: ```Modules/Customer/Entities/Customer.php``` <br />
the created model looks like this:
```
<?php

namespace Modules\Customer\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuids;

class Customer extends Model
{
    use HasFactory, Uuids;

    /**
     * Mass-assignable attributes
     *
     * @var array[]
    */
    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Customer\Database\factories\CustomerFactory::new();
    }
}
```
To follow the convention of how the project was built, you have to create some files for each new created model, let's take the Book model for example:
```
use HasFactory, Uuids, BookMethods, BookRelationships, Updatable;
```
Let's go through the unusual ones one by one: <br />
#### BookMethods: 
This trait includes every method that is related to the book model, for example: ```createBook()``` <br />

You will notice that the BookMethods has a method called ```createBook()```, well, that's the case with every other module, we have one method which responsible for creating a new record of that model so that we can do modifications easily and just in one place when we want. 

#### BookRelationships: 
This trait includes every relationship of the book model, for example: ```publisher()``` or ```category()```

#### Updatable:
This is a global trait which can be used for all the models, it includes methods that related to updating a model, like: ```updateUsingRequest()```

<b>The goal from those traits is mainly leaving the Models just for properties, besides, any developer who is new to the project, they can directly access a method/relationship because they know exactly where it might be located.</b>

## Create a new controller:
<b>Note</b>: All the controllers are a single action controller
```
php artisan module:make-controller FetchAllCustomers Customer
```

## Migration:
Go to ```Modules/Customer/migrations/create_customers_table.php``` and put your code there

## File Upload:
We have one method that handles file uploading all over the project, it's located in the ```Modules\Core\Http\Controllers\CoreController``` class and it's called ```uploadMedia```, you basically feed it 2 required arguments and 3 optional ones.
```
/**
 * Uploads the given media to a collection
 *
 * @param User|Model $model
 * @param $media
 * @param string $collection
 * @param string|null $name
 * @param string|null $fileName
 * @return void
 * @throws FileDoesNotExist
 * @throws FileIsTooBig
 */
public function uploadMedia(
    User|Model $model,
    $media,
    string $collection,
    string $name = null,
    string $fileName = null
)
{
    $media = $model->addMedia($media);

    if ($name) $media->usingName($name);

    if ($fileName) $media->usingFileName($fileName);

    return $media->toMediaCollection($collection);
}
```
