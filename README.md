# Printful app

## Init project

Run

```bash
./init.sh
```

## Tests

### Run tests

```bash
docker-compose exec printful_php ./vendor/bin/phpunit
```

## Add printful shipping options to cache

```bash
docker-compose exec printful_php ./bin/console add-printful-shipping-options
```

## File cache folder

```bash
/tmp/dev-printful-cache/
```

For tests
```bash
/tmp/tests/dev-printful-cache/
```