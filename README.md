# JsonBin.io PHP SDK

A modern PHP SDK for the [JsonBin.io](https://jsonbin.io) API. This SDK uses PHP 8.2+ and follows development best practices to provide you with a clean and fluent interface to the JsonBin.io API.

## Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
  - [Initialization](#initialization)
  - [Working with Bins](#working-with-bins)
    - [Create a bin](#create-a-bin)
    - [Read a bin](#read-a-bin)
    - [Update a bin](#update-a-bin)
    - [Delete a bin](#delete-a-bin)
  - [Working with Collections](#working-with-collections)
    - [Create a collection](#create-a-collection)
    - [Read a collection](#read-a-collection)
    - [Update a collection](#update-a-collection)
    - [Delete a collection](#delete-a-collection)
    - [List bins in a collection](#list-bins-in-a-collection)
    - [List bins without collection (uncategorized)](#list-bins-without-collection-uncategorized)
    - [Add a bin to a collection](#add-a-bin-to-a-collection)
    - [Remove a bin from a collection](#remove-a-bin-from-a-collection)
  - [Working with Access Keys](#working-with-access-keys)
    - [Create an access key](#create-an-access-key)
    - [List access keys](#list-access-keys)
    - [Delete an access key](#delete-an-access-key)
  - [Working with Logs](#working-with-logs)
    - [List logs](#list-logs)
- [Error Handling](#error-handling)
- [Configuration Options](#configuration-options)

## Requirements

- PHP 8.2 or higher
- Composer

## Installation

```bash
composer require shevabam/jsonbin-sdk
```

## Usage

### Initialization

```php
<?php

require 'vendor/autoload.php';

use JsonBinSDK\JsonBinClient;

// Initialize the client with your Master Key
$client = new JsonBinClient('YOUR_API_KEY');
```

### Working with Bins

#### Create a bin

```php
// Create a simple bin
$data = ['name' => 'John Doe', 'age' => 30];
$result = $client->bins()->create($data);

// Create a bin with options
$result = $client->bins()->create($data, [
    'private' => true,
    'name' => 'My test bin',
    'collectionId' => 'COLLECTION_ID'
]);
```

#### Read a bin

```php
$binId = 'BIN_ID';
$bin = $client->bins()->read($binId);
```

#### Update a bin

```php
$binId = 'BIN_ID';
$updatedData = ['name' => 'Jane Doe', 'age' => 31];
$result = $client->bins()->update($binId, $updatedData);
```

#### Delete a bin

```php
$binId = 'BIN_ID';
$result = $client->bins()->delete($binId);
```

### Working with Collections

#### Create a collection

```php
$result = $client->collections()->create('My Collection');
```

#### Read a collection

```php
$collectionId = 'COLLECTION_ID';
$collection = $client->collections()->read($collectionId);
```

#### Update a collection

```php
$collectionId = 'COLLECTION_ID';
$result = $client->collections()->update($collectionId, 'New Collection Name');
```

#### Delete a collection

```php
$collectionId = 'COLLECTION_ID';
$result = $client->collections()->delete($collectionId);
```

#### List bins in a collection

```php
$collectionId = 'COLLECTION_ID';
$bins = $client->collections()->listBins($collectionId);
```

#### List bins without collection (uncategorized)

```php
$bins = $client->collections()->listUncategorizedBins();
```

#### Add a bin to a collection

```php
$collectionId = 'COLLECTION_ID';
$binId = 'BIN_ID';
$result = $client->collections()->addBin($collectionId, $binId);
```

#### Remove a bin from a collection

```php
$collectionId = 'COLLECTION_ID';
$binId = 'BIN_ID';
$result = $client->collections()->removeBin($collectionId, $binId);
```

### Working with Access Keys

#### Create an access key

```php
$result = $client->accessKey()->create('My New Access Key 2', [
    'read' => true,
    'update' => true,
    'delete' => true,
    'create' => true,
]);
```

#### List access keys

```php
$bins = $client->accessKey()->list();
```

#### Delete an access key

```php
$accessKey = 'abc123';
$bins = $client->accessKey()->delete($accessKey);
```

### Working with Logs

#### List logs

```php
$bins = $client->log()->list();
```



## Error Handling

The SDK throws `JsonBinSDK\Exception\ApiException` when an API error occurs:

```php
use JsonBinSDK\Exception\ApiException;

try {
    $bin = $client->bins()->read('non_existent_id');
} catch (ApiException $e) {
    echo 'API Error: ' . $e->getMessage();
}
```

## Configuration Options

You can customize the SDK behavior when creating the client:

```php
$client = new JsonBinClient('YOUR_API_KEY');
$client->getConfig()->setTimeout(60);
```

