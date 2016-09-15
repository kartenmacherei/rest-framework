# RESTful Server Framework

The goal of this framework is to enable us to quickly bootstrap new RESTful Services.

## Basic Concepts

## Components

### Command

A command changes the state of a resource (like creating or updating).

### Query

A query does not change the state of a resource and only returns existing data.

### Request 

### Response

### RestResource

## Using the Framework

### Add the Framework to your composer.json:
```
	"require": {
		"kartenmacherei/http-framework": "^0.1.0"
	}
```

As long as the code is not publicly available, you'll also need to add a link to our private BitBucket repo:
```
    "repositories": [
        {
            "type": "vcs",
            "url":  "git@bitbucket.org:kartenmacherei/http-framework.git"
        },
    ]
```

### Connect your code to the Framework:
