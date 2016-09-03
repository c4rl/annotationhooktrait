<?php

namespace AE;

/**
 * Class AnnotationHookTrait.
 *
 * @package AE
 */
trait AnnotationHookTrait {

  /**
   * Applies methods that map to given annotation name.
   *
   * @param string $annotation_name
   *   Name of annotation.
   *
   * Subsequent arguments will be passed to applicable methods.
   */
  function applyHook($annotation_name) {
    $args = func_get_args();
    array_shift($args);

    $instance = $this;
    array_map(function ($method_name) use ($instance, $args) {
      call_user_func_array([$instance, $method_name], $args);
    }, self::gatherApplicableMethodNames(get_called_class(), $annotation_name));
  }

  /**
   * Gather methods that for a given class apply to the annotation name.
   *
   * @param string $class_name
   *   Name of class.
   * @param $annotation_name
   *   Annotation name, without "@" prefix.
   *
   * @return string[]
   *   Array of applicable method names.
   */
  public static function gatherApplicableMethodNames($class_name, $annotation_name) {

    static $cache = [];

    $cache_key = implode(':', array_merge([__FUNCTION__], func_get_args()));

    if (!array_key_exists($cache_key, $cache)) {
      $methods = (new \ReflectionClass($class_name))->getMethods();

      $applicable_methods = array_filter($methods, function (\ReflectionMethod $method) use ($annotation_name) {
        return array_reduce(array_filter(explode(PHP_EOL, $method->getDocComment())), function ($annotation_applies, $line) use ($annotation_name) {
          return $annotation_applies || strtolower(trim($line)) == strtolower(sprintf('* @%s', $annotation_name));
        }, FALSE);
      });

      $applicable_method_names = array_map(function (\ReflectionMethod $method) {
        return $method->name;
      }, $applicable_methods);

      $cache[$cache_key] = array_reverse($applicable_method_names);
    }

    return $cache[$cache_key];
  }

}
