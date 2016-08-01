<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = null)
 *
 * @SuppressWarnings(PHPMD)
*/
class UnitTester extends \Codeception\Actor
{
    use _generated\UnitTesterActions;

   /**
    * Define custom actions here
    */

   /**
    * Get an random active user for testing
    * @param  [int] $group_id
    * @param  [int] $uni_id
    * @return [int]
    */
   public function get_random_active_user($group_id=null, $uni_id=null){
   		$CI =& get_instance();
   		$CI->db->select('id')
   		       ->from('users')
   		       ->where('active', 1);
   		if($group_id)
   			$CI->db->where('group_id', $group_id);

   		if($uni_id)
   			$CI->db->where('uni_id', $uni_id);

   		$CI->db->order_by('id', 'RANDOM');
   		$CI->db->order_by('id', 'ASC');

   		$query = $CI->db->get();
  
  		$result = $query->row();
  		return $result->id;
   }
}
