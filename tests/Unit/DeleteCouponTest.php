<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class DeleteCouponTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDeleteCoupon()
    {

    $response = $this->call('DELETE', 'Coupon/19');

    $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue(true);
    }
}
