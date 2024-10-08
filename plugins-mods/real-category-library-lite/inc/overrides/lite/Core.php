<?php

namespace DevOwl\RealCategoryLibrary\lite;

use DevOwl\RealCategoryLibrary\Vendor\DevOwl\Freemium\CoreLite;
// @codeCoverageIgnoreStart
\defined('ABSPATH') or die('No script kiddies please!');
// Avoid direct file request
// @codeCoverageIgnoreEnd
/** @internal */
trait Core
{
    use CoreLite;
    // Documented in IOverrideCore
    public function overrideConstruct()
    {
        // Silence is golden.
    }
    // Documented in IOverrideCore
    public function overrideInit()
    {
        // Silence is golden.
    }
}
