<?php

$I = new ApiTester($scenario);
$user_email = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'2','id'=>'8'));
$user_email_staff = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'3','id'=>'9178'));
$user_id_staff = $I->getDataFromDbCustom($I,'users','id',array('email'=>$user_email_staff,'group_id'=>'3'));

$user_password = 'ucroo123';
$club_name = $I->randStrGen(6);
$club_short_name = $club_name.'1';


// +ve
$I->am('Case 1 : get club listing after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get club listing after login');
$I->sendGET('club/listing',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ClublistCept.json');



// +ve
$I->am('Case 2 : add club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('add club after login');
$I->sendPOST('club/edit/new',['name'=>$club_name,'short_name'=>$club_short_name,'description'=>'this is good data aaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email'=>'development@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'1','owner_position'=>'Director','member_fee'=>'1.00','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'aaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaa','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$data = $I->getArrayFromJson($I);
$club_id = $data['response']['club_id'];
$I->canSeeResponseIsValidOnSchemaFile('ClubaddCept.json');




// +ve
$I->am('Case 3 : edit club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit club after login');
$I->sendPOST('club/edit/'.$club_id,['name'=>$club_name.'er','short_name'=>$club_short_name,'description'=>'this is good data aaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email'=>'development@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'1','owner_position'=>'Director','member_fee'=>'1.00','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'aaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaa','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');





// -ve
$I->am('Case 9 : edit club with not related club id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit club with not related club id after login');
$I->sendPOST('club/edit/111'.$club_id,['name'=>$club_name.'er','short_name'=>$club_short_name,'description'=>'this is good data aaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email'=>'development@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'1','owner_position'=>'Director','member_fee'=>'1.00','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'aaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaa','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
$I->am('Case 10 : edit club without club id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit club without club id after login');
$I->sendPOST('club/edit/',['name'=>$club_name.'er','short_name'=>$club_short_name,'description'=>'this is good data aaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email'=>'development@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'1','owner_position'=>'Director','member_fee'=>'1.00','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'aaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaa','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
$I->am('Case 11 : edit club with string club id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit club with string club id after login');
$I->sendPOST('club/edit/aaaaaaaaa',['name'=>$club_name.'er','short_name'=>$club_short_name,'description'=>'this is good data aaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email'=>'development@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'1','owner_position'=>'Director','member_fee'=>'1.00','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'aaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaa','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');





// +ve
$I->am('Case 4 : listing club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('listing club after login');
$I->sendGET('club/listing',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$data1 = $I->getArrayFromJson($I);
$club_added_title = $data1['response']['clubs'][$club_id]['name'];
// check weather added and edited come in listing
$I->compareString($club_name.'er',$club_added_title);
$I->canSeeResponseIsValidOnSchemaFile('ClublistCept.json');



// +ve
$I->am('Case 5 : view club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('view club after login');
$I->sendGET('club/view/'.$club_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ClubviewCept.json');


// -ve
$I->am('Case 31 : view club without param after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('view club without param after login');
$I->sendGET('club/view/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 6 : view club with string as param after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('view club with string as param after login');
$I->sendGET('club/view/aaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
$I->am('Case 7 : view club with invalid id  after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('view club with invalid id  after login');
$I->sendGET('club/view/11111111111111111111111',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// +ve
$I->am('Case 37 : admin club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin club after login');
$I->sendGET('club/admin/'.$club_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ClubviewCept.json');



// -ve
$I->am('Case 38 : admin club with blank club_id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin club with blank club_id after login');
$I->sendGET('club/admin/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
$I->am('Case 39 : admin club with string club_id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin club with string club_id after login');
$I->sendGET('club/admin/aaaaaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 40 : admin club with club_id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin club with club_id not exist after login');
$I->sendGET('club/admin/aaaaaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// +ve
$I->am('Case 41 : users_filter of club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('users_filter of club after login');
$I->sendGET('club/users_filter/'.$club_id.'?sSearch=chas&iDisplayLength=&iDisplayStart=&sEcho=',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ClubuserfilterCept.json');




// +ve
$I->am('Case 44 : admin_custom_fields of club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('users_filter of club after login');
$I->sendPOST('club/admin_custom_fields/'.$club_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ClubadmincustomCept.json');



// -ve
$I->am('Case 45 : admin_custom_fields of club without club id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin_custom_fields of club without club id after login');
$I->sendPOST('club/admin_custom_fields/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 46 : admin_custom_fields of club with club id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin_custom_fields of club with club id as string after login');
$I->sendPOST('club/admin_custom_fields/aaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// +ve
$I->am('Case 47 : admin_custom_fields of club with params after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin_custom_fields of club with params after login');
$I->sendPOST('club/admin_custom_fields/'.$club_id,['club_avail_fields'=>['student_mobile'=>'true','student_id'=>'false','student_association'=>'true'],'club_fields'=>['Custom 1','Custom 2','Custom 3']]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');




// +ve
$I->am('Case 48 : events of club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('events of club after login');
$I->sendGET('club/events/'.$club_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ClubeventCept.json');



// -ve
$I->am('Case 49 : events of club with club id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('events of club with club id as string after login');
$I->sendGET('club/events/aaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 50 : events of club with club id as wrong club id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('events of club with club id as wrong club id after login');
$I->sendGET('club/events/1111111111111111111111',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// +ve
$I->am('Case 51 : events of club without club id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('events of club without club id after login');
$I->sendGET('club/events/',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ClubeventlistCept.json');



// hold
// +ve
//http://backend.localhost.ucroo/club/admin_add_member/96
$I->am('Case 52 : get fields for add member in club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('add member in club after login');
$I->sendPOST('club/admin_add_member/'.$club_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$data = $I->getArrayFromJson($I);
$fields = $data['response']['form']['fields'];
$I->canSeeResponseIsValidOnSchemaFile('ClubaddfieldsCept.json');
$postdata='[';
foreach ($fields as $field){
    Switch ($field['name']){
        Case 'first_name':
            $postdata=$postdata.'"first_name"=>"ard"';
            break;
        Case 'last_name':
            $postdata=$postdata.',"last_name"=>"ard last"';
            break;
        Case 'email':
            $postdata=$postdata.',"email"=>"ard@last.com"';
            break;
        Case 'student_association':
            $postdata=$postdata.',"student_association"=>"1"';
            break;
        default:
            $postdata=$postdata.',"'.$field['name'].'"=>""';
    }
        
}
$postdata=$postdata.']';



//+ ve
$I->am('Case 67 : add member in club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('add member in club after login');
$I->sendPOST('club/admin_add_member/'.$club_id,$postdata);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ClubaddmemberCept.json');



//+ ve
$I->am('Case 68 : admin_import_members step 1 in club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin_import_members step 1 in club after login');
$I->sendPOST('club/admin_import_members/'.$club_id);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Clubimportmember1Cept.json');



//- ve
$I->am('Case 71 : admin_import_members step 1 without club_id in club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin_import_members step 1 without club_id in club after login');
$I->sendPOST('club/admin_import_members/');
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


//- ve
$I->am('Case 72 : admin_import_members step 1 with club_id as string in club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin_import_members step 1 with club_id as string in club after login');
$I->sendPOST('club/admin_import_members/aaaaaaaaaaaa');
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



//- ve
$I->am('Case 73 : admin_import_members step 1 with club_id does not exist in club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin_import_members step 1 with club_id does not exist in club after login');
$I->sendPOST('club/admin_import_members/1111111111111111111111');
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');





//+ ve
$I->am('Case 69 : admin_import_members step 2 upload in club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin_import_members step 2 upload in club after login');
$I->sendPOST('club/admin_import_members/'.$club_id,['submit'=>'Import Members'],['userfile'=>[
            'name' => 'monash_sucroo_users_club_5.csv',
            'type' => 'file/csv',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('monash_sucroo_users_club_5.csv')),
            'tmp_name' => codecept_data_dir('monash_sucroo_users_club_5.csv'),
        ]]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$data = $I->getArrayFromJson($I);
$send_invoice = $data['response']['send_invoice'];
$new_member_data = $data['response']['new_member_data'];
$I->canSeeResponseIsValidOnSchemaFile('Clubimportmember2Cept.json');


//- ve
$I->am('Case 74 : admin_import_members step 2 upload without file in club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin_import_members step 2 upload without file in club after login');
$I->sendPOST('club/admin_import_members/'.$club_id,['submit'=>'Import Members']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



//- ve
$I->am('Case 75 : admin_import_members step 2 upload without club id in club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin_import_members step 2 upload without club id in club after login');
$I->sendPOST('club/admin_import_members/',['submit'=>'Import Members'],['userfile'=>[
            'name' => 'monash_sucroo_users_club_5.csv',
            'type' => 'file/csv',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('monash_sucroo_users_club_5.csv')),
            'tmp_name' => codecept_data_dir('monash_sucroo_users_club_5.csv'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



//- ve
$I->am('Case 76 : admin_import_members step 2 upload with club id as string in club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin_import_members step 2 upload with club id as string in club after login');
$I->sendPOST('club/admin_import_members/aaaaaaaaaaaaaaaaaa',['submit'=>'Import Members'],['userfile'=>[
            'name' => 'monash_sucroo_users_club_5.csv',
            'type' => 'file/csv',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('monash_sucroo_users_club_5.csv')),
            'tmp_name' => codecept_data_dir('monash_sucroo_users_club_5.csv'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');




//- ve
$I->am('Case 77 : admin_import_members step 2 upload with club id does not exist in club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin_import_members step 2 upload with club id does not exist in club after login');
$I->sendPOST('club/admin_import_members/111111111111111111',['submit'=>'Import Members'],['userfile'=>[
            'name' => 'monash_sucroo_users_club_5.csv',
            'type' => 'file/csv',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('monash_sucroo_users_club_5.csv')),
            'tmp_name' => codecept_data_dir('monash_sucroo_users_club_5.csv'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



//+ ve
$I->am('Case 78 : admin_import_followers step 1 in club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin_import_followers step 1 in club after login');
$I->sendPOST('club/admin_import_followers/'.$club_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Clubimportfollowers1Cept.json');



//- ve
$I->am('Case 79 : admin_import_followers step 1 without club id in club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin_import_followers step 1 without club id in club after login');
$I->sendPOST('club/admin_import_followers/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



//- ve
$I->am('Case 80 : admin_import_followers step 1 with club id as string in club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin_import_followers step 1 with club id as string in club after login');
$I->sendPOST('club/admin_import_followers/gggggggggggggggggggggggggg',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



//- ve
$I->am('Case 81 : admin_import_followers step 1 with club id not exist in club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin_import_followers step 1 with club id not exist in club after login');
$I->sendPOST('club/admin_import_followers/5555555555555555555',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');




//+ ve
$I->am('Case 82 : admin_import_followers step 2 upload in club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin_import_followers step 2 upload in club after login');
$I->sendPOST('club/admin_import_followers/'.$club_id,['submit'=>'Import Club Followers'],['userfile'=>[
            'name' => 'monash_sucroo_users_club_5 followers.csv',
            'type' => 'file/csv',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('monash_sucroo_users_club_5 followers.csv')),
            'tmp_name' => codecept_data_dir('monash_sucroo_users_club_5 followers.csv'),
        ]]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


//- ve
$I->am('Case 83 : admin_import_followers step 2 upload in club without club id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin_import_followers step 2 upload in club without club id after login');
$I->sendPOST('club/admin_import_followers/',['submit'=>'Import Club Followers'],['userfile'=>[
            'name' => 'monash_sucroo_users_club_5 followers.csv',
            'type' => 'file/csv',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('monash_sucroo_users_club_5 followers.csv')),
            'tmp_name' => codecept_data_dir('monash_sucroo_users_club_5 followers.csv'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


//- ve
$I->am('Case 84 : admin_import_followers step 2 upload in club with club id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin_import_followers step 2 upload in club with club id as string after login');
$I->sendPOST('club/admin_import_followers/aaaaaaaaaa',['submit'=>'Import Club Followers'],['userfile'=>[
            'name' => 'monash_sucroo_users_club_5 followers.csv',
            'type' => 'file/csv',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('monash_sucroo_users_club_5 followers.csv')),
            'tmp_name' => codecept_data_dir('monash_sucroo_users_club_5 followers.csv'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


//- ve
$I->am('Case 85 : admin_import_followers step 2 upload in club with club id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin_import_followers step 2 upload in club with club id not exist after login');
$I->sendPOST('club/admin_import_followers/1111111111111111',['submit'=>'Import Club Followers'],['userfile'=>[
            'name' => 'monash_sucroo_users_club_5 followers.csv',
            'type' => 'file/csv',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('monash_sucroo_users_club_5 followers.csv')),
            'tmp_name' => codecept_data_dir('monash_sucroo_users_club_5 followers.csv'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');




//+ ve
$I->am('Case 88 : event create step 1 in club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('event create step 1 in club after login');
$I->sendPOST('club/event_edit/'.$club_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Clubcreateevent1Cept.json');



//- ve
$I->am('Case 89 : event create step 1 in club without club_id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('event create step 1 in club without club_id after login');
$I->sendPOST('club/event_edit/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



//- ve
$I->am('Case 90 : event create step 1 in club with club_id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('event create step 1 in club with club_id as string after login');
$I->sendPOST('club/event_edit/ssssssssssssssssssssss',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



//- ve
$I->am('Case 91 : event create step 1 in club with club_id does not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('event create step 1 in club with club_id does not exist after login');
$I->sendPOST('club/event_edit/111111111111111111111111',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



//+ ve
$I->am('Case 92 : event create step 2 in club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('event create step 2 in club after login');
date_default_timezone_set('Australia/Sydney');
$start_date = date('d/m/Y');
$end_date = date('d/m/Y', strtotime('+ 5 days'));
$start_date_hrs = date('h', strtotime('+ 2 hours'));
$start_date_mins = date('i');
$start_date_period = date('A');

$end_date_hrs = date('h', strtotime('+ 5 hours'));
$end_date_mins = date('i');

$I->sendPOST('club/event_edit/'.$club_id,['event_type'=>'social_event','title'=>'Club Event 05012016',"description"=>"test event description test event description test event description test event description test event description ",
    "start_date"=>$start_date,
    "start_date_hrs"=>$start_date_hrs,
    "start_date_mins"=>$start_date_mins,
    "start_date_period"=>$start_date_period,
    "end_date"=>$end_date,
    "end_date_hrs"=>$end_date_hrs,
    "end_date_mins"=>$end_date_mins,
    "end_date_period"=>"PM",
    "timezone"=>"Australia/Sydney",
    "location"=>"Ahmedabad",
    "ticketed_event"=>"true"]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$data2 = $I->getArrayFromJson($I);
$I->canSeeResponseIsValidOnSchemaFile('Clubcreateevent2Cept.json');




// +ve
$I->am('Case 112 : edit event with event id and club id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('update bank detail of club after login');
$I->sendPOST('club/admin_bank_details/'.$club_id,['bank_name'=>'HDFC Bank','account_name'=>'Kaushal Parekh','account_bsb'=>'123456','account_number'=>'123123123']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ClubmsgCept.json');










//- ve
$I->am('Case 93 : event create step 2 in club without club_id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('event create step 2 in club without club_id after login');
$I->sendPOST('club/event_edit/',['event_type'=>'social_event','title'=>'Club Event 05012016',"description"=>"test event description test event description test event description test event description test event description ",
    "start_date"=>"26/01/2016",
    "start_date_hrs"=>"01",
    "start_date_mins"=>"00",
    "start_date_period"=>"AM",
    "end_date"=>"05/11/2016",
    "end_date_hrs"=>"12",
    "end_date_mins"=>"00",
    "end_date_period"=>"PM",
    "timezone"=>"Australia/Sydney",
    "location"=>"Ahmedabad",
    "ticketed_event"=>"true"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');




//- ve
$I->am('Case 94 : event create step 2 in club with club_id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('event create step 2 in club with club_id as string after login');
$I->sendPOST('club/event_edit/aaaaaaaaaaaaaaaa',['event_type'=>'social_event','title'=>'Club Event 05012016',"description"=>"test event description test event description test event description test event description test event description ",
    "start_date"=>"26/01/2016",
    "start_date_hrs"=>"01",
    "start_date_mins"=>"00",
    "start_date_period"=>"AM",
    "end_date"=>"05/11/2016",
    "end_date_hrs"=>"12",
    "end_date_mins"=>"00",
    "end_date_period"=>"PM",
    "timezone"=>"Australia/Sydney",
    "location"=>"Ahmedabad",
    "ticketed_event"=>"true"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


//- ve
$I->am('Case 95 : event create step 2 in club with club_id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('event create step 2 in club with club_id not exist after login');
$I->sendPOST('club/event_edit/222222222222222222222222222',['event_type'=>'social_event','title'=>'Club Event 05012016',"description"=>"test event description test event description test event description test event description test event description ",
    "start_date"=>"26/01/2016",
    "start_date_hrs"=>"01",
    "start_date_mins"=>"00",
    "start_date_period"=>"AM",
    "end_date"=>"05/11/2016",
    "end_date_hrs"=>"12",
    "end_date_mins"=>"00",
    "end_date_period"=>"PM",
    "timezone"=>"Australia/Sydney",
    "location"=>"Ahmedabad",
    "ticketed_event"=>"true"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



//+ ve
$I->am('Case 70 : admin_import_members step 3 confirm in club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin_import_members step 3 confirm in club after login');
$I->sendPOST('club/admin_import_members/'.$club_id,['new_member_data'=>$new_member_data,'send_invoice'=>$send_invoice,'fields'=>['first_name','last_name','email']]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Clubimportmember3Cept.json');




// +ve
//http://backend.localhost.ucroo/club/admin_bank_details/127
$I->am('Case 53 : admin bank detail of club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin bank detail of club after login');
$I->sendPOST('club/admin_bank_details/'.$club_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ClubbankdetailCept.json');


// -ve
$I->am('Case 54 : admin bank detail of club with blank club id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin bank detail of club with blank club id after login');
$I->sendPOST('club/admin_bank_details/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 55 : admin bank detail of club with string club id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin bank detail of club with string club id after login');
$I->sendPOST('club/admin_bank_details/aaaaaaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');




// -ve
$I->am('Case 56 : admin bank detail of club with club id un authorized/ not exist  after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin bank detail of club with club id un authorized/ not exist  after login');
$I->sendPOST('club/admin_bank_details/111111111111111111111',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



//http://backend.localhost.ucroo/club/admin_bank_details/127
// +ve
$I->am('Case 57 : update bank detail of club after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('update bank detail of club after login');
$I->sendPOST('club/admin_bank_details/'.$club_id,['bank_name'=>'HDFC Bank','account_name'=>'Kaushal Parekh','account_bsb'=>'123456','account_number'=>'123123123']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ClubmsgCept.json');


// -ve
$I->am('Case 58 : update bank detail of club without club id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('update bank detail of club without club id after login');
$I->sendPOST('club/admin_bank_details/',['bank_name'=>'HDFC Bank','account_name'=>'Kaushal Parekh','account_bsb'=>'123456','account_number'=>'123123123']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 59 : update bank detail of club with club id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('update bank detail of club with club id as string after login');
$I->sendPOST('club/admin_bank_details/aaaaaaaaaaaaa',['bank_name'=>'HDFC Bank','account_name'=>'Kaushal Parekh','account_bsb'=>'123456','account_number'=>'123123123']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 60 : update bank detail of club with club id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('update bank detail of club with club id not exist after login');
$I->sendPOST('club/admin_bank_details/2222222222222222222222',['bank_name'=>'HDFC Bank','account_name'=>'Kaushal Parekh','account_bsb'=>'123456','account_number'=>'123123123']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');









//FAIL start==================================================



// fail [giving 200 , should be 400 and error msg]
//- ve
$I->am('Case 96 : event create step 2 in club without event_type after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('event create step 2 in club without event_type after login');
$I->sendPOST('club/event_edit/'.$club_id,['title'=>'Club Event 05012016',"description"=>"test event description test event description test event description test event description test event description ",
    "start_date"=>"26/01/2016",
    "start_date_hrs"=>"01",
    "start_date_mins"=>"00",
    "start_date_period"=>"AM",
    "end_date"=>"05/11/2016",
    "end_date_hrs"=>"12",
    "end_date_mins"=>"00",
    "end_date_period"=>"PM",
    "timezone"=>"Australia/Sydney",
    "location"=>"Ahmedabad",
    "ticketed_event"=>"true"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// fail [giving 200 , should be 400 and error msg]
//- ve
$I->am('Case 97 : event create step 2 in club without title after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('event create step 2 in club without title after login');
$I->sendPOST('club/event_edit/'.$club_id,['event_type'=>'social_event',"description"=>"test event description test event description test event description test event description test event description ",
    "start_date"=>"26/01/2016",
    "start_date_hrs"=>"01",
    "start_date_mins"=>"00",
    "start_date_period"=>"AM",
    "end_date"=>"05/11/2016",
    "end_date_hrs"=>"12",
    "end_date_mins"=>"00",
    "end_date_period"=>"PM",
    "timezone"=>"Australia/Sydney",
    "location"=>"Ahmedabad",
    "ticketed_event"=>"true"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// fail [giving 200 , should be 400 and error msg]
//- ve
$I->am('Case 98 : event create step 2 in club without description after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('event create step 2 in club without description after login');
$I->sendPOST('club/event_edit/'.$club_id,['event_type'=>'social_event','title'=>'Club Event 05012016',
    "start_date"=>"26/01/2016",
    "start_date_hrs"=>"01",
    "start_date_mins"=>"00",
    "start_date_period"=>"AM",
    "end_date"=>"05/11/2016",
    "end_date_hrs"=>"12",
    "end_date_mins"=>"00",
    "end_date_period"=>"PM",
    "timezone"=>"Australia/Sydney",
    "location"=>"Ahmedabad",
    "ticketed_event"=>"true"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// fail [giving 200 , should be 400 and error msg]
//- ve
$I->am('Case 99 : event create step 2 in club without start_date after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('event create step 2 in club without start_date after login');
$I->sendPOST('club/event_edit/'.$club_id,['event_type'=>'social_event','title'=>'Club Event 05012016',"description"=>"test event description test event description test event description test event description test event description ",
    "start_date_hrs"=>"01",
    "start_date_mins"=>"00",
    "start_date_period"=>"AM",
    "end_date"=>"05/11/2016",
    "end_date_hrs"=>"12",
    "end_date_mins"=>"00",
    "end_date_period"=>"PM",
    "timezone"=>"Australia/Sydney",
    "location"=>"Ahmedabad",
    "ticketed_event"=>"true"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// fail [giving 200 , should be 400 and error msg]
//- ve
$I->am('Case 100 : event create step 2 in club without start_date_hrs after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('event create step 2 in club without start_date_hrs after login');
$I->sendPOST('club/event_edit/'.$club_id,['event_type'=>'social_event','title'=>'Club Event 05012016',"description"=>"test event description test event description test event description test event description test event description ",
    "start_date"=>"26/01/2016",
    "start_date_mins"=>"00",
    "start_date_period"=>"AM",
    "end_date"=>"05/11/2016",
    "end_date_hrs"=>"12",
    "end_date_mins"=>"00",
    "end_date_period"=>"PM",
    "timezone"=>"Australia/Sydney",
    "location"=>"Ahmedabad",
    "ticketed_event"=>"true"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// fail [giving 200 , should be 400 and error msg]
//- ve
$I->am('Case 101 : event create step 2 in club without start_date_mins after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('event create step 2 in club without start_date_mins after login');
$I->sendPOST('club/event_edit/'.$club_id,['event_type'=>'social_event','title'=>'Club Event 05012016',"description"=>"test event description test event description test event description test event description test event description ",
    "start_date"=>"26/01/2016",
    "start_date_hrs"=>"01",
    "start_date_period"=>"AM",
    "end_date"=>"05/11/2016",
    "end_date_hrs"=>"12",
    "end_date_mins"=>"00",
    "end_date_period"=>"PM",
    "timezone"=>"Australia/Sydney",
    "location"=>"Ahmedabad",
    "ticketed_event"=>"true"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// fail [giving 200 , should be 400 and error msg]
//- ve
$I->am('Case 102 : event create step 2 in club without start_date_period after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('event create step 2 in club without start_date_period after login');
$I->sendPOST('club/event_edit/'.$club_id,['event_type'=>'social_event','title'=>'Club Event 05012016',"description"=>"test event description test event description test event description test event description test event description ",
    "start_date"=>"26/01/2016",
    "start_date_hrs"=>"01",
    "start_date_mins"=>"00",
    "end_date"=>"05/11/2016",
    "end_date_hrs"=>"12",
    "end_date_mins"=>"00",
    "end_date_period"=>"PM",
    "timezone"=>"Australia/Sydney",
    "location"=>"Ahmedabad",
    "ticketed_event"=>"true"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// fail [giving 200 , should be 400 and error msg]
//- ve
$I->am('Case 103 : event create step 2 in club without end_date after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('event create step 2 in club without end_date after login');
$I->sendPOST('club/event_edit/'.$club_id,['event_type'=>'social_event','title'=>'Club Event 05012016',"description"=>"test event description test event description test event description test event description test event description ",
    "start_date"=>"26/01/2016",
    "start_date_hrs"=>"01",
    "start_date_mins"=>"00",
    "start_date_period"=>"AM",
    "end_date_hrs"=>"12",
    "end_date_mins"=>"00",
    "end_date_period"=>"PM",
    "timezone"=>"Australia/Sydney",
    "location"=>"Ahmedabad",
    "ticketed_event"=>"true"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// fail [giving 200 , should be 400 and error msg]
//- ve
$I->am('Case 104 : event create step 2 in club without end_date_hrs after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('event create step 2 in club without end_date_hrs after login');
$I->sendPOST('club/event_edit/'.$club_id,['event_type'=>'social_event','title'=>'Club Event 05012016',"description"=>"test event description test event description test event description test event description test event description ",
    "start_date"=>"26/01/2016",
    "start_date_hrs"=>"01",
    "start_date_mins"=>"00",
    "start_date_period"=>"AM",
    "end_date"=>"05/11/2016",
    "end_date_mins"=>"00",
    "end_date_period"=>"PM",
    "timezone"=>"Australia/Sydney",
    "location"=>"Ahmedabad",
    "ticketed_event"=>"true"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// fail [giving 200 , should be 400 and error msg]
//- ve
$I->am('Case 105 : event create step 2 in club without end_date_mins after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('event create step 2 in club without end_date_mins after login');
$I->sendPOST('club/event_edit/'.$club_id,['event_type'=>'social_event','title'=>'Club Event 05012016',"description"=>"test event description test event description test event description test event description test event description ",
    "start_date"=>"26/01/2016",
    "start_date_hrs"=>"01",
    "start_date_mins"=>"00",
    "start_date_period"=>"AM",
    "end_date"=>"05/11/2016",
    "end_date_hrs"=>"12",
    "end_date_period"=>"PM",
    "timezone"=>"Australia/Sydney",
    "location"=>"Ahmedabad",
    "ticketed_event"=>"true"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');




// fail [giving 200 , should be 400 and error msg]
//- ve
$I->am('Case 106 : event create step 2 in club without end_date_period after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('event create step 2 in club without end_date_period after login');
$I->sendPOST('club/event_edit/'.$club_id,['event_type'=>'social_event','title'=>'Club Event 05012016',"description"=>"test event description test event description test event description test event description test event description ",
    "start_date"=>"26/01/2016",
    "start_date_hrs"=>"01",
    "start_date_mins"=>"00",
    "start_date_period"=>"AM",
    "end_date"=>"05/11/2016",
    "end_date_hrs"=>"12",
    "end_date_mins"=>"00",
    "timezone"=>"Australia/Sydney",
    "location"=>"Ahmedabad",
    "ticketed_event"=>"true"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// fail [giving 200 , should be 400 and error msg]
//- ve
$I->am('Case 107 : event create step 2 in club without timezone after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('event create step 2 in club without timezone after login');
$I->sendPOST('club/event_edit/'.$club_id,['event_type'=>'social_event','title'=>'Club Event 05012016',"description"=>"test event description test event description test event description test event description test event description ",
    "start_date"=>"26/01/2016",
    "start_date_hrs"=>"01",
    "start_date_mins"=>"00",
    "start_date_period"=>"AM",
    "end_date"=>"05/11/2016",
    "end_date_hrs"=>"12",
    "end_date_mins"=>"00",
    "end_date_period"=>"PM",
    "location"=>"Ahmedabad",
    "ticketed_event"=>"true"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// fail [giving 200 , should be 400 and error msg]
//- ve
$I->am('Case 108 : event create step 2 in club without location after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('event create step 2 in club without location after login');
$I->sendPOST('club/event_edit/'.$club_id,['event_type'=>'social_event','title'=>'Club Event 05012016',"description"=>"test event description test event description test event description test event description test event description ",
    "start_date"=>"26/01/2016",
    "start_date_hrs"=>"01",
    "start_date_mins"=>"00",
    "start_date_period"=>"AM",
    "end_date"=>"05/11/2016",
    "end_date_hrs"=>"12",
    "end_date_mins"=>"00",
    "end_date_period"=>"PM",
    "timezone"=>"Australia/Sydney",
    "ticketed_event"=>"true"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');




// fail [giving 200 , should be 400 and error msg]
//- ve
$I->am('Case 109 : event create step 2 in club without ticketed_event after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('event create step 2 in club without ticketed_event after login');
$I->sendPOST('club/event_edit/'.$club_id,['event_type'=>'social_event','title'=>'Club Event 05012016',"description"=>"test event description test event description test event description test event description test event description ",
    "start_date"=>"26/01/2016",
    "start_date_hrs"=>"01",
    "start_date_mins"=>"00",
    "start_date_period"=>"AM",
    "end_date"=>"05/11/2016",
    "end_date_hrs"=>"12",
    "end_date_mins"=>"00",
    "end_date_period"=>"PM",
    "timezone"=>"Australia/Sydney",
    "location"=>"Ahmedabad",
    ]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// fail [giving 200 , should be 400 and error msg]
//- ve
$I->am('Case 110 : event create step 2 in club with past start_date after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('event create step 2 in club with past start_date after login');
$I->sendPOST('club/event_edit/'.$club_id,['event_type'=>'social_event','title'=>'Club Event 05012016',"description"=>"test event description test event description test event description test event description test event description ",
    "start_date"=>"26/01/2014",
    "start_date_hrs"=>"01",
    "start_date_mins"=>"00",
    "start_date_period"=>"AM",
    "end_date"=>"05/11/2016",
    "end_date_hrs"=>"12",
    "end_date_mins"=>"00",
    "end_date_period"=>"PM",
    "timezone"=>"Australia/Sydney",
    "location"=>"Ahmedabad",
    "ticketed_event"=>"true"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');





// fail [giving 200 , should be 400 and error msg]
//- ve
$I->am('Case 111 : event create step 2 in club with past end_date after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('event create step 2 in club with past end_date after login');
$I->sendPOST('club/event_edit/'.$club_id,['event_type'=>'social_event','title'=>'Club Event 05012016',"description"=>"test event description test event description test event description test event description test event description ",
    "start_date"=>"26/01/2016",
    "start_date_hrs"=>"01",
    "start_date_mins"=>"00",
    "start_date_period"=>"AM",
    "end_date"=>"05/11/2014",
    "end_date_hrs"=>"12",
    "end_date_mins"=>"00",
    "end_date_period"=>"PM",
    "timezone"=>"Australia/Sydney",
    "location"=>"Ahmedabad",
    "ticketed_event"=>"true"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');







// fail [it should give 400 and proper error msg]
//- ve
$I->am('Case 86 : admin_import_followers step 2 upload in club without file after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin_import_followers step 2 upload in club with club id not exist after login');
$I->sendPOST('club/admin_import_followers/'.$club_id,['submit'=>'Import Club Followers']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// fail [it should give 400 and proper error msg]
//- ve
$I->am('Case 87 : admin_import_followers step 2 upload in club without submit after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('admin_import_followers step 2 upload in club with club id not exist after login');
$I->sendPOST('club/admin_import_followers/'.$club_id,[],['userfile'=>[
            'name' => 'monash_sucroo_users_club_5 followers.csv',
            'type' => 'file/csv',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('monash_sucroo_users_club_5 followers.csv')),
            'tmp_name' => codecept_data_dir('monash_sucroo_users_club_5 followers.csv'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// fail [200 come with data, it should be 400 and error]
// -ve
$I->am('Case 61 : update bank detail of club without bank_name after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('update bank detail of club without bank_name after login');
$I->sendPOST('club/admin_bank_details/'.$club_id,['account_name'=>'Kaushal Parekh','account_bsb'=>'1234','account_number'=>'123123123']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// fail [200 come with data, it should be 400 and error]
// -ve
$I->am('Case 62 : update bank detail of club without account_name after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('update bank detail of club without account_name after login');
$I->sendPOST('club/admin_bank_details/'.$club_id,['bank_name'=>'HDFC Bank','account_bsb'=>'1234','account_number'=>'123123123']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// fail [200 come with data, it should be 400 and error]
// -ve
$I->am('Case 63 : update bank detail of club without account_bsb after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('update bank detail of club without account_bsb after login');
$I->sendPOST('club/admin_bank_details/'.$club_id,['bank_name'=>'HDFC Bank','account_name'=>'Kaushal Parekh','account_number'=>'123123123']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// fail [200 come with data, it should be 400 and error]
// -ve
$I->am('Case 64 : update bank detail of club without account_number after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('update bank detail of club without account_number after login');
$I->sendPOST('club/admin_bank_details/'.$club_id,['bank_name'=>'HDFC Bank','account_name'=>'Kaushal Parekh','account_bsb'=>'1234']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

// fail [200 come with data, it should be 400 and error]
// -ve
$I->am('Case 65 : update bank detail of club with account_bsb as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('update bank detail of club with account_bsb as string after login');
$I->sendPOST('club/admin_bank_details/'.$club_id,['bank_name'=>'HDFC Bank','account_name'=>'Kaushal Parekh','account_bsb'=>'ggggg','account_number'=>'123123123']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

// fail [200 come with data, it should be 400 and error]
// -ve
$I->am('Case 66 : update bank detail of club with account_bsb less than 6 int after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('update bank detail of club with account_bsb less than 6 int after login');
$I->sendPOST('club/admin_bank_details/'.$club_id,['bank_name'=>'HDFC Bank','account_name'=>'Kaushal Parekh','account_bsb'=>'123','account_number'=>'123123123']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
// fail [internal server error 500 come]
$I->am('Case 42 : users_filter of club without clubid after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('users_filter of club after login');
$I->sendGET('club/users_filter/?sSearch=chas&iDisplayLength=&iDisplayStart=&sEcho=',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');




// -ve
// fail [internal server error 500 come]
$I->am('Case 43 : users_filter of club with clubid as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('users_filter of club with clubid as string after login');
$I->sendGET('club/users_filter/aaaaa?sSearch=chas&iDisplayLength=&iDisplayStart=&sEcho=',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
// fail [it should give 400 and in response array it should be blank]
$I->am('Case 23 : edit club with already existing name after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit club with already existing name after login');
$I->sendPOST('club/edit/'.$club_id,['name'=>$club_name,'short_name'=>$club_short_name,'description'=>'this is good data aaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email'=>'development@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'1','owner_position'=>'Director','member_fee'=>'1.00','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'aaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaa','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
// fail [it should give 400 and in response array it should be blank]
$I->am('Case 24 : edit club without name after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit club without name after login');
$I->sendPOST('club/edit/'.$club_id,['short_name'=>$club_short_name.'rew','description'=>'this is good data aaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email'=>'development@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'1','owner_position'=>'Director','member_fee'=>'1.00','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'aaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaa','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
// fail [it should give 400 and in response array it should be blank]
$I->am('Case 25 : edit club without abbriviation name after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit club without abbriviation name after login');
$I->sendPOST('club/edit/'.$club_id,['name'=>$club_name.'rew','description'=>'this is good data aaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email'=>'development@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'1','owner_position'=>'Director','member_fee'=>'1.00','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'aaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaa','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');





// -ve
// fail [it should give 400 and in response array it should be blank]
$I->am('Case 26 : edit club with description less than 50 char name after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit club with description less than 50 char name after login');
$I->sendPOST('club/edit/'.$club_id,['name'=>$club_name.'rew','short_name'=>$club_short_name,'description'=>'this','website'=>'http://www.ucroo.com.au','email'=>'development@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'1','owner_position'=>'Director','member_fee'=>'1.00','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'aaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaa','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
// fail [it should give 400 and in response array it should be blank]
$I->am('Case 27 : edit club without email after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit club without email after login');
$I->sendPOST('club/edit/'.$club_id,['name'=>$club_name.'rew','short_name'=>$club_short_name,'description'=>'this aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'1','owner_position'=>'Director','member_fee'=>'1.00','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'aaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaa','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');








// -ve
// fail [it should give 400 and in response array it should be blank]
$I->am('Case 28 : edit club with email and  confirm email different after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit club with email and  confirm email different after login');
$I->sendPOST('club/edit/'.$club_id,['name'=>$club_name.'rew','short_name'=>$club_short_name,'description'=>'this aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email'=>'development1@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'1','owner_position'=>'Director','member_fee'=>'1.00','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'aaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaa','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');




// -ve
// fail [it should give 400 and in response array it should be blank]
$I->am('Case 29 : edit club without  faculty_id  after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit club without  faculty_id  after login');
$I->sendPOST('club/edit/'.$club_id,['name'=>$club_name,'short_name'=>$club_short_name,'description'=>'this is good data aaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email'=>'development@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'','owner_position'=>'Director','member_fee'=>'1.00','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'aaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaa','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
// fail [it should give 400 and in response array it should be blank]
$I->am('Case 30 : edit club with faculty_id as string  after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit club with faculty_id as string  after login');
$I->sendPOST('club/edit/'.$club_id,['name'=>$club_name,'short_name'=>$club_short_name,'description'=>'this is good data aaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email'=>'development@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'aaaa1','owner_position'=>'Director','member_fee'=>'1.00','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'aaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaa','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
// fail [it should give 400 and in response array it should be blank]
$I->am('Case 32 : edit club without owner_position  after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit club with faculty_id as string  after login');
$I->sendPOST('club/edit/'.$club_id,['name'=>$club_name,'short_name'=>$club_short_name,'description'=>'this is good data aaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email'=>'development@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'1','owner_position'=>'','member_fee'=>'1.00','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'aaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaa','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
// fail [it should give 400 and in response array it should be blank]
$I->am('Case 33 : edit club without member_fee  after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit club without member_fee  after login');
$I->sendPOST('club/edit/'.$club_id,['name'=>$club_name,'short_name'=>$club_short_name,'description'=>'this is good data aaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email'=>'development@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'1','owner_position'=>'director','member_fee'=>'','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'aaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaa','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
// fail [it should give 400 and in response array it should be blank]
$I->am('Case 34 : edit club without image after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit club without image after login');
$I->sendPOST('club/edit/'.$club_id,['name'=>$club_name,'short_name'=>$club_short_name,'description'=>'this is good data aaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email'=>'development@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'1','owner_position'=>'director','member_fee'=>'1.2','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'aaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaa','benefits'=>['0'=>'benifit 1']]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
// fail [it should give 400 and in response array it should be blank]
$I->am('Case 35 : edit club without member_message after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit club without member_message after login');
$I->sendPOST('club/edit/'.$club_id,['name'=>$club_name,'short_name'=>$club_short_name,'description'=>'this is good data aaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email'=>'development@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'1','owner_position'=>'director','member_fee'=>'1.1','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
// fail [it should give 400 and in response array it should be blank]
$I->am('Case 36 : edit club with member_message less than after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit club without member_message after login');
$I->sendPOST('club/edit/'.$club_id,['name'=>$club_name,'short_name'=>$club_short_name,'description'=>'this is good data aaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email'=>'development@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'1','owner_position'=>'director','member_fee'=>'1.1','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
// fail [it should give 400 and in response array it should be blank]
$I->am('Case 12 : add club with already existing name after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('add club with already existing name after login');
$I->sendPOST('club/edit/new',['name'=>$club_name,'short_name'=>$club_short_name,'description'=>'this is good data aaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email'=>'development@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'1','owner_position'=>'Director','member_fee'=>'1.00','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'aaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaa','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
// fail [it should give 400 and in response array it should be blank]
$I->am('Case 13 : add club without name after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('add club without name after login');
$I->sendPOST('club/edit/new',['short_name'=>$club_short_name.'rew','description'=>'this is good data aaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email'=>'development@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'1','owner_position'=>'Director','member_fee'=>'1.00','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'aaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaa','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
// fail [it should give 400 and in response array it should be blank]
$I->am('Case 42 : add club without abbriviation name after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('add club without abbriviation name after login');
$I->sendPOST('club/edit/new',['name'=>$club_name.'rew','description'=>'this is good data aaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email'=>'development@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'1','owner_position'=>'Director','member_fee'=>'1.00','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'aaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaa','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');





// -ve
// fail [it should give 400 and in response array it should be blank]
$I->am('Case 43 : add club with description less than 50 char name after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('add club with description less than 50 char name after login');
$I->sendPOST('club/edit/new',['name'=>$club_name.'rew','short_name'=>$club_short_name,'description'=>'this','website'=>'http://www.ucroo.com.au','email'=>'development@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'1','owner_position'=>'Director','member_fee'=>'1.00','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'aaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaa','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
// fail [it should give 400 and in response array it should be blank]
$I->am('Case 14 : add club without email after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('add club without email after login');
$I->sendPOST('club/edit/new',['name'=>$club_name.'rew','short_name'=>$club_short_name,'description'=>'this aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'1','owner_position'=>'Director','member_fee'=>'1.00','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'aaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaa','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');








// -ve
// fail [it should give 400 and in response array it should be blank]
$I->am('Case 15 : add club with email and  confirm email different after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('add club with email and  confirm email different after login');
$I->sendPOST('club/edit/new',['name'=>$club_name.'rew','short_name'=>$club_short_name,'description'=>'this aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email'=>'development1@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'1','owner_position'=>'Director','member_fee'=>'1.00','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'aaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaa','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');




// -ve
// fail [it should give 400 and in response array it should be blank]
$I->am('Case 16 : add club without  faculty_id  after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('add club without  faculty_id  after login');
$I->sendPOST('club/edit/new',['name'=>$club_name,'short_name'=>$club_short_name,'description'=>'this is good data aaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email'=>'development@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'','owner_position'=>'Director','member_fee'=>'1.00','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'aaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaa','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
// fail [it should give 400 and in response array it should be blank]
$I->am('Case 17 : add club with faculty_id as string  after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('add club with faculty_id as string  after login');
$I->sendPOST('club/edit/new',['name'=>$club_name,'short_name'=>$club_short_name,'description'=>'this is good data aaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email'=>'development@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'aaaa1','owner_position'=>'Director','member_fee'=>'1.00','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'aaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaa','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');






// -ve
// fail [it should give 400 and in response array it should be blank]
$I->am('Case 18 : add club without owner_position  after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('add club with faculty_id as string  after login');
$I->sendPOST('club/edit/new',['name'=>$club_name,'short_name'=>$club_short_name,'description'=>'this is good data aaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email'=>'development@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'1','owner_position'=>'','member_fee'=>'1.00','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'aaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaa','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
// fail [it should give 400 and in response array it should be blank]
$I->am('Case 19 : add club without member_fee  after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('add club without member_fee  after login');
$I->sendPOST('club/edit/new',['name'=>$club_name,'short_name'=>$club_short_name,'description'=>'this is good data aaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email'=>'development@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'1','owner_position'=>'director','member_fee'=>'','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'aaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaa','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
// fail [it should give 400 and in response array it should be blank]
$I->am('Case 20 : add club without image after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('add club without image after login');
$I->sendPOST('club/edit/new',['name'=>$club_name,'short_name'=>$club_short_name,'description'=>'this is good data aaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email'=>'development@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'1','owner_position'=>'director','member_fee'=>'1.2','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'aaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaaaaa aaaaaaaaaaaa','benefits'=>['0'=>'benifit 1']]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
// fail [it should give 400 and in response array it should be blank]
$I->am('Case 21 : add club without member_message after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('add club without member_message after login');
$I->sendPOST('club/edit/new',['name'=>$club_name,'short_name'=>$club_short_name,'description'=>'this is good data aaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email'=>'development@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'1','owner_position'=>'director','member_fee'=>'1.1','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
// fail [it should give 400 and in response array it should be blank]
$I->am('Case 22 : add club with member_message less than after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email_staff, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('add club without member_message after login');
$I->sendPOST('club/edit/new',['name'=>$club_name,'short_name'=>$club_short_name,'description'=>'this is good data aaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','website'=>'http://www.ucroo.com.au','email'=>'development@ucroo.com','email_confirm'=>'development@ucroo.com','phone'=>'123123123','faculty_id'=>'1','owner_position'=>'director','member_fee'=>'1.1','student_discount'=>'0.05','can_student_join'=>'true','collect_gst'=>'false','digital_card'=>'false','member_message'=>'','benefits'=>['0'=>'benifit 1']],['clubpicture'=>[
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');






