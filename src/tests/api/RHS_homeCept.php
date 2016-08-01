<?php
$I = new ApiTester($scenario);
$user_email = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'2'));
$user_password = 'ucroo123';
$subject_id = $I->getDataFromDbCustom($I,'unit','id',array());

//+ve
$I->am('Case 1 : get general side bar after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get general side bar after Login with Email & Password');
$I->sendPost('sidebar_rhs/general',['blocks' => 'at_university']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('RSH_homeCept1.json');

//-ve
$I->am('Case 2 : get general side bar with blank param after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get general side bar with blank param after Login with Email & Password');
$I->sendPost('sidebar_rhs/general',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('RSH_homeCept2.json');

//-ve
$I->am('Case 3 : get general side bar with invalid blocks param after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get general side bar with invalid blocks param after Login with Email & Password');
$I->sendPost('sidebar_rhs/general',['blocks' => '123at_university']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('RSH_homeCept2.json');

//-ve
$I->am('Case 4 : get group specific side bar with blank param after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get group specific side bar with blank param after login with Email & Password');
$I->sendPost('sidebar_rhs/group_specific',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('RSH_homeCept2.json');

//-ve
$I->am('Case 5 : get group specific side bar with object type empty after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get group specific side bar with object type empty after login with Email & Password');
$I->sendPost('sidebar_rhs/group_specific',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('RSH_homeCept2.json');

//-ve
$I->am('Case 6 : get group specific side bar with object type invalid after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get group specific side bar with object type invalid after login with Email & Password');
$I->sendPost('sidebar_rhs/group_specific/ontario',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('RSH_homeCept2.json');

//+ve
$I->am('Case 7 : get group specific side bar with object id and object type after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get group specific side bar with object type id and object type after login with Email & Password');
$I->sendPost('sidebar_rhs/group_specific/subject/'.$subject_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('RSH_homeCept3.json');

//-ve
$I->am('Case 8 : get group specific side bar with object id not exist as integer and object type after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get group specific side bar with object id not exist as integer and object type after login');
$I->sendPost('sidebar_rhs/group_specific/subject/1111111',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('RSH_homeCept3.json');


