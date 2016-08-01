<?php
//// DELETE FROM `connection` WHERE user_id_1=2 and user_id_2=1
// delete row in connection table where user_id_1=2 and user_id_2=1
$I = new ApiTester($scenario);

$user_email = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'2','uni_id'=>'13'));
$user_password = 'ucroo123';
$user_id_1 = $I->getDataFromDbCustom($I,'users','id',array('group_id'=>'2','uni_id'=>'13'));


$user_email2 = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'2','uni_id'=>'13'));
$user_password2 = 'ucroo123';
$user_id_2 = $I->getDataFromDbCustom($I,'users','id',array('group_id'=>'2','uni_id'=>'13'));
$entity_id=4;



//+ve
$I->am('Case 1 : Detail profile of person after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password2]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Detail profile of person after login');
$I->sendGet('profile/view/'.$user_id_1,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept1.json');

//-ve
$I->am('Case 2 : Detail profile of person with wrong user id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password2]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Detail profile of person with wrong user id after login');
$I->sendGet('profile/view/82222222222222222',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

//+ve
$I->am('Case 3 : get past_subjects of person after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password2]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get past_subjects of person after login');
$I->sendPost('profile/action/'.$user_id_1.'/past_subjects',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept2.json');

//-ve
$I->am('Case 4 : get past_subjects of person with user id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password2]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get past_subjects of person with user id not exist after login');
$I->sendPost('profile/action/16000000000/past_subjects',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


//+ve
$I->am('Case 6 : request_connection of person after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password2]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('request_connection of person after login');
$I->sendPost('profile/action/'.$user_id_1.'/request_connection',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept4.json');
 
 


//-ve
//// DELETE FROM `connection` WHERE user_id_1=2 and user_id_2=1
// delete row in connection table where user_id_1=2 and user_id_2=1
$I->am('Case 7 : request_connection of person with string as user_id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password2]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('request_connection of person with string as user_id after login');
$I->sendPost('profile/action/aaaaaaaaaaaa/request_connection',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


//-ve
$I->am('Case 9 : confirm_connection of person with string as user_id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password2]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('confirm_connection of person with string as user_id after login');
$I->sendPost('profile/action/844444/confirm_connection',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept4.json');

//+ve
$I->am('Case 8 : confirm_connection of person after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('confirm_connection of person after login');
$I->sendPost('profile/action/'.$user_id_2.'/confirm_connection',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept4.json');

//+ve
$I->am('Case 10 : ignore_connection of person after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('ignore_connection of person after login');
$I->sendPost('profile/action/'.$user_id_2.'/ignore_connection',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept4.json');





//-ve
$I->am('Case 11 : ignore_connection of person with user_id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('ignore_connection of person with user_id as string after login');
$I->sendPost('profile/action/eeeeeeeeee/ignore_connection',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept4.json');


//+ve
$I->am('Case 13 : profile do endorse on subject after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('profile do endorse on subject after login');
$I->sendPost('profile/do_endorse/UNIT/'.$entity_id.'/'.$user_id_1.'/0',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept4.json');

//-ve
$I->am('Case 14 : profile do endorse on subject with entity_id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('profile do endorse on subject with entity_id as string after login');
$I->sendPost('profile/do_endorse/UNIT/aaaaaaaa/'.$user_id_1.'/0',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept4.json');

//-ve
$I->am('Case 15 : profile do endorse on subject with user_id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('profile do endorse on subject with user_id as string after login');
$I->sendPost('profile/do_endorse/UNIT/'.$entity_id.'/aaaaaa/0',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept4.json');

//-ve
$I->am('Case 16 : profile do endorse on subject with user_id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('profile do endorse on subject with user_id as string after login');
$I->sendPost('profile/do_endorse/UNIT/'.$entity_id.'/aaaaaa/0',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept4.json');

//+ve
// failing response code is 200 it should be 400
$I->am('Case 17 : profile do endorse on subject with entity_type wrong after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('profile do endorse on subject with entity_type wrong after login');
$I->sendPost('profile/do_endorse/eeeeeeeeeeee/'.$entity_id.'/'.$user_id_2.'/0',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept4.json');

//-ve
$I->am('Case 18 : get subject suggestion for endorse self after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get subject suggestion for endorse self after login');
$I->sendGet('profile/get_endorse_suggestion_classes/'.$user_id_1,[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept6.json');

//+ve
$I->am('Case 19 : get subject suggestion for endorse after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get subject suggestion for endorse after login');
$I->sendGet('profile/get_endorse_suggestion_classes/'.$user_id_2,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept5.json');

// 19-02-2016
//-ve
//http://backend.localhost.ucroo/profile/get_endorse_suggestion_classes/ddddddddddd
//failing
$I->am('Case 20 : get subject suggestion for endorse after login with user_id as string');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get subject suggestion for endorse after login with user_id as string');
$I->sendGet('profile/get_endorse_suggestion_classes/aaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept6.json');

// 19-02-2016
//-ve
// failing
// http://backend.localhost.ucroo/profile/action/eeeeeeeee/past_subjects
$I->am('Case 5 : get past_subjects of person with user id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password2]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get past_subjects of person with user id as string after login');
$I->sendPost('profile/action/aaa/past_subjects',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');
