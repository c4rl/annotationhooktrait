<?php

namespace Aht;

class B extends A {

  /**
   * @preprocess
   */
  protected function doBallsyThing($message) {
    echo __FUNCTION__ . ' says ' . $message  . PHP_EOL;
  }

}


