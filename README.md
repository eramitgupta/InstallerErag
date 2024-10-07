## Laravel Installer: Easy & User-Friendly
<center>
<img width="956" alt="Screenshot 2024-10-04 at 10 34 23 PM" src="https://github.com/user-attachments/assets/b05fe465-6349-4705-9cf5-4f7086182f2d">
</center>
InstallerErag packages can be seamlessly integrated into any Laravel project. Designed for simplicity, this package allows you to dynamically configure essential settings such as:

- Minimum PHP version required
- PHP execution
- Default Laravel folder permissions
- `.env` file setup
- Custom account form

Additionally, InstallerErag automates database migrations and seeding processes.

![Laravel-InstallerErag](https://github.com/user-attachments/assets/43c68ea8-1544-4616-ba07-2462cfe384f4)

## Getting Started

Install the package via Composer:

```bash
composer require erag/installererag
```

### Step 1: Register the Service Provider

#### Laravel 11.x

Ensure the service provider is registered in `/bootstrap/providers.php`:

```php
return [
    // ...
    InstallerErag\InstallerServiceProvider::class
];
```

#### Laravel 10.x

Add the service provider to `config/app.php`:

```php
'providers' => [
    // ...
    InstallerErag\InstallerServiceProvider::class,
];
```

### Step 2: Publish Vendor Files

Run the following command to publish the necessary assets:

```bash
php artisan vendor:publish --tag=InstallerErag --force
```

### Step 3: Start Installation

Navigate to your installation URL:

```bash
https://yourdomain.com/install-app
```

### Step 4: Set Folder Permissions

Ensure the appropriate file or directory permissions with:

```bash
sudo chmod -R 775 directory_name
```

## Customizing Requirements and Permissions

To customize PHP requirements or folder permissions, edit `yourProject/config/install.php`:

```php
'requirements' => [
    // Add or remove PHP extensions as needed
],
'permissions' => [
    // Add or remove folder permissions as needed
]
```

## Adding Dynamic `.env` Variables

To add new `.env` variables dynamically, modify `yourProject/config/install.php` like so:

```php
'needed="34dsf24bcgf"' . "\n" .
'apikey="123456"',
```

## Inserting Dynamic Fields to the Account Form

To add extra fields to the account form:

1. Navigate to `resources/views/vendor/account.blade.php`.
2. Add the following code for a new field (e.g., phone number):

```html
<div class="col-md-12 mb-3">
    <x-install-input label="Phone Number" required="true" name="phone_number" type="text"
        value="{{ old('phone_number') }}" />
    <x-install-error for="phone_number" />
</div>
```

3. Update the input tag in `yourproject/config/install.php`:

```php
'account' => [
    'name' => 'required|string|max:255',
    'email' => 'required|email|unique:users|max:255',
    'password' => 'required|string|min:6',
    'phone_number' => 'required',
]
```
