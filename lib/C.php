<?php

namespace AE;

class C extends B {

  protected function doCrayThingAgain($message) {
    echo __FUNCTION__ . ' says ' . $message  . PHP_EOL;
  }

  /**
   * @preprocess
   */
  protected function doCrayThing($message) {
    echo __FUNCTION__ . ' says ' . $message  . PHP_EOL;
  }

}

