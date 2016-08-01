<?php

$I = new ApiTester($scenario);
$user_email1 = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'2'));
$user_id = $I->getDataFromDbCustom($I,'users','id',array('email'=>$user_email1));
$user_email2 = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'2'));
$user_password = 'ucroo123';
$servicepage_name = $I->randStrGen(6);
$subject_id_1 = $I->getDataFromDbCustom($I,'unit','id',array('id'=>'18'));



// +ve
$I->am('Case 1 : get study logs graph data api after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get study logs graph data api after login');
$I->sendPOST('study_timer/study_graph/',['from_date'=>'2015-10-17','to_date'=>'2015-10-17']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudytimerstudylogCept.json');

// +ve
$I->am('Case 5 : Add study session API after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add study session API after login');
$I->sendPOST('study_timer/study_session_add/',['study_date'=>'2015-10-17','study_time'=>'60','unit_id'=>'3']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudytimerstudylogCept.json');

//-ve
$I->am('Case 6 : Add study session API without date after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add study session API without date after login');
$I->sendPOST('study_timer/study_session_add/',['study_time'=>'60','unit_id'=>'3']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudytimerstudylogCept.json');



//-ve
$I->am('Case 7 : Add study session API without time after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add study session API without time after login');
$I->sendPOST('study_timer/study_session_add/',['study_date'=>'2015-10-17','unit_id'=>'3']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudytimerstudylogCept.json');




//-ve
$I->am('Case 8 : Add study session API without unit id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add study session API without unit id after login');
$I->sendPOST('study_timer/study_session_add/',['study_date'=>'2015-10-17','study_time'=>'60']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudytimerstudylogCept.json');








//+ve
$I->am('Case 9 : Study Session History API after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Study Session History API after login');
$I->sendGET('study_timer/study_session_list/1/10',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$data = $I->getArrayFromJson($I);
$study_log_id = '';
foreach ($data['response']['study_session_data'] as $k=>$v){
    if (!empty($study_log_id)){
        break;
    }
    $study_log_id = $v[0]['id'];
}

$I->canSeeResponseIsValidOnSchemaFile('StudytimerlistCept.json');







//+ve
$I->am('Case 14 : Delete Study Session API after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Delete Study Session API after login');
$I->sendPOST('study_timer/study_session_delete/',['study_log_id'=>$study_log_id]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudytimerstudylogCept.json');



//-ve
$I->am('Case 15 : Delete Study Session API again with same study_log_id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Delete Study Session API again with same study_log_id after login');
$I->sendPOST('study_timer/study_session_delete/',['study_log_id'=>$study_log_id]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudytimerstudylogCept.json');


//-ve
$I->am('Case 16 : Delete Study Session API again with study_log_id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Delete Study Session API again with study_log_id as string after login');
$I->sendPOST('study_timer/study_session_delete/',['study_log_id'=>'aaaaa']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudytimerstudylogCept.json');



//-ve
$I->am('Case 17 : Delete Study Session API again with study_log_id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Delete Study Session API again with study_log_id not exist after login');
$I->sendPOST('study_timer/study_session_delete/',['study_log_id'=>'9999999999999999999']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudytimerstudylogCept.json');



//-ve
$I->am('Case 18 : Delete Study Session API again without study_log_id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Delete Study Session API again without study_log_id after login');
$I->sendPOST('study_timer/study_session_delete/',['study_log_id'=>'']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudytimerstudylogCept.json');







//+ve
$I->am('Case 19 : Start Study Session API after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$data2 = $I->getArrayFromJson($I);
$unit = $data2['response']['mainMenu']['unit'];
if(count($unit)==0){
    $I->sendPost('subject/enrol/'.$subject_id_1,[]);
    $unit_id = $subject_id_1;
} else{
    $unit_id = $data2['response']['mainMenu']['unit'][0]['id'];
}
$I->wantTo('Start Study Session API after login');
$I->sendPOST('/study_timer/start/',['unit_selected'=>$unit_id]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudytimerstudylogCept.json');



//+ve
$I->am('Case 20 : get study timer state/status API after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get study timer state/status API after login');
$I->sendGET('/study_timer/status/',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudytimerstatusCept.json');


//+ve
$I->am('Case 21 : Stop Study Session API after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Stop Study Session API after login');
$I->sendPOST('/study_timer/stop/',['unit_selected'=>$unit_id]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudytimerstudylogCept.json');



//-ve
$I->am('Case 22 : Start Study Session API without unit id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Start Study Session API without unit id after login');
$I->sendPOST('/study_timer/start/',['unit_selected'=>'']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudytimerstudylogCept.json');


//-ve
$I->am('Case 23 : Start Study Session API with unit id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Start Study Session API with unit id not exist after login');
$I->sendPOST('/study_timer/start/',['unit_selected'=>'444444444444444444']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudytimerstudylogCept.json');



//-ve
$I->am('Case 24 : Start Study Session API with unit id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Start Study Session API with unit id as string after login');
$I->sendPOST('/study_timer/start/',['unit_selected'=>'ssssssssssssssssssssssss']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudytimerstudylogCept.json');










//+ve
$I->am('Case 28 : get time select list API, that will use with add study session manually after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get time select list API, that will use with add study session manually after login');
$I->sendGET('study_timer/time_select_list/',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudytimertimeselectlistCept.json');


//+ve
$I->am('Case 29 : Get user connections API, that will use with Studied Comparison after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Get user connections API, that will use with Studied Comparison after login');
$I->sendGET('general/user_connection/',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudytimerconnectionCept.json');



//-ve
$I->am('Case 11 : Study Session History API with pageno as string and page coung as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Study Session History API with pageno as string and page coung as string after login');
$I->sendGET('study_timer/study_session_list/a/d',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudytimerstudylogCept.json');


//-ve
$I->am('Case 12 : Study Session History API with page coung as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Study Session History API with page coung as string after login');
$I->sendGET('study_timer/study_session_list/3/d',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudytimerstudylogCept.json');










//-ve
$I->am('Case 25 : Stop Study Session API without unit id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Stop Study Session API without unit id after login');
$I->sendPOST('/study_timer/stop/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudytimerstudylogCept.json');




// fail giving db error
//-ve
$I->am('Case 10 : Study Session History API with pageno as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Study Session History API with pageno as string after login');
$I->sendGET('study_timer/study_session_list/a/10',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudytimerstudylogCept.json');


// fail it is giving 200 it should be 400
// -ve
$I->am('Case 2 : get study logs graph data with star date greater than end date api after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get study logs graph data with star date greater than end date api after login');
$I->sendPOST('study_timer/study_graph/',['from_date'=>'2017-10-17','to_date'=>'2015-10-17']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudytimerstudylogCept.json');


// fail it is giving 200 it should be 400
// -ve
$I->am('Case 3 : get study logs graph data without star date api after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get study logs graph data without star date api after login');
$I->sendPOST('study_timer/study_graph/',['from_date'=>'2017-10-17']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudytimerstudylogCept.json');


 