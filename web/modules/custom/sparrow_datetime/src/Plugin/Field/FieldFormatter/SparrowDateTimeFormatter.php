<?php

/**
 * @file
 * Contains \Drupal\youtube_formatter\Plugin\field\formatter\YouTubeLinkFormatter.
 */

namespace Drupal\sparrow_datetime\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Datetime\Element\Datetime;
use Drupal\Component\Datetime\DateTimePlus;

/**
 * Plugin implementation of the 'Sparrow_datetime_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "Sparrow_datetime_formatter",
 *   label = @Translation("Sparrow Datetime Formatter"),
 *   field_types = {
 *     "datetime"
 *   }
 * )
 */
class SparrowDateTimeFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = array();

    foreach ($items as $delta => $item) {
      // Get datetime data.
      $value = $item->getValue()["value"];

      // Calculate time variables to show.
      $today = DateTimePlus::createFromTimestamp(strtotime("now"));
      $created = DateTimePlus::createFromTimestamp(strtotime($value));
      $diff = $today->diff($created);
      $diff = $diff->format('%d day(s) %h hour(s) %i minute(s) ago');
      $created = $created->format('Y-m-d');

      $elements[$delta] = array(
        '#theme' => 'sparrow_datetime_formatter',
        '#diff' => $diff,
        '#date' => $created,
      );

    }

    return $elements;
  }

}
