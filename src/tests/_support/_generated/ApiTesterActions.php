<?php  //[STAMP] 79bba6e5f20e310bf4b104b253bad7cd
namespace _generated;

// This class was automatically generated by build task
// You should not change it manually as it will be overwritten on next build
// @codingStandardsIgnoreFile

use Helper\Api;
use Helper\JsonSchema;
use Codeception\Module\Db;
use Codeception\Module\REST;

trait ApiTesterActions
{
    /**
     * @return \Codeception\Scenario
     */
    abstract protected function getScenario();

    
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     *  Validate response by json schema
    *
    *  @param string $schema path to json schema file
     * @see \Helper\JsonSchema::canSeeResponseIsValidOnSchemaFile()
     */
    public function canSeeResponseIsValidOnSchemaFile($schema) {
        return $this->getScenario()->runStep(new \Codeception\Step\Action('canSeeResponseIsValidOnSchemaFile', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     *  Get specified field from db randomly
    *
    *  @param string $object object of 
    *  @param string $table name of table
    *  @param string $field name of table field
    *  @param string $where array of where clause
     * @see \Helper\JsonSchema::getDataFromDbCustom()
     */
    public function getDataFromDbCustom($object, $table, $field, $where) {
        return $this->getScenario()->runStep(new \Codeception\Step\Action('getDataFromDbCustom', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     *
     * @see \Helper\JsonSchema::getArrayFromJson()
     */
    public function getArrayFromJson($I) {
        return $this->getScenario()->runStep(new \Codeception\Step\Action('getArrayFromJson', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Inserts SQL record into database. This record will be erased after the test.
     *
     * ``` php
     * <?php
     * $I->haveInDatabase('users', array('name' => 'miles', 'email' => 'miles@davis.com'));
     * ?>
     * ```
     *
     * @param       $table
     * @param array $data
     *
     * @return integer $id
     * @see \Codeception\Module\Db::haveInDatabase()
     */
    public function haveInDatabase($table, $data) {
        return $this->getScenario()->runStep(new \Codeception\Step\Action('haveInDatabase', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks if a row with given column values exists.
     * Provide table name and column values.
     *
     * Example:
     *
     * ``` php
     * <?php
     * $I->seeInDatabase('users', array('name' => 'Davert', 'email' => 'davert@mail.com'));
     *
     * ```
     * Will generate:
     *
     * ``` sql
     * SELECT COUNT(*) FROM `users` WHERE `name` = 'Davert' AND `email` = 'davert@mail.com'
     * ```
     * Fails if no such user found.
     *
     * @param       $table
     * @param array $criteria
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Module\Db::seeInDatabase()
     */
    public function canSeeInDatabase($table, $criteria = null) {
        return $this->getScenario()->runStep(new \Codeception\Step\ConditionalAssertion('seeInDatabase', func_get_args()));
    }
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks if a row with given column values exists.
     * Provide table name and column values.
     *
     * Example:
     *
     * ``` php
     * <?php
     * $I->seeInDatabase('users', array('name' => 'Davert', 'email' => 'davert@mail.com'));
     *
     * ```
     * Will generate:
     *
     * ``` sql
     * SELECT COUNT(*) FROM `users` WHERE `name` = 'Davert' AND `email` = 'davert@mail.com'
     * ```
     * Fails if no such user found.
     *
     * @param       $table
     * @param array $criteria
     * @see \Codeception\Module\Db::seeInDatabase()
     */
    public function seeInDatabase($table, $criteria = null) {
        return $this->getScenario()->runStep(new \Codeception\Step\Assertion('seeInDatabase', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Asserts that found number of records in database
     *
     * ``` php
     * <?php
     * $I->seeNumRecords(1, 'users', ['name' => 'davert'])
     * ?>
     * ```
     *
     * @param int    $num      Expected number
     * @param string $table    Table name
     * @param array  $criteria Search criteria [Optional]
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Module\Db::seeNumRecords()
     */
    public function canSeeNumRecords($num, $table, $criteria = null) {
        return $this->getScenario()->runStep(new \Codeception\Step\ConditionalAssertion('seeNumRecords', func_get_args()));
    }
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Asserts that found number of records in database
     *
     * ``` php
     * <?php
     * $I->seeNumRecords(1, 'users', ['name' => 'davert'])
     * ?>
     * ```
     *
     * @param int    $num      Expected number
     * @param string $table    Table name
     * @param array  $criteria Search criteria [Optional]
     * @see \Codeception\Module\Db::seeNumRecords()
     */
    public function seeNumRecords($num, $table, $criteria = null) {
        return $this->getScenario()->runStep(new \Codeception\Step\Assertion('seeNumRecords', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Effect is opposite to ->seeInDatabase
     *
     * Checks if there is no record with such column values in database.
     * Provide table name and column values.
     *
     * Example:
     *
     * ``` php
     * <?php
     * $I->dontSeeInDatabase('users', array('name' => 'Davert', 'email' => 'davert@mail.com'));
     *
     * ```
     * Will generate:
     *
     * ``` sql
     * SELECT COUNT(*) FROM `users` WHERE `name` = 'Davert' AND `email` = 'davert@mail.com'
     * ```
     * Fails if such user was found.
     *
     * @param       $table
     * @param array $criteria
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Module\Db::dontSeeInDatabase()
     */
    public function cantSeeInDatabase($table, $criteria = null) {
        return $this->getScenario()->runStep(new \Codeception\Step\ConditionalAssertion('dontSeeInDatabase', func_get_args()));
    }
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Effect is opposite to ->seeInDatabase
     *
     * Checks if there is no record with such column values in database.
     * Provide table name and column values.
     *
     * Example:
     *
     * ``` php
     * <?php
     * $I->dontSeeInDatabase('users', array('name' => 'Davert', 'email' => 'davert@mail.com'));
     *
     * ```
     * Will generate:
     *
     * ``` sql
     * SELECT COUNT(*) FROM `users` WHERE `name` = 'Davert' AND `email` = 'davert@mail.com'
     * ```
     * Fails if such user was found.
     *
     * @param       $table
     * @param array $criteria
     * @see \Codeception\Module\Db::dontSeeInDatabase()
     */
    public function dontSeeInDatabase($table, $criteria = null) {
        return $this->getScenario()->runStep(new \Codeception\Step\Assertion('dontSeeInDatabase', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Fetches a single column value from a database.
     * Provide table name, desired column and criteria.
     *
     * Example:
     *
     * ``` php
     * <?php
     * $mail = $I->grabFromDatabase('users', 'email', array('name' => 'Davert'));
     *
     * ```
     *
     * @version 1.1
     *
     * @param       $table
     * @param       $column
     * @param array $criteria
     *
     * @return mixed
     * @see \Codeception\Module\Db::grabFromDatabase()
     */
    public function grabFromDatabase($table, $column, $criteria = null) {
        return $this->getScenario()->runStep(new \Codeception\Step\Action('grabFromDatabase', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Sets HTTP header
     *
     * @param $name
     * @param $value
     * @part json
     * @part xml
     * @see \Codeception\Module\REST::haveHttpHeader()
     */
    public function haveHttpHeader($name, $value) {
        return $this->getScenario()->runStep(new \Codeception\Step\Action('haveHttpHeader', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks over the given HTTP header and (optionally)
     * its value, asserting that are there
     *
     * @param $name
     * @param $value
     * @part json
     * @part xml
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Module\REST::seeHttpHeader()
     */
    public function canSeeHttpHeader($name, $value = null) {
        return $this->getScenario()->runStep(new \Codeception\Step\ConditionalAssertion('seeHttpHeader', func_get_args()));
    }
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks over the given HTTP header and (optionally)
     * its value, asserting that are there
     *
     * @param $name
     * @param $value
     * @part json
     * @part xml
     * @see \Codeception\Module\REST::seeHttpHeader()
     */
    public function seeHttpHeader($name, $value = null) {
        return $this->getScenario()->runStep(new \Codeception\Step\Assertion('seeHttpHeader', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks over the given HTTP header and (optionally)
     * its value, asserting that are not there
     *
     * @param $name
     * @param $value
     * @part json
     * @part xml
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Module\REST::dontSeeHttpHeader()
     */
    public function cantSeeHttpHeader($name, $value = null) {
        return $this->getScenario()->runStep(new \Codeception\Step\ConditionalAssertion('dontSeeHttpHeader', func_get_args()));
    }
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks over the given HTTP header and (optionally)
     * its value, asserting that are not there
     *
     * @param $name
     * @param $value
     * @part json
     * @part xml
     * @see \Codeception\Module\REST::dontSeeHttpHeader()
     */
    public function dontSeeHttpHeader($name, $value = null) {
        return $this->getScenario()->runStep(new \Codeception\Step\Assertion('dontSeeHttpHeader', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that http response header is received only once.
     * HTTP RFC2616 allows multiple response headers with the same name.
     * You can check that you didn't accidentally sent the same header twice.
     *
     * ``` php
     * <?php
     * $I->seeHttpHeaderOnce('Cache-Control');
     * ?>>
     * ```
     *
     * @param $name
     * @part json
     * @part xml
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Module\REST::seeHttpHeaderOnce()
     */
    public function canSeeHttpHeaderOnce($name) {
        return $this->getScenario()->runStep(new \Codeception\Step\ConditionalAssertion('seeHttpHeaderOnce', func_get_args()));
    }
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that http response header is received only once.
     * HTTP RFC2616 allows multiple response headers with the same name.
     * You can check that you didn't accidentally sent the same header twice.
     *
     * ``` php
     * <?php
     * $I->seeHttpHeaderOnce('Cache-Control');
     * ?>>
     * ```
     *
     * @param $name
     * @part json
     * @part xml
     * @see \Codeception\Module\REST::seeHttpHeaderOnce()
     */
    public function seeHttpHeaderOnce($name) {
        return $this->getScenario()->runStep(new \Codeception\Step\Assertion('seeHttpHeaderOnce', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Returns the value of the specified header name
     *
     * @param $name
     * @param Boolean $first Whether to return the first value or all header values
     *
     * @return string|array The first header value if $first is true, an array of values otherwise
     * @part json
     * @part xml
     * @see \Codeception\Module\REST::grabHttpHeader()
     */
    public function grabHttpHeader($name, $first = null) {
        return $this->getScenario()->runStep(new \Codeception\Step\Action('grabHttpHeader', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Adds HTTP authentication via username/password.
     *
     * @param $username
     * @param $password
     * @part json
     * @part xml
     * @see \Codeception\Module\REST::amHttpAuthenticated()
     */
    public function amHttpAuthenticated($username, $password) {
        return $this->getScenario()->runStep(new \Codeception\Step\Condition('amHttpAuthenticated', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Adds Digest authentication via username/password.
     *
     * @param $username
     * @param $password
     * @part json
     * @part xml
     * @see \Codeception\Module\REST::amDigestAuthenticated()
     */
    public function amDigestAuthenticated($username, $password) {
        return $this->getScenario()->runStep(new \Codeception\Step\Condition('amDigestAuthenticated', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Adds Bearer authentication via access token.
     *
     * @param $accessToken
     * @part json
     * @part xml
     * @see \Codeception\Module\REST::amBearerAuthenticated()
     */
    public function amBearerAuthenticated($accessToken) {
        return $this->getScenario()->runStep(new \Codeception\Step\Condition('amBearerAuthenticated', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Sends a POST request to given uri.
     *
     * Parameters and files (as array of filenames) can be provided.
     *
     * @param $url
     * @param array|\JsonSerializable $params
     * @param array $files
     * @part json
     * @part xml
     * @see \Codeception\Module\REST::sendPOST()
     */
    public function sendPOST($url, $params = null, $files = null) {
        return $this->getScenario()->runStep(new \Codeception\Step\Action('sendPOST', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Sends a HEAD request to given uri.
     *
     * @param $url
     * @param array $params
     * @part json
     * @part xml
     * @see \Codeception\Module\REST::sendHEAD()
     */
    public function sendHEAD($url, $params = null) {
        return $this->getScenario()->runStep(new \Codeception\Step\Action('sendHEAD', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Sends an OPTIONS request to given uri.
     *
     * @param $url
     * @param array $params
     * @part json
     * @part xml
     * @see \Codeception\Module\REST::sendOPTIONS()
     */
    public function sendOPTIONS($url, $params = null) {
        return $this->getScenario()->runStep(new \Codeception\Step\Action('sendOPTIONS', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Sends a GET request to given uri.
     *
     * @param $url
     * @param array $params
     * @part json
     * @part xml
     * @see \Codeception\Module\REST::sendGET()
     */
    public function sendGET($url, $params = null) {
        return $this->getScenario()->runStep(new \Codeception\Step\Action('sendGET', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Sends PUT request to given uri.
     *
     * @param $url
     * @param array $params
     * @param array $files
     * @part json
     * @part xml
     * @see \Codeception\Module\REST::sendPUT()
     */
    public function sendPUT($url, $params = null, $files = null) {
        return $this->getScenario()->runStep(new \Codeception\Step\Action('sendPUT', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Sends PATCH request to given uri.
     *
     * @param       $url
     * @param array $params
     * @param array $files
     * @part json
     * @part xml
     * @see \Codeception\Module\REST::sendPATCH()
     */
    public function sendPATCH($url, $params = null, $files = null) {
        return $this->getScenario()->runStep(new \Codeception\Step\Action('sendPATCH', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Sends DELETE request to given uri.
     *
     * @param $url
     * @param array $params
     * @param array $files
     * @part json
     * @part xml
     * @see \Codeception\Module\REST::sendDELETE()
     */
    public function sendDELETE($url, $params = null, $files = null) {
        return $this->getScenario()->runStep(new \Codeception\Step\Action('sendDELETE', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Sends LINK request to given uri.
     *
     * @param       $url
     * @param array $linkEntries (entry is array with keys "uri" and "link-param")
     *
     * @link http://tools.ietf.org/html/rfc2068#section-19.6.2.4
     *
     * @author samva.ua@gmail.com
     * @part json
     * @part xml
     * @see \Codeception\Module\REST::sendLINK()
     */
    public function sendLINK($url, $linkEntries) {
        return $this->getScenario()->runStep(new \Codeception\Step\Action('sendLINK', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Sends UNLINK request to given uri.
     *
     * @param       $url
     * @param array $linkEntries (entry is array with keys "uri" and "link-param")
     * @link http://tools.ietf.org/html/rfc2068#section-19.6.2.4
     * @author samva.ua@gmail.com
     * @part json
     * @part xml
     * @see \Codeception\Module\REST::sendUNLINK()
     */
    public function sendUNLINK($url, $linkEntries) {
        return $this->getScenario()->runStep(new \Codeception\Step\Action('sendUNLINK', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks whether last response was valid JSON.
     * This is done with json_last_error function.
     *
     * @part json
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Module\REST::seeResponseIsJson()
     */
    public function canSeeResponseIsJson() {
        return $this->getScenario()->runStep(new \Codeception\Step\ConditionalAssertion('seeResponseIsJson', func_get_args()));
    }
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks whether last response was valid JSON.
     * This is done with json_last_error function.
     *
     * @part json
     * @see \Codeception\Module\REST::seeResponseIsJson()
     */
    public function seeResponseIsJson() {
        return $this->getScenario()->runStep(new \Codeception\Step\Assertion('seeResponseIsJson', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks whether the last response contains text.
     *
     * @param $text
     * @part json
     * @part xml
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Module\REST::seeResponseContains()
     */
    public function canSeeResponseContains($text) {
        return $this->getScenario()->runStep(new \Codeception\Step\ConditionalAssertion('seeResponseContains', func_get_args()));
    }
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks whether the last response contains text.
     *
     * @param $text
     * @part json
     * @part xml
     * @see \Codeception\Module\REST::seeResponseContains()
     */
    public function seeResponseContains($text) {
        return $this->getScenario()->runStep(new \Codeception\Step\Assertion('seeResponseContains', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks whether last response do not contain text.
     *
     * @param $text
     * @part json
     * @part xml
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Module\REST::dontSeeResponseContains()
     */
    public function cantSeeResponseContains($text) {
        return $this->getScenario()->runStep(new \Codeception\Step\ConditionalAssertion('dontSeeResponseContains', func_get_args()));
    }
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks whether last response do not contain text.
     *
     * @param $text
     * @part json
     * @part xml
     * @see \Codeception\Module\REST::dontSeeResponseContains()
     */
    public function dontSeeResponseContains($text) {
        return $this->getScenario()->runStep(new \Codeception\Step\Assertion('dontSeeResponseContains', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks whether the last JSON response contains provided array.
     * The response is converted to array with json_decode($response, true)
     * Thus, JSON is represented by associative array.
     * This method matches that response array contains provided array.
     *
     * Examples:
     *
     * ``` php
     * <?php
     * // response: {name: john, email: john@gmail.com}
     * $I->seeResponseContainsJson(array('name' => 'john'));
     *
     * // response {user: john, profile: { email: john@gmail.com }}
     * $I->seeResponseContainsJson(array('email' => 'john@gmail.com'));
     *
     * ?>
     * ```
     *
     * This method recursively checks if one array can be found inside of another.
     *
     * @param array $json
     * @part json
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Module\REST::seeResponseContainsJson()
     */
    public function canSeeResponseContainsJson($json = null) {
        return $this->getScenario()->runStep(new \Codeception\Step\ConditionalAssertion('seeResponseContainsJson', func_get_args()));
    }
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks whether the last JSON response contains provided array.
     * The response is converted to array with json_decode($response, true)
     * Thus, JSON is represented by associative array.
     * This method matches that response array contains provided array.
     *
     * Examples:
     *
     * ``` php
     * <?php
     * // response: {name: john, email: john@gmail.com}
     * $I->seeResponseContainsJson(array('name' => 'john'));
     *
     * // response {user: john, profile: { email: john@gmail.com }}
     * $I->seeResponseContainsJson(array('email' => 'john@gmail.com'));
     *
     * ?>
     * ```
     *
     * This method recursively checks if one array can be found inside of another.
     *
     * @param array $json
     * @part json
     * @see \Codeception\Module\REST::seeResponseContainsJson()
     */
    public function seeResponseContainsJson($json = null) {
        return $this->getScenario()->runStep(new \Codeception\Step\Assertion('seeResponseContainsJson', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Returns current response so that it can be used in next scenario steps.
     *
     * Example:
     *
     * ``` php
     * <?php
     * $user_id = $I->grabResponse();
     * $I->sendPUT('/user', array('id' => $user_id, 'name' => 'davert'));
     * ?>
     * ```
     *
     * @version 1.1
     * @return string
     * @part json
     * @part xml
     * @see \Codeception\Module\REST::grabResponse()
     */
    public function grabResponse() {
        return $this->getScenario()->runStep(new \Codeception\Step\Action('grabResponse', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Returns data from the current JSON response using [JSONPath](http://goessner.net/articles/JsonPath/) as selector.
     * JsonPath is XPath equivalent for querying Json structures. Try your JsonPath expressions [online](http://jsonpath.curiousconcept.com/).
     * Even for a single value an array is returned.
     *
     * This method **require [`flow/jsonpath` > 0.2](https://github.com/FlowCommunications/JSONPath/) library to be installed**.
     *
     * Example:
     *
     * ``` php
     * <?php
     * // match the first `user.id` in json
     * $firstUser = $I->grabDataFromJsonResponse('$..users[0].id');
     * $I->sendPUT('/user', array('id' => $firstUser[0], 'name' => 'davert'));
     * ?>
     * ```
     *
     * @param $jsonPath
     * @return array
     * @version 2.0.9
     * @throws \Exception
     * @part json
     * @see \Codeception\Module\REST::grabDataFromResponseByJsonPath()
     */
    public function grabDataFromResponseByJsonPath($jsonPath) {
        return $this->getScenario()->runStep(new \Codeception\Step\Action('grabDataFromResponseByJsonPath', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks if json structure in response matches the xpath provided.
     * JSON is not supposed to be checked against XPath, yet it can be converted to xml and used with XPath.
     * This assertion allows you to check the structure of response json.
     *     *
     * ```json
     *   { "store": {
     *       "book": [
     *         { "category": "reference",
     *           "author": "Nigel Rees",
     *           "title": "Sayings of the Century",
     *           "price": 8.95
     *         },
     *         { "category": "fiction",
     *           "author": "Evelyn Waugh",
     *           "title": "Sword of Honour",
     *           "price": 12.99
     *         }
     *    ],
     *       "bicycle": {
     *         "color": "red",
     *         "price": 19.95
     *       }
     *     }
     *   }
     * ```
     *
     * ```php
     * <?php
     * // at least one book in store has author
     * $I->seeResponseJsonMatchesXpath('//store/book/author');
     * // first book in store has author
     * $I->seeResponseJsonMatchesXpath('//store/book[1]/author');
     * // at least one item in store has price
     * $I->seeResponseJsonMatchesXpath('/store//price');
     * ?>
     * ```
     * @part json
     * @version 2.0.9
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Module\REST::seeResponseJsonMatchesXpath()
     */
    public function canSeeResponseJsonMatchesXpath($xpath) {
        return $this->getScenario()->runStep(new \Codeception\Step\ConditionalAssertion('seeResponseJsonMatchesXpath', func_get_args()));
    }
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks if json structure in response matches the xpath provided.
     * JSON is not supposed to be checked against XPath, yet it can be converted to xml and used with XPath.
     * This assertion allows you to check the structure of response json.
     *     *
     * ```json
     *   { "store": {
     *       "book": [
     *         { "category": "reference",
     *           "author": "Nigel Rees",
     *           "title": "Sayings of the Century",
     *           "price": 8.95
     *         },
     *         { "category": "fiction",
     *           "author": "Evelyn Waugh",
     *           "title": "Sword of Honour",
     *           "price": 12.99
     *         }
     *    ],
     *       "bicycle": {
     *         "color": "red",
     *         "price": 19.95
     *       }
     *     }
     *   }
     * ```
     *
     * ```php
     * <?php
     * // at least one book in store has author
     * $I->seeResponseJsonMatchesXpath('//store/book/author');
     * // first book in store has author
     * $I->seeResponseJsonMatchesXpath('//store/book[1]/author');
     * // at least one item in store has price
     * $I->seeResponseJsonMatchesXpath('/store//price');
     * ?>
     * ```
     * @part json
     * @version 2.0.9
     * @see \Codeception\Module\REST::seeResponseJsonMatchesXpath()
     */
    public function seeResponseJsonMatchesXpath($xpath) {
        return $this->getScenario()->runStep(new \Codeception\Step\Assertion('seeResponseJsonMatchesXpath', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks if json structure in response matches [JsonPath](http://goessner.net/articles/JsonPath/).
     * JsonPath is XPath equivalent for querying Json structures. Try your JsonPath expressions [online](http://jsonpath.curiousconcept.com/).
     * This assertion allows you to check the structure of response json.
     *
     * This method **require [`flow/jsonpath` > 0.2](https://github.com/FlowCommunications/JSONPath/) library to be installed**.
     *
     * ```json
     *   { "store": {
     *       "book": [
     *         { "category": "reference",
     *           "author": "Nigel Rees",
     *           "title": "Sayings of the Century",
     *           "price": 8.95
     *         },
     *         { "category": "fiction",
     *           "author": "Evelyn Waugh",
     *           "title": "Sword of Honour",
     *           "price": 12.99
     *         }
     *    ],
     *       "bicycle": {
     *         "color": "red",
     *         "price": 19.95
     *       }
     *     }
     *   }
     * ```
     *
     * ```php
     * <?php
     * // at least one book in store has author
     * $I->seeResponseJsonMatchesJsonPath('$.store.book[*].author');
     * // first book in store has author
     * $I->seeResponseJsonMatchesJsonPath('$.store.book[0].author');
     * // at least one item in store has price
     * $I->seeResponseJsonMatchesJsonPath('$.store..price');
     * ?>
     * ```
     *
     * @part json
     * @version 2.0.9
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Module\REST::seeResponseJsonMatchesJsonPath()
     */
    public function canSeeResponseJsonMatchesJsonPath($jsonPath) {
        return $this->getScenario()->runStep(new \Codeception\Step\ConditionalAssertion('seeResponseJsonMatchesJsonPath', func_get_args()));
    }
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks if json structure in response matches [JsonPath](http://goessner.net/articles/JsonPath/).
     * JsonPath is XPath equivalent for querying Json structures. Try your JsonPath expressions [online](http://jsonpath.curiousconcept.com/).
     * This assertion allows you to check the structure of response json.
     *
     * This method **require [`flow/jsonpath` > 0.2](https://github.com/FlowCommunications/JSONPath/) library to be installed**.
     *
     * ```json
     *   { "store": {
     *       "book": [
     *         { "category": "reference",
     *           "author": "Nigel Rees",
     *           "title": "Sayings of the Century",
     *           "price": 8.95
     *         },
     *         { "category": "fiction",
     *           "author": "Evelyn Waugh",
     *           "title": "Sword of Honour",
     *           "price": 12.99
     *         }
     *    ],
     *       "bicycle": {
     *         "color": "red",
     *         "price": 19.95
     *       }
     *     }
     *   }
     * ```
     *
     * ```php
     * <?php
     * // at least one book in store has author
     * $I->seeResponseJsonMatchesJsonPath('$.store.book[*].author');
     * // first book in store has author
     * $I->seeResponseJsonMatchesJsonPath('$.store.book[0].author');
     * // at least one item in store has price
     * $I->seeResponseJsonMatchesJsonPath('$.store..price');
     * ?>
     * ```
     *
     * @part json
     * @version 2.0.9
     * @see \Codeception\Module\REST::seeResponseJsonMatchesJsonPath()
     */
    public function seeResponseJsonMatchesJsonPath($jsonPath) {
        return $this->getScenario()->runStep(new \Codeception\Step\Assertion('seeResponseJsonMatchesJsonPath', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Opposite to seeResponseJsonMatchesJsonPath
     *
     * @param array $jsonPath
     * @part json
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Module\REST::dontSeeResponseJsonMatchesJsonPath()
     */
    public function cantSeeResponseJsonMatchesJsonPath($jsonPath) {
        return $this->getScenario()->runStep(new \Codeception\Step\ConditionalAssertion('dontSeeResponseJsonMatchesJsonPath', func_get_args()));
    }
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Opposite to seeResponseJsonMatchesJsonPath
     *
     * @param array $jsonPath
     * @part json
     * @see \Codeception\Module\REST::dontSeeResponseJsonMatchesJsonPath()
     */
    public function dontSeeResponseJsonMatchesJsonPath($jsonPath) {
        return $this->getScenario()->runStep(new \Codeception\Step\Assertion('dontSeeResponseJsonMatchesJsonPath', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Opposite to seeResponseContainsJson
     *
     * @part json
     * @param array $json
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Module\REST::dontSeeResponseContainsJson()
     */
    public function cantSeeResponseContainsJson($json = null) {
        return $this->getScenario()->runStep(new \Codeception\Step\ConditionalAssertion('dontSeeResponseContainsJson', func_get_args()));
    }
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Opposite to seeResponseContainsJson
     *
     * @part json
     * @param array $json
     * @see \Codeception\Module\REST::dontSeeResponseContainsJson()
     */
    public function dontSeeResponseContainsJson($json = null) {
        return $this->getScenario()->runStep(new \Codeception\Step\Assertion('dontSeeResponseContainsJson', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks if response is exactly the same as provided.
     *
     * @part json
     * @part xml
     * @param $response
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Module\REST::seeResponseEquals()
     */
    public function canSeeResponseEquals($response) {
        return $this->getScenario()->runStep(new \Codeception\Step\ConditionalAssertion('seeResponseEquals', func_get_args()));
    }
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks if response is exactly the same as provided.
     *
     * @part json
     * @part xml
     * @param $response
     * @see \Codeception\Module\REST::seeResponseEquals()
     */
    public function seeResponseEquals($response) {
        return $this->getScenario()->runStep(new \Codeception\Step\Assertion('seeResponseEquals', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks response code equals to provided value.
     *
     * @part json
     * @part xml
     * @param $code
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Module\REST::seeResponseCodeIs()
     */
    public function canSeeResponseCodeIs($code) {
        return $this->getScenario()->runStep(new \Codeception\Step\ConditionalAssertion('seeResponseCodeIs', func_get_args()));
    }
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks response code equals to provided value.
     *
     * @part json
     * @part xml
     * @param $code
     * @see \Codeception\Module\REST::seeResponseCodeIs()
     */
    public function seeResponseCodeIs($code) {
        return $this->getScenario()->runStep(new \Codeception\Step\Assertion('seeResponseCodeIs', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that response code is not equal to provided value.
     *
     * @part json
     * @part xml
     * @param $code
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Module\REST::dontSeeResponseCodeIs()
     */
    public function cantSeeResponseCodeIs($code) {
        return $this->getScenario()->runStep(new \Codeception\Step\ConditionalAssertion('dontSeeResponseCodeIs', func_get_args()));
    }
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that response code is not equal to provided value.
     *
     * @part json
     * @part xml
     * @param $code
     * @see \Codeception\Module\REST::dontSeeResponseCodeIs()
     */
    public function dontSeeResponseCodeIs($code) {
        return $this->getScenario()->runStep(new \Codeception\Step\Assertion('dontSeeResponseCodeIs', func_get_args()));
    }
}
