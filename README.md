
## The Laravel installer is very user-friendly and easy to install.

<p align="center">
  <a href="https://paypal.me/teamdevgeek">
    <img src="https://github.com/eramitgupta/server-commands/blob/main/%24-donate-ff69b4.svg">
  </a>
</p>

![screenshot](https://raw.githubusercontent.com/eramitgupta/files/main/Laravel-InstallerErag.jpg)

## Getting Started

```bash
composer require erag/installererag
```

### step 1

It seems like you are trying to include a service provider in your Laravel application. If you want to add the InstallerErag\InstallerServiceProvider::class to your Laravel application, you typically need to follow these steps:

Locate config/app.php:
Open the config/app.php file in your Laravel project.

Find providers array:
Inside the config/app.php file, find the providers array.

```bash
'providers' => [
    // ...
    InstallerErag\InstallerServiceProvider::class,
],
```

### step 2

```bash
 php artisan vendor:publish --tag=InstallerErag --force
```

### step 3 Now start the installation

```bash
 https://yourdomain.com/app/install
```

![screenshot](https://raw.githubusercontent.com/eramitgupta/files/main/InstallerErag.gif)

### How to customize Requirements and Permissions?

Certainly! If you want just the content without additional explanations, here's the simplified content for your yourProject/config/install.php file.

"requirements" => Add or remove additional PHP extensions as needed <br>
"permissions" => Add or remove additional folder permissions as needed

### How to add new .env variable dynamic ?
If you want to create an additional .env file based on the configuration in the yourProject/config/install.php file, you can follow these steps:


We will be displaying an array of environments. Within the same array, you need to include the following.
Ex:
```bash
'needed="123456"',
```


### License

The MIT License (MIT). Please see License File for more information.

> GitHub [@eramitgupta](https://github.com/eramitgupta) &nbsp;&middot;&nbsp;
> Linkedin [@eramitgupta](https://www.linkedin.com/in/eramitgupta/)&nbsp;&middot;&nbsp;
> Donote [@eramitgupta](https://paypal.me/teamdevgeek/)

