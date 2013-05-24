<?php

function questionsanswers_form_system_theme_settings_alter(&$form, $form_state) {

  $form['advansed_theme_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Advansed Theme Settings'),
  );

  $form['advansed_theme_settings']['tm_value_3'] = array(
    '#type' => 'select',
    '#title' => t('Theme Skin'),
    '#default_value' => theme_get_setting('tm_value_3'),
    '#options' => array (
      'pink' => t('Blue & Pink'),
      'blue' => t('Green & Blue'),
	    'gray' => t('Gray & Dark'),
      'red' => t('Orange & Red'),
      'brown' => t('Brown & Green'),
      //'custom' => t('Custom'),
    ),
  );
  
  $form['advansed_theme_settings']['tm_value_6'] = array(
    '#type' => 'select',
    '#title' => t('Top Variation'),
    '#default_value' => theme_get_setting('tm_value_6'),
    //'#description' => t(''),
    '#options' => array (
      '0' => t('Disable'),
	    '1' => t('Enable'),
    ),
  );
/*
  $form['advansed_theme_settings']['tm_value_5'] = array(
    '#type' => 'select',
    '#title' => t('Theme Background'),
    '#default_value' => theme_get_setting('tm_value_5'),
    '#options' => array (
      '1' => t('Background 1'),
	    '2' => t('Background 2'),
      '3' => t('Background 3'),
      '4' => t('Background 4'),
      '5' => t('Background 5'),
      '6' => t('Background 6'),
      '7' => t('Background 7'),
      '8' => t('Background 8'),
      '9' => t('Background 9'),
      '10' => t('Background 10'),
      '11' => t('Background 11'),
      '12' => t('Background 12'),
      '13' => t('Background 13'),
      '14' => t('Background 14'),
      '15' => t('Background 15'),
      '16' => t('Background 16'),
      '17' => t('Background 17'),
      '18' => t('Background 18'),
      '19' => t('Background 19'),
      '20' => t('Background 20'),
      '21' => t('Background 21'),
      '22' => t('Background 22'),
      '23' => t('Background 23'),
      '24' => t('Background 24'),
      '25' => t('Background 25'),
      '26' => t('Background 26'),
      '27' => t('Background 27'),
      '28' => t('Background 28'),
      '29' => t('Background 29'),
      '30' => t('Background 30'),
      '31' => t('Background 31'),
      '32' => t('Background 32'),
      '33' => t('Background 33'),
      '34' => t('Background 34'),
      '35' => t('Background 35'),
      '36' => t('Background 36'),
      '37' => t('Background 37'),
    ),
  );
*/
  
  $form['advansed_theme_settings']['tm_value_0'] = array(
    '#type' => 'textfield',
    '#title' => t('Twitter'),
    '#default_value' => theme_get_setting('tm_value_0'),
    '#size' => 32,
  );
}

