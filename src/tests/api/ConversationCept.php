<?php
$I = new ApiTester($scenario);
$user_email = $I->getDataFromDbCustom($I,'users','email',array('group_id'=>'2'));
$user_password = 'ucroo123';

//+ve
$I->am('Case 1 : Get Messages after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Get message after Login with Email & Password');
$I->sendGet('conversation/messages',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ConversationCept1.json');

//+ve
$I->am('Case 2 : Get Messages of perticular conversation after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Get Messages of perticular conversation after login with Email & Password');
$I->sendGet('conversation/messages/124',[]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ConversationCept2.json');

//+ve
$I->am('Case 3 : Mark a particular conversation as read after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Mark a particular conversation as read after Login with Email & Password');
$I->sendGet('conversation/read',['conversation_id' => '124']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ConversationCept3.json');

//-ve
$I->am('Case 4 : Post Messages without text after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Post Messages without text after Login with Email & Password');
$I->sendPost('conversation/message',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ConversationCept4.json');

//+ve
$I->am('Case 5 : Posting a New Message / Thread after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Posting a New Message / Thread after Login with Email & Password');
$I->sendPost('conversation/message',['text' => 'Posting a New Message', 'recipient[0]' => '18', 'recipient[1]' => '19']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ConversationCept5.json');

//+ve
$I->am('Case 6 : Posting a Message in Existing Conversation / Thread after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Posting a Message in Existing Conversation / Thread after Login with Email & Password');
$I->sendPost('conversation/message/124',['text' => 'Posting a Message in Existing Conversation', 'recipient[0]' => '2', 'recipient[1]' => '3']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ConversationCept5.json');

//-ve
$I->am('Case 7 : Adding a File Attachment to a Message without file after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Adding a File Attachment to a Message without file after Login with Email & Password');
$I->sendPost('conversation/message_attachment',[]);
$I->seeResponseCodeIs(400);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ConversationCept7.json');

//+ve
$I->am('Case 8 : Adding a File Attachment to a Message after login');
$I->wantTo('Login with Email & Password');
$I->sendPost('user_login',['email' => $user_email, 'password' => $user_password]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->wantTo('Adding a File Attachment to a Message after Login with Email & Password');
$I->sendPost('conversation/message_attachment',[],['userfile' => [
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('myFile.jpg')),
            'tmp_name' => codecept_data_dir('myFile.jpg'),
        ]]);
//myFile.jpg  is physically put at tests/_data/myFile.jpg
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile('ConversationCept8.json');




