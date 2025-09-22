# SilverStripe Requirements Resolver

## Overview

Helper module to resolve the path to global requirements like jQuery, and the like. 

This was built for Silverstripe 4 because the local jQuery and jQuery validate versions in framework were outdated and we needed a way to override those with a newer/more secure version. 

It helps making sure that only one version of a certain library is included for a site.

It also makes sure that when a JS requirement is called twice, once with defer/async and once without, the requirement is included without async/defer to make sure all js code works.

## Requirements

SilverStripe CMS 6, see [composer.json](composer.json)

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
jquery: 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js'
'jquery-validate': 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js'
'jqueryui-js': 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.1/jquery-ui.min.js'
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
