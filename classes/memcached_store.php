<?
define('MEMCACHED_SERVER', '192.168.0.115');
define('MEMCACHED_PORT', '11211');

/**
 * Class tương tác với Memcache
 * memcached_store
 *
 * @package
 * @copyright 2012
 * @version $Id$
 * @access public
 */
class memcached_store{
	var $memcache;
	var $connect_successful = false;

	/**
	 * Khởi tạo
	 * memcached_store::memcached_store()
	 *
	 * @return
	 */
	function memcached_store(){

		//Nếu MEMCACHED_SERVER là none thì return luôn
		if (MEMCACHED_SERVER == "none"){
			return;
		}

		$this->memcache = new Memcache;

		//Bẻ ra nhiều server
		$array_memcached = explode(",", MEMCACHED_SERVER);

		//Loop để add memcached server
		foreach ($array_memcached as $m_key => $m_value){
			$link_connect = @$this->memcache->addServer(trim($m_value), MEMCACHED_PORT, true);
		}

		//Nếu kết nối thành công thì cho biến connect_successful là true
		if ($link_connect){
			$this->connect_successful = true;
		}
	}

	/**
	 * [Get data from memcache]
	 * @param  [String] $key [Unique key in Memcache]
	 * @return [mixed]      [Data return]
	 */
	function get($key){
		if ($this->connect_successful) return @$this->memcache->get($key);
		else return NULL;
	}

	/**
	 * [set description]
	 * @param [mixed]  $key     [Key in Memcache]
	 * @param [mixed]  $value   [Value in Memcache]
	 * @param integer $timeout [Timout - Default is 600s equal 10 minutes]
	 */
	function set($key, $value, $timeout = 600){
		if ($this->connect_successful) return @$this->memcache->set($key, $value, 0, $timeout);
		else return NULL;
	}

	/**
	 * Xóa cache có key = $key
	 * memcached_store::delete()
	 *
	 * @param mixed $key
	 * @return
	 */
	function delete($key){
		if ($this->connect_successful) return @$this->memcache->delete($key);
		else return NULL;
	}


	/**
	 * Xóa toàn bộ dữ liệu trong cache
	 * memcached_store::flush()
	 *
	 * @return
	 */
	function flush(){
		if ($this->connect_successful) return @$this->memcache->flush();
		else return NULL;
	}

	//get getStats
	function getExtendedStats(){
		if ($this->connect_successful) return $this->memcache->getExtendedStats();
		else return NULL;
	}


}
?>