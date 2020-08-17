<?php declare(strict_types=1);
require 'vendor/autoload.php';
require './models/ConnecDB.php';
require './models/UserModel.php';
require './controllers/UserController.php';
require './helpers/ResponseHelper.php';
require './helpers/RequestHelper.php';

use PHPUnit\Framework\TestCase;


class TestUser extends TestCase {

    /**
     * @test
     */
    public function saveUserWhenNotRequestParamsExists() {
        $userController = new UserController();
        $this->assertNull($userController->users_insert_update());
    }
}