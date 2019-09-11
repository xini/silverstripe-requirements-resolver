# SilverStripe Requirements Resolver

## Overview

Helper module to resolve the path to global requirements like jQuery, and the like. 

It helps making sure that only one version of a certain library is included for a site.

It also makes sure that when a JS requirement is called twice, once with defer/async and once without, the requirement is included without async/defer to make sure all js code works.

## Requirements

SilverStripe CMS 4.2, see [composer.json](composer.json)

## Installation

Install the module using composer:

```
composer require innoweb/silverstripe-requirements-resolver dev-master
```
Then run dev/build.

## Usage

### In PHP

```
Requirements::javascript(
    RequirementsResolver::get('jquery')
);
```

### In template

```
<% require javascript($ResolveRequirement("jquery")) %>
```

## Configuration

The following requirements are pre-configured in the module's config:

```
'jquery': '//code.jquery.com/jquery-3.3.1.min.js'
'jquery-validate': '//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js'
'jqueryui-js': '//code.jquery.com/ui/1.12.1/jquery-ui.min.js'
```

Additional requirements can be added the the module's config:

```
Innoweb\RequirementsResolver\RequirementsResolver:
  requirements:
    '{key}': '{URL}'
```

Once configured, the key can be used to load the Requirements path.

## License

BSD 3-Clause License, see [License](license.md)
