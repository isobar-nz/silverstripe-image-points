<?php

namespace LittleGiant\SilverStripeImagePoints\DataObjects;

use LittleGiant\SilverStripeImagePoints\Forms\PointField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\FieldType\DBInt;
use SilverStripe\ORM\FieldType\DBText;
use SilverStripe\ORM\FieldType\DBVarchar;

/**
 * Class Point
 * @package LittleGiant\SilverStripeImagePoints\DataObjects
 */
class Point extends DataObject
{
    /**
     * @config
     * @var int
     */
    private static $image_width = 1920;

    /**
     * @config
     * @var int
     */
    private static $image_height = 823;

    /**
     * @var string
     */
    private static $table_name = 'LittleGiant_Silverstripe_ImagePoints_Point';

    /**
     * @var array
     */
    private static $db = [
        'Title'    => DBVarchar::class,
        'Content'  => DBText::class,
        'Position' => DBVarchar::class,
        'Sort'     => DBInt::class,
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'PointOf' => DataObject::class,
    ];

    /**
     * @var array
     */
    private static $defaults = [
        'Position' => '50,50',
    ];

    /**
     * @var array
     */
    private static $summary_fields = [
        'Title'           => 'Title',
        'Content.Summary' => 'Summary',
    ];

    /**
     * @var string
     */
    private static $default_sort = 'Sort';

    /**
     * @var string
     */
    private static $singular_name = 'Point';

    /**
     * @var string
     */
    private static $plural_name = 'Points';

    /**
     * @return \SilverStripe\Forms\FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Sort');
        $fields->removeByName('Position');
        $fields->removeByName('Content');
        $fields->removeByName('LinkTracking');
        $fields->removeByName('FileTracking');


        if (!$this->ID) {
            $fields->addFieldToTab('Root.Main', LiteralField::create('',
                '<p class="message notice"><strong>Note</strong>: To add a point, please save first.</p>'
            ));

            return $fields;
        }

        /**
         * Check if an image has been uploaded.
         */
        $image = $this->PointOf()->Image();
        if (!$image || !$image->exists()) {
            $fields->addFieldToTab('Root.Main', LiteralField::create('',
                sprintf(
                    '<p class="message warning"><strong>Warning</strong>: No Image found in <strong>%s</strong>, you will need to upload an image before you can plot a point.</p>',
                    $this->PointOf()->Title
                )
            ));

            return $fields;
        }

        $imageWidth = $this->config()->image_width;
        $imageHeight = $this->config()->image_height;

        $fields->addFieldsToTab('Root.Main', [
            TextareaField::create('Content', 'Content')
                ->setRows(2),
            PointField::create(
                'Position',
                DBField::create_field('HTMLFragment',
                    '<p>Position</p><p><small>Click the image to set the position</small></p>'
                ),
                $this->Position,
                $image->Fill($imageWidth, $imageHeight)->URL,
                $imageWidth,
                $imageHeight
            )->removeExtraClass('form-group'),
        ]);

        return $fields;
    }

    /**
     * @return float
     */
    public function getXPos(): float
    {
        $values = explode(',', $this->Position);
        $value = count($values) ? $values[0] : 0;

        return $value;
    }

    /**
     * @return float
     */
    public function getYPos(): float
    {
        $values = explode(',', $this->Position);
        $value = count($values) ? $values[1] : 0;

        return $value;
    }
}
