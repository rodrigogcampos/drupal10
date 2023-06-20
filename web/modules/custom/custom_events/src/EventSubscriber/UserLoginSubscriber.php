<?php

namespace Drupal\custom_events\EventSubscriber;

use Drupal\custom_events\Event\UserLoginEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Class UserLoginSubscriber.
 * 
 * @package Drupal\custom_events\EventSubscriber
 */
class UserLoginSubscriber implements EventSubscriberInterface {
    use StringTranslationTrait;

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents() {
        return [
            UserLoginEvent::EVENT_NAME => 'onUserLogin',
        ];
    }

    public function onUserLogin(UserLoginEvent $event) {
        $database = \Drupal::database();
        $dateFormatter = \Drupal::service('date.formatter');

        $account_created = $database->select('users_field_data', 'ud')
            ->fields('ud', ['created'])
            ->condition('ud.uid', $event->account->id())
            ->execute()
            ->fetchField();

        \Drupal::messenger()->addStatus($this->t('Welcome, your account was created on %created_date.', 
          ['%created_date' => $dateFormatter->format($account_created, 'short'),
        ]));
    }

}