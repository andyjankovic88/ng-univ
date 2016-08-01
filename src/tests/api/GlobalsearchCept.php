<?php
$I = new ApiTester($scenario);

$user_email = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'2'));
$user_password = 'ucroo123';

//-ve
$I->am('Case 1 : Global search without search param after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Global search without search param after login');
$I->sendPost('ucroo_search/global',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('GlobalsearchCept.json');

//-ve
$I->am('Case 2 : Global search with search param blank after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Global search with search param blank after login');
$I->sendPost('ucroo_search/global',['search_term'=>'']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('GlobalsearchCept.json');


//+ve
$I->am('Case 3 : Global search with search param after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Global search with search param after login');
$I->sendPost('ucroo_search/global',['search_term'=>'chase']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('GlobalsearchCept1.json');

//+ve
$I->am('Case 4 : Global search with search param as numeric and special chars value after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Global search with search param as numeric and special chars value after login');
$I->sendPost('ucroo_search/global',['search_term'=>'11#!&*()_+1/1@1']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('GlobalsearchCept1.json');

//+ve
$I->am('Case 5 : Global search with page_number and per_page after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Global search with page_number and per_page after login');
$I->sendPost('ucroo_search/global/1/3',['search_term'=>'1111']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('GlobalsearchCept1.json');


//+ve
$I->am('Case 6 : Global search with page_number as string and per_page after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Global search with page_number as string and per_page after login');
$I->sendPost('ucroo_search/global/w/3',['search_term'=>'1111']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('GlobalsearchCept1.json');

//+ve
$I->am('Case 7 : Global search with page_number and per_page as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Global search with page_number and per_page as string after login');
$I->sendPost('ucroo_search/global/1/a',['search_term'=>'1111']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('GlobalsearchCept1.json');

