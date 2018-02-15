<?php
/**
 * Placeholder Pixel plugin for Craft CMS 3.x
 *
 * Create a base64-encoded transparent pixel of the given width and height
 *
 * @link      https://github.com/tibemolde
 * @copyright Copyright (c) 2018 TIBE Molde
 */

namespace tibemolde\placeholderpixel\variables;

use tibemolde\placeholderpixel\PlaceholderPixel;

/**
 * @author    TIBE Molde
 * @package   PlaceholderPixel
 * @since     1.0.0
 */
class PixelVariable
{
    // Public Methods
    // =========================================================================

    /**
     * @param array $options
     *
     * @return string
     *
     */
    public function get(array $options = ['width' => null, 'height' => null, 'aspectRatio' => null])
    {
        return PlaceholderPixel::$plugin->pixel->get($options);
    }
}
