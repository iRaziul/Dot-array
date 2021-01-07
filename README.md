# Dot Array - Dot notation for PHP Array

Dot array can be used to access arrays in PHP with dot notation like other popular programming languages such as JavaScript.


## Examples

Regular array syntax in PHP:

```php
$array['data']['items']['user'] = 'John Doe';

echo $array['data']['items']['user'];

```

Using dot-array:

```php
Arr::set($array, 'data.items.user', 'John Doe');

echo Arr::get($array, 'data.items.user');
```

## Install

Install the latest version using [Composer](https://getcomposer.org/):

```
composer require iraziul/dot-array
```

## Methods

Dot has the following methods:

- [set()](#set)
- [get()](#get)
- [has()](#has)
- [delete()](#delete)
- [flatten()](#flatten)

<a name="set"></a>
### set()

Sets a given key / value pair:
```php
Arr::set($array, 'user.name', 'John Doe');

// Equivalent vanilla PHP
$array['user']['name'] = 'John Doe';
```

Multiple key / value pairs:
```php
Arr::set($array, [
    'user.name' => 'John Doe',
    'posts.count' => 119
]);
```


<a name="get"></a>
### get()

Returns the value of a given key:
```php
echo Arr::get($array, 'user.name');

// Equivalent vanilla PHP < 7.0
echo isset($array['user']['name']) ? $array['user']['name'] : null;

// Equivalent vanilla PHP >= 7.0
echo $array['user']['name'] ?? null;
```

Returns a given default value, if the given key doesn't exist:
```php
echo Arr::get($array, 'user.name', 'default value here');
```

<a name="has"></a>
### has()

Check if a given key exists (returns boolean true or false):
```php
Arr::has($array, 'user.name');
```


<a name="delete"></a>
### delete()

Deletes the given key:
```php
Arr::delete($array, 'user.name');

// Equivalent vanilla PHP
unset($array['user']['name']);
```

Multiple keys:
```php
Arr::delete($array, [
    'user.name',
    'page.title'
]);
```

<a name="flatten"></a>
### flatten()

Returns a flattened array with the keys delimited by a given character (default "."):
```php
$flatten = Arr::flatten($array);
```

## License

[MIT license](LICENSE.md)