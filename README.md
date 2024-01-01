# About phractico

<p>
    <a href="https://codecov.io/gh/yknsilva/phractico"><img src="https://codecov.io/gh/yknsilva/phractico/branch/main/graph/badge.svg" alt="Coverage"/></a>
</p>

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

# Database

Your database connection must be mapped inside [ApplicationDatabaseProvider.php](./src/Database/ApplicationDatabaseProvider.php) class,
which is consumed by bootstrap file when application is initialized.

By default, **_phractico_** comes with a [SQLite database adapter](./src/Database/Connection/SQLiteAdapter.php)
assuming database file is located at path `/path/to/phractico/database/database.sqlite`.

If you want to have others adapters, you just need to implement [Connection](./src/Core/Infrastructure/Database/Connection.php)
and then mapping your new adapter in `ApplicationDatabaseProvider` file.

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

- Perform an HTTP request to ensure database connection works fine!
  - **Note:** `sqlite3` PHP extension is required for `SQLiteAdapter`
```shell
curl --location --request GET 'http://localhost:8000/exampleDatabase' \
--header 'Content-Type: application/json' \
--data '{
    "test": "database"
}'
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