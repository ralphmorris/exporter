# Exporter

Exporter is a package for Laravel that provides a simple csv export of any collection of models.

## Usage

In your controller use:

```php
use RalphMorris\Exporter\Exporter;
```

Then inside your method a simple call could look like:

```php
public function export()
{
    $users = User::get();

    $exporter = new Exporter;

    return $exporter->exportToCsv($users');
}
```

You can also optionally specify the filename by providing a second parameter.

```php
return $exporter->exportToCsv($users', 'my-file-name.csv');
```
