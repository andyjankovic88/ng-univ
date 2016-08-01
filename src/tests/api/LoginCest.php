<?php
use \ApiTester;

class LoginCest
{
    public function _before(ApiTester $I)
    {
    }

    public function _after(ApiTester $I)
    {
    }


    /**
    * @group student
    * @group_id 2
    */

    // User Login Test Case
    public function testUserLoginStudent(ApiTester $I)
    {
        $I->login($I,2);
    }

    /**
    * @group academic
    * @group_id 3
    */

    // User Login Test Case
    public function testUserLoginAcademic(ApiTester $I)
    {
        $I->login($I,3);
    }

    /**
    * @group staff
    * @group_id 4
    */

    // User Login Test Case
    public function testUserLoginStaff(ApiTester $I)
    {
        $I->login($I,4);
    }

    /**
    * @group unadmin
    * @group_id 5
    */

    // User Login Test Case
    public function testUserLoginUnadmin(ApiTester $I)
    {
        $I->login($I,5);
    }

    /**
    * @group student
    * @group_id 2
    */

    // User Login Test Case with wrong password
    public function testBlankPasswordStudent(ApiTester $I)
    {

        $email = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>2));

        $group_name = $I->getGroupName(2);
        //+ve
        $I->am($group_name.' user');
        $I->wantTo('Login with Email & Password');
        $I->sendPost('user_login',['email' => $email, 'password' => '']);
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();

    }

    /**
    * @group student
    * @group_id 2
    */

    // User Login Test Case with wrong password
    public function testWrongCredsStudent(ApiTester $I)
    {

        $email = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>2));

        $group_name = $I->getGroupName(2);
        //+ve
        $I->am($group_name.' user');
        $I->wantTo('Login with Email & Password');
        $I->sendPost('user_login',['email' => $email, 'password' => '']);
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();

    }
}
