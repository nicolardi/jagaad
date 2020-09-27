<?php

namespace Tests\Unit;

use App\Traits\ApiResponse;
use PHPUnit\Framework\TestCase;

/**
 * Tests if the ApiResponse trait is working
 */
class ApiResponseTest extends TestCase
{
    use ApiResponse;

    /**
     * Success Response
     *
     * @return void
     */
    public function testSuccessResponse()
    {
        $this->assertTrue(method_exists($this, 'successResponse'), 'success response method');
    }
  
     /**
     * Error Response
     *
     * @return void
     */
    public function testErrorResponse()
    {
        $this->assertTrue(method_exists($this, 'errorResponse'), 'error response method');
    }
}
