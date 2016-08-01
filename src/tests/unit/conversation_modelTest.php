<?php


class conversation_modelTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('conversation_model');
        $this->obj = $this->CI->conversation_model;
        
        $this->user_id = $this->tester->get_random_active_user();
        
    }

    protected function _after()
    {
    }

    // Sample Test for getting all conversation id's
    public function test_get_all_conversation_ids()
    {   
        $conversation_ids = $this->obj->get_all_conversation_ids($this->user_id);
        $count = count($conversation_ids);
        $this->assertGreaterThanOrEqual(0, $count, "Total Conversation : ".$count);
        $this->assertNotNull($conversation_ids, "conversation_ids is null");
    }
}