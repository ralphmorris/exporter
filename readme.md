# Exporter

Exporter is a package for Laravel that provides a simple csv export of any collection of models.

## Installation

```
composer require ralphmorris/exporter
```

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

    return $exporter->exportToCsv($users);
}
```

You can also optionally specify the filename by providing a second parameter.

```php
return $exporter->exportToCsv($users, 'my-file-name.csv');
```

### Speciying which columns to export

If you only want to export certain columns from your model simply include the ExportableColumnsTrait trait in your model class and define a protected property of $exportableColumns with an array of the fields you would like to be exportable.

For example:

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use RalphMorris\Exporter\ExportableColumnsTrait;

class User extends Model
{
	use ExportableColumnsTrait;

	/**
	 * The columns that are exportable to CSV
	 * 
	 * @var array
	 */
    protected $exportableColumns = [
        'name',
        'email',
    ];
```

Then in your query simply call the query scope exportableColumns() as per the below example.

```php
public function export()
{
    $users = User::exportableColumns()->get();

    $exporter = new Exporter;

    return $exporter->exportToCsv($users);
}
```