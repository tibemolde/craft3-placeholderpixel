<?php
/**
 * Placeholder Pixel plugin for Craft CMS 3.x
 *
 * Create a base64-encoded transparent pixel of the given width and height
 *
 * @link      https://github.com/sjenset
 * @copyright Copyright (c) 2018 TIBE Molde
 */

namespace tibemolde\placeholderpixel;

use Craft;
use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;
use tibemolde\placeholderpixel\services\PixelService;
use tibemolde\placeholderpixel\variables\PixelVariable;
use yii\base\Event;

/**
 * Class PlaceholderPixel
 *
 * @property PixelService pixel
 * @author    TIBE Molde
 * @package   PlaceholderPixel
 * @since     1.0.0
 *
 */
class PlaceholderPixel extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var PlaceholderPixel
     */
    public static $plugin;
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;
        $this->setComponents(['pixel' => PixelService::class]);

        Event::on(CraftVariable::class, CraftVariable::EVENT_INIT, function (Event $event) {
            /** @var CraftVariable $variable */
            $variable = $event->sender;
            $variable->set('placeholderPixel', PixelVariable::class);
        });

        Craft::info(Craft::t('placeholder-pixel', '{name} plugin loaded', ['name' => $this->name]), __METHOD__);
    }
}
