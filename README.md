# laravel-trait-encrypt
A Laravel model trait for Encrypting model data

## Installation

```
"koodoo/laravel-trait-encrypt": "dev-master"
```

## Use

In the model

```
<?php
use Koodoo\laravelTraitEncrypt\Encryptable;
use Encryptable;

protected $encryptable = [
 'table_field_to_be_encrypted',
 'table_field_to_be_encrypted',
 'table_field_to_be_encrypted',
 'table_field_to_be_encrypted'
];
```