<?php

namespace DevOwl\RealCategoryLibrary\base;

use DevOwl\RealCategoryLibrary\Vendor\MatthiasWeb\Utils\Core as UtilsCore;
\defined('ABSPATH') or die('No script kiddies please!');
// Avoid direct file request
/**
 * Base class for the applications Core class.
 * @internal
 */
abstract class Core
{
    use \DevOwl\RealCategoryLibrary\base\UtilsProvider;
    use UtilsCore;
    /**
     * The constructor handles the core startup mechanism.
     *
     * The constructor is protected because a factory method should only create
     * a Core object.
     *
     * @codeCoverageIgnore
     */
    protected function __construct()
    {
        // Define lazy constants
        \define('RCL_TD', $this->getPluginData('TextDomain'));
        \define('RCL_VERSION', $this->getPluginData('Version'));
        $this->construct();
    }
}
