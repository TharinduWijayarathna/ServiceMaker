# Service Maker

tharindu/service-maker is a Composer package for Laravel that provides an Artisan command to generate service files. This package simplifies the process of creating service classes tailored to your Laravel application's needs.

## Installation

You can install the package via Composer:

```bash
composer require tharindu/service-maker
```

## Usage

To generate a service file, use the Artisan command:

```bash
php artisan make:service
```

Follow the prompts to specify whether to create a folder for the service, the folder name, model name related to the service, and the service name itself. The command will create the necessary service file in your Laravel application's `app/Services` directory.

## Example

Here's an example of how the generated service file looks:

```bash
<?php

namespace App\Services\Product;

use App\Models\Product;

class ProductService
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    // Example methods:
    public function store($data)
    {
        return $this->product->create($data);
    }

    public function update($data, $id)
    {
        return $this->product->where('id', $id)->update($data);
    }

    public function destroy($id)
    {
        return $this->product->destroy($id);
    }

    public function show($id)
    {
        return $this->product->find($id);
    }

    public function all()
    {
        return $this->product->all();
    }
}
```

Replace `ProductService`, `Product`, and methods as per your application's requirements.

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Contributing

Contributions are welcome! Feel free to submit issues and pull requests.

## Author

- Tharindu Wijayarathna
- Contact: wikum.dev@gmail.com

## Acknowledgements

Thank you to the Laravel community and contributors."
