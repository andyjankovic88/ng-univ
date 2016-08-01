<?php
$I = new ApiTester($scenario);
$user_email = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'2'));
$user_password = 'ucroo123';


//-ve
$I->am('Case 1 : Set Password before login');
$I->wantTo('Set Password');
$I->sendPOST('account_settings/change_password',['oldPass' => 'ucroo123','newPass' => 'ucroo123','repeatNewPass' => 'ucroo123']);
$I->seeResponseCodeIs(401);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Account_settingsCept2.json');

//+ve
$I->am('Case 2 : Get Account settings after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Get Account settings');
$I->sendGet('account_settings/get_settings',['user_id' => '1']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Account_settingsCept1.json');

//+ve
$I->am('Case 3 : Set Password after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Set Password');
$I->sendPOST('account_settings/change_password',['oldPass' => 'ucroo123','newPass' => 'ucroo123','repeatNewPass' => 'ucroo123']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Account_settingsCept2.json');

//-ve
$I->am('Case 4 : Set Password with wrong old passwod after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Set Password with wrong old passwod after login');
$I->sendPOST('account_settings/change_password',['oldPass' => 'ucroo1234','newPass' => 'ucroo123','repeatNewPass' => 'ucroo123']);
$I->seeResponseCodeIs(401);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Account_settingsCept2.json');

//-ve
$I->am('Case 5 : Set Password with blank fileds after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Set Password with blank fileds after login');
$I->sendPOST('account_settings/change_password',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Account_settingsCept2.json');



 

//+ve
$I->am('Case 7 : Set privacy_settings in account setting fileds after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Set privacy_settings in account setting fileds after login');
$I->sendPOST('account_settings/update_settings/privacy_settings',["user_permissions" => ["122" => "everyone"]]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Account_settingsCept3.json');

//+ve
$I->am('Case 8 : Set Email Notification in account setting with blank fileds after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Set Email Notification in account setting with blank fileds after login');
$I->sendPOST('account_settings/update_settings/email_notification',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Account_settingsCept8.json');

//+ve
$I->am('Case 9 : Set Email Notification in account setting after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Set Email Notification in account setting after login');
$I->sendPOST('account_settings/update_settings/email_notification',["feeds" => "0","messages" => "1", "ratings" => "1","connections" =>"1","daily_schedule" => "1","clubs" => "1","study_groups" => "1","classes" => "1","service_page" => "1", "mentors" => "1", "customgroups" => "1"]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Account_settingsCept8.json');

//+ve
$I->am('Case 10 : Set Prefered Email with blank in account setting after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Set Prefered Email with blank in account setting after login');
$I->sendPOST('account_settings/update_settings/prefered_email',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Account_settingsCept3.json');

//+ve
$I->am('Case 11 : Set Prefered Email in account setting after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Set Prefered Email in account setting after login');
$I->sendPOST('account_settings/update_settings/prefered_email',["prefered_email" => "1"]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Account_settingsCept3.json');

//+ve
$I->am('Case 12 : Set Block Users with blank in account setting after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Set Block Users with blank in account setting after login');
$I->sendPOST('account_settings/update_settings/block_users/add',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Account_settingsCept3.json');

//+ve
$I->am('Case 13 : Set Block Users in account setting after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Set Block Users in account setting after login');
$I->sendPOST('account_settings/update_settings/block_users/add',["user_ids" => ["0" => "22", "1" => "25"]]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Account_settingsCept3.json');

//+ve
$I->am('Case 14 : Set Unblock Users with blank in account setting after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Set Unblock Users with blank in account setting after login');
$I->sendPOST('account_settings/update_settings/block_users/delete',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Account_settingsCept3.json');

//+ve
$I->am('Case 15 : Set Unblock Users in account setting after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Set Unblock Users in account setting after login');
$I->sendPOST('account_settings/update_settings/block_users/delete',["auto_user_id" => "22"]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Account_settingsCept3.json');

//+ve
$I->am('Case 17 : search user with blank params after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('search user with blank params after login');
$I->sendPOST('json/search_users/',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Account_settingsCept17.json');

//+ve
$I->am('Case 18 : search user with blank params after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('search user with blank params after login');
$I->sendPOST('json/search_users/',["action" => "search","term" => "st","except_ids" => "1,2,3,4,5,6,7,8,9"]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Account_settingsCept18.json');

//-ve
$I->am('Case 6 : Set privacy_settings with blank fields in account setting fileds after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Set privacy_settings with blank fields in account setting fileds after login');
$I->sendPOST('account_settings/update_settings/privacy_settings',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Account_settingsCept2.json');