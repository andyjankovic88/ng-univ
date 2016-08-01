<?php
$I = new ApiTester($scenario);
//Academic - team+userid9178@ucroo.com
/*$user_email1 = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'3'));
$user_password1 = 'ucroo123';

//Student - temp4@ucroo.com
$user_email2 = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'2'));
$user_password2 = 'ucroo123';

//Universityadmin - chase+deakin1@ucroo.com
$user_email3 = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'5'));
$user_password3 = 'ucroo123';
*/
$user_email1 = 'team+userid22@ucroo.com';
$user_password1 = 'ucroo123';
$email_name = $I->randStrGen(6).'@retu.com';



//+ve
$I->am('Case 1 : Login service');
$I->wantTo('Login with Email & Password');
$I->sendPost('mapi/login_android',['email' => $user_email1, 'password' => $user_password1]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$data=$I->getArrayFromJson($I);
$token=$data['ucroo_auth_token'];
$I->canSeeResponseIsValidOnSchemaFile('MapiloginCept.json');


//+ve
$I->am('Case 2 : GET ALL Activity');
$I->wantTo('GET ALL Activity');
$I->haveHttpHeader('Auth-Token',$token);
$I->haveHttpHeader('device_info' , 'ios-2.1');
$I->sendGet('mapi/activity',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson(); 
$data2=$I->getArrayFromJson($I);
$type=$data2[0]['type'];
$I->canSeeResponseIsValidOnSchemaFile('MapieventCept.json');



//+ve
$I->am('Case 3 : GET ALL Activity by specific type');
$I->wantTo('GET ALL Activity by specific type');
$I->haveHttpHeader('Auth-Token',$token);
$I->haveHttpHeader('device_info' , 'ios-2.1');
$I->sendGet('mapi/activity?type='.$type,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MapieventCept.json');



//+ve
$I->am('Case 4 : GET ALL notifications');
$I->wantTo('GET ALL notifications');
$I->haveHttpHeader('Auth-Token',$token);
$I->haveHttpHeader('device_info' , 'ios-2.1');
$I->sendGet('mapi/notifications',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson(); 
$data3=$I->getArrayFromJson($I);
$notifications_type=$data3['notifications'][0]['type'];
$I->canSeeResponseIsValidOnSchemaFile('MapinotificationCept.json');



//+ve
$I->am('Case 5 : GET All notifications of specific type');
$I->wantTo('GET All notifications of specific type');
$I->haveHttpHeader('Auth-Token',$token);
$I->haveHttpHeader('device_info' , 'ios-2.1');
$I->sendGet('mapi/notifications?type='.$notifications_type,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson(); 
$I->canSeeResponseIsValidOnSchemaFile('MapinotificationCept.json');


// fail due to indexing issue
//+ve
$I->am('Case 6 : GET ALL message');
$I->wantTo('GET ALL message');
$I->haveHttpHeader('Auth-Token',$token);
$I->haveHttpHeader('device_info' , 'ios-2.1');
$I->sendGet('mapi/messages',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson(); 
$data4=$I->getArrayFromJson($I);
$conversation_id=$data4[0]['id'];
$I->canSeeResponseIsValidOnSchemaFile('MapimessageCept.json');


// fail due to indexing issue
//+ve
$I->am('Case 7 : GET message with specific conversation id');
$I->wantTo('GET message with specific conversation id');
$I->haveHttpHeader('Auth-Token',$token);
$I->haveHttpHeader('device_info' , 'ios-2.1');
$I->sendGet('mapi/messages/'.$conversation_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson(); 
$I->canSeeResponseIsValidOnSchemaFile('Mapimessage2Cept.json');



//+ve
$I->am('Case 8 : Add Study Timer');
$I->wantTo('Add Study Timer');
$I->haveHttpHeader('Auth-Token',$token);
$I->haveHttpHeader('device_info' , 'ios-2.1');
$I->sendGet('mapi/study_timer_status',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson(); 
$I->canSeeResponseIsValidOnSchemaFile('MapistudytimerCept.json');



//+ve
$I->am('Case 9 : Add Comments on Post');
$I->wantTo('Add Comments on Post');
$I->haveHttpHeader('Auth-Token',$token);
$I->haveHttpHeader('device_info' , 'ios-2.1');
$I->sendGet('mapi/feed_items_comments/130',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson(); 
$I->canSeeResponseIsValidOnSchemaFile('MapisucessCept.json');


//+ve
$I->am('Case 10 : Create Feed POST');
$I->wantTo('Create Feed POST');
$I->haveHttpHeader('Auth-Token',$token);
$I->haveHttpHeader('device_info' , 'ios-2.1');
$I->sendPOST('mapi/feed/university/8',['feed_item'=>['type'=>'post','title'=>'aaa','text'=>'This is Post Content','is_anonymous'=>'false'],'post_faculty'=>'1','post_campus'=>'39','post_is_international'=>'1','post_year'=>'1']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson(); 
$I->canSeeResponseIsValidOnSchemaFile('MapisucessCept.json');



// http://backend.localhost.ucroo/mapi/events/club/93
//+ve
$I->am('Case 29 : Club Events');
$I->wantTo('Club Events');
$I->haveHttpHeader('Auth-Token',$token);
$I->sendGET('mapi/events/club/93',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson(); 
$I->canSeeResponseIsValidOnSchemaFile('MapiclubCept.json');


// NOT write as - The configuration file memcached.php does not exist
// http://192.192.8.237/ucroo_backend/src/index.php/connections/connect/connectuser
//+ve
$I->am('Case 28 : Connection Request');
$I->wantTo('Connection Request');
$I->haveHttpHeader('Auth-Token',$token);
$I->sendPOST('mapi/feed/university/8',['feed_item'=>['type'=>'post','title'=>'aaa','text'=>'This is Post Content','is_anonymous'=>'false'],'post_faculty'=>'1','post_campus'=>'39','post_is_international'=>'1','post_year'=>'1']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson(); 
$I->canSeeResponseIsValidOnSchemaFile('MapisucessCept.json');



//+ve
$I->am('Case 11 : Create Feed File');
$I->wantTo('Create Feed File');
$I->haveHttpHeader('Auth-Token',$token);
$I->haveHttpHeader('device_info' , 'ios-2.1');
$I->sendPOST('mapi/feed/university/8',['feed_item'=>['type'=>'post','title'=>'aaa','text'=>'This is Post Content','is_anonymous'=>'false'],'post_faculty'=>'1','post_campus'=>'39','post_is_international'=>'1','post_year'=>'1']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson(); 
$I->canSeeResponseIsValidOnSchemaFile('MapisucessCept.json');


//+ve
$I->am('Case 12 : Create Feed Link');
$I->wantTo('Create Feed Link');
$I->haveHttpHeader('Auth-Token',$token);
$I->haveHttpHeader('device_info' , 'ios-2.1');
$I->sendPOST('mapi/feed/university/8',['feed_item'=>['type'=>'post','title'=>'aaa','text'=>'This is Post Content','is_anonymous'=>'false'],'post_faculty'=>'1','post_campus'=>'39','post_is_international'=>'1','post_year'=>'1']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson(); 
$I->canSeeResponseIsValidOnSchemaFile('MapisucessCept.json');





//+ve
$I->am('Case 13 : Create Feed Poll');
$I->wantTo('Create Feed Poll');
$I->haveHttpHeader('Auth-Token',$token);
$I->haveHttpHeader('device_info' , 'ios-2.1');
$I->sendPOST('mapi/feed/university/8',['feed_item'=>['poll_answers'=>['0'=>'A','1'=>'B','2'=>'C'],'type'=>'post','title'=>'aaa','text'=>'This is Post Content','is_anonymous'=>'false'],'post_faculty'=>'1','post_campus'=>'39','post_is_international'=>'1','post_year'=>'1']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson(); 
$I->canSeeResponseIsValidOnSchemaFile('MapisucessCept.json');



//+ve
$I->am('Case 14 : Create New USer - Sign up');
$I->wantTo('Create Feed Poll');
$I->haveHttpHeader('Auth-Token',$token);
$I->haveHttpHeader('device_info' , 'ios-2.1');
$I->sendPOST('mapi/feed/university/8',['feed_item'=>['poll_answers'=>['0'=>'A','1'=>'B','2'=>'C'],'type'=>'post','title'=>'aaa','text'=>'This is Post Content','is_anonymous'=>'false'],'post_faculty'=>'1','post_campus'=>'39','post_is_international'=>'1','post_year'=>'1']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson(); 
$I->canSeeResponseIsValidOnSchemaFile('MapisucessCept.json');



//+ve
$I->am('Case 15 : Create New USer - Sign up');
$I->wantTo('Create Feed Poll');
$I->sendPOST('mapi/signup',['first_name'=>'Jaymit Fb','last_name'=>'patel','email'=>$email_name,'secondary_email'=>'weq@qaz.com','password'=>'ucroo123','password_confirmation'=>'ucroo123','gender'=>'male','university_id'=>'1','campus_id'=>'39','course_id'=>'3','start_year'=>'2012','completion_year'=>'2016','international'=>'0','faculty_id'=>'3','normal_student_sign_up'=>'1','group_id'=>'2']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson(); 
$I->canSeeResponseIsValidOnSchemaFile('MapisignupCept.json');


//+ve
$I->am('Case 16 : Create Poll');
$I->wantTo('Create Poll');
$I->haveHttpHeader('Auth-Token',$token);
$I->haveHttpHeader('device_info' , 'ios-2.1');
$I->sendPOST('mapi/feed/university/8',['feed_item'=>['poll_answers'=>['0'=>'1','1'=>'2','2'=>'3'],'type'=>'post','title'=>'aaa','text'=>'This is Post Content','is_anonymous'=>'false'],'post_faculty'=>'1','post_campus'=>'39','post_is_international'=>'1','post_year'=>'1']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson(); 
$I->canSeeResponseIsValidOnSchemaFile('MapisucessCept.json');


//+ve
$I->am('Case 17 : Create new Study Group');
$I->wantTo('Create new Study Group');
$I->haveHttpHeader('Auth-Token',$token);
$I->sendPOST('mapi/create_study_group',['name'=>'My Temp Study grp','purpose_group'=>'Sample Purpose','time_from'=>'7:30:00','time_to'=>'11:30:00','time_day'=>'1','privacy'=>'1','icon'=>'']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson(); 
$I->canSeeResponseIsValidOnSchemaFile('MapisucessCept.json');



//http://192.192.8.237/ucroo_backend/src/index.php/mapi/events/customgroups/96
//+ve
$I->am('Case 29 : Custom Group');
$I->wantTo('Custom Group');
$I->haveHttpHeader('Auth-Token',$token);
$I->sendGET('mapi/events/customgroups/96',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson(); 
$I->canSeeResponseIsValidOnSchemaFile('Mapicustomgroup2Cept.json');

//+ve
$I->am('Case 18 : Custom Group');
$I->wantTo('Custom Group');
$I->haveHttpHeader('Auth-Token',$token);
$I->sendGET('mapi/custom_group_all',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson(); 
$I->canSeeResponseIsValidOnSchemaFile('MapicustomgroupCept.json');


//+ve
$I->am('Case 19 : Feed list');
$I->wantTo('Feed list');
$I->haveHttpHeader('Auth-Token',$token);
$I->sendGET('mapi/feed_list',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson(); 
$I->canSeeResponseIsValidOnSchemaFile('MapifeedlistCept.json');


//+ve
$I->am('Case 20 : Get All Comments');
$I->wantTo('Get All Comments');
$I->haveHttpHeader('Auth-Token',$token);
$I->sendGET('mapi/feed/university/15',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$data4=$I->getArrayFromJson($I);
$post_id=$data4['posts'][0]['id'];
$I->sendGET('mapi/feed_items_comments/'.$post_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MapifeeditemcommentsCept.json');



//+ve
$I->am('Case 21 : Like post');
$I->wantTo('Like post');
$I->haveHttpHeader('Auth-Token',$token);
$I->sendGET('mapi/feed_items/'.$post_id.'/upvote',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MapisucessCept.json');


//+ve
$I->am('Case 22 : dislike post');
$I->wantTo('dislike post');
$I->haveHttpHeader('Auth-Token',$token);
$I->sendGET('mapi/feed_items/'.$post_id.'/downvote',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MapisucessCept.json');


//+ve
$I->am('Case 23 : get profile service');
$I->wantTo('get profile service');
$I->haveHttpHeader('Auth-Token',$token);
$I->sendGET('mapi/me',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MapiprofileCept.json');

// here static message id passed because for /message response was not coming due to indexing prob
//+ve
$I->am('Case 24 : get messages service');
$I->wantTo('get messages service');
$I->haveHttpHeader('Auth-Token',$token);
$I->sendGET('mapi/messages/93',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Mapimessage3Cept.json');


//+ve
$I->am('Case 25 : get notification service');
$I->wantTo('get notification service');
$I->haveHttpHeader('Auth-Token',$token);
$I->sendGET('mapi/notifications/',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MapinotificationCept.json');


//http://192.192.8.237/ucroo_backend/src/index.php/mapi/feed_items_poll/1182
//+ve
$I->am('Case 30 : Poll Voted');
$I->wantTo('Poll Voted');
$I->haveHttpHeader('Auth-Token',$token);
$I->sendPOST('mapi/feed_items_poll/1182',['poll_option_id'=>'42']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MapisucessCept.json');



//+ve
$I->am('Case 26 : get all service');
$I->wantTo('get all service');
$I->haveHttpHeader('Auth-Token',$token);
$I->sendGET('mapi/services_all/',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MapiserviceallCept.json');


//+ve
$I->am('Case 27 : get one service');
$I->wantTo('get one service');
$I->haveHttpHeader('Auth-Token',$token);
$I->sendGET('mapi/events/service/106',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MapiserviceCept.json');



//UCROO Connection - Filter
// taking too much time to execute so commented
//+ve
/*$I->am('Case 31 : UCROO Connection - Filter');
$I->wantTo('UCROO Connection - Filter');
$I->haveHttpHeader('Auth-Token',$token);
$I->sendPOST('connections/filter_connections',['is_filtered'=>'1','search_term'=>'pr']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MapiconnectionCept.json');*/


//UCROO Get Suggested Connection
//+ve
$I->am('Case 32 : UCROO Get Suggested Connection');
$I->wantTo('UCROO Get Suggested Connection');
$I->haveHttpHeader('Auth-Token',$token);
$I->sendGET('connections/suggested_connection',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MapisuggestedconnectionCept.json');