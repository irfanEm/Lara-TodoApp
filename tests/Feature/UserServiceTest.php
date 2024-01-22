<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    public function setUp(): void
    {
        parent::setUp();
        $this->userService = $this->app->make(UserService::class);
    }

    public function testLoginSukses()
    {
        self::assertTrue($this->userService->login("irfan_em", "271197"));
        self::assertTrue($this->userService->login("shilvia_qa", "170303"));
        self::assertTrue($this->userService->login("balqis_fa", "130321"));
    }

    public function testLoginNotFound()
    {
        self::assertFalse($this->userService->login("irfan", "271197"));
        self::assertFalse($this->userService->login("shilvia", "170303"));
        self::assertFalse($this->userService->login("balqis", "130321"));
    }

    public function testLoginWrongPw()
    {
        self::assertFalse($this->userService->login("irfan_em", "271190"));
        self::assertFalse($this->userService->login("shilvia_qa", "170304"));
        self::assertFalse($this->userService->login("balqis_fa", "130324"));
    }
}
