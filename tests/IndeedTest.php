<?php

use Aamortimer\Indeed\Indeed;

class IndeedTest extends PHPUnit_Framework_TestCase {
  /**
   * @expectedException InvalidArgumentException
   */
   public function testDetailsJobKeyException()
   {
      $indeed = new Indeed;
      $indeed->details(array());
   }
}
