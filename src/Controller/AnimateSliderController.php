<?php

/**
 * @file
 * Contains \Drupal\animate_slider\Controller\AnimateSliderController.
 */

namespace Drupal\animate_slider\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller for animate_slider pages.
 *
 * @ingroup animate_slider
 */
class AnimateSliderController extends ControllerBase {

    public function animate() {


//        return array(
//          '#theme' => 'getnews',
//          '#test_var' => 'Hello',
//        );

        dsm('animate');

        return array(
            '#theme' => 'animate_slider',
            '#test_var' => 'Hello2',
        );
    }

}
