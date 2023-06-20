<?php

namespace Drupal\custom_events\Event;

use Drupal\Component\EventDispatcher\Event;
use Drupal\user\UserInterface;

/**
 * Event that is fired when a user logs in.
 */
class UserLoginEvent extends Event {

    const EVENT_NAME = 'custom_evensts_user_login';

    /**
     * The user account.
     * 
     * @var \Drupal\user\UserInterface
     */
    public $account;

    /**
     * Constructs the object.
     * 
     * @param \Drupal\user\UserInterface $account
     */
    public function __construct(UserInterface $account) {
        $this->account = $account;
    }

    
}    