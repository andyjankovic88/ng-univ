<?php
$I = new ApiTester($scenario);
$user_email = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'2'));
$user_id = $I->getDataFromDbCustom($I,'users','id',array('email'=>$user_email,'group_id'=>'2'));
$user_password = 'ucroo123';

/*
 * use this to get response of json
 $data=$I->getArrayFromJson($I);
 echo '<pre>'; print_r($data);die;
*/



//+ve
$I->am('Case 1 : post feed after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('post feed after login with Email & Password');
$I->sendPost('feeds/add/club',['feed_item' => ['text' => 'Post Text', 'type' => 'post', 'is_anonymous' => 'true'],'post_faculty' => '1','post_campus' => '12','post_is_international' => '1','post_year'=>'1','pinning_date'=>'26/05/2015']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
//to get post id
$data=$I->getArrayFromJson($I);
$post_id=$data['response']['post_id'];
//to get post id
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept1.json');

//-ve
$I->am('Case 2 : post feed with wrong object type after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('post feed with wrong object type after login');
$I->sendPost('feeds/add/club1',['feed_item' => ['text' => 'Post Text', 'type' => 'post', 'is_anonymous' => 'true'],'post_faculty' => '1','post_campus' => '12','post_is_international' => '1','post_year'=>'1','pinning_date'=>'26/05/2015']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');

//-ve
$I->am('Case 3 : post feed without feed_item type after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('post feed without feed_item type after login');
$I->sendPost('feeds/add/club',['feed_item' => ['text' => 'Post Text','is_anonymous' => 'true'],'post_faculty' => '1','post_campus' => '12','post_is_international' => '1','post_year'=>'1','pinning_date'=>'26/05/2015']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');

//-ve
// current user have not right for 'university' object type
$I->am('Case 4 : post feed without right of posting in perticular object type after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('post feed without right of posting in perticular object type after login');
$I->sendPost('feeds/add/university',['feed_item' => ['text' => 'Post Text','type' => 'post','is_anonymous' => 'true'],'post_faculty' => '1','post_campus' => '12','post_is_international' => '1','post_year'=>'1','pinning_date'=>'26/05/2015']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');

//-ve
$I->am('Case 5 : post feed without post text after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('post feed without post text after login');
$I->sendPost('feeds/add/club',['feed_item' => ['type' => 'post','is_anonymous' => 'true'],'post_faculty' => '1','post_campus' => '12','post_is_international' => '1','post_year'=>'1','pinning_date'=>'26/05/2015']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');

//+ve
$I->am('Case 6 : poll type feeds/add after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('poll type feeds/add after login');
$I->sendPost('feeds/add/club',['feed_item' => ['text' => 'poll Text','type' => 'poll','poll_answers' => ['Poll option 1','Poll option 2']],'is_anonymous' => 'true']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
//
$data=$I->getArrayFromJson($I);
$poll_options_id=$data['response']['poll_options_id'][0];
//
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept3.json');

//-ve
$I->am('Case 7 : poll type feeds/add without poll_answer after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('poll type feeds/add without poll_answer after login');
$I->sendPost('feeds/add/club',['feed_item' => ['text' => 'poll Text','type' => 'poll'],'is_anonymous' => 'true']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');

//-ve
$I->am('Case 8 : poll type feeds/add without poll_answer as array after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('poll type feeds/add without poll_answer as array after login');
$I->sendPost('feeds/add/club',['feed_item' => ['text' => 'poll Text','type' => 'poll','poll_answers' => 'Poll option 1'],'is_anonymous' => 'true']);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');

//+ve
$I->am('Case 9 : post link after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('post link after login with Email & Password');
$I->sendPost('feeds/add/club',['feed_item' => ['text' => 'link Text', 'type' => 'link', 'is_anonymous' => 'true'],'post_faculty' => '1','post_campus' => '12','post_is_international' => '1','post_year'=>'1','pinning_date'=>'26/05/2015']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept4.json');

//-ve
$I->am('Case 10 : post comment withour params after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('post comment withour params after login');
$I->sendPost('feeds/comments',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');

//+ve
$I->am('Case 12 : post comment after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('post comment after login');
$I->sendPost('feeds/comments/'.$post_id.'/add',["text" => "This is text", "object_type" => "club","object_id" => "0"]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
//
$data=$I->getArrayFromJson($I);
$comment_id=$data['response']['comment_id'];
//
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept5.json');

//-ve
$I->am('Case 13 : post comment with object_type wrong  after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('post comment with object_type wrong  after login');
$I->sendPost('feeds/comments/'.$post_id.'/add',["text" => "This is text", "object_type" => "club1","object_id" => "0"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');

//-ve
$I->am('Case 14 : post comment with object_id wrong  after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('post comment with object_id wrong  after login');
$I->sendPost('feeds/comments/'.$post_id.'/add',["text" => "This is text", "object_type" => "club","object_id" => "10"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');

//-ve
$I->am('Case 15 : post comment with feed_post_id not valid after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('post comment with feed_post_id not valid after login');
$I->sendPost('feeds/comments/168311111111/add',["text" => "This is text", "object_type" => "club","object_id" => "10"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');

//+ve
$I->am('Case 16 : edit comment after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit comment after login');
$I->sendPost('feeds/comments/'.$comment_id.'/edit',["text" => "This is text", "object_type" => "club","object_id" => "0"]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept5.json');

//-ve
$I->am('Case 17 : edit comment with blank text after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit comment with blank text after login');
$I->sendPost('feeds/comments/'.$comment_id.'/edit',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');

//-ve
$I->am('Case 18 : edit comment with not valid comment_id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit comment with not valid comment_id after login');
$I->sendPost('feeds/comments/5599999999/edit',["text" => "This is text", "object_type" => "club","object_id" => "0"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');

//-ve
$I->am('Case 19 : edit comment after login with other user then creator of comment');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('edit comment after login with other user then creator of comment');
$I->sendPost('feeds/comments/55/edit',["text" => "This is text", "object_type" => "club","object_id" => "0"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');

//-ve
$I->am('Case 20 : delete comment after login with other user then creator of comment');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('delete comment after login with other user then creator of comment');
$I->sendPost('feeds/comments/55/delete',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');

//-ve
$I->am('Case 21 : delete comment after login with wrong comment id');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('delete comment after login with wrong comment id');
$I->sendPost('feeds/comments/55/delete',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');

//+ve
$I->am('Case 11 : delete comment after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('delete comment after login');
$I->sendPost('feeds/comments/'.$comment_id.'/delete',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');


//+ve
$I->am('Case 22 : like post after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('like post after login');
$I->sendPost('feeds/posts/'.$post_id.'/like',["object_type" => "club","object_id" => "0"]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept6.json');

//-ve
$I->am('Case 23 : like post with wrong object_type after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('like post with wrong object_type after login');
$I->sendPost('feeds/posts/'.$comment_id.'/like',["object_type" => "club1","object_id" => "0"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');

//-ve
$I->am('Case 24 : like post with wrong object_id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('like post with wrong object_id after login');
$I->sendPost('feeds/posts/'.$comment_id.'/like',["object_type" => "club","object_id" => "1"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');

//+ve
$I->am('Case 29 : report post after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('report post after login');
$I->sendPost('feeds/posts/'.$post_id.'/report',["object_type" => "club","object_id" => "0"]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');



//+ve
$I->am('Case 35 : get comments of post after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get comments of post after login');
$I->sendPost('feeds/posts/'.$post_id.'/comments',["object_type" => "club","object_id" => "0"]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept7.json');


//+ve
$I->am('Case 36 : get comments of post with pages after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('get comments of post with pages after login');
$I->sendPost('feeds/posts/'.$post_id.'/comments',["object_type" => "club","object_id" => "0"]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept7.json');


//+ve
$I->am('Case 25 : delete post after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('delete post after login');
$I->sendPost('feeds/posts/'.$post_id.'/delete',["object_type" => "club","object_id" => "0"]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');


//-ve
$I->am('Case 26 : delete post of created by other user after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('delete post of created by other user after login');
$I->sendPost('feeds/posts/1776/delete',["object_type" => "club","object_id" => "0"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');

//-ve
$I->am('Case 27 : delete post with wrong object_type after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('delete post with wrong object_type after login');
$I->sendPost('feeds/posts/1776/delete',["object_type" => "club1","object_id" => "0"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');

//-ve
$I->am('Case 28 : delete post with wrong object_id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('delete post with wrong object_id after login');
$I->sendPost('feeds/posts/1776/delete',["object_type" => "club","object_id" => "1"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');


 

//-ve
$I->am('Case 30 : report post already reported after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('report post already reported after login');
$I->sendPost('feeds/posts/'.$post_id.'/report',["object_type" => "club","object_id" => "0"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');

//-ve
$I->am('Case 31 : report post already reported with wrong object_type after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('report post already reported with wrong object_type after login');
$I->sendPost('feeds/posts/'.$post_id.'/report',["object_type" => "club1","object_id" => "0"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');

//-ve
$I->am('Case 32 : report post already reported with wrong object_id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('report post already reported with wrong object_id after login');
$I->sendPost('feeds/posts/'.$post_id.'/report',["object_type" => "club1","object_id" => "0"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');

//-ve
$I->am('Case 33 : report post with wrong object_type after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('report post already reported with wrong object_type after login');
$I->sendPost('feeds/posts/'.$post_id.'/report',["object_type" => "club1","object_id" => "0"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');

//-ve
$I->am('Case 34 : report post with wrong object_id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('report post already reported with wrong object_id after login');
$I->sendPost('feeds/posts/'.$post_id.'/report',["object_type" => "club1","object_id" => "0"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');


//+ve
$I->am('Case 37 : fetching feeds list after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('fetching feeds list after login');
$I->sendPost('feeds/list/club/0',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();

//-ve
$I->am('Case 38 : fetching feeds list with wrong feed_object after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('fetching feeds list with wrong feed_object after login');
$I->sendPost('feeds/list/club1/0',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();

//+ve
$I->am('Case 39 : fetching feeds list with wrong feed_object_id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('fetching feeds list with wrong feed_object_id after login');
$I->sendPost('feeds/list/club/1',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept9.json');

//+ve
$I->am('Case 40 : fetching feeds list with paging after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('fetching feeds list with paging after login');
$I->sendPost('feeds/list/club/0/page/1',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();





//+ve
$I->am('Case 42 : fetching feeds list with search after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('fetching feeds list with search after login');
$I->sendPost('feeds/list/club/0',["search_term" => "post"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();


//+ve
$I->am('Case 44 : fetching feeds list For UCROO News after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('fetching feeds list For UCROO News after login');
$I->sendPost('feeds/list/university_rss/16/page/1',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept9.json');

//-ve
$I->am('Case 45 : For adding a poll answer with no permission after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('For adding a poll answer with no permission after login');
$I->sendPost('feeds/poll_answers/',["object_type" => "club","id"=>'204',"object_id"=>"0"]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');

//+ve
$I->am('Case 46 : For adding a poll answer after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('For adding a poll answer after login');
$I->sendPost('feeds/poll_answers/',["object_type" => "club","id"=>$poll_options_id,"object_id"=>"0"]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept10.json');


$study_group_id = $I->getDataFromDbCustom($I,'study_group','id',array());


// +ve
$I->am('Case 47 : To subscribe for university feed after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
//to get uni id
$data=$I->getArrayFromJson($I);
$uni_id=$data['response']['eduInstitution']['id'];
$I->wantTo('To subscribe for university feed after login');
$I->sendGet('/feeds/subscription/follow/university/'.$uni_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('EventCept0.json');


// +ve
$I->am('Case 48 : To Unsubscribe for university feed after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
//to get uni id
$data=$I->getArrayFromJson($I);
$uni_id=$data['response']['eduInstitution']['id'];
$I->wantTo('To Unsubscribe for university feed after login');
$I->sendGet('/feeds/subscription/unfollow/university/'.$uni_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('EventCept0.json');



// -ve
$I->am('Case 49 : To subscribe for university with uni_id as string feed after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To subscribe for university with uni_id as string feed after login');
$I->sendGet('/feeds/subscription/follow/university/aaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('EventCept0.json');


// -ve
$I->am('Case 50 : To Unsubscribe for university with uni_id as string feed after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Case 50 : To Unsubscribe for university with uni_id as string feed after login');
$I->sendGet('/feeds/subscription/unfollow/university/aaaaaaaa',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('EventCept0.json');


// -ve
// failing
$I->am('Case 51 : To subscribe for university without uni_id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To subscribe for university without uni_id after login');
$I->sendGet('/feeds/subscription/follow/university/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');


// -ve
// failing
$I->am('Case 52 : To Unsubscribe for university without uni_id after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('To Unsubscribe for university without uni_id after login');
$I->sendGet('/feeds/subscription/unfollow/university/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');


//-ve
// failing
$I->am('Case 54 : To get details flag details for subscription with feed listing without param after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
//to get uni id
$data=$I->getArrayFromJson($I);
$uni_id=$data['response']['eduInstitution']['id'];
$I->wantTo('To get details flag details for subscription with feed listing without param after login');
$I->sendPost('/feeds/list/university/',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept2.json');



$I->am('Case 53 : To get details flag details for subscription with feed listing after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
//to get uni id
$data=$I->getArrayFromJson($I);
$uni_id=$data['response']['eduInstitution']['id'];
$I->wantTo('To get details flag details for subscription with feed listing after login');
$I->sendPost('/feeds/list/university/'.$uni_id,[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('FeedsCept12.json');