# Laravel Notify (Laravel 5 Package)

Notifications for Laravel 5. This is a simple package that extends  Illuminate MessageBag.
It provides a simple interface for displaying notifications.

Please note, this uses **session flashing** and therefore the messages are only stored for 1 page redirect, not
indefinitely.

## Installation
Require this package with composer using the following command:

    composer require coderjp/notify

Add the service provider to the `providers` array in `config/app.php`

    'Coderjp\Notify\NotifyServiceProvider',
    
Add the facade to the `aliases` array in `config/app.php`

    'Notify'    => 'Coderjp\Notify\Facades\Notify',
    
Generate the config file for changing various settings. This can be found in `config/notify.php`.
        
    php artisan vendor:publish --provider=Coderjp\\Notify\\NotifyServiceProvider

## Configuration

To add your own message types, add them to the `types` array in `config/notify.php`.
By default the options are `success, error, info`.

## Usage

### Storing Notifications
To store a notification call the type like so

```php
Notify::success('The user was added!');
Notify::error('There was a problem adding the user, Please try again');
Notify::info('The user\'s password was changed');
```

### Outputing Notifications

To output a certain type of notification

```php
if (Notify::has('success')
    <div class="alert alert-success">
        <ul>
        @foreach(Notify::get('success') as $message)
            <li>{{ $message }}</li>
        @endforeach
        </ul>
    </div>
@endif
```

To output all/any

```php
if (Notify::all())
    <div class="alert">
        <ul>
        @foreach(Notify::all() as $message)
            <li>{{ $message }}</li>
        @endforeach
        </ul>
    </div>
@endif
```

## Contributions

If you feel that this project should do more, please open a pull request or open an issue for future improvements / functionality.
