# Image Points

Image points is a module that allows you to add "points" on an image that allows you to loop through items with `x` and `y` coordinates for positioning.

## Installation

Installation via composer:

```bash
$ composer require littlegiant/silverstripe-image-points
```

## Usage

Include the point in your model.

```php
use LittleGiant\LittleImagePoints\DataObjects\Point;
```

By default the image point will use the model's `Image`, which is a required relationship your model needs. This is needed so you can ad points to something...

```php
private static $has_one = [
    'Image' => Image::class
];

private static $has_many = [
    'ImagePoints' => Point::class . '.PointOf'
];

private static $owns = [
    'Image'
];
```

Simply add/edit the points using a gridfield.

```php
$fields->addFieldsToTab('Root.ImagePoints', [
    new GridField('ImagePoints', 'Image Points', $this->ImagePoints(), $myGridfieldConfig),
]);
```
