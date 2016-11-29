<?php
/**
 * @file
 * Contains \Drupal\contact_mail_templates\Form\ContactMailTemplatesForm.
 */

namespace Drupal\contact_mail_templates\Form;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

/**
 * Configure custom settings for this site.
 */
class ContactMailTemplatesForm extends ConfigFormBase {

  /**
   * Constructor for ContactMailTemplates.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   * The factory for configuration objects.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    parent::__construct($config_factory);
  }

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   * The unique string identifying the form.
   */
  public function getFormId() {
    return 'contact_mail_templates_form';
  }

  /**
   * Gets the configuration names that will be editable.
   *
   * @return array
   * An array of configuration object names that are editable if called in
   * conjunction with the trait's config() method.
   */
  protected function getEditableConfigNames() {
    return ['config.contact_mail_templates'];
  }

  /**
   * Form constructor.
   *
   * @param array $form
   * An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   * The current state of the form.
   *
   * @return array
   * The form structure.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['contact_mail_templates']['title'] = array(
      'title' => array(
        '#type' => 'textfield',
        '#title' => t('Title text'),
        '#maxlength' => 255,
        '#default_value' => '',
        '#description' => t('The title to display in e-mails.'),
      ),
    );

    $form['contact_mail_templates']['subject'] = array(
      'title' => array(
          '#type' => 'textfield',
          '#title' => t('Subject text'),
          '#default_value' => '',
          '#description' => t('The subject to display in e-mails.'),
      ),
    );

    $form['contact_mail_templates']['message'] = array(
      'title' => array(
        '#type' => 'text_format',
        '#title' => t('Message template'),
        '#default_value' => '',
        '#format' => 'restricted_html',
        '#description' => t('The template for message in e-mails.'),
      ),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   * An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   * The current state of the form.
   */

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('config.contact_mail_templates')
      ->set('logo_title', $form_state->getValue(array('contact_mail_templates', 'logo', 'title')))
      ->save();
    parent::submitForm($form, $form_state);
  }
}