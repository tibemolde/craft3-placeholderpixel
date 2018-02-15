<?php
/**
 * Placeholder Pixel plugin for Craft CMS 3.x
 *
 * Create a base64-encoded transparent pixel of the given width and height
 *
 * @link      https://github.com/sjenset
 * @copyright Copyright (c) 2018 TIBE Molde
 */

namespace tibemolde\placeholderpixel\services;

use Craft;
use craft\base\Component;

/**
 * @author    TIBE Molde
 * @package   PlaceholderPixel
 * @since     1.0.0
 */
class PixelService extends Component
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
        $useGCD      = true;
        $width       = !empty($options['width']) ? $options['width'] : 1;
        $height      = !empty($options['height']) ? $options['height'] : 1;
        $aspectRatio = !empty($options['aspectRatio']['w']) && !empty($options['aspectRatio']['h']) ? $options['aspectRatio'] : ['w' => 16, 'h' => 10];
        if ($width > 1 && $height === 1) {
            $useGCD = false;
            $height = round($width / $aspectRatio['w'] * $aspectRatio['h']);
            if ($height < 1) {
                $height = 1;
            }
        } else if ($height > 1 && $width === 1) {
            $useGCD = false;
            $width  = round($height / $aspectRatio['h'] * $aspectRatio['w']);
            if ($width < 1) {
                $width = 1;
            }
        }
        if ($useGCD) {
            $gcd    = $this->getGCD($width, $height);
            $width  /= $gcd;
            $height /= $gcd;
        }
        $cacheKey    = "placeholderPixel{$width}x{$height}";
        $cachedPixel = Craft::$app->cache->get($cacheKey);
        if ($cachedPixel) {
            return $cachedPixel;
        }
        $im    = imagecreatetruecolor($width, $height);
        $black = imagecolorallocate($im, 0, 0, 0);
        imagecolortransparent($im, $black);
        ob_start();
        imagepng($im);
        $pixel = ob_get_contents();
        ob_end_clean();
        $encodedPixel = sprintf('%s,%s', 'data:image/png;base64', base64_encode($pixel));
        Craft::$app->cache->set($cacheKey, $encodedPixel);

        return $encodedPixel;
    }

    /**
     * @param $a
     * @param $b
     *
     * @return mixed
     */
    private function getGCD($a, $b)
    {
        while ($b !== 0) {
            $m = $a % $b;
            $a = $b;
            $b = $m;
        }

        return $a;
    }
}
