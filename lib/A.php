<?php

namespace AE;

class A {
  use AnnotationHookTrait;

  /**
   * @Preprocess
   */
  protected function doAsinineThing($message) {
    echo __FUNCTION__ . ' says ' . $message  . PHP_EOL;
  }

  protected function doAsinineThingAgain($message) {
    echo __FUNCTION__ . ' says ' . $message  . PHP_EOL;
  }

}
