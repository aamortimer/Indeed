<?php

use Aamortimer\Indeed\Indeed;

class IndeedTest extends PHPUnit_Framework_TestCase {
  /**
   * @expectedException InvalidArgumentException
   */
   public function testDetailsJobKeyException()
   {
      $indeed = new Indeed;
      $indeed->details(array('publisher'=>'12345'));
   }

   /**
    * @expectedException InvalidArgumentException
    */
    public function testSearchPublisherException()
    {
       $indeed = new Indeed;
       $indeed->search(array());
    }

   public function testDetailsJobKey()
   {
      $indeed = new Indeed;
      $indeed->details(array('publisher'=>'12345', 'jobkeys'=>1));
   }


}
