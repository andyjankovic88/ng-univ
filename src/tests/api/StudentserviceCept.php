<?php

$I = new ApiTester($scenario);
$user_email1 = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'2'));
$user_id = $I->getDataFromDbCustom($I,'users','id',array('email'=>$user_email1));
$user_email2 = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'2'));
$user_password = 'ucroo123';
$servicepage_name = $I->randStrGen(6);




// +ve
$I->am('Case 1 : Student Services List after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Student Services List after login');
$I->sendGET('servicepage/listing',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$data = $I->getArrayFromJson($I);
$service_id = '';
foreach ($data['response'] as $item){
    if(!empty($service_id)){
        break;
    }
    foreach ($item as $subitem){

        if(empty($subitem['is_member']) || ($subitem['is_member']=='false')){
            $service_id = $subitem['id']; break;
        }
        
    }
}
$I->canSeeResponseIsValidOnSchemaFile('StudentservicelistCept.json');






// +ve
$I->am('Case 2 : Student Services Follow after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Student Services Follow after login');
$I->sendPOST('servicepage/follow/'.$service_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// +ve
$I->am('Case 3 : Student Services unFollow after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Student Services unFollow after login');
$I->sendPOST('servicepage/unfollow/'.$service_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// -ve
$I->am('Case 4 : Student Services Follow without service id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Student Services Follow without service id after login');
$I->sendPOST('servicepage/follow/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// -ve
$I->am('Case 5 : Student Services Follow with service id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Student Services Follow with service id as string after login');
$I->sendPOST('servicepage/follow/aaaaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// -ve
$I->am('Case 7 : Student Services unFollow without service id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Student Services unFollow without service id after login');
$I->sendPOST('servicepage/unfollow/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// -ve
$I->am('Case 8 : Student Services unFollow with service id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Student Services unFollow with service id as string after login');
$I->sendPOST('servicepage/unfollow/aaaaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');




// -ve
$I->am('Case 9 : Student Services unFollow with service id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Student Services unFollow with service id not exist after login');
$I->sendPOST('servicepage/unfollow/1111111111',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');




// +ve
$I->am('Case 10 : Student Services view after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Student Services view after login');
$I->sendGET('servicepage/view_details/'.$service_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentserviceviewCept.json');



// -ve
$I->am('Case 11 : Student Services view without service id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Student Services view without service id after login');
$I->sendGET('servicepage/view_details/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// -ve
$I->am('Case 12 : Student Services view with service id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Student Services view with service id as string after login');
$I->sendGET('servicepage/view_details/aaaaaaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');





// +ve
$I->am('Case 14 : Get service page followers after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Get service page followers after login');
$I->sendGET('servicepage/followers/'.$service_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowerCept.json');



// -ve
$I->am('Case 15 : Get service page followers without service id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo(' Get service page followers without service id after login');
$I->sendGET('servicepage/followers/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// -ve
$I->am('Case 16 : Get service page followers with service id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo(' Get service page followers with service id as string after login');
$I->sendGET('servicepage/followers/aaaaaaaaaaaaaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// +ve
$I->am('Case 17 : Get service page followers with not existing service id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Get service page followers with not existing service id after login');
$I->sendGET('servicepage/followers/33333333333333333',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowerCept.json');

//HOLD
//**API 6:** Add / Edit Service Page API.
//**API End Point:** http://backend.localhost.ucroo/servicepage/addedit/[service_id]

// +ve
$I->am('Case 25 : Add Service Page after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add Service Page after login');
$I->sendPOST('servicepage/addedit/',['name'=>$servicepage_name,'description'=>'dec aaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaa','website'=>'www.ggg.com','email'=>'a@a.com','phone'=>'123123','faculty_id'=>'-1','campus_id'=>'-1','office_location'=>[],'dropin_day'=>[],'dropin_start'=>[],'dropin_end'=>[],'dropin_location'=>[],'dropin_campus'=>[],'staff_email'=>[],'staff_name'=>[]]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');




// -ve
$I->am('Case 26 : Add Service Page with same name after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add Service Page with same name after login');
$I->sendPOST('servicepage/addedit/',['name'=>$servicepage_name,'description'=>'dec aaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaa','website'=>'www.ggg.com','email'=>'a@a.com','phone'=>'123123','faculty_id'=>'-1','campus_id'=>'-1','office_location'=>[],'dropin_day'=>[],'dropin_start'=>[],'dropin_end'=>[],'dropin_location'=>[],'dropin_campus'=>[],'staff_email'=>[],'staff_name'=>[]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// -ve
$I->am('Case 27 : Add Service Page without name after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add Service Page without name after login');
$I->sendPOST('servicepage/addedit/',['description'=>'dec aaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaa','website'=>'www.ggg.com','email'=>'a@a.com','phone'=>'123123','faculty_id'=>'-1','campus_id'=>'-1','office_location'=>[],'dropin_day'=>[],'dropin_start'=>[],'dropin_end'=>[],'dropin_location'=>[],'dropin_campus'=>[],'staff_email'=>[],'staff_name'=>[]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// -ve
$I->am('Case 28 : Add Service Page without description after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add Service Page without description after login');
$I->sendPOST('servicepage/addedit/',['name'=>$servicepage_name.'trt','website'=>'www.ggg.com','email'=>'a@a.com','phone'=>'123123','faculty_id'=>'-1','campus_id'=>'-1','office_location'=>[],'dropin_day'=>[],'dropin_start'=>[],'dropin_end'=>[],'dropin_location'=>[],'dropin_campus'=>[],'staff_email'=>[],'staff_name'=>[]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');




// -ve
$I->am('Case 29 : Add Service Page with description less than 50 char after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add Service Page with description less than 50 char after login');
$I->sendPOST('servicepage/addedit/',['name'=>$servicepage_name.'wsad','description'=>'dec ','website'=>'www.ggg.com','email'=>'a@a.com','phone'=>'123123','faculty_id'=>'-1','campus_id'=>'-1','office_location'=>[],'dropin_day'=>[],'dropin_start'=>[],'dropin_end'=>[],'dropin_location'=>[],'dropin_campus'=>[],'staff_email'=>[],'staff_name'=>[]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// +ve
$I->am('Case 34 : Student Services List after adding new service page');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Student Services List after adding new service page');
$I->sendGET('servicepage/listing',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$data1 = $I->getArrayFromJson($I);
$service_id_edit = '';
foreach ($data1['response']['university_wide_services'] as $item){
    if(!empty($service_id_edit)){
        break;
    }
    if($subitem['group_name'] == $servicepage_name){
            $service_id_edit = $subitem['id'];
    }
}
$I->canSeeResponseIsValidOnSchemaFile('StudentservicelistCept.json');





// +ve
$I->am('Case 30 : Edit Service Page after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Service Page after login');
$I->sendPOST('servicepage/addedit/'.$service_id_edit,['name'=>$servicepage_name.'rr','description'=>'dec aaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaa','website'=>'www.ggg.com','email'=>'a@a.com','phone'=>'123123','faculty_id'=>'-1','campus_id'=>'-1','office_location'=>[],'dropin_day'=>[],'dropin_start'=>[],'dropin_end'=>[],'dropin_location'=>[],'dropin_campus'=>[],'staff_email'=>[],'staff_name'=>[]]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// -ve
$I->am('Case 31 : Edit Service Page without name after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Service Page without name after login');
$I->sendPOST('servicepage/addedit/'.$service_id_edit,['description'=>'dec aaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaa','website'=>'www.ggg.com','email'=>'a@a.com','phone'=>'123123','faculty_id'=>'-1','campus_id'=>'-1','office_location'=>[],'dropin_day'=>[],'dropin_start'=>[],'dropin_end'=>[],'dropin_location'=>[],'dropin_campus'=>[],'staff_email'=>[],'staff_name'=>[]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// -ve
$I->am('Case 32 : Edit Service Page without description after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Service Page without description after login');
$I->sendPOST('servicepage/addedit/'.$service_id_edit,['name'=>$servicepage_name.'trt','website'=>'www.ggg.com','email'=>'a@a.com','phone'=>'123123','faculty_id'=>'-1','campus_id'=>'-1','office_location'=>[],'dropin_day'=>[],'dropin_start'=>[],'dropin_end'=>[],'dropin_location'=>[],'dropin_campus'=>[],'staff_email'=>[],'staff_name'=>[]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');




// -ve
$I->am('Case 33 : Edit Service Page with description less than 50 char after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Service Page with description less than 50 char after login');
$I->sendPOST('servicepage/addedit/'.$service_id_edit,['name'=>$servicepage_name.'wsad','description'=>'dec ','website'=>'www.ggg.com','email'=>'a@a.com','phone'=>'123123','faculty_id'=>'-1','campus_id'=>'-1','office_location'=>[],'dropin_day'=>[],'dropin_start'=>[],'dropin_end'=>[],'dropin_location'=>[],'dropin_campus'=>[],'staff_email'=>[],'staff_name'=>[]]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');






// +ve
$I->am('Case 18 : get add/edit Service Page form details after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get add/edit Service Page form details after login');
$I->sendPOST('servicepage/unfollow/'.$service_id,[]);
$I->sendGET('servicepage/addedit_form_details/'.$service_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentserviceformdetailCept.json');



// -ve
$I->am('Case 19 : get add/edit Service Page form details with service id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get add/edit Service Page form details with service id as string after login');
$I->sendGET('servicepage/addedit_form_details/aaaaaaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// -ve
$I->am('Case 20 : get add/edit Service Page form details with service id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get add/edit Service Page form details with service id not exist after login');
$I->sendGET('servicepage/addedit_form_details/',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('Studentserviceformdetail2Cept.json');



// +ve
$I->am('Case 35 : Add Service Event to service page after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add Service Event to service page after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');




// +ve
$I->am('Case 21 : get service page events listing after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get service page events listing after login');
$I->sendGET('servicepage/event_lists/'.$service_id_edit,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$data2 = $I->getArrayFromJson($I);
$total_event = count($data2['response']['upcoming_events']);
$event_title = $data2['response']['upcoming_events'][$total_event-1]['title'];
$event_id = $data2['response']['upcoming_events'][$total_event-1]['id'];
$I->compareString('aa'.$servicepage_name,$event_title);
$I->canSeeResponseIsValidOnSchemaFile('StudentserviceeventlistCept.json');



// +ve
$I->am('Case 36 : edit Service Event to service page after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit Service Event to service page after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit.'/'.$event_id,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// -ve
$I->am('Case 37 : edit Service Event to service page with event id string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit Service Event to service page with event id string after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit.'/aaaaaaaaaa',['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// -ve
$I->am('Case 38 : edit Service Event to service page with event id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit Service Event to service page with event id not exist after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit.'/11111111111111111111',['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// -ve
$I->am('Case 39 : edit Service Event to service page with service id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit Service Event to service page with service id not exist after login');
$I->sendPOST('servicepage/event_addedit/11111111111111/'.$event_id,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// -ve
$I->am('Case 40 : edit Service Event to service page with service id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit Service Event to service page with service id as string after login');
$I->sendPOST('servicepage/event_addedit/aaaaaaaaaaaaaaa/'.$event_id,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// -ve
$I->am('Case 41 : edit Service Event to service page with service id blank after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit Service Event to service page with service id blank after login');
$I->sendPOST('servicepage/event_addedit//'.$event_id,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


////require

// without title
// -ve
$I->am('Case 42 : Add Service Event to service page without title after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add Service Event to service page without title after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit,['description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// desc
// -ve
$I->am('Case 43 : Add Service Event to service page without desc after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add Service Event to service page without desc after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit,['title'=>'aa'.$servicepage_name,'start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// startdate
// -ve
$I->am('Case 44 : Add Service Event to service page without startdate after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add Service Event to service page without startdate after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// end date
// -ve
$I->am('Case 45 : Add Service Event to service page without end date after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add Service Event to service page without end date after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// start_date_hrs
// -ve
$I->am('Case 46 : Add Service Event to service page without start_date_hrs after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add Service Event to service page without start_date_hrs after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// end_date_hrs
// -ve
$I->am('Case 47 : Add Service Event to service page without end_date_hrs after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add Service Event to service page without end_date_hrs after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// location
// -ve
$I->am('Case 48 : Add Service Event to service page without location after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add Service Event to service page without location after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// max_attendees
// -ve
$I->am('Case 49 : Add Service Event to service page without max_attendees  after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add Service Event to service page without max_attendees  after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// timezone
// -ve
$I->am('Case 50 : Add Service Event to service page without timezone after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add Service Event to service page without timezone after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// campus_id
// -ve
$I->am('Case 51 : Add Service Event to service page without campus_id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add Service Event to service page  without campus_id after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



//// validation

// startdate proper
// -ve
$I->am('Case 52 : Add Service Event to service page with startdate improper after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add Service Event to service page with startdate improper after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'aaaaaaaaa','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// startdate not expire
// -ve
$I->am('Case 53 : Add Service Event to service page with past startdate after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add Service Event to service page with past startdate after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2012','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');

// end date proper
// -ve
$I->am('Case 54 : Add Service Event to service page with end date as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add Service Event to service page with end date as string after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'sssssssssssssssss','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// end date not expire
// -ve
$I->am('Case 55 : Add Service Event to service page with past end date after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add Service Event to service page with past end date after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2011','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// end date should be greater than start
// -ve
$I->am('Case 56 : Add Service Event to service page with end date lower than start date after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add Service Event to service page with end date lower than start date after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/01/2016','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// start_date_hrs proper
// -ve
$I->am('Case 57 : Add Service Event to service page with start date hrs as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add Service Event to service page with start date hrs as string after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'aaaaaaaaaaaa','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// end_date_hrs proper
// -ve
$I->am('Case 58 : Add Service Event to service page with end date hrs as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add Service Event to service page with end date hrs as string after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'dddddddddddddddd','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// max_attendees should be int
// -ve
$I->am('Case 59 : Add Service Event to service page with max_attendees as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add Service Event to service page with max_attendees as string after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'aaaaaaaaaaaa','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


////require

// without title
// -ve
$I->am('Case 61 : Edit Service Event to service page without title after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Service Event to service page without title after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit.'/'.$event_id,['description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// desc
// -ve
$I->am('Case 62 : Edit Service Event to service page without desc after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Service Event to service page without desc after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit.'/'.$event_id,['title'=>'aa'.$servicepage_name,'start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// startdate
// -ve
$I->am('Case 63 : Edit Service Event to service page without startdate after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Service Event to service page without startdate after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit.'/'.$event_id,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// end date
// -ve
$I->am('Case 64 : Edit Service Event to service page without end date after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Service Event to service page without end date after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit.'/'.$event_id,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// start_date_hrs
// -ve
$I->am('Case 65 : Edit Service Event to service page without start_date_hrs after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Service Event to service page without start_date_hrs after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit.'/'.$event_id,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// end_date_hrs
// -ve
$I->am('Case 66 : Edit Service Event to service page without end_date_hrs after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Service Event to service page without end_date_hrs after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit.'/'.$event_id,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// location
// -ve
$I->am('Case 67 : Edit Service Event to service page without location after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Service Event to service page without location after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit.'/'.$event_id,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// max_attendees
// -ve
$I->am('Case 68 : Edit Service Event to service page without max_attendees  after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Service Event to service page without max_attendees  after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit.'/'.$event_id,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// timezone
// -ve
$I->am('Case 69 : Edit Service Event to service page without timezone after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Service Event to service page without timezone after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit.'/'.$event_id,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// campus_id
// -ve
$I->am('Case 70 : Edit Service Event to service page without campus_id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Service Event to service page  without campus_id after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit.'/'.$event_id,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



//// validation

// startdate proper
// -ve
$I->am('Case 71 : Edit Service Event to service page with startdate improper after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Service Event to service page with startdate improper after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit.'/'.$event_id,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'aaaaaaaaa','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// startdate not expire
// -ve
$I->am('Case 72 : Edit Service Event to service page with past startdate after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Service Event to service page with past startdate after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit.'/'.$event_id,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2012','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');

// end date proper
// -ve
$I->am('Case 73 : Edit Service Event to service page with end date as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Service Event to service page with end date as string after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit.'/'.$event_id,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'sssssssssssssssss','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// end date not expire
// -ve
$I->am('Case 74 : Edit Service Event to service page with past end date after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Service Event to service page with past end date after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit.'/'.$event_id,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2011','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// end date should be greater than start
// -ve
$I->am('Case 75 : Edit Service Event to service page with end date lower than start date after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Service Event to service page with end date lower than start date after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit.'/'.$event_id,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/01/2016','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// start_date_hrs proper
// -ve
$I->am('Case 76 : Edit Service Event to service page with start date hrs as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Service Event to service page with start date hrs as string after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit.'/'.$event_id,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'aaaaaaaaaaaa','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// end_date_hrs proper
// -ve
$I->am('Case 77 : Edit Service Event to service page with end date hrs as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Service Event to service page with end date hrs as string after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit.'/'.$event_id,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'dddddddddddddddd','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// max_attendees should be int
// -ve
$I->am('Case 78 : Edit Service Event to service page with max_attendees as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Service Event to service page with max_attendees as string after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit.'/'.$event_id,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'aaaaaaaaaaaa','timezone'=>'Australia/Sydney','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');





// +ve
$I->am('Case 80 : get add/edit event form details after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get add/edit event form details after login');
$I->sendGET('servicepage/event_addedit_form_details/'.$service_id_edit.'/'.$event_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentserviceediteventformCept.json');



// +ve
$I->am('Case 81 : get add/edit event form details without event id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get add/edit event form details without event id after login');
$I->sendGET('servicepage/event_addedit_form_details/'.$service_id_edit,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentserviceediteventformCept2.json');



// -ve
$I->am('Case 82 : get add/edit event form details with event id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get add/edit event form details with event id as string after login');
$I->sendGET('servicepage/event_addedit_form_details/'.$service_id_edit.'/aaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// -ve
$I->am('Case 83 : get add/edit event form details with event id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get add/edit event form details with event id not exist after login');
$I->sendGET('servicepage/event_addedit_form_details/'.$service_id_edit.'/3333333333333',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// -ve
$I->am('Case 84 : get add/edit event form details with service id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get add/edit event form details with service id not exist after login');
$I->sendGET('servicepage/event_addedit_form_details/3333333333333333/'.$event_id,[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// -ve
$I->am('Case 85 : get add/edit event form details with service id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get add/edit event form details with service id as string after login');
$I->sendGET('servicepage/event_addedit_form_details/aaaaaaaaaaaaaa/'.$event_id,[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// -ve
$I->am('Case 86 : get add/edit event form details with service id blank after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get add/edit event form details with service id blank after login');
$I->sendGET('servicepage/event_addedit_form_details/'.$event_id,[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');




// +ve
$I->am('Case 87 : get service page Event view details after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get service page Event view details after login');
$I->sendGET('servicepage/event_lists/'.$service_id_edit.'/'.$event_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentserviceeventviewCept.json');



// -ve
$I->am('Case 88 : get service page Event view details without service id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get service page Event view details without service id after login');
$I->sendGET('servicepage/event_lists/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// -ve
$I->am('Case 89 : get service page Event view details with service id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get service page Event view details with service id as string after login');
$I->sendGET('servicepage/event_lists/aaaaaaaaaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');




// -ve
$I->am('Case 90 : get service page Event view details with service id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get service page Event view details with service id not exist after login');
$I->sendGET('servicepage/event_lists/333333333333333',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// +ve
$I->am('Case 91 : get service page Event view details after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get service page Event view details after login');
$I->sendGET('servicepage/event_view/'.$event_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentserviceeventviewCept2.json');




// -ve
$I->am('Case 92 : get service page Event view details without service id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get service page Event view details without service id after login');
$I->sendGET('servicepage/event_view/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// -ve
$I->am('Case 93 : get service page Event view details with service id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get service page Event view details with service id as string after login');
$I->sendGET('servicepage/event_view/aaaaaaaaaaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');





// -ve
$I->am('Case 94 : get service page Event view details with service id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get service page Event view details with service id not exist after login');
$I->sendGET('servicepage/event_view/33333333333333333333333',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');






// +ve
$I->am('Case 95 : servicepage Event join action after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('servicepage Event join action after login');
$I->sendPOST('servicepage/event_join/'.$event_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// -ve
$I->am('Case 96 : servicepage Event join action without event id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('servicepage Event join action without event id after login');
$I->sendPOST('servicepage/event_join/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// -ve
$I->am('Case 97 : servicepage Event join action with event id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('servicepage Event join action with event id as string after login');
$I->sendPOST('servicepage/event_join/aaaaaaaaaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// -ve
$I->am('Case 98 : servicepage Event join action with event id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('servicepage Event join action with event id not exist after login');
$I->sendPOST('servicepage/event_join/333333333333333333',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// +ve
$I->am('Case 99 : servicepage Event leave action after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('servicepage Event leave action after login');
$I->sendPOST('servicepage/event_leave/'.$event_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// -ve
$I->am('Case 100 : servicepage Event leave action without event id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('servicepage Event leave action without event id after login');
$I->sendPOST('servicepage/event_leave/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// -ve
$I->am('Case 101 : servicepage Event leave action with event id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('servicepage Event leave action with event id as string after login');
$I->sendPOST('servicepage/event_leave/aaaaaaaaaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// -ve
$I->am('Case 102 : servicepage Event leave action with event id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('servicepage Event leave action with event id not exist after login');
$I->sendPOST('servicepage/event_leave/333333333333333333',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');





// -ve
$I->am('Case 22 : get service page events listing without service id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get service page events listing without service id after login');
$I->sendGET('servicepage/event_lists/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// -ve
$I->am('Case 23 : get service page events listing with service id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get service page events listing with service id as string after login');
$I->sendGET('servicepage/event_lists/eeeeeeeeeee',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// -ve
$I->am('Case 24 : get service page events listing with service id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get service page events listing with service id not exist after login');
$I->sendGET('servicepage/event_lists/222222222222222',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');








// +ve
$I->am('Case 107 : Student Services Suggestion List after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Student Services Suggestion List after login');
$I->sendGET('servicepage/suggested/',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicesuggestionCept.json');



// +ve
$I->am('Case 108 : Student Services RHS Sidebar (Upcoming Event, Staff Members) after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Student Services RHS Sidebar (Upcoming Event, Staff Members) after login');
$I->sendPOST('sidebar_rhs/group_specific/servicepage/'.$service_id_edit,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicerhsCept.json');



// -ve
$I->am('Case 109 : Student Services RHS Sidebar (Upcoming Event, Staff Members) with service id invalid after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Student Services RHS Sidebar (Upcoming Event, Staff Members) with service id invalid after login');
$I->sendPOST('sidebar_rhs/group_specific/servicepage/2222222222222',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicerhsCept.json');



// -ve
$I->am('Case 110 : Student Services RHS Sidebar (Upcoming Event, Staff Members) with service id blank after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Student Services RHS Sidebar (Upcoming Event, Staff Members) with service id blank after login');
$I->sendPOST('sidebar_rhs/group_specific/servicepage/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// -ve
$I->am('Case 111 : Student Services RHS Sidebar (Upcoming Event, Staff Members) with service id string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Student Services RHS Sidebar (Upcoming Event, Staff Members) with service id string after login');
$I->sendPOST('sidebar_rhs/group_specific/servicepage/aaaaaaaaaaaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicejsonCept.json');




// +ve
$I->am('Case 112 : Add new Staff Member ucroo user after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('servicepage Event delete after login');
$I->sendPOST('json/save_non_ucroo_member/',['module'=>'service_pages','module_id'=>$service_id_edit,'user'=>'','name'=>$servicepage_name.'@'.$servicepage_name.'.com','email'=>'','result_format'=>'data_array']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicejsonCept.json');



// +ve
$I->am('Case 113 : Add new Staff Member ucroo user after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('servicepage Event delete after login');
$I->sendPOST('json/save_non_ucroo_member/',['module'=>'service_pages','module_id'=>$service_id_edit,'user'=>$user_id,'name'=>$servicepage_name,'email'=>$user_email1,'result_format'=>'data_array']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');




// +ve
$I->am('Case 103 : servicepage Event delete after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('servicepage Event delete after login');
$I->sendPOST('servicepage/event_delete/'.$event_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// -ve
$I->am('Case 104 : servicepage Event delete without event id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('servicepage Event delete without event id after login');
$I->sendPOST('servicepage/event_delete/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


// -ve
$I->am('Case 105 : servicepage Event delete with event id as string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('servicepage Event delete without event id after login');
$I->sendPOST('servicepage/event_delete/aaaaaaaaaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');



// -ve
$I->am('Case 106 : servicepage Event delete with event id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('servicepage Event delete without event id after login');
$I->sendPOST('servicepage/event_delete/222222222222222',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');





// timezon pass wring string // this case if failing
// -ve
$I->am('Case 79 : Edit Service Event to service page with timezone as improper string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Service Event to service page with timezone as improper string after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit.'/'.$service_id,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'aaaaaaaaaaaaaaaaaaa','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');


 // fail
// timezon pass wring string // this case if failing
// -ve
$I->am('Case 60 : Add Service Event to service page with timezone as improper string after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Add Service Event to service page with timezone as improper string after login');
$I->sendPOST('servicepage/event_addedit/'.$service_id_edit,['title'=>'aa'.$servicepage_name,'description'=>'this is descritpion that goes there','start_date'=>'01/12/2016','start_date_hrs'=>'09:15 AM','end_date'=>'01/12/2017','end_date_hrs'=>'09:15 AM','location'=>'ahmedabadb','max_attendees'=>'123','timezone'=>'aaaaaaaaaaaaaaaaaaa','specificto_campus_check'=>'','campus_id'=>'-1']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');
 

// fail 505 db error coming
// -ve
$I->am('Case 13 : Student Services view with service id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Student Services view with service id not exist after login');
$I->sendGET('servicepage/view_details/222222222222222',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');





// fail // it giving db error , appropriate msg needed
// -ve
$I->am('Case 6 : Student Services Follow with service id not exist after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email1, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Student Services Follow with service id not exist after login');
$I->sendPOST('servicepage/follow/1111111111',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('StudentservicefollowCept.json');

