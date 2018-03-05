<?php
namespace Drupal\bubble_sort\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class BubbleSortSettingsForm extends ConfigFormBase
{
    /*
   * {@inheritdoc}
   */
    public function getFormId() {
        return 'bubble_sort_settings_form';
    }

    /*
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return ['bubble_sort.settings'];
    }

    /*
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $form = parent::buildForm($form, $form_state);
        $config = $this->config('bubble_sort.settings');

        $form['bubble'] = array(
            '#type' => 'fieldset',
            '#title' => $this->t('Bubble Sort Settings'),
        );

        $form['bubble']['sort_size'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Sort Size'),
            '#default_value' => $config->get('sort_size'),
            '#required' => TRUE,
        );
        $form['bubble']['min_range'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Min Range'),
            '#default_value' => $config->get('min_range'),
            '#required' => TRUE,
        );
        $form['bubble']['max_range'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Max Range'),
            '#default_value' => $config->get('max_range'),
            '#required' => TRUE,
        );

        return $form;
    }
    /*
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state){
        $config = $this->config('bubble_sort.settings');
        $config->set('sort_size', $form_state->getValue('sort_size'));
        $config->set('min_range', $form_state->getValue('min_range'));
        $config->set('max_range', $form_state->getValue('max_range'));
        $config->save();

    }
}