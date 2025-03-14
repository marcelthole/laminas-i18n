# IsInt

`Laminas\I18n\Validator\IsInt` validates if a given value **is an integer**, using
the locale provided.

Integer values are often written differently based on country or region. For
example, using English, you may write `1234` or `1,234`; both are integer
values, but the grouping is optional. In German, you'd write `1.234`, and in
French, `1 234`.

`Laminas\I18n\Validator\IsInt` will use a provided locale when evaluating the
validity of an integer value. In such cases, it doesn't simply strip the
separator, but instead validates that the correct separator as defined by used
locale.

Internally, PHP's `NumberFormatter` (`ext/intl`) tries to create a formatted number for the given value and locale.

## Basic Usage

```php
$validator = new Laminas\I18n\Validator\IsInt();

$validator->isValid(1234);    // returns true
$validator->isValid(1234.5);  // returns false
$validator->isValid('1,234'); // returns true
```

By default, if no locale is provided, `IsInt` will use the system locale
provided by PHP's `Locale` class and the `getDefault()` method.

(The above example assumes that the environment locale is set to `en`.)

Using a notation not specific to the locale results in a `false` evaulation.

## Using Locale

<!-- markdownlint-disable MD038 MD009 MD046 -->
=== "Constructor Usage"
    ```php
    $validator = new Laminas\I18n\Validator\IsInt(['locale' => 'en_US']);

    $validator->isValid(1234); // true
    ```

=== "Setter Usage"
    ```php
    $validator = new Laminas\I18n\Validator\IsInt();
    $validator->setLocale('en_US');

    $validator->isValid(1234); // true
    ```

=== "Locale Class Usage"
    ```php
    Locale::setDefault('en_US');

    $validator = new Laminas\I18n\Validator\IsInt();

    $validator->isValid(1234); // true
    ```
<!-- markdownlint-restore -->

### Get Current Value

To get the current value of this option, use the `getLocale()` method.

```php
$validator = new Laminas\I18n\Validator\IsInt(['locale' => 'en_US']);

echo $validator->getLocale(); // 'en_US'
```

### Default Value

By default, if no locale is provided, `IsInt` will use the system locale
provided by PHP's `Locale::getDefault()`.

## Strict Validation

By default, the value's data type is not enforced.

<!-- markdownlint-disable MD038 MD009 MD046 -->
=== "Default (Without Strict)"
    ```php
    $validator = new Laminas\I18n\Validator\IsInt();

    $validator->isValid(1234);   // true
    $validator->isValid('1234'); // true
    ```
<!-- markdownlint-restore -->

To enforced a strict validation set the `strict` option to `true`.

<!-- markdownlint-disable MD038 MD009 MD046 -->
=== "Constructor Usage"
    ```php
    $validator = new Laminas\I18n\Validator\IsInt(['strict' => true]);

    $validator->isValid(1234);   // true
    $validator->isValid('1234'); // false
    ```

=== "Setter Usage"
    ```php
    $validator = new Laminas\I18n\Validator\IsInt();
    $validator->setStrict(true)

    $validator->isValid(1234);   // true
    $validator->isValid('1234'); // false
    ```
<!-- markdownlint-restore -->

### Get Current Value

To get the current value of this option, use the `getStrict()` method.

```php
$validator = new Laminas\I18n\Validator\IsInt(['strict' => true]);

echo $validator->getStrict(); // true
```

### Default Value

The default value of this option is `false`.
