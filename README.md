# RESTful Server Framework

The goal of this framework is to enable us to quickly bootstrap new RESTful Services.

## Basic Concepts

## Components

### RestResource

- Returns a `Router` that determines if a given `URL` matches this `RestResource`
- Returns a `QueryLocator` and / or a `CommandLocator` 

### ResourceRequest

- Describes the request against a specific resource
- Returns a list of supported request methods
- Returns the request method

### Router

- Returns a `ResourceRequest` based on a given `URL` 

### Command

- Changes the state of a resource (like creating or updating)

### Query

- Does not change the state of a resource and only returns existing data.

### Request 



### Response

## Using the Framework

### Requirements

- Composer
- PHP 7.0+

### Add the Framework to your composer.json:
```
	"require": {
		"kartenmacherei/rest-framework": "dev-master"
	}
```

### Connect your code to the Framework:
```php
// create a request
$request = Request::fromSuperGlobals();

// create a new instance of the framework
$framework = Framework::createInstance();

// register a RestResource
$framework->registerResource(new ReadOnlyRestResource(new BasketRouter(), new BasketQueryLocator()));

// let the framework process the request
$response = $framework->run($request);

// send the response to the client
$response->flush();
```

See `/example/src/Application` for a working example.

## License

This software is licensed under the terms of the [MIT license](https://opensource.org/licenses/MIT). See LICENSE.md for the full license.
