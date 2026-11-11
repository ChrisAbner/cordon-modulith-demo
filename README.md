# Cordon Modulith demo

A small Laravel 13 app with three modules, checked by [Cordon Modulith](https://github.com/ChrisAbner/Cordon-Modulith) on every pull request.

**See it fail:** [the demo pull request](../../pulls) takes two shortcuts between modules, and the Cordon check annotates each one in the diff.

## The modules

```text
app/Modules/
├── Catalog/    Contracts/ProductCatalog (public), Models/Product (internal)
├── Orders/     Services/PlaceOrder, Events/OrderPlaced (public)
└── Shipping/   Listeners/ScheduleShipment
```

`config/cordon.php` declares who may depend on whom:

```php
'Catalog' => ['depends_on' => []],
'Orders' => ['depends_on' => ['Catalog']],
'Shipping' => ['depends_on' => ['Orders']],
```

On `main`, Orders asks the catalog for prices through the `ProductCatalog` contract and announces `OrderPlaced`; Shipping listens to it. Cordon passes:

```text
$ vendor/bin/cordon verify
Cordon analysed 18 files in 3 modules (3 cross-module references).

No boundary violations.
```

## The pull request

It adds a stock check, and takes two shortcuts to get there:

- `PlaceOrder` reads the stock straight from Catalog's `Product` model, which is internal to Catalog.
- A new Catalog listener decrements the stock on `OrderPlaced`, so Catalog now depends on Orders, which it does not declare.

Cordon reports both:

```text
x [internal_access] app/Modules/Orders/Services/PlaceOrder.php:21
x [undeclared_dependency] app/Modules/Catalog/CatalogServiceProvider.php:20
x [undeclared_dependency] app/Modules/Catalog/Listeners/DecrementStock.php:10

3 boundary violations.
```

Orders already depends on Catalog, but listening to an event does not close a cycle: Orders does not know who listens to `OrderPlaced`. Set `listeners.cycles` to `true` in `config/cordon.php` and Cordon also reports `Catalog -> Orders -> Catalog` as a cycle.

One way to fix it: add a `stockOf()` method to `ProductCatalog` for the check, and have Catalog react to the order through something Catalog owns, or let Orders call a Catalog contract to reserve the stock.

## How the check runs

`.github/workflows/cordon.yml`:

```yaml
- uses: actions/checkout@v7
- uses: ChrisAbner/Cordon-Modulith@v0.4.0
```

The action installs the Composer dependencies and runs `vendor/bin/cordon verify --format=github`. It does not boot the application, so the job needs no `.env`, database or `APP_KEY`.

To run it locally:

```bash
composer install
vendor/bin/cordon verify
```
