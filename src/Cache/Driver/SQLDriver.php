<?php declare(strict_types=1);
/**
 * Ion
 *
 * Building blocks for web development
 *
 * PHP version 7
 *
 * @package     Ion
 * @author      Timothy J. Warren <tim@timshomepage.net>
 * @copyright   2015 - 2016 Timothy J. Warren
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version     1.0.0
 * @link        https://git.timshomepage.net/timw4mail/ion
 */

namespace Aviat\Ion\Cache\Driver;

use Aviat\Ion\ConfigInterface;
use Aviat\Ion\Exception\ConfigException;
use Aviat\Ion\Model\DB;

/**
 * Driver for caching via a traditional SQL database
 */
class SQLDriver extends DB implements DriverInterface  {

	use DriverTrait;

	/**
	 * The query builder object
	 * @var object $db
	 */
	protected $db;

	/**
	 * Create the driver object
	 *
	 * @param ConfigInterface $config
	 * @throws ConfigException
	 */
	public function __construct(ConfigInterface $config)
	{
		parent::__construct($config);

		if ( ! array_key_exists('cache', $this->db_config))
		{
			throw new ConfigException("Missing '[cache]' section in database config.");
		}

		$this->db = \Query($this->db_config['cache']);
	}

	/**
	 * Retrieve a value from the cache backend
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function get($key)
	{
		$query = $this->db->select('value')
			->from('cache')
			->where('key', $key)
			->get();
			
		$row = $query->fetch(\PDO::FETCH_ASSOC);

		if (empty($row))
		{
			return NULL;
		}

		$serializedData = $row['value'];
		return $this->unserialize($serializedData);
	}

	/**
	 * Set a cached value
	 *
	 * @param string $key
	 * @param mixed  $value
	 * @return DriverInterface
	 */
	public function set($key, $value)
	{
		$serializedData = $this->serialize($value);

		$this->db->set([
			'key' => $key,
			'value' => $serializedData,
		]);

		$this->db->insert('cache');

		return $this;
	}

	/**
	 * Invalidate a cached value
	 *
	 * @param string $key
	 * @return DriverInterface
	 */
	public function invalidate($key)
	{
		$this->db->where('key', $key)
			->delete('cache');
			
		return $this;
	}

	/**
	 * Clear the contents of the cache
	 *
	 * @return void
	 */
	public function invalidateAll()
	{
		$this->db->truncate('cache');
	}
}
// End of SQLDriver.php