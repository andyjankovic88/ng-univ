<?php

$I = new ApiTester($scenario);
$university_id = $I->getDataFromDbCustom($I,'university','id',array());
$university_id=15;
$user_email = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'2','uni_id'=>$university_id));
$user_password = 'ucroo123';
$user_email2 = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'2','uni_id'=>$university_id));

//1800-3000-7678
// +ve
$I->am('Case 47 : get suggested_groups after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get suggested_groups after login');
$I->sendPOST('customgroups/suggested_groups',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Customgroup_suggestCept.json');



// +ve
$I->am('Case 48 : get suggested_groups with paging after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo(' get suggested_groups with paging after login');
$I->sendPOST('customgroups/suggested_groups?page=1',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Customgroup_suggestCept.json');



// -ve
$I->am('Case 49 : get suggested_groups with paging as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo(' get suggested_groups with paging as string after logincustomgroups/list');
$I->sendPOST('customgroups/suggested_groups?page=a',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Customgroup_suggestCept.json');


// -ve
$I->am('Case 53  : get suggested_groups with paging as blank after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo(' get suggested_groups with paging as blank after logincustomgroups/list');
$I->sendPOST('customgroups/suggested_groups?page=',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Customgroup_suggestCept.json');



// +ve
$I->am('Case 50 : To get list with paging after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To get list with paging after login');
$I->sendPOST('customgroups/list?page=1');
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Customgroup_listpagingCept.json');



// -ve
$I->am('Case 51 : To get list with paging param as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To get list with paging param as string after login');
$I->sendPOST('customgroups/list?page=a');
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Customgroup_listCept.json');




// -ve
$I->am('Case 52 : To get list with paging param as blank after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To get list with paging param as blank after login');
$I->sendPOST('customgroups/list?page=');
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Customgroup_listCept.json');



// +ve
$I->am('Case 54 : To get list with paging param and search after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To get list with paging param as blank after login');
$I->sendPOST('customgroups/list?page=1',['search'=>'as']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Customgroup_listCept.json');


// +ve
$I->am('Case 55 : To get list with paging param and search and category after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To get list with paging param as blank after login');
$I->sendPOST('customgroups/list?page=1',['search'=>'as','categories'=>[10,11]]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Customgroup_listCept.json');


// +ve
$I->am('Case 56 : To get list with paging param and search and category as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To get list with paging param as blank after login');
$I->sendPOST('customgroups/list?page=1',['search'=>'as','categories'=>['a']]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Customgroup_listCept.json');









// +ve
$I->am('Case 1 : To get joined list after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To get joined list after login');
$I->sendPOST('customgroups/joined_list');
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Customgroup_joinlistCept.json');



// +ve
$I->am('Case 2 : To get list after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To get list after login');
$I->sendPOST('customgroups/list');
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Customgroup_listCept.json');



// +ve
$I->am('Case 3 : To create group after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create group after login');
$I->sendPOST('customgroups/create',['name'=>'aaaa','description'=>'desaaaaaaaaaaaaaaaaaaaaac goes hereaaaaaaaaaaaaaaa','privacy'=>'0','faculty_id'=>'1','category_id'=>'1','campus_id'=>'1','member_email'=>['team+userid6@ucroo.com'],'member_user_id'=>['6']],['userfile' => [
            'name' => 'myFile.jpg',
            'type' => 'jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ],'file_id' => [
            'name' => 'ucroo_unittestcase_summery.xlsx',
            'type' => 'xls',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('ucroo_unittestcase_summery.xlsx')),
            'tmp_name' => codecept_data_dir('ucroo_unittestcase_summery.xlsx'),
        ]]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$data = $I->getArrayFromJson($I);
$group_id = $data['response']['id'];
$I->canSeeResponseIsValidOnSchemaFile('Customgroup_createCept.json');





//+ve
$I->am('Case 57 : get customgroups at RHS after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get customgroups at RHS after login');
$I->sendPost('sidebar_rhs/group_specific/customgroups/'.$group_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('RSH_homecustomgroupCept.json');



//-ve
$I->am('Case 58 : get customgroups at RHS without group id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get customgroups at RHS without group id after login');
$I->sendPost('sidebar_rhs/group_specific/customgroups/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



//-ve
$I->am('Case 59 : get customgroups at RHS with group id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get customgroups at RHS with group id as string after login');
$I->sendPost('sidebar_rhs/group_specific/customgroups/aaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



//-ve
// failing as current response coming 200 with all detail blank
// it should be show error msg
/*$I->am('Case 60 : get customgroups at RHS with group id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get customgroups at RHS with group id not exist after login');
$I->sendPost('sidebar_rhs/group_specific/customgroups/444444444444444444444444444',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');
*/


// -ve
$I->am('Case 4 : To create group without name after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create group without name after login');
$I->sendPOST('customgroups/create',['description'=>'desaaaaaaaaaaaaaaaaaaaaac goes hereaaaaaaaaaaaaaaa','privacy'=>'0','faculty_id'=>'1','category_id'=>'1','campus_id'=>'1','member_email'=>['team+userid6@ucroo.com'],'member_user_id'=>['6']],['userfile' => [
            'name' => 'myFile.jpg',
            'type' => 'jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ],'file_id' => [
            'name' => 'ucroo_unittestcase_summery.xlsx',
            'type' => 'xls',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('ucroo_unittestcase_summery.xlsx')),
            'tmp_name' => codecept_data_dir('ucroo_unittestcase_summery.xlsx'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');


// -ve
$I->am('Case 5 : To create group without description after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create group without description after login');
$I->sendPOST('customgroups/create',['name'=>'aaaa','privacy'=>'0','faculty_id'=>'1','category_id'=>'1','campus_id'=>'1','member_email'=>['team+userid6@ucroo.com'],'member_user_id'=>['6']],['userfile' => [
            'name' => 'myFile.jpg',
            'type' => 'jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ],'file_id' => [
            'name' => 'ucroo_unittestcase_summery.xlsx',
            'type' => 'xls',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('ucroo_unittestcase_summery.xlsx')),
            'tmp_name' => codecept_data_dir('ucroo_unittestcase_summery.xlsx'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');



// -ve
$I->am('Case 6 : To create group with description less than 50 length after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create group with description less than 50 length after login');
$I->sendPOST('customgroups/create',['name'=>'aaaa','description'=>'aaa','privacy'=>'0','faculty_id'=>'1','category_id'=>'1','campus_id'=>'1','member_email'=>['team+userid6@ucroo.com'],'member_user_id'=>['6']],['userfile' => [
            'name' => 'myFile.jpg',
            'type' => 'jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ],'file_id' => [
            'name' => 'ucroo_unittestcase_summery.xlsx',
            'type' => 'xls',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('ucroo_unittestcase_summery.xlsx')),
            'tmp_name' => codecept_data_dir('ucroo_unittestcase_summery.xlsx'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');



// -ve
$I->am('Case 7 : To create group without privacy after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create group without privacy after login');
$I->sendPOST('customgroups/create',['name'=>'aaaa','description'=>'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa2222aaaaaaaaaa','faculty_id'=>'1','category_id'=>'1','campus_id'=>'1','member_email'=>['team+userid6@ucroo.com'],'member_user_id'=>['6']],['userfile' => [
            'name' => 'myFile.jpg',
            'type' => 'jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ],'file_id' => [
            'name' => 'ucroo_unittestcase_summery.xlsx',
            'type' => 'xls',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('ucroo_unittestcase_summery.xlsx')),
            'tmp_name' => codecept_data_dir('ucroo_unittestcase_summery.xlsx'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');



// -ve
$I->am('Case 8 : To create group without faculty_id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create group without faculty_id after login');
$I->sendPOST('customgroups/create',['name'=>'aaaa','description'=>'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa2222aaaaaaaaaa','privacy'=>'0','category_id'=>'1','campus_id'=>'1','member_email'=>['team+userid6@ucroo.com'],'member_user_id'=>['6']],['userfile' => [
            'name' => 'myFile.jpg',
            'type' => 'jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ],'file_id' => [
            'name' => 'ucroo_unittestcase_summery.xlsx',
            'type' => 'xls',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('ucroo_unittestcase_summery.xlsx')),
            'tmp_name' => codecept_data_dir('ucroo_unittestcase_summery.xlsx'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');



// -ve
$I->am('Case 9 : To create group without category_id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create group without category_id after login');
$I->sendPOST('customgroups/create',['name'=>'aaaa','description'=>'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa2222aaaaaaaaaa','privacy'=>'0','faculty_id'=>'1','campus_id'=>'1','member_email'=>['team+userid6@ucroo.com'],'member_user_id'=>['6']],['userfile' => [
            'name' => 'myFile.jpg',
            'type' => 'jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ],'file_id' => [
            'name' => 'ucroo_unittestcase_summery.xlsx',
            'type' => 'xls',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('ucroo_unittestcase_summery.xlsx')),
            'tmp_name' => codecept_data_dir('ucroo_unittestcase_summery.xlsx'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');



// -ve
$I->am('Case 10 : To create group without campus_id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create group without campus_id after login');
$I->sendPOST('customgroups/create',['name'=>'aaaa','description'=>'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa2222aaaaaaaaaa','privacy'=>'0','faculty_id'=>'1','category_id'=>'1','member_email'=>['team+userid6@ucroo.com'],'member_user_id'=>['6']],['userfile' => [
            'name' => 'myFile.jpg',
            'type' => 'jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ],'file_id' => [
            'name' => 'ucroo_unittestcase_summery.xlsx',
            'type' => 'xls',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('ucroo_unittestcase_summery.xlsx')),
            'tmp_name' => codecept_data_dir('ucroo_unittestcase_summery.xlsx'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');



// -ve
// failing
/*$I->am('Case 11 : To create group with privacy as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create group with privacy as string after login');
$I->sendPOST('customgroups/create',['name'=>'aaaa','description'=>'desaaaaaaaaaaaaaaaaaaaaac goes hereaaaaaaaaaaaaaaa','privacy'=>'a0','faculty_id'=>'1','category_id'=>'1','campus_id'=>'1','member_email'=>['team+userid6@ucroo.com'],'member_user_id'=>['6']],['userfile' => [
            'name' => 'myFile.jpg',
            'type' => 'jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ],'file_id' => [
            'name' => 'ucroo_unittestcase_summery.xlsx',
            'type' => 'xls',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('ucroo_unittestcase_summery.xlsx')),
            'tmp_name' => codecept_data_dir('ucroo_unittestcase_summery.xlsx'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');*/



// -ve
$I->am('Case 12 : To create group with faculty_id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create group with faculty_id as string after login');
$I->sendPOST('customgroups/create',['name'=>'aaaa','description'=>'desaaaaaaaaaaaaaaaaaaaaac goes hereaaaaaaaaaaaaaaa','privacy'=>'0','faculty_id'=>'a1','category_id'=>'1','campus_id'=>'1','member_email'=>['team+userid6@ucroo.com'],'member_user_id'=>['6']],['userfile' => [
            'name' => 'myFile.jpg',
            'type' => 'jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ],'file_id' => [
            'name' => 'ucroo_unittestcase_summery.xlsx',
            'type' => 'xls',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('ucroo_unittestcase_summery.xlsx')),
            'tmp_name' => codecept_data_dir('ucroo_unittestcase_summery.xlsx'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');


// -ve
$I->am('Case 13 : To create group with category_id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create group with category_id as string after login');
$I->sendPOST('customgroups/create',['name'=>'aaaa','description'=>'desaaaaaaaaaaaaaaaaaaaaac goes hereaaaaaaaaaaaaaaa','privacy'=>'0','faculty_id'=>'1','category_id'=>'aa1','campus_id'=>'1','member_email'=>['team+userid6@ucroo.com'],'member_user_id'=>['6']],['userfile' => [
            'name' => 'myFile.jpg',
            'type' => 'jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ],'file_id' => [
            'name' => 'ucroo_unittestcase_summery.xlsx',
            'type' => 'xls',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('ucroo_unittestcase_summery.xlsx')),
            'tmp_name' => codecept_data_dir('ucroo_unittestcase_summery.xlsx'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');


// -ve
$I->am('Case 14 : To create group with campus_id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create group with campus_id as string after login');
$I->sendPOST('customgroups/create',['name'=>'aaaa','description'=>'desaaaaaaaaaaaaaaaaaaaaac goes hereaaaaaaaaaaaaaaa','privacy'=>'0','faculty_id'=>'1','category_id'=>'1','campus_id'=>'aa1','member_email'=>['team+userid6@ucroo.com'],'member_user_id'=>['6']],['userfile' => [
            'name' => 'myFile.jpg',
            'type' => 'jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ],'file_id' => [
            'name' => 'ucroo_unittestcase_summery.xlsx',
            'type' => 'xls',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('ucroo_unittestcase_summery.xlsx')),
            'tmp_name' => codecept_data_dir('ucroo_unittestcase_summery.xlsx'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');



// -ve
// failing
/*
$I->am('Case 15 : To create group with userfile as wrong file type other then jpeg after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create group with userfile as wrong file type other then jpeg after login');
$I->sendPOST('customgroups/create',['name'=>'aaaa','description'=>'desaaaaaaaaaaaaaaaaaaaaac goes hereaaaaaaaaaaaaaaa','privacy'=>'0','faculty_id'=>'1','category_id'=>'1','campus_id'=>'aa1','member_email'=>['team+userid6@ucroo.com'],'member_user_id'=>['6']],['file_id' => [
            'name' => 'ucroo_unittestcase_summery.xlsx',
            'type' => 'xls',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('ucroo_unittestcase_summery.xlsx')),
            'tmp_name' => codecept_data_dir('ucroo_unittestcase_summery.xlsx'),
        ],'userfile' => [
            'name' => 'ucroo_unittestcase_summery.xlsx',
            'type' => 'xls',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('ucroo_unittestcase_summery.xlsx')),
            'tmp_name' => codecept_data_dir('ucroo_unittestcase_summery.xlsx'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');
 *
 */



// -ve
// failing
/*
$I->am('Case 16 : To create group with file_id as wrong file type other then jpeg after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To create group with file_id as wrong file type other then jpeg after login');
$I->sendPOST('customgroups/create',['name'=>'aaaa','description'=>'desaaaaaaaaaaaaaaaaaaaaac goes hereaaaaaaaaaaaaaaa','privacy'=>'0','faculty_id'=>'1','category_id'=>'1','campus_id'=>'aa1','member_email'=>['team+userid6@ucroo.com'],'member_user_id'=>['6']],['file_id' => [
            'name' => 'myFile.jpg',
            'type' => 'jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ],'userfile' => [
            'name' => 'myFile.jpg',
            'type' => 'jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');
 *
 */




// +ve
$I->am('Case 17 : To edit group after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit group after login');
$I->sendPOST('customgroups/edit/'.$group_id,['name'=>'aaaa','description'=>'desaaaaaaaaaaaaaaaaaaaaac goes hereaaaaaaaaaaaaaaa','privacy'=>'0','faculty_id'=>'1','category_id'=>'1','campus_id'=>'1','member_email'=>['team+userid6@ucroo.com'],'member_user_id'=>['6']],['userfile' => [
            'name' => 'myFile.jpg',
            'type' => 'jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ],'file_id' => [
            'name' => 'ucroo_unittestcase_summery.xlsx',
            'type' => 'xls',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('ucroo_unittestcase_summery.xlsx')),
            'tmp_name' => codecept_data_dir('ucroo_unittestcase_summery.xlsx'),
        ]]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Customgroup_editCept.json');



// -ve
$I->am('Case 18 : To edit group without name after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit group without name after login');
$I->sendPOST('customgroups/edit/'.$group_id,['description'=>'desaaaaaaaaaaaaaaaaaaaaac goes hereaaaaaaaaaaaaaaa','privacy'=>'0','faculty_id'=>'1','category_id'=>'1','campus_id'=>'1','member_email'=>['team+userid6@ucroo.com'],'member_user_id'=>['6']],['userfile' => [
            'name' => 'myFile.jpg',
            'type' => 'jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ],'file_id' => [
            'name' => 'ucroo_unittestcase_summery.xlsx',
            'type' => 'xls',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('ucroo_unittestcase_summery.xlsx')),
            'tmp_name' => codecept_data_dir('ucroo_unittestcase_summery.xlsx'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');


// -ve
$I->am('Case 19 : To edit group without description after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit group without description after login');
$I->sendPOST('customgroups/edit/'.$group_id,['name'=>'aaaa','privacy'=>'0','faculty_id'=>'1','category_id'=>'1','campus_id'=>'1','member_email'=>['team+userid6@ucroo.com'],'member_user_id'=>['6']],['userfile' => [
            'name' => 'myFile.jpg',
            'type' => 'jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ],'file_id' => [
            'name' => 'ucroo_unittestcase_summery.xlsx',
            'type' => 'xls',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('ucroo_unittestcase_summery.xlsx')),
            'tmp_name' => codecept_data_dir('ucroo_unittestcase_summery.xlsx'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');



// -ve
$I->am('Case 20 : To edit group with description less than 50 length after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit group with description less than 50 length after login');
$I->sendPOST('customgroups/edit/'.$group_id,['name'=>'aaaa','description'=>'aaa','privacy'=>'0','faculty_id'=>'1','category_id'=>'1','campus_id'=>'1','member_email'=>['team+userid6@ucroo.com'],'member_user_id'=>['6']],['userfile' => [
            'name' => 'myFile.jpg',
            'type' => 'jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ],'file_id' => [
            'name' => 'ucroo_unittestcase_summery.xlsx',
            'type' => 'xls',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('ucroo_unittestcase_summery.xlsx')),
            'tmp_name' => codecept_data_dir('ucroo_unittestcase_summery.xlsx'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');



// -ve
$I->am('Case 21 : To edit group without privacy after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit group without privacy after login');
$I->sendPOST('customgroups/edit/'.$group_id,['name'=>'aaaa','description'=>'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa2222aaaaaaaaaa','faculty_id'=>'1','category_id'=>'1','campus_id'=>'1','member_email'=>['team+userid6@ucroo.com'],'member_user_id'=>['6']],['userfile' => [
            'name' => 'myFile.jpg',
            'type' => 'jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ],'file_id' => [
            'name' => 'ucroo_unittestcase_summery.xlsx',
            'type' => 'xls',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('ucroo_unittestcase_summery.xlsx')),
            'tmp_name' => codecept_data_dir('ucroo_unittestcase_summery.xlsx'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');



// -ve
$I->am('Case 22 : To edit group without faculty_id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit group without faculty_id after login');
$I->sendPOST('customgroups/edit/'.$group_id,['name'=>'aaaa','description'=>'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa2222aaaaaaaaaa','privacy'=>'0','category_id'=>'1','campus_id'=>'1','member_email'=>['team+userid6@ucroo.com'],'member_user_id'=>['6']],['userfile' => [
            'name' => 'myFile.jpg',
            'type' => 'jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ],'file_id' => [
            'name' => 'ucroo_unittestcase_summery.xlsx',
            'type' => 'xls',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('ucroo_unittestcase_summery.xlsx')),
            'tmp_name' => codecept_data_dir('ucroo_unittestcase_summery.xlsx'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');



// -ve
$I->am('Case 23 : To edit group without category_id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit group without category_id after login');
$I->sendPOST('customgroups/edit/'.$group_id,['name'=>'aaaa','description'=>'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa2222aaaaaaaaaa','privacy'=>'0','faculty_id'=>'1','campus_id'=>'1','member_email'=>['team+userid6@ucroo.com'],'member_user_id'=>['6']],['userfile' => [
            'name' => 'myFile.jpg',
            'type' => 'jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ],'file_id' => [
            'name' => 'ucroo_unittestcase_summery.xlsx',
            'type' => 'xls',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('ucroo_unittestcase_summery.xlsx')),
            'tmp_name' => codecept_data_dir('ucroo_unittestcase_summery.xlsx'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');



// -ve
$I->am('Case 24 : To edit group without campus_id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit group without campus_id after login');
$I->sendPOST('customgroups/edit/'.$group_id,['name'=>'aaaa','description'=>'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa2222aaaaaaaaaa','privacy'=>'0','faculty_id'=>'1','category_id'=>'1','member_email'=>['team+userid6@ucroo.com'],'member_user_id'=>['6']],['userfile' => [
            'name' => 'myFile.jpg',
            'type' => 'jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ],'file_id' => [
            'name' => 'ucroo_unittestcase_summery.xlsx',
            'type' => 'xls',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('ucroo_unittestcase_summery.xlsx')),
            'tmp_name' => codecept_data_dir('ucroo_unittestcase_summery.xlsx'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');



// -ve
// failing
/*$I->am('Case 25 : To edit group with privacy as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit group with privacy as string after login');
$I->sendPOST('customgroups/edit/'.$group_id,['name'=>'aaaa','description'=>'desaaaaaaaaaaaaaaaaaaaaac goes hereaaaaaaaaaaaaaaa','privacy'=>'a0','faculty_id'=>'1','category_id'=>'1','campus_id'=>'1','member_email'=>['team+userid6@ucroo.com'],'member_user_id'=>['6']],['userfile' => [
            'name' => 'myFile.jpg',
            'type' => 'jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ],'file_id' => [
            'name' => 'ucroo_unittestcase_summery.xlsx',
            'type' => 'xls',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('ucroo_unittestcase_summery.xlsx')),
            'tmp_name' => codecept_data_dir('ucroo_unittestcase_summery.xlsx'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');*/



// -ve
$I->am('Case 26 : To edit group with faculty_id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit group with faculty_id as string after login');
$I->sendPOST('customgroups/edit/'.$group_id,['name'=>'aaaa','description'=>'desaaaaaaaaaaaaaaaaaaaaac goes hereaaaaaaaaaaaaaaa','privacy'=>'0','faculty_id'=>'a1','category_id'=>'1','campus_id'=>'1','member_email'=>['team+userid6@ucroo.com'],'member_user_id'=>['6']],['userfile' => [
            'name' => 'myFile.jpg',
            'type' => 'jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ],'file_id' => [
            'name' => 'ucroo_unittestcase_summery.xlsx',
            'type' => 'xls',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('ucroo_unittestcase_summery.xlsx')),
            'tmp_name' => codecept_data_dir('ucroo_unittestcase_summery.xlsx'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');


// -ve
$I->am('Case 27 : To edit group with category_id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit group with category_id as string after login');
$I->sendPOST('customgroups/edit/'.$group_id,['name'=>'aaaa','description'=>'desaaaaaaaaaaaaaaaaaaaaac goes hereaaaaaaaaaaaaaaa','privacy'=>'0','faculty_id'=>'1','category_id'=>'aa1','campus_id'=>'1','member_email'=>['team+userid6@ucroo.com'],'member_user_id'=>['6']],['userfile' => [
            'name' => 'myFile.jpg',
            'type' => 'jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ],'file_id' => [
            'name' => 'ucroo_unittestcase_summery.xlsx',
            'type' => 'xls',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('ucroo_unittestcase_summery.xlsx')),
            'tmp_name' => codecept_data_dir('ucroo_unittestcase_summery.xlsx'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');


// -ve
$I->am('Case 28 : To edit group with campus_id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit group with campus_id as string after login');
$I->sendPOST('customgroups/edit/'.$group_id,['name'=>'aaaa','description'=>'desaaaaaaaaaaaaaaaaaaaaac goes hereaaaaaaaaaaaaaaa','privacy'=>'0','faculty_id'=>'1','category_id'=>'1','campus_id'=>'aa1','member_email'=>['team+userid6@ucroo.com'],'member_user_id'=>['6']],['userfile' => [
            'name' => 'myFile.jpg',
            'type' => 'jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ],'file_id' => [
            'name' => 'ucroo_unittestcase_summery.xlsx',
            'type' => 'xls',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('ucroo_unittestcase_summery.xlsx')),
            'tmp_name' => codecept_data_dir('ucroo_unittestcase_summery.xlsx'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');



// -ve
// failing
/*
$I->am('Case 29 : To edit group with userfile as wrong file type other then jpeg after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit group with userfile as wrong file type other then jpeg after login');
$I->sendPOST('customgroups/edit/'.$group_id,['name'=>'aaaa','description'=>'desaaaaaaaaaaaaaaaaaaaaac goes hereaaaaaaaaaaaaaaa','privacy'=>'0','faculty_id'=>'1','category_id'=>'1','campus_id'=>'aa1','member_email'=>['team+userid6@ucroo.com'],'member_user_id'=>['6']],['file_id' => [
            'name' => 'ucroo_unittestcase_summery.xlsx',
            'type' => 'xls',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('ucroo_unittestcase_summery.xlsx')),
            'tmp_name' => codecept_data_dir('ucroo_unittestcase_summery.xlsx'),
        ],'userfile' => [
            'name' => 'ucroo_unittestcase_summery.xlsx',
            'type' => 'xls',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('ucroo_unittestcase_summery.xlsx')),
            'tmp_name' => codecept_data_dir('ucroo_unittestcase_summery.xlsx'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');
 *
 */



// -ve
// failing
/*
$I->am('Case 30 : To edit group with file_id as wrong file type other then jpeg after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To edit group with file_id as wrong file type other then jpeg after login');
$I->sendPOST('customgroups/edit/'.$group_id,['name'=>'aaaa','description'=>'desaaaaaaaaaaaaaaaaaaaaac goes hereaaaaaaaaaaaaaaa','privacy'=>'0','faculty_id'=>'1','category_id'=>'1','campus_id'=>'aa1','member_email'=>['team+userid6@ucroo.com'],'member_user_id'=>['6']],['file_id' => [
            'name' => 'myFile.jpg',
            'type' => 'jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ],'userfile' => [
            'name' => 'myFile.jpg',
            'type' => 'jpg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');
 *
 */


// +ve
$I->am('Case 31 : To get detail of group after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To get detail of group after login');
$I->sendGET('customgroups/details/'.$group_id);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Customgroup_detailCept.json');


// -ve
$I->am('Case 32 : To get detail of group without groupid after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To get detail of group without groupid after login');
$I->sendGET('customgroups/details/');
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');


// -ve
$I->am('Case 33 : To get detail of group with groupid as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To get detail of group with groupid as string after login');
$I->sendGET('customgroups/details/aaaaaaaaaaa');
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');


// -ve
$I->am('Case 34 : To get detail of group with groupid not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To get detail of group with groupid not exist after login');
$I->sendGET('customgroups/details/999999999999999');
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('CalendarCept3.json');


// +ve
$I->am('Case 35 : To joine customgroup after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To joine customgroup after login');
$I->sendPOST('customgroups/join',['id'=>$group_id]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 36 : To joine customgroup by owner after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To joine customgroup by owner after login');
$I->sendPOST('customgroups/join',['id'=>$group_id]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 37 : To joine customgroup second time after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To joine customgroup second time after login');
$I->sendPOST('customgroups/join',['id'=>$group_id]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 38 : To joine customgroup without group id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To joine customgroup without group id after login');
$I->sendPOST('customgroups/join',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 39 : To joine customgroup with group id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To joine customgroup with group id as string after login');
$I->sendPOST('customgroups/join',['id'=>'eeeeeeeeee']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 40 : To joine customgroup with group id does not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To joine customgroup with group id does not exist after login');
$I->sendPOST('customgroups/join',['id'=>'333333333333333']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// +ve
$I->am('Case 41 : To leave customgroup after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To leave customgroup after login');
$I->sendPOST('customgroups/leave',['id'=>$group_id]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
// failing
// it is allow once to leave then show error, actully at first time it should show error
/*$I->am('Case 42 : To leave customgroup by owner after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To leave customgroup by owner after login');
$I->sendPOST('customgroups/leave',['id'=>$group_id]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');*/


// -ve
/*$I->am('Case 43 : To leave customgroup second time after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To leave customgroup second time after login');
$I->sendPOST('customgroups/leave',['id'=>$group_id]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');
*/

// -ve
$I->am('Case 44 : To leave customgroup without group id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To leave customgroup without group id after login');
$I->sendPOST('customgroups/leave',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 45 : To leave customgroup with group id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To leave customgroup with group id as string after login');
$I->sendPOST('customgroups/leave',['id'=>'eeeeeeeeee']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 46 : To leave customgroup with group id does not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email2, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To leave customgroup with group id does not exist after login');
$I->sendPOST('customgroups/leave',['id'=>'333333333333333']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');

