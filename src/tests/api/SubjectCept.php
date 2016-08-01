<?php
//SELECT * FROM `unit_enrolment_current` WHERE `user_id` = 1 ORDER BY `user_id` ASC 
// and delete them

$I = new ApiTester($scenario);
$user_email = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'2'));
$user_password = 'ucroo123';
$user_id = $I->getDataFromDbCustom($I,'users','id',array('email'=>$user_email,'group_id'=>'2'));
$subject_id_1 = $I->getDataFromDbCustom($I,'unit','id',array('id'=>'18'));
$subject_id_2 = $I->getDataFromDbCustom($I,'unit','id',array('id'=>'11'));
$subject_id_3 = $I->getDataFromDbCustom($I,'unit','id',array('id'=>'3'));

// +ve
$I->am('Case 1 : Subjects enrolled lists after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Subjects enrolled lists after login');
$I->sendGet('subject/get_enrolled',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('SubjectCept.json');


// -ve
$I->am('Case 2 : Subjects search not enrolled with blank param after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Subjects search not enrolled with blank param after login');
$I->sendPost('subject/search_not_enrolled',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

// +ve
$I->am('Case 3 : Subjects search not enrolled with search_term param after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Subjects search not enrolled with search_term param after login');
$I->sendPost('subject/search_not_enrolled',['search_term'=>'re']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('SubjectCept.json');

// +ve
$I->am('Case 4 : Subjects search not enrolled with search_term and exclude_subject_ids param after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Subjects search not enrolled with search_term and exclude_subject_ids param after login');
$I->sendPost('subject/search_not_enrolled',['search_term'=>'re', 'exclude_subject_ids'=>['0'=>'2']]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('SubjectCept.json');

// -ve
$I->am('Case 5 : Subjects search not enrolled with exclude_subject_ids param as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Subjects search not enrolled with exclude_subject_ids param as string after login');
$I->sendPost('subject/search_not_enrolled',['search_term'=>'re', 'exclude_subject_ids'=>'sssss']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

// +ve
$I->am('Case 6 : Subjects search not enrolled with exclude_subject_ids param as string array after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Subjects search not enrolled with exclude_subject_ids param as string array after login');
$I->sendPost('subject/search_not_enrolled',['search_term'=>'re', 'exclude_subject_ids'=>['0'=>'sssss']]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('SubjectCept.json');

// -ve
$I->am('Case 7 : Subject Enroll with bank params after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Subject Enroll with bank params after login');
$I->sendPost('subject/enrol',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// +ve
$I->am('Case 8 : Subject Enroll with subject_id params after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Subject Enroll with subject_id params after login');
$I->sendPost('subject/enrol/'.$subject_id_1,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');
 
 

// -ve
$I->am('Case 9 : subject_already_enrolled_by_user with subject_id params after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('subject_already_enrolled_by_user with subject_id params after login');
$I->sendPost('subject/enrol/'.$subject_id_1,[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');




// +ve
$I->am('Case 10 : Subject Enroll with subject_id and user_id params after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Subject Enroll with subject_id and user_id params after login');
$I->sendPost('subject/enrol/'.$subject_id_2.'/'.$user_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

// -ve
$I->am('Case 11 : Subject Enroll with subject_id and user_id params as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Subject Enroll with subject_id and user_id params as string after login');
$I->sendPost('subject/enrol/a/b',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

// -ve
$I->am('Case 12 : Subject UnEnrol without param after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Subject UnEnrol without param after login');
$I->sendPost('subject/unenrol',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');




// -ve
$I->am('Case 15 : Subject UnEnrol with param as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Subject UnEnrol with param as string after login');
$I->sendPost('subject/unenrol/a/a/a',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

// -ve
$I->am('Case 16 : Subject invite lecturer without param after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Subject invite lecturer without param after login');
$I->sendPost('subject/invite_lecturer',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

// -ve
$I->am('Case 17 : Subject invite lecturer with subject_id string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Subject invite lecturer with subject_id string after login');
$I->sendPost('subject/invite_lecturer/a',['lecturer_name'=>'yajs','lecturer_email'=>'takamora@werty.com']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

// -ve
$I->am('Case 18 : Subject invite lecturer without lecturer_email after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Subject invite lecturer without lecturer_email after login');
$I->sendPost('subject/invite_lecturer/'.$subject_id_1,['lecturer_name'=>'yajs']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

// -ve
$I->am('Case 19 : Subject invite lecturer without lecturer_name after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Subject invite lecturer without lecturer_name after login');
$I->sendPost('subject/invite_lecturer/'.$subject_id_1,['lecturer_email'=>'yajs@qqqq.com']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

// +ve
$I->am('Case 20 : Subject invite lecturer after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Subject invite lecturer after login');
$I->sendPost('subject/invite_lecturer/'.$subject_id_1,['lecturer_name'=>'yajs','lecturer_email'=>'takamora@werty.com']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// +ve
$I->am('Case 21 : Get subject setup details after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Get subject setup details after login');
$I->sendGet('subject/setup_details/'.$subject_id_1,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('SubjectCept2.json');

// -ve
$I->am('Case 22 : Get subject setup without subject_id details after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Get subject setup without subject_id details after login');
$I->sendGet('subject/setup_details',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

// -ve
$I->am('Case 23 : Get subject setup with subject_id as string details after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Get subject setup with subject_id as string details after login');
$I->sendGet('subject/setup_details/aaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

// -ve
$I->am('Case 24 : Subject Setup without subject_id details after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Subject Setup without subject_id details after login');
$I->sendPost('subject/setup',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

// -ve
$I->am('Case 25 : Subject Setup with subject_id as string details after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Subject Setup with subject_id as string details after login');
$I->sendPost('subject/setup/aaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

// -ve
$I->am('Case 26 : Subject Setup with subject_id but without params details after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Subject Setup with subject_id but without params details after login');
$I->sendPost('subject/setup/'.$subject_id_1,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

// +ve
$I->am('Case 27 : Get subject all academics after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Get subject all academics after login');
$I->sendGet('subject/academics/'.$subject_id_3,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('SubjectCept3.json');



// +ve
$I->am('Case 30 : get enrolled users after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get enrolled users after login');
$I->sendGet('subject/enrolled_users/'.$subject_id_3.'?sSearch=&iDisplayLength=2&iDisplayStart=&sEcho=',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('SubjectCept4.json');

// -ve
$I->am('Case 31 : get enrolled users with blank user_id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get enrolled users with blank user_id after login');
$I->sendGet('subject/enrolled_users/?sSearch=&iDisplayLength=2&iDisplayStart=&sEcho=',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('SubjectCept4.json');


// +ve
$I->am('Case 33 : Get subjects all students after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Get subjects all students after login');
$I->sendGet('/subject/students/3/1/3',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('SubjectCept5.json');


// -ve
$I->am('Case 35 : Get subjects all students without pagenum and pagecount after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Get subjects all students without pagenum and pagecount after login');
$I->sendGet('/subject/students/3',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('SubjectCept5.json');


// -ve
$I->am('Case 36 : Get subjects all students without pagecount after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Get subjects all students without pagecount after login');
$I->sendGet('/subject/students/3/1',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('SubjectCept5.json');


// -ve
$I->am('Case 37 : Get subjects all students with pagecount as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Get subjects all students with pagecount as string after login');
$I->sendGet('/subject/students/3/1/aaaa',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('SubjectCept5.json');


// -ve
$I->am('Case 38 : Get subjects all students with page & pagecount as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Get subjects all students with page & pagecount as string after login');
$I->sendGet('/subject/students/3/aaaa/aaaa',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('SubjectCept5.json');


// +ve
$I->am('Case 40 : get connections to suggest for enroll in current subject after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Get subjects all students with page & pagecount as string after login');
$I->sendGet('subject/connections_suggestion_for_enroll/12',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

// +ve
$I->am('Case 13 : Subject UnEnrol with param subject_id only after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Subject UnEnrol with param subject_id only after login');
$I->sendPost('subject/unenrol/'.$subject_id_1,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// +ve
$I->am('Case 14 : Subject UnEnrol with param subject_id and user_id  after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Subject UnEnrol with param subject_id and user_id  after login');
$I->sendPost('subject/unenrol/'.$subject_id_2.'/'.$user_id.'/ucroo',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');




// -ve
// failing
$I->am('Case 42 : with subject_id as string get connections to suggest for enroll in current subject after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('with subject_id as string get connections to suggest for enroll in current subject after login');
$I->sendGet('subject/connections_suggestion_for_enroll/aaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
// failing
$I->am('Case 41 : without subject_id get connections to suggest for enroll in current subject after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('without subject_id get connections to suggest for enroll in current subject after login');
$I->sendGet('subject/connections_suggestion_for_enroll',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');





// -ve
// failing
$I->am('Case 39 : Get subjects all students with subject_id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Get subjects all students with subject_id as string after login');
$I->sendGet('/subject/students/3aaa/1/3',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



 
// -ve
// failing
$I->am('Case 34 : Get subjects all students without param after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Get subjects all students without param after login');
$I->sendGet('/subject/students/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

// -ve
// failing
$I->am('Case 32 : get enrolled users with string user_id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get enrolled users with string user_id after login');
$I->sendGet('subject/enrolled_users/aaaaa?sSearch=&iDisplayLength=2&iDisplayStart=&sEcho=',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('SubjectCept4.json');



// -ve
// failing this case, DB error coming
$I->am('Case 28 : Get subject all academics without subject id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Get subject all academics without subject id after login');
$I->sendGet('subject/academics/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');
 

// -ve
// failing this case, DB error coming
$I->am('Case 29 : Get subject all academics with subject id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Get subject all academics with subject id as string after login');
$I->sendGet('subject/academics/aaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

