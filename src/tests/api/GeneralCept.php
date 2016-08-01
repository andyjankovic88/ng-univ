<?php
$I = new ApiTester($scenario);
$I->wantTo('Fetch all universities list');
$I->sendGet('universities');
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();