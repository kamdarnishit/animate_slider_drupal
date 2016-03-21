<?php

namespace Drupal\animate_slider\Plugin\views\style;

use Drupal\views\Plugin\views\style\StylePluginBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Style plugin for the cards view.
 *
 * @ViewsStyle(
 *   id = "animate_slider",
 *   title = @Translation("Animate Slider"),
 *   help = @Translation("Animate Slider"),
 *   theme = "animate_slider_style",
 *   display_types = {"normal"}
 * )
 */
class AnimateSlider extends StylePluginBase {

    /**
     * Does the style plugin for itself support to add fields to it's output.
     *
     * @var bool
     */
    protected $usesFields = TRUE;

    /**
     * Denotes whether the plugin has an additional options form.
     *
     * @var bool
     */
    protected $usesOptions = TRUE;

    /**
     * Does the style plugin allows to use style plugins.
     *
     * @var bool
     */
    protected $usesRowPlugin = TRUE;

    /**
     * Does the style plugin support custom css class for the rows.
     *
     * @var bool
     */
    protected $usesRowClass = FALSE;

    /**
     * Does the style plugin support grouping.
     *
     * @var bool
     */
    protected $usesGrouping = FALSE;

    /**
     * {@inheritdoc}
     */
    protected function defineOptions() {
        parent::defineOptions();
        $options['autoplay'] = array('default' => TRUE);
        $options['interval'] = array('default' => 4000);
        $options['show_transition'] = array('default' => '');
        $options['hide_transition'] = array('default' => '');
    }

    /**
     * {@inheritdoc}
     */
    public function buildOptionsForm(&$form, FormStateInterface $form_state) {
        parent::buildOptionsForm($form, $form_state);

        $options = array('' => $this->t('- NONE -'));
        $field_labels = $this->displayHandler->getFieldLabels(TRUE);
        $field_labels = array_keys($field_labels);
        
        $options+=$field_labels;



        $form['global'] = array(
            '#type' => 'fieldset',
            '#title' => 'Global',
        );

        
        $form['global']['autoplay'] = array(
            '#type' => 'checkbox',
            '#title' => $this->t('Autoplay'),
            '#default_value' => (isset($this->options['global']['autoplay'])) ?
                    $this->options['global']['autoplay'] : $this->options['autoplay'],
            '#description' => t('Enable to auto play.'),
        );

        $form['global']['interval'] = array(
            '#type' => 'number',
            '#title' => $this->t('Interval'),
            '#attributes' => array(
                'min' => 0,
                'step' => 1,
                'value' => (isset($this->options['global']['interval'])) ?
                        $this->options['global']['interval'] : $this->options['interval'],
            ),
            '#description' => t('Specifies Interval in milliseconds.'),
        );

        for($i=0;$i<count($field_labels);$i++){
            
        
        $form[$field_labels[$i]] = array(
            '#type' => 'fieldset',
            '#title' => $field_labels[$i],
        );

        $form[$field_labels[$i]]['show_transition'] = [
            '#type' => 'select',
            '#title' => $this->t('Show Transition'),
            '#description' => t('Show Transition'),
            '#default_value' => (isset($this->options[$field_labels[$i]]['show_transition'])) ?
                    $this->options[$field_labels[$i]]['show_transition'] : $this->options[$field_labels[$i]]['show_transition'],
            '#options' => [
                'Slide Effects' => [
                    'slideInDown' => $this->t('slideInDown'),
                    'slideInLeft' => $this->t('slideInLeft'),
                    'slideInRight' => $this->t('slideInRight'),
                    'slideInUp' => $this->t('slideInUp'),
                ],
                'Fade Effects' => [
                    'fadeIn' => $this->t('fadeIn'),
                    'fadeInDown' => $this->t('fadeInDown'),
                    'fadeInDownBig' => $this->t('fadeInDownBig'),
                    'fadeInLeft' => $this->t('fadeInLeft'),
                    'fadeInLeftBig' => $this->t('fadeInLeftBig'),
                    'fadeInRight' => $this->t('fadeInRight'),
                    'fadeInRightBig' => $this->t('fadeInRightBig'),
                    'fadeInUp' => $this->t('fadeInUp'),
                    'fadeInUpBig' => $this->t('fadeInUpBig'),
                    'fadeInUpLarge' => $this->t('fadeInUpLarge'),
                    'fadeInDownLarge' => $this->t('fadeInDownLarge'),
                    'fadeInLeftLarge' => $this->t('fadeInLeftLarge'),
                    'fadeInRightLarge' => $this->t('fadeInRightLarge'),
                    'fadeInUpLeft' => $this->t('fadeInUpLeft'),
                    'fadeInUpLeftBig' => $this->t('fadeInUpLeftBig'),
                    'fadeInUpLeftLarge' => $this->t('fadeInUpLeftLarge'),
                    'fadeInUpRight' => $this->t('fadeInUpRight'),
                    'fadeInUpRightBig' => $this->t('fadeInUpRightBig'),
                    'fadeInUpRightLarge' => $this->t('fadeInUpRightLarge'),
                    'fadeInDownLeft' => $this->t('fadeInDownLeft'),
                    'fadeInDownLeftBig' => $this->t('fadeInDownLeftBig'),
                    'fadeInDownLeftLarge' => $this->t('fadeInDownLeftLarge'),
                    'fadeInDownRight' => $this->t('fadeInDownRight'),
                    'fadeInDownRightBig' => $this->t('fadeInDownRightBig'),
                    'fadeInDownRightLarge' => $this->t('fadeInDownRightLarge'),
                ],
                'Flip Effects' => [
                    'flipInX' => $this->t('flipInX'),
                    'flipInY' => $this->t('flipInY'),
                    'lightSpeedIn' => $this->t('lightSpeedIn'),
                    'flipInTopFront' => $this->t('flipInTopFront'),
                    'flipInTopBack' => $this->t('flipInTopBack'),
                    'flipInBottomFront' => $this->t('flipInBottomFront'),
                    'flipInBottomBack' => $this->t('flipInBottomBack'),
                    'flipInLeftFront' => $this->t('flipInLeftFront'),
                    'flipInLeftBack' => $this->t('flipInLeftBack'),
                    'flipInRightFront' => $this->t('flipInRightFront'),
                    'flipInRightBack' => $this->t('flipInRightBack'),
                ],
                'Bounce Effects' => [
                    'bounce' => $this->t('bounce'),
                    'bounceIn' => $this->t('bounceIn'),
                    'bounceInDown' => $this->t('bounceInDown'),
                    'bounceInRight' => $this->t('bounceInRight'),
                    'bounceInUp' => $this->t('bounceInUp'),
                    'bounceInBig' => $this->t('bounceInBig'),
                    'bounceInLarge' => $this->t('bounceInLarge'),
                    'bounceInUpBig' => $this->t('bounceInUpBig'),
                    'bounceInUpLarge' => $this->t('bounceInUpLarge'),
                    'bounceInDownBig' => $this->t('bounceInDownBig'),
                    'bounceInDownLarge' => $this->t('bounceInDownLarge'),
                    'bounceInLeft' => $this->t('bounceInLeft'),
                    'bounceInLeftBig' => $this->t('bounceInLeftBig'),
                    'bounceInLeftLarge' => $this->t('bounceInLeftLarge'),
                    'bounceInRightBig' => $this->t('bounceInRightBig'),
                    'bounceInRightLarge' => $this->t('bounceInRightLarge'),
                    'bounceInUpLeft' => $this->t('bounceInUpLeft'),
                    'bounceInUpLeftBig' => $this->t('bounceInUpLeftBig'),
                    'bounceInUpLeftLarge' => $this->t('bounceInUpLeftLarge'),
                    'bounceInUpRight' => $this->t('bounceInUpRight'),
                    'bounceInUpRightBig' => $this->t('bounceInUpRightBig'),
                    'bounceInUpRightLarge' => $this->t('bounceInUpRightLarge'),
                    'bounceInDownLeft' => $this->t('bounceInDownLeft'),
                    'bounceInDownLeftBig' => $this->t('bounceInDownLeftBig'),
                    'bounceInDownLeftLarge' => $this->t('bounceInDownLeftLarge'),
                    'bounceInDownRight' => $this->t('bounceInDownRight'),
                    'bounceInDownRightBig' => $this->t('bounceInDownRightBig'),
                    'bounceInDownRightLarge' => $this->t('bounceInDownRightLarge'),
                ],
                'Rotate Effects' => [
                    'rotateIn' => $this->t('rotateIn'),
                    'rotateInDownLeft' => $this->t('rotateInDownLeft'),
                    'rotateInDownRight' => $this->t('rotateInDownRight'),
                    'rotateInUpLeft' => $this->t('rotateInUpLeft'),
                    'rotateInUpRight' => $this->t('rotateInUpRight'),
                ],
                'Zoom Effects' => [
                    'zoomIn' => $this->t('zoomIn'),
                    'zoomInUp' => $this->t('zoomInUp'),
                    'zoomInUpBig' => $this->t('zoomInUpBig'),
                    'zoomInUpLarge' => $this->t('zoomInUpLarge'),
                    'zoomInDown' => $this->t('zoomInDown'),
                    'zoomInDownBig' => $this->t('zoomInDownBig'),
                    'zoomInDownLarge' => $this->t('zoomInDownLarge'),
                    'zoomInLeft' => $this->t('zoomInLeft'),
                    'zoomInLeftBig' => $this->t('zoomInLeftBig'),
                    'zoomInLeftLarge' => $this->t('zoomInLeftLarge'),
                    'zoomInRight' => $this->t('zoomInRight'),
                    'zoomInRightBig' => $this->t('zoomInRightBig'),
                    'zoomInRightLarge' => $this->t('zoomInRightLarge'),
                    'zoomInUpLeft' => $this->t('zoomInUpLeft'),
                    'zoomInUpLeftBig' => $this->t('zoomInUpLeftBig'),
                    'zoomInUpLeftLarge' => $this->t('zoomInUpLeftLarge'),
                    'zoomInUpRight' => $this->t('zoomInUpRight'),
                    'zoomInUpRightBig' => $this->t('zoomInUpRightBig'),
                    'zoomInUpRightLarge' => $this->t('zoomInUpRightLarge'),
                    'zoomInDownLeft' => $this->t('zoomInDownLeft'),
                    'zoomInDownLeftBig' => $this->t('zoomInDownLeftBig'),
                    'zoomInDownLeftLarge' => $this->t('zoomInDownLeftLarge'),
                    'zoomInDownRight' => $this->t('zoomInDownRight'),
                    'zoomInDownRightBig' => $this->t('zoomInDownRightBig'),
                    'zoomInDownRightLarge' => $this->t('zoomInDownRightLarge'),
                ],
                'Other Effects' => [
                    'hinge' => $this->t('hinge'),
                    'rollIn' => $this->t('rollIn'),
                    'strobe' => $this->t('strobe'),
                    'shakeX' => $this->t('shakeX'),
                    'shakeY' => $this->t('shakeY'),
                    'spin' => $this->t('spin'),
                    'spinReverse' => $this->t('spinReverse'),
                    'slingshot' => $this->t('slingshot'),
                    'slingshotReverse' => $this->t('slingshotReverse'),
                    'pulsate' => $this->t('pulsate'),
                    'heartbeat' => $this->t('heartbeat'),
                    'panic' => $this->t('panic'),
                    'flash' => $this->t('flash'),
                    'pulse' => $this->t('pulse'),
                    'rubberBand' => $this->t('rubberBand'),
                    'shake' => $this->t('shake'),
                    'swing' => $this->t('swing'),
                    'tada' => $this->t('tada'),
                    'wobble' => $this->t('wobble'),
                ],
            ],
        ];

        
        $form[$field_labels[$i]]['hide_transition'] = [
            '#type' => 'select',
            '#title' => $this->t('Hide Transition'),
            '#description' => t('Hide Transition'),
            '#default_value' => (isset($this->options[$field_labels[$i]]['hide_transition'])) ?
                    $this->options[$field_labels[$i]]['hide_transition'] : $this->options[$field_labels[$i]]['hide_transition'],
            '#options' => [
                'Slide Effects' => [
                    'slideOutLeft' => $this->t('slideOutLeft'),
                    'slideOutRight' => $this->t('slideOutRight'),
                    'slideOutUp' => $this->t('slideOutUp'),
                    'slideOutDown' => $this->t('slideOutDown'),
                ],
                'Fade Effects' => [
                    'fadeOut' => $this->t('fadeOut'),
                    'fadeOutUpLarge' => $this->t('fadeOutUpLarge'),
                    'fadeOutDownLarge' => $this->t('fadeOutDownLarge'),
                    'fadeOutLeftLarge' => $this->t('fadeOutLeftLarge'),
                    'fadeOutRightLarge' => $this->t('fadeOutRightLarge'),
                    'fadeOutUpLeft' => $this->t('fadeOutUpLeft'),
                    'fadeOutUpLeftBig' => $this->t('fadeOutUpLeftBig'),
                    'fadeOutUpLeftLarge' => $this->t('fadeOutUpLeftLarge'),
                    'fadeOutUpRight' => $this->t('fadeOutUpRight'),
                    'fadeOutUpRightBig' => $this->t('fadeOutUpRightBig'),
                    'fadeOutUpRightLarge' => $this->t('fadeOutUpRightLarge'),
                    'fadeOutDownLeft' => $this->t('fadeOutDownLeft'),
                    'fadeOutDownLeftBig' => $this->t('fadeOutDownLeftBig'),
                    'fadeOutDownLeftLarge' => $this->t('fadeOutDownLeftLarge'),
                    'fadeOutDownRight' => $this->t('fadeOutDownRight'),
                    'fadeOutDownRightBig' => $this->t('fadeOutDownRightBig'),
                    'fadeOutDownRightLarge' => $this->t('fadeOutDownRightLarge'),
                    'fadeOutDown' => $this->t('fadeOutDown'),
                    'fadeOutDownBig' => $this->t('fadeOutDownBig'),
                    'fadeOutLeft' => $this->t('fadeOutLeft'),
                    'fadeOutLeftBig' => $this->t('fadeOutLeftBig'),
                    'fadeOutRight' => $this->t('fadeOutRight'),
                    'fadeOutRightBig' => $this->t('fadeOutRightBig'),
                    'fadeOutUp' => $this->t('fadeOutUp'),
                    'fadeOutUpBig' => $this->t('fadeOutUpBig'),
                ],
                'Flip Effects' => [
                    'flipOutX' => $this->t('flipOutX'),
                    'flipOutY' => $this->t('flipOutY'),
                    'lightSpeedOut' => $this->t('lightSpeedOut'),
                    'flipOutTopFront' => $this->t('flipOutTopFront'),
                    'flipOutTopBack' => $this->t('flipOutTopBack'),
                    'flipOutBottomFront' => $this->t('flipOutBottomFront'),
                    'flipOutBottomback' => $this->t('flipOutBottomback'),
                    'flipOutLeftFront' => $this->t('flipOutLeftFront'),
                    'flipOutLeftBack' => $this->t('flipOutLeftBack'),
                    'flipOutRightFront' => $this->t('flipOutRightFront'),
                    'flipOutRightBack' => $this->t('flipOutRightBack'),
                ],
                'Bounce Effects' => [
                    'bounce' => $this->t('bounce'),
                    'bounceOut' => $this->t('bounceOut'),
                    'bounceOutDown' => $this->t('bounceOutDown'),
                    'bounceOutLeft' => $this->t('bounceOutLeft'),
                    'bounceOutRight' => $this->t('bounceOutRight'),
                    'bounceOutUp' => $this->t('bounceOutUp'),
                    'bounceOutBig' => $this->t('bounceOutBig'),
                    'bounceOutLarge' => $this->t('bounceOutLarge'),
                    'bounceOutUpBig' => $this->t('bounceOutUpBig'),
                    'bounceOutUpLarge' => $this->t('bounceOutUpLarge'),
                    'bounceOutDownBig' => $this->t('bounceOutDownBig'),
                    'bounceOutDownLarge' => $this->t('bounceOutDownLarge'),
                    'bounceOutLeftBig' => $this->t('bounceOutLeftBig'),
                    'bounceOutLeftLarge' => $this->t('bounceOutLeftLarge'),
                    'bounceOutRightBig' => $this->t('bounceOutRightBig'),
                    'bounceOutRightLarge' => $this->t('bounceOutRightLarge'),
                    'bounceOutUpLeft' => $this->t('bounceOutUpLeft'),
                    'bounceOutUpLeftBig' => $this->t('bounceOutUpLeftBig'),
                    'bounceOutUpLeftLarge' => $this->t('bounceOutUpLeftLarge'),
                    'bounceOutUpRight' => $this->t('bounceOutUpRight'),
                    'bounceOutUpRightBig' => $this->t('bounceOutUpRightBig'),
                    'bounceOutUpRightLarge' => $this->t('bounceOutUpRightLarge'),
                    'bounceOutDownLeft' => $this->t('bounceOutDownLeft'),
                    'bounceOutDownLeftBig' => $this->t('bounceOutDownLeftBig'),
                    'bounceOutDownLeftLarge' => $this->t('bounceOutDownLeftLarge'),
                    'bounceOutDownRight' => $this->t('bounceOutDownRight'),
                    'bounceOutDownRightBig' => $this->t('bounceOutDownRightBig'),
                    'bounceOutDownRightLarge' => $this->t('bounceOutDownRightLarge'),
                ],
                'Rotate Effects' => [
                    'rotateOut' => $this->t('rotateOut'),
                    'rotateOutDownLeft' => $this->t('rotateOutDownLeft'),
                    'rotateOutDownRight' => $this->t('rotateOutDownRight'),
                    'rotateOutUpLeft' => $this->t('rotateOutUpLeft'),
                    'rotateOutUpRight' => $this->t('rotateOutUpRight'),
                ],
                'Zoom Effects' => [
                    'zoomOut' => $this->t('zoomOut'),
                    'zoomOutUp' => $this->t('zoomOutUp'),
                    'zoomOutUpBig' => $this->t('zoomOutUpBig'),
                    'zoomOutUpBig' => $this->t('zoomOutUpBig'),
                    'zoomOutUpLarge' => $this->t('zoomOutUpLarge'),
                    'zoomOutDownBig' => $this->t('zoomOutDownBig'),
                    'zoomOutDownLarge' => $this->t('zoomOutDownLarge'),
                    'zoomOutLeft' => $this->t('zoomOutLeft'),
                    'zoomOutLeftBig' => $this->t('zoomOutLeftBig'),
                    'zoomOutLeftLarge' => $this->t('zoomOutLeftLarge'),
                    'zoomOutRight' => $this->t('zoomOutRight'),
                    'zoomOutRightBig' => $this->t('zoomOutRightBig'),
                    'zoomOutRightLarge' => $this->t('zoomOutRightLarge'),
                    'zoomOutUpLeft' => $this->t('zoomOutUpLeft'),
                    'zoomOutUpLeftBig' => $this->t('zoomOutUpLeftBig'),
                    'zoomOutUpLeftLarge' => $this->t('zoomOutUpLeftLarge'),
                    'zoomOutUpRight' => $this->t('zoomOutUpRight'),
                    'zoomOutUpRightBig' => $this->t('zoomOutUpRightBig'),
                    'zoomOutUpRightLarge' => $this->t('zoomOutUpRightLarge'),
                    'zoomOutDownLeft' => $this->t('zoomOutDownLeft'),
                    'zoomOutDownLeftBig' => $this->t('zoomOutDownLeftBig'),
                    'zoomOutDownLeftLarge' => $this->t('zoomOutDownLeftLarge'),
                    'zoomOutDownRight' => $this->t('zoomOutDownRight'),
                    'zoomOutDownRightBig' => $this->t('zoomOutDownRightBig'),
                    'zoomOutDownRightLarge' => $this->t('zoomOutDownRightLarge'),
                ],
                'Other' => [
                    'rollOut' => $this->t('rollIn'),
                ],
            ],
        ];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function render() {

        dsm($this->view);
        
        $field_labels = $this->displayHandler->getFieldLabels(TRUE);

        $field_labels = array_keys($field_labels);

        dsm($field_labels,'label');
        
        for ($i = 0; $i < count($this->view->result); $i++) {
            for ($j = 0; $j < count($field_labels); $j++) {
                $field_item_list = $this->view->result[$i]->_entity->get($field_labels[$j]);
                $field_type = $field_item_list->getFieldDefinition()->getType();
                dsm($field_type,'type');
                
                if ($field_type == string) {
                    $caption[$i] = array('value'=>$field_item_list->getValue(),'label'=>$field_labels[$j]);
                } elseif ($field_type == image) {
                    $image[$i] = array('value'=>$this->view->style_plugin->getField($i, 'field_slide'),'label'=>$field_labels[$j]);
                    //$image[$i]['label'] = $field_labels[$j];
                }
            }
        }

        dsm($caption,'cap');
        dsm($image,'img');

        $item = new \stdClass();

        $item->image = $image;
        $item->caption = $caption;
        $item->labels = $field_labels;


        for ($i = 0; $i < count($image); $i++) {
            $item->data[$i] = array('image' =>array('value'=>$item->image[$i]['value'],'label'=>$item->image[$i]['label']), 'caption' => array('value'=>$item->caption[$i]['value'][0]['value'],'label'=>$item->caption[$i]['label']));
        }
        dsm($item->data);

        $build = array(
            '#theme' => $this->themeFunctions(),
            '#view' => $this->view,
            '#options' => $this->options,
            '#rows' => $item,
        );
        
        return $build;
    }
    
}
