<?php

$I = new ApiTester($scenario);
$user_email = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'2'));
$user_id = $I->getDataFromDbCustom($I,'users','id',array('group_id'=>'2','email'=>$user_email));
$user_password = 'ucroo123';

$title = 'my title';


// +ve
$I->am('Case 1 : Listing Items – Market Place after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Listing Items – Market Place after login');
$I->sendPOST('marketplace/itemlisting',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MarketplaceCept.json');


// +ve
$I->am('Case 2 : Listing Items – Market Place with params after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Listing Items – Market Place with params after login');
$I->sendPOST('marketplace/itemlisting',['filter_input'=>'a','filter_category'=>'1','filter_campus'=>'1','filter_order'=>'asc']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MarketplaceCept.json');


// -ve
$I->am('Case 3 : Listing Items – Market Place with wrong params after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Listing Items – Market Place after login');
$I->sendPOST('marketplace/itemlisting',['filter_input'=>'a','filter_category'=>'aaa1','filter_campus'=>'1','filter_order'=>'ascaaa']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MarketplaceCept.json');



// +ve
$I->am('Case 6 : Listing Items – Market Place for specific user after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Listing Items – Market Place for specific user after login');
$I->sendPOST('marketplace/itemlisting/'.$user_id,['filter_input'=>'','filter_category'=>'','filter_campus'=>'','filter_order'=>'asc']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
//$I->canSeeResponseIsValidOnSchemaFile('MarketplaceCept.json');



// -ve
$I->am('Case 7 : Listing Items – Market Place for specific user with wrong data after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Listing Items – Market Place for specific user with wrong data after login');
$I->sendPOST('marketplace/itemlisting/aaaaaaaaa',['filter_input'=>'a','filter_category'=>'1','filter_campus'=>'1','filter_order'=>'asc']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MarketplaceCept.json');


// +ve
$I->am('Case 4 : Upload Image in Market Place after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Upload Image in Market Place after login');
$I->sendPOST('upload/index',[],['userfile' => [
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$data = $I->getArrayFromJson($I);
$photo = $data[0]['name'];
$I->canSeeResponseIsValidOnSchemaFile('MarketplaceimageuploadCept.json');



// -ve
$I->am('Case 5 : Upload Image in Market Place without image after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Upload Image in Market Place without image after login');
$I->sendPOST('upload/index',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MarketplaceimageuploaderrorCept.json');



// +ve
$I->am('Case 8 : Post New Item after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Post New Item after login');
$I->sendPOST('marketplace/saveitem/',['item_name'=>$title,'description'=>'desc goes here','photo'=>$photo,'category_id'=>1,'price'=>'12']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



$I->am('Case 6 : Listing Items – Market Place for specific user after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Listing Items – Market Place for specific user after login');
$I->sendPOST('marketplace/itemlisting/'.$user_id,['filter_input'=>'','filter_category'=>'','filter_campus'=>'','filter_order'=>'asc']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$data = $I->getArrayFromJson($I);
$added_title = $data['response']['items'][0]['item_name'];
$I->compareString($title,$added_title);






// -ve
$I->am('Case 9 : Post New Item without item name after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Post New Item without item name after login');
$I->sendPOST('marketplace/saveitem/',['description'=>'desc goes here','photo'=>$photo,'category_id'=>1,'price'=>'12']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MarketplaceerrorCept.json');



// -ve
$I->am('Case 10 : Post New Item without description after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Post New Item without description after login');
$I->sendPOST('marketplace/saveitem/',['item_name'=>'desc goes here','photo'=>$photo,'category_id'=>1,'price'=>'12']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MarketplaceerrorCept.json');



// -ve
$I->am('Case 11 : Post New Item without photo after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Post New Item without photo after login');
$I->sendPOST('marketplace/saveitem/',['item_name'=>'unitestcase','description'=>'desc goes here','category_id'=>1,'price'=>'12']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MarketplaceerrorCept.json');



// -ve
$I->am('Case 12 : Post New Item without category id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Post New Item without category id after login');
$I->sendPOST('marketplace/saveitem/',['item_name'=>'unitestcase','description'=>'desc goes here','photo'=>$photo,'price'=>'12']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MarketplaceerrorCept.json');


// -ve
$I->am('Case 13 : Post New Item without price after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Post New Item without price after login');
$I->sendPOST('marketplace/saveitem/',['item_name'=>'unitestcase','description'=>'desc goes here','photo'=>$photo,'category_id'=>1]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MarketplaceerrorCept.json');



// +ve
$I->am('Case 6 : Listing Items – Market Place for specific user after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Listing Items – Market Place for specific user after login');
$I->sendPOST('marketplace/itemlisting/'.$user_id,['filter_input'=>'','filter_category'=>'','filter_campus'=>'','filter_order'=>'asc']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$data = $I->getArrayFromJson($I);
$item_id = $data['response']['items'][0]['item_id'];
$I->canSeeResponseIsValidOnSchemaFile('MarketplaceCept.json');



// +ve
$I->am('Case 14 : Edit Item after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Item after login');
$I->sendPOST('marketplace/saveitem/'.$item_id,['item_name'=>'unitestcase','description'=>'desc goes here','photo'=>$photo,'category_id'=>'3','price'=>'12']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');



// -ve
$I->am('Case 15 : Edit Item without item name after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Item without item name after login');
$I->sendPOST('marketplace/saveitem/'.$item_id,['description'=>'desc goes here','photo'=>$photo,'category_id'=>1,'price'=>'12']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MarketplaceerrorCept.json');



// -ve
$I->am('Case 16 : Edit Item without description after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Item without description after login');
$I->sendPOST('marketplace/saveitem/'.$item_id,['item_name'=>'desc goes here','photo'=>$photo,'category_id'=>1,'price'=>'12']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MarketplaceerrorCept.json');



// -ve
$I->am('Case 17 : Edit Item without photo after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Item without photo after login');
$I->sendPOST('marketplace/saveitem/'.$item_id,['item_name'=>'unitestcase','description'=>'desc goes here','category_id'=>1,'price'=>'12']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MarketplaceerrorCept.json');



// -ve
$I->am('Case 18 : Edit Item without category id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Item without category id after login');
$I->sendPOST('marketplace/saveitem/'.$item_id,['item_name'=>'unitestcase','description'=>'desc goes here','photo'=>$photo,'price'=>'12']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MarketplaceerrorCept.json');


// -ve
$I->am('Case 19 : Edit Item without price after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Edit Item without price after login');
$I->sendPOST('marketplace/saveitem/'.$item_id,['item_name'=>'unitestcase','description'=>'desc goes here','photo'=>$photo,'category_id'=>1]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('MarketplaceerrorCept.json');



// +ve
$I->am('Case 20 : Mark Item as Sold after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Mark Item as Sold after login');
$I->sendGET('marketplace/markassold/'.$user_id.'/'.$item_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// +ve
$I->am('Case 21 : Remove Item as Sold after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Remove Item as Sold after login');
$I->sendGET('marketplace/removeitem/'.$user_id.'/'.$item_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 22 : Mark Item as Sold without params after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Mark Item as Sold without params after login');
$I->sendGET('marketplace/markassold/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


// -ve
$I->am('Case 23 : Remove Item as Sold without param after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Remove Item as Sold without param after login');
$I->sendGET('marketplace/removeitem/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ProfileCept3.json');


