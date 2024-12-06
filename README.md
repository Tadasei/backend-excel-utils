
# Tadasei/backend-excel-utils

This package provides stub utilities for working with [Laravel Excel](https://docs.laravel-excel.com/). It simplifies the creation of Excel exports by offering pre-built components, including a model for metadata and tracking, as well as traits for custom styles and cell data types.

## Features

- **Export Model**:  
  Provides metadata and tracking for Excel exports:
  - Export type (linked to the Laravel Excel export class).
  - User requesting the export.
  - Request time and timezone.
  - Processing timestamp (`processed_at`).
  - Integration with [tadasei/backend-file-management](https://github.com/tadasei/backend-file-management) for file metadata.

- **Traits for Excel Export Classes**:
  - `BoldHeadings`: Adds bold styling to heading cells.
  - `CenteredCells`: Centers the content of cells.
  - `CustomCellDataTypes`: Handles custom cell data types, including the `phoneNumber` type to preserve leading `+` in phone numbers.

- **Artisan Command for Quick Setup**:  
  Generates the following stubs ready for customization:
  - **Migration**: `database/migrations/YYYY_MM_DD_HHMMSS_create_exports_table.php`
  - **Model**: `app/Models/Export.php`
  - **Traits**:  
    - `app/Traits/BoldHeadings.php`  
    - `app/Traits/CenteredCells.php`  
    - `app/Traits/CustomCellDataTypes.php`  

## Installation

### Requirements

- Laravel (compatible with Laravel Excel)
- PHP 8.0+  
- [maatwebsite/excel](https://docs.laravel-excel.com/) `^3.1`  
- [tadasei/backend-file-management](https://github.com/tadasei/backend-file-management) `>=1.0.0`

### Steps

1. Install the package via Composer:

   ```bash
   composer require tadasei/backend-excel-utils
   ```

2. Run the installation command to generate stubs:

   ```bash
   php artisan excel-utils:install
   ```

   This will generate:
   - `database/migrations/YYYY_MM_DD_HHMMSS_create_exports_table.php`
   - `app/Models/Export.php`
   - `app/Traits/BoldHeadings.php`
   - `app/Traits/CenteredCells.php`
   - `app/Traits/CustomCellDataTypes.php`

## Usage

### Export Model

The `Export` model tracks metadata for your exports and integrates with the `File` model from the `tadasei/backend-file-management` package. Key attributes include:
- **type**: The Laravel Excel export class that triggers the export.
- **user_id**: The ID of the user who requested the export.
- **requested_at**: The timestamp of the export request.
- **timezone**: The user's timezone at the time of the request.
- **processed_at**: A nullable timestamp representing when the export was processed. It remains `null` if the export is pending or in progress.

Feel free to extend or customize the `Export` model to suit your application.

### Traits

#### 1. **BoldHeadings**

Use the `BoldHeadings` trait in your export classes to apply bold styling to heading cells. Implement it with Laravel Excel's `styles()` method:

```php
use App\Traits\BoldHeadings;

class ExampleExport implements FromCollection, WithStyles
{
    use BoldHeadings;

    // Other methods...
}
```

#### 2. **CenteredCells**

Apply centered alignment to cells using the `CenteredCells` trait:

```php
use App\Traits\CenteredCells;

class ExampleExport implements FromCollection, WithStyles
{
    use CenteredCells;

    // Other methods...
}
```

#### 3. **CustomCellDataTypes**

Support custom cell data types with the `CustomCellDataTypes` trait, such as preserving leading `+` in phone numbers:

```php
use App\Traits\CustomCellDataTypes;

class ExampleExport implements FromCollection, WithCustomValueBinder
{
    use CustomCellDataTypes;

    // Other methods...
}
```

## Customization

The generated files are stubs intended as a starting point. You can modify them to better fit your application's requirements.

## Contributing

Contributions are welcome! If you have suggestions, bug reports, or feature requests, please open an issue on the GitHub repository.


## License

This package is licensed under the [MIT License](LICENSE).
