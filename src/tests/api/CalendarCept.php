<?php
$I = new ApiTester($scenario);
$user_email = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'2'));
$user_password = 'ucroo123';


//+ve
$I->am('Case 1 : University Event List after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('University Event List after login');
$I->sendPost('calendar/university_calendar_events',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept.json');

//+ve
//http://backend.localhost.ucroo/calendar/university_calendar_setup
$I->am('Case 2 : calendar setup get after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('calendar setup get after login');
$I->sendGet('calendar/university_calendar_setup',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept2.json');


//+ve
$I->am('Case 3 : calendar setup post after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('calendar setup post after login');
$I->sendPost('calendar/university_calendar_setup',['type'=>'assessment','assessment_unit_id'=>'4','date'=>'12-12-2016','time_from'=>'11:30:00','time_to'=>'13:00:00','title'=>'aaaa 1','alert'=>'2','repeat-event-value'=>'daily','repeat-end-date'=>'12-12-2016','no-end-time'=>'1']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');


//-ve
//university_calendar_ics
$I->am('Case 7 : university_calendar_ics without post param after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('university_calendar_ics without post param after login');
$I->sendPost('calendar/university_calendar_ics',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');

//+ve
//university_calendar_ics
$I->am('Case 8 : university_calendar_ics after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('university_calendar_ics after login');
$I->sendPost('calendar/university_calendar_ics',[],['file_ics' => [
            'name' => 'Google Calnder-2.1.ics',
            'type' => 'ics',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('Google Calnder-2.1.ics')),
            'tmp_name' => codecept_data_dir('Google Calnder-2.1.ics'),
        ]]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept4.json');

//-ve
$I->am('Case 9 : university_calendar_ics with wrong file type after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('university_calendar_ics with wrong file type after login');
$I->sendPost('calendar/university_calendar_ics',[],['file_ics' => [
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');




//-ve
// failing 
$I->am('Case 4 : calendar setup post with repeat-end-date as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('calendar setup post with repeat-end-date as string after login');
$I->sendPost('calendar/university_calendar_setup',['type'=>'assessment','assessment_unit_id'=>'4','date'=>'12-12-2016','time_from'=>'11:30:00','time_to'=>'13:00:00','title'=>'aaaa 1','alert'=>'2','repeat-event-value'=>'daily','repeat-end-date'=>'aaaaaaaaaaa','no-end-time'=>'1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');



//-ve
// failing
$I->am('Case 5 : calendar setup post with date as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('calendar setup post with date as string after login');
$I->sendPost('calendar/university_calendar_setup',['type'=>'assessment','assessment_unit_id'=>'4','date'=>'ddddddddddddddddddddddd','time_from'=>'11:30:00','time_to'=>'13:00:00','title'=>'aaaa 1','alert'=>'2','repeat-event-value'=>'daily','repeat-end-date'=>'12-12-2016','no-end-time'=>'1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');


//-ve
// failing
$I->am('Case 6 : calendar setup post without post param after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('calendar setup post without post param after login');
$I->sendPost('calendar/university_calendar_setup',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');
 
 
 