<?php

namespace Innoweb\RequirementsResolver;

use Override;
use SilverStripe\Core\Injector\Injectable;
use SilverStripe\Core\Manifest\ModuleResourceLoader;
use SilverStripe\View\Requirements_Backend;

class PrioritisingJavascriptRequirementsBackend extends Requirements_Backend
{
    use Injectable;

    /**
     * Register the given JavaScript file as required.
     *
     * @param string $file Either relative to docroot or in the form "vendor/package:resource"
     * @param array $options List of options. Available options include:
     * - 'provides' : List of scripts files included in this file
     * - 'async' : Boolean value to set async attribute to script tag
     * - 'defer' : Boolean value to set defer attribute to script tag
     * - 'type' : Override script type= value.
     * - 'integrity' : SubResource Integrity hash
     * - 'crossorigin' : Cross-origin policy for the resource
     */
    #[Override]
    public function javascript($file, $options = [])
    {
        $file = ModuleResourceLoader::singleton()->resolvePath($file);

        // Get type
        $type = null;
        if (isset($this->javascript[$file]['type'])) {
            $type = $this->javascript[$file]['type'];
        }

        if (isset($options['type'])) {
            $type = $options['type'];
        }

        // make sure that async/defer is NOT set if it is set to false once. If it is requested to be non async/defer once, it should not be asynced/deferred
        $async = (
            (
                isset($options['async']) && isset($options['async'])
                && !isset($this->javascript[$file])
            ) || (
                isset($options['async']) && isset($options['async'])
                && isset($this->javascript[$file])
                && isset($this->javascript[$file]['async'])
                && $this->javascript[$file]['async'] == true
            )
        );
        $defer = (
            (
                isset($options['defer']) && isset($options['defer'])
                && !isset($this->javascript[$file])
            ) || (
                isset($options['defer']) && isset($options['defer'])
                && isset($this->javascript[$file])
                && isset($this->javascript[$file]['defer'])
                && $this->javascript[$file]['defer'] == true
            )
        );
        $integrity = $options['integrity'] ?? null;
        $crossorigin = $options['crossorigin'] ?? null;

        $this->javascript[$file] = [];
        if ($type) {
            $this->javascript[$file]['type'] = $type;
        }

        if ($async) {
            $this->javascript[$file]['async'] = true;
        }

        if ($defer) {
            $this->javascript[$file]['defer'] = true;
        }

        $this->javascript[$file]['integrity'] = $integrity;
        $this->javascript[$file]['crossorigin'] = $crossorigin;

        // Record scripts included in this file
        if (isset($options['provides'])) {
            $this->providedJavascript[$file] = array_values($options['provides'] ?? []);
        }
    }
}
