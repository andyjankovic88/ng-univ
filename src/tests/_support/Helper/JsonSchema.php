<?php
namespace Helper;

/**
* Json schema module for codeception
* @author  Pratik
* This file will take json schema file from the tests/json_schema folder
*/
class JsonSchema extends \Codeception\Module
{
    /**
    *  Validate response by json schema
    *
    *  @param string $schema path to json schema file
    */
    public function canSeeResponseIsValidOnSchemaFile($schema)
    {
        require_once APPPATH . 'third_party/json_validator/vendor/autoload.php';
        $schemaPath = FCPATH.'tests/json_schema/'.$schema;
       
        $retriever = new \JsonSchema\Uri\UriRetriever();
        $schema = $retriever->retrieve('file://' .$schemaPath);
        $refResolver = new \JsonSchema\RefResolver($retriever);
        $refResolver->resolve($schema, 'file://' . $schemaPath);
        $response = $this->getModule('REST')->response;
        $validator = new \JsonSchema\Validator();
        $validator->setUriRetriever(new \JsonSchema\Uri\UriRetriever());
        $validator->check(json_decode($response), $schema);
        $message = '';
        $isValid = $validator->isValid(); 
        if (! $isValid) {
            $message = "JSON does not validate. Violations:\n";
            foreach ($validator->getErrors() as $error) {
                $message .= $error['property']." ".$error['message'].PHP_EOL;
            }
        }
        $this->assertTrue($isValid, $message);
    }


    /**
    *  Get specified field from db randomly
    *
    *  @param string $object object of 
    *  @param string $table name of table
    *  @param string $field name of table field
    *  @param string $where array of where clause
    */
    public function getDataFromDbCustom($object,$table,$field,$where)
    {   
        $CI =& get_instance();
        $CI->db->select($field)
               ->from($table);
        
        if($table=='users')       
            $CI->db->where('active', 1);

        if($where)
            $CI->db->where($where);

        $CI->db->order_by('id', 'RANDOM');

        $query = $CI->db->get();
  
        $result = $query->row();
        return $result->$field;

        //return $object->grabFromDatabase($table, $field, $where);
    }


    public function getArrayFromJson($I){
        $response = $I->grabResponse();
        $response_string = (string)$response;
        $json = json_decode($response_string, true);
        return $json;
    }

    /**
    *  Validate two string comparision
    *
    *  @param string $compare1 string one to compare
    *  @param string $compare2 string two to compare
    */
    public function compareString($compare1,$compare2)
    {   
        $this->assertEquals($compare1, $compare2);
    }


    /**
    *  Validate two string comparision
    *
    *  @param string $len lenght of string
    */
    function randStrGen($len){
        $result = "";
        $chars = "abcdefghijklmnopqrstuvwxyz?!-0123456789";
        $charArray = str_split($chars);
        for($i = 0; $i < $len; $i++){
                $randItem = array_rand($charArray);
                $result .= "".$charArray[$randItem];
        }
        return $result;
    }

    /**
     * General Function to perform login
     * @param  [object] $I        [API Tester Object]
     * @param  [int] $group_id [Users group_id]
     */
    public function login($I, $group_id=null){
            

        $password='ucroo123';

        if(!isset($group_id) || $group_id==''){
            $group_id = $this->_get_random_group_id();
        }

        $email = $this->getDataFromDbCustom($I,'users','email',array('group_id'=>$group_id));

        $group_name = $this->getGroupName($group_id);
        //+ve
        $I->am($group_name.' user');
        $I->wantTo('Login with Email & Password as a '.$group_name);
        $I->sendPost('user_login',['email' => $email, 'password' => $password]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->canSeeResponseIsValidOnSchemaFile('LoginCept.json');

    }

    /**
     * Get group name from group id
     * @param  [int] $group_id
     * @return [string]
     */
    public function getGroupName($group_id){
        
        $array = array(
            1=> 'admin',
            2=> 'student',
            3=> 'academic',
            4=> 'staff',
            5=> 'unadmin'
        );

        return $array[$group_id];
    }

    /**
     * Get random group id
     * @return [int]
     */
    private function _get_random_group_id(){
        $group_ids = array(1,2,3,4,5);

        $selected = array_rand($group_ids, 1);

        return $group_ids[$selected];
    }


}