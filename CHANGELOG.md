# Changelog

All notable changes are documented in this file using the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

## [3.0.0] - 2017-07-27

### Added

* add transaction monitoring through NewRelic
* instantiation has been changed: `Framework::createInstance(Config $config)`

## [2.1.6] - 2017-11-30

### Added

* introduced `ServiceUnavailableResponse`

## [2.1.5] - 2017-11-16

### Added

* introduced `Request::hasBody()`

## [2.1.1] - 2017-01-26

### Changed

* `ErrorHandler::register()` now accepts an optional `ExceptionRender`. If no renderer is provided, `JsonExceptionRenderer` will be used to retain backwards compatibility.

### Added

* introduced `JsonBody::has()`

## [2.1.0] - 2017-01-19

### Changed

* Allow body in `DELETE` requests

## [2.0.0] - 2017-01-17

### Changed

* Classes extending `RestResource` now need to implement the `getUriPattern()` method

### Added

* `PhpObjectContent` has been added to allow sending a response containing a serialised PHP object

## [1.0.0] - 2016-12-22

Initial Release

## [Unreleased]

[Unreleased]: https://github.com/kartenmacherei/rest-framework/compare/3.0.0...HEAD
[1.0.0]: https://github.com/kartenmacherei/rest-framework/releases/tag/1.0.0
[2.0.0]: https://github.com/kartenmacherei/rest-framework/releases/tag/2.0.0
[2.1.0]: https://github.com/kartenmacherei/rest-framework/releases/tag/2.1.0
[2.1.1]: https://github.com/kartenmacherei/rest-framework/releases/tag/2.1.1
[2.1.5]: https://github.com/kartenmacherei/rest-framework/releases/tag/2.1.5
[3.0.0]: https://github.com/kartenmacherei/rest-framework/releases/tag/3.0.0
