<?php
$I = new ApiTester($scenario);
//Academic - team+userid9178@ucroo.com
$user_email1 = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'3'));
$user_password1 = 'ucroo123';

//Student - temp4@ucroo.com
$user_email2 = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'2'));
$user_password2 = 'ucroo123';

//Universityadmin - chase+deakin1@ucroo.com
$user_email3 = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'5'));
$user_password3 = 'ucroo123';



//+ve
$I->am('Case 1 : Login as a Academic');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password1]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('LoginCept.json');

//+ve
$I->am('Case 2 : Login as a Student');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password2]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('LoginCept.json');

//+ve
$I->am('Case 3 : Login as a Universityadmin');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email3, 'password' => $user_password3]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('LoginCept.json');

//-ve
$I->am('Case 4 : Login as a Universityadmin with wrong credentials');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email3, 'password' => '$user_password3']);
$I->seeResponseCodeIs(401);
$I->seeResponseIsJson();

//-ve
$I->am('Case 5 : Login with blank password');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email3, 'password' => '']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();

//-ve
$I->am('Case 6 : Login with blank email');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => '', 'password' => $user_password3]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();