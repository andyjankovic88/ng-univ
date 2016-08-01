	<?php
/*
 * Used to created model stubs
 * 
 * EXAMPLE USAGE:
 * CL#: php create_model.php
 * Object Model Creator
 * ---------------------
 * usage:
 * create_model.php <tablename>
 * e.g php create_model.php table_name
 */

//define('BASEPATH', dirname(dirname($_SERVER['PHP_SELF'])));
define('BASEPATH', "..");


include(BASEPATH.'/application/config/database.php');

echo "\nObject Model Creator\n---------------------\n";

if(count($argv) < 2)
	die("usage:\n{$argv[0]} <tablename>\n");

function map_datatype($mysql_type)
{
	$map['integer'] = array('int');	
	$map['string'] = array('char', 'enum', 'text');
	$map['string'] = array('blob','mediumblob');
	$map['float'] = array('double', 'float', 'numeric', 'decimal');
	$map['datetime'] = array('datetime','timestamp','date','time');
	
	foreach($map as $type => $my_types)
	{
		foreach($my_types as $my_type)
		{
			if(strstr($mysql_type, $my_type))
				return $type;
		}
	}
}

function set_default($type, $default)
{
	if(gettype($default) == 'NULL')
		return 'null';
	if($type == 'string')
		return '\''.$default.'\'';
	if($type == 'int' && $default === '')
		return '\'\'';
	return $default;
}

$link = mysql_connect($db['default']['hostname'], $db['default']['username'], $db['default']['password']);
mysql_query('use '.$db['default']['database'], $link);

$sql = "SHOW FIELDS FROM {$argv[1]}";
$result = mysql_query($sql, $link);
if(!$result)
	die("Could not find table in database\n");
$fields = array();
while($row = mysql_fetch_array($result))
{
	$fields[$row['Field']] = array(map_datatype($row['Type']), $row['Default']);
}

$upper = ucwords($argv[1]);

$outstring = '<?php
/**
 * '.$upper.'Model
 * auto generated via create_model.php
 * on '.date('jS \of F Y').'
 */
 
 namespace models;
 use Doctrine\ORM\EntityRepository; 
 
/**
 * @Entity
 * @Entity(repositoryClass="models\\'.ucfirst($argv[1]).'Repository") 
 * @Table(name="'.$argv[1].'")
 */ 
class '.$upper.'
{';

foreach($fields as $key => $meta)
{
	$outstring .= '
	/**';
	if($key == 'id')	{
		$outstring .= ' 
	* @Id';
	}
	$outstring .= '
	* @Column(type="'.$meta[0].'")';
	if($key == 'id')	{
		$outstring .= '
	* @GeneratedValue(strategy="AUTO")';
	}
	$outstring .= '
	*/
	private $'.$key.';
	';
		
		//\''.$key.'\' => array(\'type\' => \''.$meta[0].'\', \'default\' => '.set_default($meta[0], $meta[1]).'),';
}
//$outstring = substr($outstring, 0, -1);

$outstring .=  '



';

foreach($fields as $key => $meta)
{
	$outstring .= '
	public function get'.ucfirst($key).'() 
	{
	  return $this->'.$key.';
	}
	
	public function set'.ucfirst($key).'($value) 
	{
	  $this->'.$key.' = $value;
	}
	';
		
		//\''.$key.'\' => array(\'type\' => \''.$meta[0].'\', \'default\' => '.set_default($meta[0], $meta[1]).'),';
}

$outstring .=  '
}

class '.ucfirst($argv[1]).'Repository extends EntityRepository 
{



}
?>';

if(mysql_num_rows($result) > 0)
{
	if(($fout = @fopen(BASEPATH.'/application/models/'.$upper.'.php', 'x')) === FALSE)
	{
		if(($fout = @fopen(BASEPATH.'/application/models/'.$argv[1].'model_new.php', 'x')) === FALSE)
	        die("cannot create model, it already exsits, so does the _new one\n");
	}
    if (fwrite($fout, $outstring) === FALSE) 
        die("Cannot write to model\n");
    fclose($fout);
    echo "Model Created\n";	
}
?>
