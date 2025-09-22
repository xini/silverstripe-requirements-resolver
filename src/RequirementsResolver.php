<?php

namespace Innoweb\RequirementsResolver;

use SilverStripe\Core\Config\Configurable;
use SilverStripe\Core\Extensible;
use SilverStripe\Core\Injector\Injectable;
use SilverStripe\View\TemplateGlobalProvider;

class RequirementsResolver implements TemplateGlobalProvider
{
    use Extensible;
    use Injectable;
    use Configurable;

    private static $requirements = [];

    public static function get_all()
    {
        return static::config()->get('requirements');
    }

    public static function get($key)
    {
        $all = static::get_all();
        if ($all && !empty($all) && isset($all[$key])) {
            return $all[$key];
        }

        return null;
    }

    public static function get_template_global_variables()
    {
        return [
            'ResolveRequirement' => 'get',
        ];
    }
}
