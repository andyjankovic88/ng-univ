<?php
use \ApiTester;

class FeedsCest
{
    public function _before(ApiTester $I)
    {
        
    }

    public function _after(ApiTester $I)
    {
    }

    /**
    * @group student
    * @group_id 2
    */
    public function testAddPostStudent(ApiTester $I)
    {
        $I->login($I, 2);
        $this->_prepare_add_request($I, 'student');
    }

    public function testListPostStudent(ApiTester $I)
    {
        $I->login($I, 2);
        $this->_list_post($I, 'student');
    }


    /**
    * @group academic
    * @group_id 3
    */
    public function testAddPostAcademic(ApiTester $I)
    {
        $I->login($I, 3);
        $this->_prepare_add_request($I, 'academic');
    }

    public function testListPostAcademic(ApiTester $I)
    {
        $I->login($I, 3);
        $this->_list_post($I, 'academic');
    }

    /**
    * @group staff
    * @group_id 4
    */
    public function testAddPostStaff(ApiTester $I)
    {
        $I->login($I, 4);
        $this->_prepare_add_request($I, 'staff');
    }

    public function testListPostStaff(ApiTester $I)
    {
        $I->login($I, 4);
        $this->_list_post($I, 'staff');
    }

    /**
    * @group unadmin
    * @group_id 5
    */
    public function testAddPostUnadmin(ApiTester $I)
    {
        $I->login($I, 5);
        $this->_prepare_add_request($I, 'unadmin');
    }

    public function testListPostUnadmin(ApiTester $I)
    {
        $I->login($I, 5);
        $this->_list_post($I, 'unadmin');
    }


    /**
     * Add a new post
     * @param [object] $I           
     * @param [string] $object_type 
     * @param [int] $object_id   
     * @param [string] $user_group  
     */
    private function _add_new_post($I, $object_type, $object_id, $user_group){

        $I->am($user_group.' I add a new post in '.$object_type);
        $I->sendPost('feeds/add/'.$object_type.'/'.$object_id,['feed_item' => ['text' => 'Post Text', 'type' => 'post']]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        
        $I->canSeeResponseIsValidOnSchemaFile('FeedsCept1.json');

    }

    /**
     * Prepare the data for adding a new post
     * @param  [object] $I          
     * @param  [string] $group_name 
     */
    private function _prepare_add_request($I, $group_name){

        $data=$I->getArrayFromJson($I);
        
        $object_id= @$data['response']['mainMenu']['study_group'][0]['id'];

        if($object_id){
            $this->_add_new_post($I, 'study_group', $object_id, $group_name);
        }

        $object_id2= @$data['response']['mainMenu']['service_page'][0]['id'];

        if($object_id2){
            $this->_add_new_post($I, 'service_page', $object_id2, $group_name);
        }

        $object_id3= @$data['response']['mainMenu']['unit'][0]['id'];

        if($object_id3){
            $this->_add_new_post($I, 'unit', $object_id3, $group_name);
        }

        $object_id4= @$data['response']['mainMenu']['mentors'][0]['id'];

        if($object_id4){
            $this->_add_new_post($I, 'mentors', $object_id4, $group_name);
        }

        $object_id5= @$data['response']['mainMenu']['customgroups'][0]['id'];

        if($object_id5){
            $this->_add_new_post($I, 'customgroups', $object_id5, $group_name);
        }

        $object_id6= @$data['response']['mainMenu']['club'][0]['id'];

        if($object_id5){
            $this->_add_new_post($I, 'club', $object_id5, $group_name);
        }

    }
  
    private function _list_post(ApiTester $I, $group_name){

        $data=$I->getArrayFromJson($I);
        $I->wantTo('fetching feeds list as a '.$group_name);
        $id= @$data['response']['mainMenu']['study_group'][0]['id'];
        if($id){
            $I->am($group_name. ' i am listing study group');
            $I->sendPost('feeds/list/study_group/'.$id,[]);
            $I->seeResponseCodeIs(200);
            $I->seeResponseIsJson();
            $I->canSeeResponseIsValidOnSchemaFile('FeedsCept12.json');

            //Like Post
            $data=$I->getArrayFromJson($I);
            $post_id = @$data['response']['posts'][0]['id'];
            $this->_like_post($I,'study_group',$group_name, $post_id);
        }

        $id2= @$data['response']['mainMenu']['service_page'][0]['id'];
        if($id2){
            $I->am($group_name. ' i am listing service_page feed');
            $I->sendPost('feeds/list/service_page/'.$id2,[]);
            $I->seeResponseCodeIs(200);
            $I->seeResponseIsJson();
            $I->canSeeResponseIsValidOnSchemaFile('FeedsCept12.json');

            //Like Post
            $data=$I->getArrayFromJson($I);
            $post_id = @$data['response']['posts'][0]['id'];
            $this->_like_post($I,'service_page',$group_name, $post_id);
        }

        $id3= @$data['response']['mainMenu']['unit'][0]['id'];
        if($id3){
            $I->am($group_name. ' i am listing classes feed');
            $I->sendPost('feeds/list/unit/'.$id3,[]);
            $I->seeResponseCodeIs(200);
            $I->seeResponseIsJson();
            $I->canSeeResponseIsValidOnSchemaFile('FeedsCept12.json');

            //Like Post
            $data=$I->getArrayFromJson($I);
            $post_id = @$data['response']['posts'][0]['id'];
            $this->_like_post($I,'classes',$group_name, $post_id);
        }

        $id4= @$data['response']['mainMenu']['mentors'][0]['id'];
        if($id4){
            $I->am($group_name. ' i am listing mentors feed');
            $I->sendPost('feeds/list/mentors/'.$id4,[]);
            $I->seeResponseCodeIs(200);
            $I->seeResponseIsJson();
            $I->canSeeResponseIsValidOnSchemaFile('FeedsCept12.json');

            //Like Post
            $data=$I->getArrayFromJson($I);
            $post_id = @$data['response']['posts'][0]['id'];
            $this->_like_post($I,'mentors',$group_name, $post_id);
        }

        $id5= @$data['response']['mainMenu']['customgroups'][0]['id'];
        if($id5){
            $I->am($group_name. ' i am listing customgroups feed');
            $I->sendPost('feeds/list/customgroups/'.$id5,[]);
            $I->seeResponseCodeIs(200);
            $I->seeResponseIsJson();
            $I->canSeeResponseIsValidOnSchemaFile('FeedsCept12.json');

            //Like Post
            $data=$I->getArrayFromJson($I);
            $post_id = @$data['response']['posts'][0]['id'];
            $this->_like_post($I,'customgroups',$group_name, $post_id);
        }

        $id6= @$data['response']['mainMenu']['club'][0]['id'];
        if($id6){
            $I->am($group_name. ' i am listing club feed');
            $I->sendPost('feeds/list/club/'.$id6,[]);
            $I->seeResponseCodeIs(200);
            $I->seeResponseIsJson();
            $I->canSeeResponseIsValidOnSchemaFile('FeedsCept12.json');

            //Like Post
            $data=$I->getArrayFromJson($I);
            $post_id = @$data['response']['posts'][0]['id'];
            $this->_like_post($I,'club',$group_name, $post_id);

            
        }

        $id7= @$data['response']['mainMenu']['student_news']['id'];
        if($id7){
            $I->am($group_name. ' i am listing ucroo news feed');
            $I->sendPost('feeds/list/university_rss/'.$id7,[]);
            $I->seeResponseCodeIs(200);
            $I->seeResponseIsJson();
            $I->canSeeResponseIsValidOnSchemaFile('UniversityRSSFeedsCept.json');
            
            //Like Post
            $data=$I->getArrayFromJson($I);
            $post_id = @$data['response']['posts'][0]['id'];
            $this->_like_post($I,'ucroo news',$group_name, $post_id);
        }
    }

    /**
     * Like a feed post
     */
    private function _like_post(ApiTester $I, $feed_object, $group_name, $post_id=null){
        

        if($post_id){
            $I->am($group_name. ' i have liked a '.$feed_object.' feed');
            $I->sendPost('feeds/posts/'.$post_id.'/like',[]);
            $I->seeResponseCodeIs(200);
            $I->seeResponseIsJson();
            $I->canSeeResponseIsValidOnSchemaFile('FeedsCept6.json');
        }
    }

}
