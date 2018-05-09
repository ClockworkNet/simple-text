<?php
/**
 * @link https://craftcms.com/
 * @copyright Copyright (c) Pixel & Tonic, Inc.
 * @license MIT
 */

namespace craft\simpletext;

use craft\events\RegisterComponentTypesEvent;
use craft\services\Fields;
use craft\services\UserPermissions;
use craft\simpletext\models\Settings;
use yii\base\Event;

/**
 * Simple Text plugin
 */
class Plugin extends \craft\base\Plugin
{

    const EDIT_BLOCK_PERMISSIONS = 'editCodeBlocks';
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // Register our field type.
        Event::on(Fields::class, Fields::EVENT_REGISTER_FIELD_TYPES, function(RegisterComponentTypesEvent $event) {
            $event->types[] = Field::class;
        });

        // Register field permission.
        Event::on(UserPermissions::class, UserPermissions::EVENT_REGISTER_PERMISSIONS,  function(RegisterComponentTypesEvent $event) {
                $event->permissions[\Craft::t('simple-text', 'Code Blocks')] = [
                self::EDIT_BLOCK_PERMISSIONS => ['label' => \Craft::t('simple-text', 'Edit Code Blocks')],
            ];
        });
    }
}
