<?php

// Extension handlersocket version 0.3.0


/**
 * The extension providing API for communicating with
 * {@link http://github.com/ahiguti/HandlerSocket-Plugin-for-MySQL HandlerSocket plugin for MySQL}.
 * libhsclient binding for PHP.
 *
 * @link http://github.com/ahiguti/HandlerSocket-Plugin-for-MySQL
 * @link http://code.google.com/p/php-handlersocket
 */
class HandlerSocket
{
	/* Constants */
	const PRIMARY = 'PRIMARY';
	const UPDATE  = 'U';
	const DELETE  = 'D';


	/* Methods */

	/**
	 * Creates a new conection objects.
	 *
	 * <br/>Examples:<pre>
	 * try {
	 * 	$hs = new HandlerSocket('localhost', 9999);
	 * } catch (HandlerSocketException $e) {
	 * 	die($e->getMessage());
	 * }
	 *
	 * <b>timeout setting:</b>
	 *
	 * try {
	 * 	$hs = new HandlerSocket('localhost', 9999, array('timeout' => 30));
	 * } catch (HandlerSocketException $e) {
	 * 	die($e->getMessage());
	 * }
	 * </pre>
	 *
	 * @throw HandletSocketException if the connection is invalid.
	 *
	 * @param string $host host name
	 * @param string $port port number
	 * @param array $options <p>
	 * options:<br/>
	 * <b>timeout</b> - connection timeout seconds.
	 * </p>
	 */
	public function __construct($host, $port, $options = null) {}

	/**
	 * Authenticate using a plain password.
	 *
	 * <br/>Example:<pre>
	 * if (!$hs->auth('pass')) {
	 * 	die('Fault auth');
	 * }
	 * </pre>
	 *
	 * @param string $key	password
	 * @param string $type	authenticate type (not used in this version)
	 *
	 * @return bool Returns if the authenticate was successfully.
	 */
	public function auth($key, $type = null) {}

	/**
	 * Opens a database index.
	 *
	 * <br/>Examples:<pre>
	 * try {
	 * 	$hs = new HandlerSocket('localhost', 9999);
	 * } catch (HandlerSocketException $e) {
	 * 	die($e->getMessage());
	 * }
	 *
	 * if (!$hs->openIndex(1, 'db', 'table', 'PRIMARY', 'k,v')) {
	 * 	die('Fault openIndex');
	 * }
	 *
	 * <b>filter setting:</b>
	 * $hs->openIndex(1, 'db', 'table', 'PRIMARY', 'k,v', 'f1,f2');
	 * </pre>
	 *
	 * @param int $id <p>
	 * id
	 * </p>
	 * @param string $db <p>
	 * database name
	 * </p>
	 * @param string $table <p>
	 * table name
	 * </p>
	 * @param string $index <p>
	 * index name
	 * </p>
	 * @param string $field <p>
	 * field lists. Name of the field in the table. Can specify multiple comma separated values.
	 * </p>
	 * @param string|array $filter <p>
	 * filter lists. Name of the field in the table. Can specify multiple comma separated values.
	 * </p>
	 *
	 * @return bool Returns TRUE if the open was successfull, FALSE otherwise
	 */
	public function openIndex($id, $db, $table, $index, $field, $filter = null) {}

	/**
	 * Executes single query.
	 *
	 * <br/>Examples:<pre>
	 *
	 * $hs->openIndex(1, 'db', 'table', 'PRIMARY', 'k,v', 'f1,f2');
	 * $ret = $hs->executSingle(1, '>=', array('K1'));
	 * // SELECT k, v FROM table WHERE k >= 'K1' LIMIT 1
	 *
	 * The above example will return something similar to:
	 * array(
	 * 	array("K1", "V1")
	 * )
	 *
	 *
	 * <b>limit and offset:</b>
	 *
	 * $ret = $hs->executeSingle(1, '>=', array('K1'), 5);
	 * // SELECT k, v FROM table WHERE k >= 'k1' LIMIT 5
	 *
	 * $ret = $hs->executeSingle(1, '>=', array('K1'), 5, 3);
	 * // SELECT k, v FROM table WHERE k >= 'k1' LIMIT 3, 5
	 *
	 *
	 * <b>filter:</b>
	 *
	 * $ret = $hs->executeSingle(1, '>=', array('K1'), 1, 0, null, null, array('F', '>', 0, 'F1'));
	 * // SELECT k, v FROM table WHERE k >= 'K1' AND f1 > 'F1' LIMIT 5
	 *
	 * $ret = $hs->executeSingle(1, '>=', array('K1'), 10, 0, null, null, array(array('F', '>', 0, 'F1'), array('F', '<', 1, 'F10')));
	 * // SELECT k, v FROM table WHERE k >= 'K1' AND f1 > 'F1' AND f2 <= 'F20' LIMIT 10
	 *
	 *
	 * in
	 *
	 * $ret = $hs->executeSingle(1, '>=', array('K1'), 3, 0, null, null, null, 0, array('K1', 'K3', 'K5'));
	 * // SELECT k, v FROM table WHERE k IN ('K1', 'K3', 'K5') LIMIT 3
	 *
	 *
	 * <b>update:</b>
	 *
	 * $ret = $hs->executeSingle(1, '=', array('K1'), 1, 0, 'U', array('KEY1', 'VAL1'));
	 * // UPDATE table SET k = 'KEY1', v = 'VAL1' WHERE k = 'K1' LIMIT 1
	 *
	 * The above example will return something similar to:
	 * int(1)
	 * it returns the number of modified records.
	 *
	 *
	 * $ret = $hs->executeSingle(1, '=', array('K1'), 1, 0, 'U?', array('KEY1', 'VAL1'));
	 * // UPDATE table SET k = 'KEY1', v = 'VAL1' WHERE k = 'K1'
	 *
	 * The above example will return something similar to:
	 *
	 * array(
	 * 	array("K1", "V1")
	 * )
	 * If the '?' suffix is specified, it returns the contents of the records before modification.
	 * </pre>
	 *
	 * @param int $id <p>
	 * id
	 * </p>
	 * @param string $operate	<p>
	 * comparison operator. supported: '=', '<', '<=', '>', '>='
	 * </p>
	 * @param array $criteria <p>
	 * comparison values
	 * </p>
	 * @param int $limit <p>
	 * limit value
	 * </p>
	 * @param int $offset <p>
	 * offset value
	 * </p>
	 * @param string $update <p>
	 * update operator. supported: U, +, -, D, U?, +?, -?, D?
	 * </p>
	 * @param array $values <p>
	 * update values
	 * </p>
	 * @param array $filters <p>
	 * filter values. Specifying an array of the form:
	 * <table>
	 * 	<tr><th>key</th><th>value</th></tr>
	 * 	<tr><td>0</td><td>filter operator (F or W)</td></tr>
	 * 	<tr><td>1</td><td>filter comarison operator</td></tr>
	 * 	<tr><td>2</td><td>filter position number</td></tr>
	 * 	<tr><td>3</td><td>filter comarison value</td></tr>
	 * </table>
	 * </p>
	 * @param int $in_key <p>
	 * index number of in field
	 * </p>
	 * @param array $in_values <p>
	 * in values
	 * </p>
	 *
	 * @return mixed Returns the results.
	 */
	public function executeSingle($id, $operate, array $criteria, $limit = 1, $offset = 0, $update = null, array $values = array(), array $filters = array(), $in_key = -1, array $in_values = array()) {}

	/**
	 * Executes multiple queries.
	 *
	 * <br/>Example:<pre>
	 * $ret = $hs->executMulti(
	 * 	array(
	 * 		array(1, '>=', array('K1')),
	 * 		array(1, '>=', array('K1'), 3),
	 * 		array(1, '>=', array('K1'), 1, 0, null, null, array('F', '>', 0, 'F1')),
	 * 		array(1, '=', array('K1'), 1, 0, 'U', array('KEY1', 'VAL1'))
	 * 	)
	 * );
	 *
	 * The above example will return something similar to:
	 *
	 * array(
	 * 	array(
	 * 		array("K1", "V1")
	 * 	),
	 * 	array(
	 * 		array("K1", "V1"),
	 * 		array("K2", "V2"),
	 * 		array("K3", "V3")
	 *	)
	 * 	array(
	 * 		array("K1", "V1")
	 * 	)
	 * 	int(1)
	 * )
	 * </pre>
	 *
	 * @see executeSingle
	 *
	 * @param array $args array of executeSingle parameter
	 *
	 * @return array Returns the results.
	 */
	public function executeMulti(array $args) {}

	/**
	 * Executes update query.
	 * This method is the same as the 'U' argument to specify a fifth executeSingle.
	 *
	 * <br/>Example:<pre>
	 *
	 * $ret = $hs->executeUpdate(1, '=', array('K1'), array('KEY1', 'VAL1'));
	 * // UPDATE table SET k = 'KEY1', v = 'VAL1' WHERE k = 'K1'
	 *
	 * The above example will return something similar to:
	 *
	 * int(1)
	 * </pre>
	 *
	 * @param int	 $id		id
	 * @param string $operate	comparison operator
	 * @param array	 $criteria	comparison values
	 * @param array	 $values	update values
	 * @param int	 $limit		limit value
	 * @param int	 $offset	offset value
	 * @param array	 $filters	filter values
	 * @param int	 $in_key	index number of in field
	 * @param array	 $in_values	Details of the argument is a reference executeSingle.
	 *
	 * @return mixed Returns the results.
	 */
	public function executeUpdate($id, $operate, array $criteria, array $values, $limit = 1, $offset = 0, array $filters = array(), $in_key  = -1, array $in_values = array()) {}

	/**
	 * Executes delete query.
	 * This method is the same as the 'D' argument to specify a fifth executeSingle.
	 *
	 * <br/>Example: <pre>
	 * $ret = $hs->executeDelete(1, '=', array('K1'));
	 * //DELETE FROM table WHERE k = 'K1'
	 *
	 * The above example will return something similar to:
	 *
	 * int(1)
	 * </pre>
	 *
	 * @param int	 $id		id
	 * @param string $operate	comparison operator
	 * @param array  $criteria	comparison values
	 * @param int	 $limit		limit value
	 * @param int	 $offset	offset value
	 * @param array  $filters	filter values
	 * @param int	 $in_key	index number of in field
	 * @param array  $in_values	in values. Details of the argument is a reference executeSingle.
	 *
	 * @return mixed Returns the results.
	 */
	public function executeDelete($id, $operate, array $criteria, $limit = 1, $offset = 0, array $filters = array(), $in_key = -1, array $in_values = array()) {}

	/**
	 * Executes insert query.
	 *
	 * <br/>Example: <pre>
	 * $hs->openIndex(1, 'db', 'table', 'PRIMARY', 'k,v');
	 * $ret = $hs->executeInsert(1, array('K10', 'V10'));
	 * //INSERT INTO table (k, v) VALUES ('K10', 'V10')
	 *
	 * The above example will return something similar to:
	 *
	 * int(1)
	 * </pre>
	 *
	 * @param int	$id		id
	 * @param array	$field	array of insert fields
	 *
	 * @return mixed Returns the results.
	 */
	public function executeInsert($id, array $field) {}

	/**
	 * Returns a last error message.
	 *
	 * @return mixed error message
	 */
	public function getError() {}

	/**
	 * Creates a new index objects
	 *
	 * <br/>Example: <pre>
	 * try {
	 * 	$hs = new HandlerSocket('localhost', 9999);
	 * 	$index = $hs->createIndex(1, 'db', 'table', 'PRIMARY', 'k,v');
	 * } catch (HandlerSocketException $e) {
	 * 	die($e->getMessage());
	 * }
	 *
	 * <b>filter setting:</b>
	 *
	 * $index = $hs->createIndex(1, 'db', 'table', 'PRIMARY', array('k', 'v'), array('filter' => array('f1', 'f2')));
	 * </pre>
	 *
	 * @throw HandlerSocetException if the create is invalid.
	 *
	 * @param int			$id		 id
	 * @param string		$db		 database name
	 * @param string		$table	 table name
	 * @param string		$index	 index name
	 * @param string|array	$fields	 field lists
	 * @param array			$options options
	 *
	 * @return HandlerSocketIndex Returns the HandlerSocketIndex object.
	 */
	public function createIndex($id, $db, $table, $index, array $fields, array $options = array()) {}


	/**
	 * @param int $id
	 * @param string $operate
	 * @param array $criteria
	 * @param int $limit
	 * @param int $offset
	 * @param string $update
	 * @param array $values
	 * @param array $filters
	 * @param int $in_key
	 * @param array $in_values
	 *
	 * @return mixed
	 */
	public function executeFind($id, $operate, array $criteria, $limit = 1, $offset = 0, $update = null, array $values = array(), array $filters = array(), $in_key = -1, array $in_values = array()) {}
}


/**
 * HandlerSocketIndex
 */
class HandlerSocketIndex
{
	/* Fields */

	/**
	 * @var string
	 */
	protected $_db;
	/**
	 * @var string
	 */
	protected $_table;
	/**
	 * @var string
	 */
	protected $_name;
	/**
	 * @var mixed
	 */
	protected $_field;


	/* Methods */

	/**
	 * Creates a new index objects
	 *
	 * @throw HandlerSocetException if the create is invalid.
	 *
	 * @param HandlerSocket	$hs
	 * @param int			$id		id
	 * @param string		$db		database name
	 * @param string		$table	table name
	 * @param string		$index	index name
	 * @param string|array	$fields	field lists
	 * @param array			$options
	 */
	public function __construct(HandlerSocket $hs, $id, $db, $table, $index, array $fields, array $options = array()) {}

	/**
	 * Returns an index id
	 *
	 * @return int
	 */
	public function getId() {}

	/**
	 * Returns a database name
	 *
	 * @return string
	 */
	public function getDatabase() {}

	/**
	 * Returns a table name
	 *
	 * @return string
	 */
	public function getTable() {}

	/**
	 * Returns an index name
	 *
	 * @return string
	 */
	public function getName() {}

	/**
	 * @return mixed
	 */
	public function getColumn() {}

	/**
	 * Returns a field list
	 *
	 * @return array
	 */
	public function getField() {}

	/**
	 * Returns a filter list
	 *
	 * @return array
	 */
	public function getFilter() {}

	/**
	 * Returns a operator list
	 *
	 * @return array
	 */
	public function getOperator() {}

	/**
	 * Returns a last error message
	 *
	 * @return array|mixed error message
	 */
	public function getError() {}

	/**
	 * Returns a rows
	 *
	 * @param string|array $query
	 * @param int $limit
	 * @param int $offset
	 * @param array $options
	 *
	 * @return mixed Returns the results.
	 */
	public function find(array $query, $limit = 1, $offset = 0, array $options = array()) {}

	/**
	 * Insert
	 *
	 * @param mixed $var
	 * @param mixed $_
	 *
	 * @return mixed Returns the results.
	 */
	public function insert($var) {}

	/**
	 * Update
	 *
	 * @param string|array $query
	 * @param string|array $update
	 * @param int $limit
	 * @param int $offset
	 * @param array $options
	 *
	 * @return mixed Returns the results.
	 */
	public function update(array $query, array $update, $limit = 1, $offset = 0, array $options = array()) {}

	/**
	 * Remove
	 *
	 * @param array $query
	 * @param int $limit
	 * @param int $offset
	 * @param array $options
	 *
	 * @return mixed Returns the results.
	 */
	public function remove(array $query, $limit = 1, $offset = 0, array $options = array()) {}

	/**
	 * Multi execute
	 *
	 * @param array $args
	 *
	 * @return array Returns the results.
	 */
	public function multi(array $args) {}
}


/**
 * HandlerSocketException
 */
class HandlerSocketException extends Exception {}

