# About phractico
Go fast with **_phractico_**, a PHP micro-project designed to accelerate your API projects with simplicity.

# Usage

**_phractico_** was designed with your precious resource in mind: _time!_ ⌚

The **_phractico_** ideology involves fewer configuration files to get your PHP API working.
The [Bootstrap file](./src/Core/Bootstrap.php) concentrates the entire application configuration
for _controllers_, _routing_, etc.

To introduce new endpoints in your API, you simply need to create a _controller_ class by
implementing the [`Controller`](./src/Core/Infrastructure/Http/Controller.php) interface and its `routes` method.
Then, describe routing resources to their actions. Finally,
map the new controller in [ApplicationControllerProvider.php](src/API/Http/Provider/ApplicationControllerProvider.php).

_Voilà!_ 🎉

For examples, see [ExampleController](./src/API/Http/Controller/ExampleController.php).

# Installation

Go fast with **_phractico_** and [phpctl](https://github.com/opencodeco/phpctl):

- Run `composer`
```shell
phpctl composer install
```

- Run a local server
```shell
phpctl server 8000
```

- Perform an HTTP request to ensure everything works fine!
```shell
curl --location 'http://localhost:8000/example'
```

# Tests & Quality Tools

To execute all PHPUnit test suites, run:
```shell
phpctl composer test
```

To execute quality tools, run:
```shell
phpctl composer quality
```

# Contributing

Feel free to explore the project and turn **_phractico_** more practical!