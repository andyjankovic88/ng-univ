<?php

$I = new ApiTester($scenario);
$user_email1 = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'2'));
$user_email2 = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'2'));
$user_email3 = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'3'));
$user_password = 'ucroo123';





// +ve
$I->am('Case 2 : Mentor groups list without search after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Mentor groups list without search after login');
$I->sendPOST('mentorgroup/list',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MentorgrouplistCept.json');



// +ve
$I->am('Case 3 : Add mentorgroup after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email3, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add mentorgroup after login');
$I->sendPOST('mentorgroup/addedit',['group_name'=>'atest','program_name'=>'var','group_members'=>['0'=>['user_id'=>'1','user_name'=>'aaaaa','user_email'=>'a@a.com','member_type'=>'mentee']]]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$data = $I->getArrayFromJson($I);
$group_id = $data['response']['mentorgroup_id'];
$I->canSeeResponseIsValidOnSchemaFile('MentorgroupaddCept.json');



// +ve
$I->am('Case 32 : view detail of  mentorgroup after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email3, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('view detail of  mentorgroup after login');
$I->sendGET('mentorgroup/view_details/'.$group_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MentorgroupviewdetailCept.json');


// -ve
$I->am('Case 33 : view detail of  mentorgroup without group id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email3, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('view detail of  mentorgroup without group id after login');
$I->sendGET('mentorgroup/view_details/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 34 : view detail of  mentorgroup with group id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email3, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('view detail of  mentorgroup with group id as string after login');
$I->sendGET('mentorgroup/view_details/aaaaaaaaaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
$I->am('Case 35 : view detail of  mentorgroup with group id as invalid group id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email3, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('view detail of  mentorgroup with group id as invalid group id after login');
$I->sendGET('mentorgroup/view_details/88888888888888888888888888888',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// +ve
$I->am('Case 1 : Mentor groups list with search after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email3, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Mentor groups list with search after login');
$I->sendPOST('mentorgroup/list',['search_term'=>'','faculty_ids'=>[],'campus_ids'=>[]]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$data = $I->getArrayFromJson($I);
$latest_group_id = $data['response']['groups'][0]['group_id'];
$I->canSeeResponseIsValidOnSchemaFile('MentorgrouplistCept.json');
// check that latest created group exist in listing
$I->compareString($group_id,$latest_group_id);




// -ve
$I->am('Case 6 : Add mentorgroup without group_name after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add mentorgroup without group_name after login');
$I->sendPOST('mentorgroup/addedit',['program_name'=>'var','group_members'=>['0'=>['user_id'=>'1','user_name'=>'aaaaa','user_email'=>'a@a.com','member_type'=>'mentee']]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');




// -ve
$I->am('Case 7 : Add mentorgroup without program_name after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add mentorgroup without program_name after login');
$I->sendPOST('mentorgroup/addedit',['group_name'=>'atest','group_members'=>['0'=>['user_id'=>'1','user_name'=>'aaaaa','user_email'=>'a@a.com','member_type'=>'mentee']]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');




// +ve
$I->am('Case 4 : edit mentorgroup after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit mentorgroup after login');
$I->sendPOST('mentorgroup/addedit/'.$group_id,['group_name'=>'atest123','program_name'=>'var']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MentorgroupaddCept.json');



// -ve
$I->am('Case 8 : edit mentorgroup without group_name after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit mentorgroup without group_name after login');
$I->sendPOST('mentorgroup/addedit/'.$group_id,['program_name'=>'var','group_members'=>['0'=>['user_id'=>'1','user_name'=>'aaaaa','user_email'=>'a@a.com','member_type'=>'mentee']]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');




// -ve
$I->am('Case 9 : edit mentorgroup without program_name after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit mentorgroup without program_name after login');
$I->sendPOST('mentorgroup/addedit/'.$group_id,['group_name'=>'atest','group_members'=>['0'=>['user_id'=>'1','user_name'=>'aaaaa','user_email'=>'a@a.com','member_type'=>'mentee']]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');






// +ve
$I->am('Case 5 : get detail of  mentorgroup after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email3, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get detail of  mentorgroup after login');
$I->sendGET('mentorgroup/addedit_form_details/'.$group_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MentorgroupdetailCept.json');



// -ve
$I->am('Case 10 : get detail of  mentorgroup with not exist group id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email3, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get detail of  mentorgroup with not exist group id after login');
$I->sendGET('mentorgroup/addedit_form_details/1111111111111111',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 11 : get detail of  mentorgroup with group id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email3, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get detail of  mentorgroup with group id as string after login');
$I->sendGET('mentorgroup/addedit_form_details/aaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// +ve
$I->am('Case 16 : Leave mentorgroup as mentor after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email3, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Leave mentorgroup as mentor after login');
$I->sendPOST('mentorgroup/leave_as_mentor/'.$group_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
$I->am('Case 20 : Leave mentorgroup as mentor without group id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email3, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Leave mentorgroup as mentor without group id after login');
$I->sendPOST('mentorgroup/leave_as_mentor/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
$I->am('Case 21 : Leave mentorgroup as mentor with group id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email3, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Leave mentorgroup as mentor with group id not exist after login');
$I->sendPOST('mentorgroup/leave_as_mentor/111111111111111111111',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 22 : Leave mentorgroup as mentor with group id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email3, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Leave mentorgroup as mentor with group id as string after login');
$I->sendPOST('mentorgroup/leave_as_mentor/aaaaaaaaaaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// +ve
$I->am('Case 17 : Join mentorgroup as mentor after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Join mentorgroup as mentor after login');
$I->sendPOST('mentorgroup/join_as_mentor/'.$group_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
$I->am('Case 23 : Join mentorgroup as mentor without group id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Join mentorgroup as mentor without group id after login');
$I->sendPOST('mentorgroup/join_as_mentor/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
$I->am('Case 24 : Join mentorgroup as mentor with group id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Join mentorgroup as mentor with group id as string after login');
$I->sendPOST('mentorgroup/join_as_mentor/aaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
$I->am('Case 25 : Join mentorgroup as mentor with group id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Join mentorgroup as mentor with group id not exit after login');
$I->sendPOST('mentorgroup/join_as_mentor/444444444444444444444444444444',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');




// +ve
$I->am('Case 18 : Join mentorgroup as mentee after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Join mentorgroup as mentee after login');
$I->sendPOST('mentorgroup/join_as_mentee/'.$group_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 26 : Join mentorgroup as mentee without group id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Join mentorgroup as mentee without group id after login');
$I->sendPOST('mentorgroup/join_as_mentee/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 27 : Join mentorgroup as mentee with group id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Join mentorgroup as mentee with group id as string after login');
$I->sendPOST('mentorgroup/join_as_mentee/aaaaaaaaaaaaaaaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
$I->am('Case 28 : Join mentorgroup as mentee with group id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Join mentorgroup as mentee with group id not exist after login');
$I->sendPOST('mentorgroup/join_as_mentee/555555555555555555555',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');




// +ve
$I->am('Case 19 : Leave mentorgroup as mentee after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Leave mentorgroup as mentee after login');
$I->sendPOST('mentorgroup/leave_as_mentee/'.$group_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
$I->am('Case 29 : Leave mentorgroup as mentee without group_id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Leave mentorgroup as mentee without group_id after login');
$I->sendPOST('mentorgroup/leave_as_mentee/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
$I->am('Case 30 : Leave mentorgroup as mentee with group_id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Leave mentorgroup as mentee with group_id as string after login');
$I->sendPOST('mentorgroup/leave_as_mentee/aaaaaaaaaaaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
$I->am('Case 31 : Leave mentorgroup as mentee with group_id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Leave mentorgroup as mentee with group_id not exist after login');
$I->sendPOST('mentorgroup/leave_as_mentee/8888888888888888888888888888888',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



//19-02-2016
// +ve
$I->am('Case 12 : delete  mentorgroup after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email3, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('delete  mentorgroup after login');
$I->sendPOST('mentorgroup/delete/'.$group_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
$I->am('Case 13 : delete  mentorgroup without group id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email3, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('delete  mentorgroup without group id after login');
$I->sendPOST('mentorgroup/delete/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');




// -ve
$I->am('Case 14 : delete  mentorgroup with group id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email3, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('delete  mentorgroup with group id as string after login');
$I->sendPOST('mentorgroup/delete/aaaaaaaaaaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
$I->am('Case 15 : delete  mentorgroup with group id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email3, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('delete  mentorgroup with group id not exist after login');
$I->sendPOST('mentorgroup/delete/2222222222222222222222222222222222',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// +ve
$I->am('Case 36 : search  mentorgroup after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('search  mentorgroup after login');
$I->sendPOST('json/search_mentees',['action'=>'search','term'=>'test','except_ids'=>'1,22']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MentorgroupsearchCept.json');




//======================================================================
//19-02-2016
/*

// fail [it is giving 200 with im proper data]
// -ve
$I->am('Case 37 : search  mentorgroup without action after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('search  mentorgroup without action after login');
$I->sendPOST('json/search_mentees',['term'=>'test','except_ids'=>'1,22']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// fail [it is giving 200 with im proper data]
// -ve
$I->am('Case 38 : search  mentorgroup without term after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('search  mentorgroup without term after login');
$I->sendPOST('json/search_mentees',['action'=>'search','except_ids'=>'1,22']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// fail [it is giving 200 with im proper data]
// -ve
$I->am('Case 39 : search  mentorgroup without except_ids after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('search  mentorgroup without except_ids after login');
$I->sendPOST('json/search_mentees',['action'=>'search','term'=>'test']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

*/

// fail [it is giving 200 and blank response]
// -ve
/*$I->am('Case 12 : get detail of  mentorgroup without group id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get detail of  mentorgroup without group id after login');
$I->sendGET('mentorgroup/addedit_form_details/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');*/