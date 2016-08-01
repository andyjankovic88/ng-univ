<?php
$previous_day = date("d/m/Y", strtotime("-1 day"));
$next_day = date("d/m/Y", strtotime("+1 day"));
$next_year_day = date("d/m/Y", strtotime("+365 day"));

$I = new ApiTester($scenario);
$user_email = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'2'));
$user_email_staff = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'4'));
$user_id_staff = $I->getDataFromDbCustom($I,'users','id',array('email'=>$user_email_staff,'group_id'=>'4'));

$user_password = 'ucroo123';


// +ve
$I->am('Case 1 : To get all[upcoming/past] events along with attendees list after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$data=$I->getArrayFromJson($I);
// get data from login response
$university_id = $data['response']['eduInstitution']['id'];
$mentors_id = @$data['response']['mainMenu']['mentors'][0]['id'];
$customgroups_id = @$data['response']['mainMenu']['customgroups'][0]['id'];
// get data from login response
$I->wantTo('To get all[upcoming/past] events along with attendees list after login');
$I->sendGet('ucroo_events/listing/university/'.$university_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('EventCept1.json');


// -ve
$I->am('Case 2 : To get all[upcoming/past] events along with attendees list passing university not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To get all[upcoming/past] events along with attendees list passing university not exist  after login');
$I->sendGet('ucroo_events/listing/university/99999999999',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('EventCept0.json');


// -ve
$I->am('Case 3 : To get all[upcoming/past] events along with attendees passing university as string list after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To get all[upcoming/past] events along with attendees passing university as string list after login');
$I->sendGet('ucroo_events/listing/university/aaaaaaaaaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('EventCept0.json');




// +ve
// failing
if($mentors_id){
$I->am('Case 4 : mentors To get all[upcoming/past] events along with attendees  after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('mentors To get all[upcoming/past] events along with attendees  after login');
$I->sendGet('ucroo_events/listing/mentors/'.$mentors_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('EventCept0.json');
}


// -ve
// failing
$I->am('Case 5 : mentors To get all[upcoming/past] events along with attendees mentor id not exist  after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('mentors To get all[upcoming/past] events along with attendees mentor id not exist  after login');
$I->sendGet('ucroo_events/listing/mentors/11111111111111',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('EventCept0.json');



// -ve
// failing
$I->am('Case 6 : mentors To get all[upcoming/past] events along with attendees mentor id as string  after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('mentors To get all[upcoming/past] events along with attendees mentor id as string  after login');
$I->sendGet('ucroo_events/listing/mentors/aaaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');


 
if($customgroups_id){
// +ve
$I->am('Case 7 : customgroup To get all[upcoming/past] events along with attendees  after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('customgroup To get all[upcoming/past] events along with attendees  after login');
$I->sendGet('ucroo_events/listing/customgroups/'.$customgroups_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('EventCept2.json');
}

// -ve
$I->am('Case 8 : customgroup To get all[upcoming/past] events along with attendees not exist customgroup id  after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('customgroup To get all[upcoming/past] events along with attendees  after login');
$I->sendGet('ucroo_events/listing/customgroups/55555555555',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('EventCept0.json');


// -ve
$I->am('Case 9 : customgroup To get all[upcoming/past] events along with attendees customgroup id as string  after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('customgroup To get all[upcoming/past] events along with attendees customgroup id as string  after login');
$I->sendGet('ucroo_events/listing/customgroups/aaaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('EventCept0.json');


// +ve
$I->am('Case 10 : To get form details like campus  after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$data=$I->getArrayFromJson($I);
// get data from login response
$university_id_staff = $data['response']['eduInstitution']['id'];
// get data from login response
$I->wantTo('To get form details like campus  after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/new',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('EventCept3.json');


// -ve
$I->am('Case 11 : To get form details like campus with university id not exist  after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To get form details like campus with university id not exist  after login');
$I->sendPOST('ucroo_events/action/university/4444444444444444444444/new',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('EventCept0.json');



// -ve
$I->am('Case 12 : To get form details like campus with university id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To get form details like campus with university id as string after login');
$I->sendPOST('ucroo_events/action/university/aaaaaaaaaaaaaaaaaa/new',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('EventCept0.json');


$I = new ApiTester($scenario);
// +ve
$I->am('Case 13 : To create new event by submit after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create new event by submit after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/new',['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date'=>$next_day,'start_date_hrs'=>'09:30 AM','end_date'=>$next_year_day,'end_date_hrs'=>'09:30 PM','location'=>'Melbourne','max_attendees'=>'15','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$data_listing=$I->getArrayFromJson($I);
$event_id = $data_listing['response']['event_id'];
$I->canSeeResponseIsValidOnSchemaFile('EventCept0.json');




// -ve
$I->am('Case 16 : To create new event by submit by past startdate after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create new event by submit by past startdate after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/new',['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date'=>$previous_day,'start_date_hrs'=>'09:30 AM','end_date'=>$next_year_day,'end_date_hrs'=>'09:30 PM','location'=>'Melbourne','max_attendees'=>'15','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
$I->am('Case 17 : To create new event by submit without title after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create new event by submit without title after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/new',['description'=>'ddddessssccrrrrpttiion','start_date'=>$next_day,'start_date_hrs'=>'09:30 AM','end_date'=>$next_year_day,'end_date_hrs'=>'09:30 PM','location'=>'Melbourne','max_attendees'=>'15','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 18 : To create new event by submit without description after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create new event by submit without description after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/new',['title'=>'text','start_date'=>$next_day,'start_date_hrs'=>'09:30 AM','end_date'=>$next_year_day,'end_date_hrs'=>'09:30 PM','location'=>'Melbourne','max_attendees'=>'15','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

// -ve
$I->am('Case 19 : To create new event by submit without start_date after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create new event by submit without start_date after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/new',['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date_hrs'=>'09:30 AM','end_date'=>$next_year_day,'end_date_hrs'=>'09:30 PM','location'=>'Melbourne','max_attendees'=>'15','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

// -ve
$I->am('Case 20 : To create new event by submit without start_date_hrs after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create new event by submit without start_date_hrs after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/new',['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date'=>$next_day,'end_date'=>$next_year_day,'end_date_hrs'=>'09:30 PM','location'=>'Melbourne','max_attendees'=>'15','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

// -ve
$I->am('Case 21 : To create new event by submit without end_date after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Case 21 : To create new event by submit without end_date after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/new',['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date'=>$next_day,'start_date_hrs'=>'09:30 AM','end_date_hrs'=>'09:30 PM','location'=>'Melbourne','max_attendees'=>'15','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

// -ve
$I->am('Case 22 : To create new event by submit without end_date_hrs after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create new event by submit without end_date_hrs after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/new',['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date'=>$next_day,'start_date_hrs'=>'09:30 AM','end_date'=>$next_year_day,'location'=>'Melbourne','max_attendees'=>'15','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

// -ve
$I->am('Case 23 : To create new event by submit without location after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create new event by submit without location after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/new',['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date'=>$next_day,'start_date_hrs'=>'09:30 AM','end_date'=>$next_year_day,'end_date_hrs'=>'09:30 PM','max_attendees'=>'15','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 24 : To create new event by submit without max_attendees after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create new event by submit without max_attendees after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/new',['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date'=>$next_day,'start_date_hrs'=>'09:30 AM','end_date'=>$next_year_day,'end_date_hrs'=>'09:30 PM','location'=>'Melbourne','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 25 : To create new event by submit without timezone after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create new event by submit without timezone after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/new',['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date'=>$next_day,'start_date_hrs'=>'09:30 AM','end_date'=>$next_year_day,'end_date_hrs'=>'09:30 PM','location'=>'Melbourne','max_attendees'=>'15','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
// failing
$I->am('Case 26 : To create new event by submit by timezone wrong after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create new event by submit by timezone wrong after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/new',['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date'=>$next_day,'start_date_hrs'=>'09:30 AM','end_date'=>$next_year_day,'end_date_hrs'=>'09:30 PM','location'=>'Melbourne','max_attendees'=>'15','timezone'=>'1111','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
$I->am('Case 27 : To create new event by submit with max_attendees as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create new event by submit with max_attendees as string after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/new',['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date'=>$next_day,'start_date_hrs'=>'09:30 AM','end_date'=>$next_year_day,'end_date_hrs'=>'09:30 PM','location'=>'Melbourne','max_attendees'=>'aaa','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 28 : To create new event by submit with start_date as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create new event by submit with start_date as string after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/new',['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date'=>'fffffffffffff','start_date_hrs'=>'09:30 AM','end_date'=>$next_year_day,'end_date_hrs'=>'09:30 PM','location'=>'Melbourne','max_attendees'=>'12','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 29 : To create new event by submit with start_date_hrs as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create new event by submit with start_date_hrs as string after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/new',['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date'=>$next_day,'start_date_hrs'=>'qqqqqqqqqqq','end_date'=>$next_year_day,'end_date_hrs'=>'09:30 PM','location'=>'Melbourne','max_attendees'=>'12','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
// failing
$I->am('Case 30 : To create new event by submit with end_date as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create new event by submit with end_date as string after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/new',['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date'=>$next_day,'start_date_hrs'=>'09:30 AM','end_date'=>'wwwwwwwwwwwww','end_date_hrs'=>'09:30 PM','location'=>'Melbourne','max_attendees'=>'12','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
// failing
$I->am('Case 31 : To create new event by submit with end_date_hrs as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create new event by submit with end_date_hrs as string after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/new',['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date'=>$next_day,'start_date_hrs'=>'09:30 AM','end_date'=>$next_year_day,'end_date_hrs'=>'sssssssssssss','location'=>'Melbourne','max_attendees'=>'12','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');




//$event_id = $I->getDataFromDbCustom($I,'ucroo_event','id',array('module_id' => $university_id_staff,'module_name'=>'University','creator_id'=>$user_id_staff,'end_date>'=>'2013-02-17 16:56:59'));


// +ve
$I->am('Case 14 : To edit event by submit after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit event by submit after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/edit/'.$event_id,['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date'=>$next_day,'start_date_hrs'=>'09:30 AM','end_date'=>$next_year_day,'end_date_hrs'=>'09:30 PM','location'=>'Melbourne','max_attendees'=>'15','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('EventCept0.json');


// -ve
$I->am('Case 32 : To edit event by submit by past startdate after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit event by submit by past startdate after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/edit/'.$event_id,['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date'=>$previous_day,'start_date_hrs'=>'09:30 AM','end_date'=>$next_year_day,'end_date_hrs'=>'09:30 PM','location'=>'Melbourne','max_attendees'=>'15','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
$I->am('Case 33 : To edit event by submit without title after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit event by submit without title after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/edit/'.$event_id,['description'=>'ddddessssccrrrrpttiion','start_date'=>$next_day,'start_date_hrs'=>'09:30 AM','end_date'=>$next_year_day,'end_date_hrs'=>'09:30 PM','location'=>'Melbourne','max_attendees'=>'15','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 34 : To edit event by submit without description after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit event by submit without description after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/edit/'.$event_id,['title'=>'text','start_date'=>$next_day,'start_date_hrs'=>'09:30 AM','end_date'=>$next_year_day,'end_date_hrs'=>'09:30 PM','location'=>'Melbourne','max_attendees'=>'15','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

// -ve
$I->am('Case 35 : To edit event by submit without start_date after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit event by submit without start_date after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/edit/'.$event_id,['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date_hrs'=>'09:30 AM','end_date'=>$next_year_day,'end_date_hrs'=>'09:30 PM','location'=>'Melbourne','max_attendees'=>'15','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

// -ve
$I->am('Case 36 : To edit event by submit without start_date_hrs after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit event by submit without start_date_hrs after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/edit/'.$event_id,['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date'=>$next_day,'end_date'=>$next_year_day,'end_date_hrs'=>'09:30 PM','location'=>'Melbourne','max_attendees'=>'15','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

// -ve
$I->am('Case 37 : To edit event by submit without end_date after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Case 21 : To edit event by submit without end_date after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/edit/'.$event_id,['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date'=>$next_day,'start_date_hrs'=>'09:30 AM','end_date_hrs'=>'09:30 PM','location'=>'Melbourne','max_attendees'=>'15','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

// -ve
$I->am('Case 38 : To edit event by submit without end_date_hrs after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit event by submit without end_date_hrs after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/edit/'.$event_id,['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date'=>$next_day,'start_date_hrs'=>'09:30 AM','end_date'=>$next_year_day,'location'=>'Melbourne','max_attendees'=>'15','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

// -ve
$I->am('Case 39 : To edit event by submit without location after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit event by submit without location after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/edit/'.$event_id,['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date'=>$next_day,'start_date_hrs'=>'09:30 AM','end_date'=>$next_year_day,'end_date_hrs'=>'09:30 PM','max_attendees'=>'15','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 40 : To edit event by submit without max_attendees after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit event by submit without max_attendees after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/edit/'.$event_id,['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date'=>$next_day,'start_date_hrs'=>'09:30 AM','end_date'=>$next_year_day,'end_date_hrs'=>'09:30 PM','location'=>'Melbourne','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 41 : To edit event by submit without timezone after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit event by submit without timezone after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/edit/'.$event_id,['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date'=>$next_day,'start_date_hrs'=>'09:30 AM','end_date'=>$next_year_day,'end_date_hrs'=>'09:30 PM','location'=>'Melbourne','max_attendees'=>'15','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
// failing
$I->am('Case 42 : To edit event by submit by timezone wrong after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit event by submit by timezone wrong after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/edit/'.$event_id,['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date'=>$next_day,'start_date_hrs'=>'09:30 AM','end_date'=>$next_year_day,'end_date_hrs'=>'09:30 PM','location'=>'Melbourne','max_attendees'=>'15','timezone'=>'1111','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
$I->am('Case 43 : To edit event by submit with max_attendees as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit event by submit with max_attendees as string after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/edit/'.$event_id,['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date'=>$next_day,'start_date_hrs'=>'09:30 AM','end_date'=>$next_year_day,'end_date_hrs'=>'09:30 PM','location'=>'Melbourne','max_attendees'=>'aaa','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 44 : To edit event by submit with start_date as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit event by submit with start_date as string after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/edit/'.$event_id,['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date'=>'fffffffffffff','start_date_hrs'=>'09:30 AM','end_date'=>$next_year_day,'end_date_hrs'=>'09:30 PM','location'=>'Melbourne','max_attendees'=>'12','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 45 : To edit event by submit with start_date_hrs as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit event by submit with start_date_hrs as string after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/edit/'.$event_id,['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date'=>$next_day,'start_date_hrs'=>'qqqqqqqqqqq','end_date'=>$next_year_day,'end_date_hrs'=>'09:30 PM','location'=>'Melbourne','max_attendees'=>'12','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
// failing
$I->am('Case 46 : To edit event by submit with end_date as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit event by submit with end_date as string after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/edit/'.$event_id,['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date'=>$next_day,'start_date_hrs'=>'09:30 AM','end_date'=>'wwwwwwwwwwwww','end_date_hrs'=>'09:30 PM','location'=>'Melbourne','max_attendees'=>'12','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
// failing
$I->am('Case 47 : To edit event by submit with end_date_hrs as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit event by submit with end_date_hrs as string after login');
$I->sendPOST('ucroo_events/action/university/'.$university_id_staff.'/edit/'.$event_id,['title'=>'text','description'=>'ddddessssccrrrrpttiion','start_date'=>$next_day,'start_date_hrs'=>'09:30 AM','end_date'=>$next_year_day,'end_date_hrs'=>'sssssssssssss','location'=>'Melbourne','max_attendees'=>'12','timezone'=>'Australia/Sydney','specificto_campus_check'=>'0','campus_id[0]'=>'45','campus_id[1]'=>'46','campus_id[2]'=>'48','target_year'=>'11']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');




// +ve
$I->am('Case 53 : Join Event after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Join Event after login');
$I->sendGET('ucroo_events/join/university/'.$university_id_staff.'/'.$event_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
$I->am('Case 54 : Join Event event id as string  after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Join Event event id as string  after login');
$I->sendGET('ucroo_events/join/university/'.$university_id_staff.'/aaaaaaaaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 55 : Join Event event id not exist  after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Join Event event id not exist  after login');
$I->sendGET('ucroo_events/join/university/'.$university_id_staff.'/222222222222222',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 57 : leave Event event id as string  after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('leave Event event id as string  after login');
$I->sendGET('ucroo_events/leave/university/'.$university_id_staff.'/aaaaaaaaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 58 : leave Event event id not exist  after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('leave Event event id not exist  after login');
$I->sendGET('ucroo_events/leave/university/'.$university_id_staff.'/222222222222222',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// +ve
$I->am('Case 56 : leave Event after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('leave Event after login');
$I->sendGET('ucroo_events/leave/university/'.$university_id_staff.'/'.$event_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// +ve
$I->am('Case 50 : To get events details for detailed view after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To get events details for detailed view after login');
$I->sendGET('ucroo_events/view/university/'.$event_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('EventCept4.json');


// -ve
$I->am('Case 51 : To get events details for detailed view with event id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To get events details for detailed view with event id as string after login');
$I->sendGET('ucroo_events/view/university/eeeeeeeeeeeeeeeee',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
$I->am('Case 52 : To get events details for detailed view with event id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To get events details for detailed view with event id not exist after login');
$I->sendGET('ucroo_events/view/university/99999999999999999999',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// +ve
$I->am('Case 15 : To delete event by submit after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To delete event by submit after login');
$I->sendGET('ucroo_events/delete/university/'.$university_id_staff.'/'.$event_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 48 : To delete event by event id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To delete event by event id as string after login');
$I->sendGET('ucroo_events/delete/university/'.$university_id_staff.'/aaaaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 49 : To delete event by event id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To delete event by event id not exist after login');
$I->sendGET('ucroo_events/delete/university/'.$university_id_staff.'/9999999999999',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');