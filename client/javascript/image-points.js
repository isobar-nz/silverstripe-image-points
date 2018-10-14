'use strict';

(function ($) {
  $.entwine('ss', function ($) {
    $('.js-hot-spot').entwine({
      onclick: function (e) {
        var HOT_SPOT = $('.js-hot-spot');
        var HOT_SPOT_POINT = $('.js-hot-spot-point');
        var offset = $(this).offset();
        var POS_X = e.pageX - offset.left;
        var POS_Y = e.pageY - offset.top;
        var WIDTH = HOT_SPOT.width();
        var HEIGHT = HOT_SPOT.height();
        var PERCENTAGE_X = getPositionPercentage(POS_X, WIDTH);
        var PERCENTAGE_Y = getPositionPercentage(POS_Y, HEIGHT);

        // Set the hidden field values.
        $('#Form_ItemEditForm_Position_xPos').val(PERCENTAGE_X);
        $('#Form_ItemEditForm_Position_yPos').val(PERCENTAGE_Y);

        // Update the hot-spot point.
        HOT_SPOT_POINT.css('left', PERCENTAGE_X + '%');
        HOT_SPOT_POINT.css('top', PERCENTAGE_Y + '%');
      }
    });
  });

  /**
   * @desc Get the percentage of the position in relation to the image.
   * @param position
   * @param max
   * @returns {number}
   */
  function getPositionPercentage(position, max) {
    if (position > max) return 0; // protect against division by zero.
    return (position / max) * 100;
  }
})(jQuery);
