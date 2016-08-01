<?php 
$I = new ApiTester($scenario);
$I->wantTo('Return all universities');
$I->sendGet('universities');
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('demoCept.json');
