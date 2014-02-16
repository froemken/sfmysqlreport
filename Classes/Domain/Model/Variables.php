<?php
namespace StefanFroemken\Sfmysqlreport\Domain\Model;

/***************************************************************
*  Copyright notice
*
*  (c) 2014 Stefan Froemken <froemken@gmail.com>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * This model saves the mysql status
 */
class Variables {

	/**
	 * innodb_log_buffer_size
	 *
	 * @var int
	 */
	protected $innodbLogBufferSize = 0;

	/**
	 * innodb_flush_log_at_trx_commit
	 *
	 * @var int
	 */
	protected $innodbFlushLogAtTrxCommit = 0;

	/**
	 * join_buffer_size
	 *
	 * @var int
	 */
	protected $joinBufferSize = 0;

	/**
	 * key_buffer_size
	 *
	 * @var int
	 */
	protected $keyBufferSize = 0;

	/**
	 * key_cache_block_size
	 *
	 * @var int
	 */
	protected $keyCacheBlockSize = 0;

	/**
	 * max_heap_table_size
	 *
	 * @var int
	 */
	protected $maxHeapTableSize = 0;

	/**
	 * table_definition_cache
	 *
	 * @var int
	 */
	protected $tableDefinitionCache = 0;

	/**
	 * table_open_cache
	 *
	 * @var int
	 */
	protected $tableOpenCache = 0;

	/**
	 * thread_cache_size
	 *
	 * @var int
	 */
	protected $threadCacheSize = 0;

	/**
	 * tmp_table_size
	 *
	 * @var int
	 */
	protected $tmpTableSize = 0;





	/**
	 * Getter for innodb_log_buffer_size
	 *
	 * @return int
	 */
	public function getInnodbLogBufferSize() {
		return $this->innodbLogBufferSize;
	}

	/**
	 * Setter for innodb_log_buffer_size
	 *
	 * @param int $innodbLogBufferSize
	 * @return void
	 */
	public function setInnodbLogBufferSize($innodbLogBufferSize) {
		$this->innodbLogBufferSize = $innodbLogBufferSize;
	}

	/**
	 * Getter for innodb_flush_log_at_trx_commit
	 *
	 * @return int
	 */
	public function getInnodbFlushLogAtTrxCommit() {
		return $this->innodbFlushLogAtTrxCommit;
	}

	/**
	 * Setter for innodb_flush_log_at_trx_commit
	 *
	 * @param int $innodbFlushLogAtTrxCommit
	 * @return void
	 */
	public function setInnodbFlushLogAtTrxCommit($innodbFlushLogAtTrxCommit) {
		$this->innodbFlushLogAtTrxCommit = $innodbFlushLogAtTrxCommit;
	}

	/**
	 * Getter for join_buffer_size
	 *
	 * @return int
	 */
	public function getJoinBufferSize() {
		return $this->joinBufferSize;
	}

	/**
	 * Setter for join_buffer_size
	 *
	 * @param int $joinBufferSize
	 * @return void
	 */
	public function setJoinBufferSize($joinBufferSize) {
		$this->joinBufferSize = $joinBufferSize;
	}

	/**
	 * Getter for key_buffer_size
	 *
	 * @return int
	 */
	public function getKeyBufferSize() {
		return $this->keyBufferSize;
	}

	/**
	 * Setter for key_buffer_size
	 *
	 * @param int $keyBufferSize
	 * @return void
	 */
	public function setKeyBufferSize($keyBufferSize) {
		$this->keyBufferSize = $keyBufferSize;
	}

	/**
	 * Getter for key_cache_block_size
	 *
	 * @return int
	 */
	public function getKeyCacheBlockSize() {
		return $this->keyCacheBlockSize;
	}

	/**
	 * Setter for key_cache_block_size
	 *
	 * @param int $keyCacheBlockSize
	 * @return void
	 */
	public function setKeyCacheBlockSize($keyCacheBlockSize) {
		$this->keyCacheBlockSize = $keyCacheBlockSize;
	}

	/**
	 * Getter for max_heap_table_size
	 *
	 * @return int
	 */
	public function getMaxHeapTableSize() {
		return $this->maxHeapTableSize;
	}

	/**
	 * Setter for max_heap_table_size
	 *
	 * @param int $maxHeapTableSize
	 * @return void
	 */
	public function setMaxHeapTableSize($maxHeapTableSize) {
		$this->maxHeapTableSize = $maxHeapTableSize;
	}

	/**
	 * Getter for table_definition_cache
	 *
	 * @return int
	 */
	public function getTableDefinitionCache() {
		return $this->tableDefinitionCache;
	}

	/**
	 * Setter for tableDefinitionCache
	 *
	 * @param int $tableDefinitionCache
	 * @return void
	 */
	public function setTableDefinitionCache($tableDefinitionCache) {
		$this->tableDefinitionCache = $tableDefinitionCache;
	}

	/**
	 * Getter for table_open_cache
	 *
	 * @return int
	 */
	public function getTableOpenCache() {
		return $this->tableOpenCache;
	}

	/**
	 * Setter for tableOpenCache
	 *
	 * @param int $tableOpenCache
	 * @return void
	 */
	public function setTableOpenCache($tableOpenCache) {
		$this->tableOpenCache = $tableOpenCache;
	}

	/**
	 * Getter for thread_cache_size
	 *
	 * @return int
	 */
	public function getThreadCacheSize() {
		return $this->threadCacheSize;
	}

	/**
	 * Setter for thread_cache_size
	 *
	 * @param int $threadCacheSize
	 * @return void
	 */
	public function setThreadCacheSize($threadCacheSize) {
		$this->threadCacheSize = $threadCacheSize;
	}

	/**
	 * Getter for tmp_table_size
	 *
	 * @return int
	 */
	public function getTmpTableSize() {
		return $this->tmpTableSize;
	}

	/**
	 * Setter for tmp_table_size
	 *
	 * @param int $tmpTableSize
	 * @return void
	 */
	public function setTmpTableSize($tmpTableSize) {
		$this->tmpTableSize = $tmpTableSize;
	}

}