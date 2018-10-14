# Image Points

Image points is a module that allows you to add "points" on an image that allows you to loop through items with `x` and `y` coordinates for positioning.

## Screenshot

![Screenshot](https://github.com/littlegiant/silverstripe-image-points/blob/master/screenshot.png)

## Installation

Installation via composer:

```bash
$ composer require littlegiant/silverstripe-image-points
```

## Usage

### Model

Include the point in your model.

```php
use LittleGiant\SilverstripeImagePoints\DataObjects\Point;
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

### Template

Usage in the template.

```html
<ol>
  <% loop $ImagePoints %>
    <li style="top: {$YPos}%; left: {$XPos}%;">
      <h4>{$Title}</h4>
      <p>{$Content}</p>
    </li>
  <% end_loop %>
</ol>
```

## Licence


The MIT License (MIT)

Copyright (c) 2015 Little Giant Design Ltd

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
