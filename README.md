# RESTful Server Framework

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/kartenmacherei/rest-framework/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/kartenmacherei/rest-framework/?branch=master)
[![Build Status](https://travis-ci.org/kartenmacherei/rest-framework.svg?branch=master)](https://travis-ci.org/kartenmacherei/rest-framework)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/3eb072a0-0f58-4d39-a91d-71662adbdcd7/mini.png)](https://insight.sensiolabs.com/projects/3eb072a0-0f58-4d39-a91d-71662adbdcd7)

The goal of this framework is to enable us to quickly bootstrap new RESTful Services while sticking to our very strict coding guidelines. This especially means that any kind of magic should be avoided. 

## Basic Concepts

## Components

### RestResource

- Provides a `Pattern` that can be matches against an ```URI``` 
- Supports HTTP verbs by implementing interfaces like `SupportsGetRequests`
- Returns `Action` objects through explicit methods like `getPostCommand()` or `getQuery()` 

### ResourceRouter

- Holds references to all ```RestResource``` objects it is responsible for
- Determines if it is responsible for routing a given URL in `canRoute()`
- Returns a `RestResource` in `doRoute()`

### Command

- Changes the state of a resource (like creating or updating)

### Query

- Does not change the state of a resource and only returns existing data.

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

// register a RestResource Router
$framework->registerResourceRouter(new BasketResourceRouter());

// let the framework process the request
$response = $framework->run($request);

// send the response to the client
$response->flush();
```

See https://github.com/kartenmacherei/rest-framework-example for a working example.

## License

This software is licensed under the terms of the [MIT license](https://opensource.org/licenses/MIT). See LICENSE.md for the full license.
