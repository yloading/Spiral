<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\RandomController;

class RandomControllerUnitTest extends TestCase
{

    public function testInstanceOfRandomController() {
        $randomObjectController = new RandomController();

        $this->assertInstanceOf(RandomController::class, $randomObjectController);

        return $randomObjectController;
        
    }

    /**
     * A basic unit test example.
     * 
     * @depends testInstanceOfRandomController
     */
    
    public function testThisIsFiveRandomChar(RandomController $randomObjectController)
    {
        $randomObjectController->generateString();
    }

}
