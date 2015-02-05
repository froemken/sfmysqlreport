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
class Status {

	/**
	 * Aborted_clients
	 *
	 * @var int
	 */
	protected $abortedClients = 0;

	/**
	 * Aborted_connects
	 *
	 * @var int
	 */
	protected $abortedConnects = 0;

	/**
	 * Com_select
	 *
	 * @var int
	 */
	protected $comSelect = 0;

	/**
	 * Connections
	 *
	 * @var int
	 */
	protected $connections = 0;

	/**
	 * Created_tmp_disk_tables
	 *
	 * @var int
	 */
	protected $createdTmpDiskTables = 0;

	/**
	 * Created_tmp_tables
	 *
	 * @var int
	 */
	protected $createdTmpTables = 0;

	/**
	 * Innodb_buffer_pool_pages_data
	 *
	 * @var int
	 */
	protected $innodbBufferPoolPagesData = 0;

	/**
	 * Innodb_buffer_pool_pages_flushed
	 *
	 * @var int
	 */
	protected $innodbBufferPoolPagesFlushed = 0;

	/**
	 * Innodb_buffer_pool_pages_free
	 *
	 * @var int
	 */
	protected $innodbBufferPoolPagesFree = 0;

	/**
	 * Innodb_buffer_pool_pages_misc
	 *
	 * @var int
	 */
	protected $innodbBufferPoolPagesMisc = 0;

	/**
	 * Innodb_buffer_pool_pages_total
	 *
	 * @var int
	 */
	protected $innodbBufferPoolPagesTotal = 0;

	/**
	 * Innodb_buffer_pool_read_requests
	 *
	 * @var int
	 */
	protected $innodbBufferPoolReadRequests = 0;

	/**
	 * Innodb_buffer_pool_reads
	 *
	 * @var int
	 */
	protected $innodbBufferPoolReads = 0;

	/**
	 * Innodb_buffer_pool_write_requests
	 *
	 * @var int
	 */
	protected $innodbBufferPoolWriteRequests = 0;

	/**
	 * Innodb_page_size
	 *
	 * @var int
	 */
	protected $innodbPageSize = 0;

	/**
	 * Key_blocks_unused
	 *
	 * @var int
	 */
	protected $keyBlocksUnused = 0;

	/**
	 * Key_read_requests
	 *
	 * @var int
	 */
	protected $keyReadRequests = 0;

	/**
	 * Key_reads
	 *
	 * @var int
	 */
	protected $keyReads = 0;

	/**
	 * Open_table_definitions
	 *
	 * @var int
	 */
	protected $openTableDefinitions = 0;

	/**
	 * Open_tables
	 *
	 * @var int
	 */
	protected $openTables = 0;

	/**
	 * Opened_table_definitions
	 *
	 * @var int
	 */
	protected $openedTableDefinitions = 0;

	/**
	 * Opened_tables
	 *
	 * @var int
	 */
	protected $openedTables = 0;

	/**
	 * qcacheFreeBlocks
	 *
	 * @var int
	 */
	protected $qcacheFreeBlocks = 0;

	/**
	 * qcacheFreeMemory
	 *
	 * @var int
	 */
	protected $qcacheFreeMemory = 0;

	/**
	 * qcacheHits
	 *
	 * @var int
	 */
	protected $qcacheHits = 0;

	/**
	 * qcacheInserts
	 *
	 * @var int
	 */
	protected $qcacheInserts = 0;

	/**
	 * qcacheLowmemPrunes
	 *
	 * @var int
	 */
	protected $qcacheLowmemPrunes = 0;

	/**
	 * qcacheNotCached
	 *
	 * @var int
	 */
	protected $qcacheNotCached = 0;

	/**
	 * qcacheQueriesInCache
	 *
	 * @var int
	 */
	protected $qcacheQueriesInCache = 0;

	/**
	 * qcacheTotalBlocks
	 *
	 * @var int
	 */
	protected $qcacheTotalBlocks = 0;

	/**
	 * slaveRunning
	 *
	 * @var string
	 */
	protected $slaveRunning = 'OFF';

	/**
	 * Threads_connected
	 *
	 * @var int
	 */
	protected $threadsConnected = 0;

	/**
	 * Threads_created
	 *
	 * @var int
	 */
	protected $threadsCreated = 0;

	/**
	 * Uptime
	 *
	 * @var int
	 */
	protected $uptime = 0;

	/**
	 * Uptime_since_flush_status
	 *
	 * @var int
	 */
	protected $uptimeSinceFlushStatus = 0;





	/**
	 * Getter for Aborted_Clients
	 *
	 * @return int
	 */
	public function getAbortedClients() {
		return $this->abortedClients;
	}

	/**
	 * Setter for Aborted_Clients
	 *
	 * @param int $abortedClients
	 * @return void
	 */
	public function setAbortedClients($abortedClients) {
		$this->abortedClients = $abortedClients;
	}

	/**
	 * Getter for Aborted_Connects
	 *
	 * @return int
	 */
	public function getAbortedConnects() {
		return $this->abortedConnects;
	}

	/**
	 * Setter for Aborted_Connects
	 *
	 * @param int $abortedConnects
	 * @return void
	 */
	public function setAbortedConnects($abortedConnects) {
		$this->abortedConnects = $abortedConnects;
	}

	/**
	 * Returns the comSelect
	 *
	 * @return int $comSelect
	 */
	public function getComSelect() {
		return $this->comSelect;
	}

	/**
	 * Sets the comSelect
	 *
	 * @param int $comSelect
	 * @return void
	 */
	public function setComSelect($comSelect) {
		$this->comSelect = $comSelect;
	}

	/**
	 * Returns the connections
	 *
	 * @return int $connections
	 */
	public function getConnections() {
		return $this->connections;
	}

	/**
	 * Sets the connections
	 *
	 * @param int $connections
	 * @return void
	 */
	public function setConnections($connections) {
		$this->connections = $connections;
	}

	/**
	 * Getter for Created_tmp_disk_tables
	 *
	 * @return int
	 */
	public function getCreatedTmpDiskTables() {
		return $this->createdTmpDiskTables;
	}

	/**
	 * Setter for Created_tmp_disk_tables
	 *
	 * @param int $createdTmpDiskTables
	 * @return void
	 */
	public function setCreatedTmpDiskTables($createdTmpDiskTables) {
		$this->createdTmpDiskTables = $createdTmpDiskTables;
	}

	/**
	 * Getter for Created_tmp_tables
	 *
	 * @return int
	 */
	public function getCreatedTmpTables() {
		return $this->createdTmpTables;
	}

	/**
	 * Setter for Created_tmp_tables
	 *
	 * @param int $createdTmpTables
	 * @return void
	 */
	public function setCreatedTmpTables($createdTmpTables) {
		$this->createdTmpTables = $createdTmpTables;
	}

	/**
	 * Returns the innodbBufferPoolPagesData
	 *
	 * @return int $innodbBufferPoolPagesData
	 */
	public function getInnodbBufferPoolPagesData() {
		return $this->innodbBufferPoolPagesData;
	}

	/**
	 * Sets the innodbBufferPoolPagesData
	 *
	 * @param int $innodbBufferPoolPagesData
	 * @return void
	 */
	public function setInnodbBufferPoolPagesData($innodbBufferPoolPagesData) {
		$this->innodbBufferPoolPagesData = $innodbBufferPoolPagesData;
	}

	/**
	 * Returns the innodbBufferPoolPagesFlushed
	 *
	 * @return int $innodbBufferPoolPagesFlushed
	 */
	public function getInnodbBufferPoolPagesFlushed() {
		return $this->innodbBufferPoolPagesFlushed;
	}

	/**
	 * Sets the innodbBufferPoolPagesFlushed
	 *
	 * @param int $innodbBufferPoolPagesFlushed
	 * @return void
	 */
	public function setInnodbBufferPoolPagesFlushed($innodbBufferPoolPagesFlushed) {
		$this->innodbBufferPoolPagesFlushed = $innodbBufferPoolPagesFlushed;
	}

	/**
	 * Returns the innodbBufferPoolPagesFree
	 *
	 * @return int $innodbBufferPoolPagesFree
	 */
	public function getInnodbBufferPoolPagesFree() {
		return $this->innodbBufferPoolPagesFree;
	}

	/**
	 * Sets the innodbBufferPoolPagesFree
	 *
	 * @param int $innodbBufferPoolPagesFree
	 * @return void
	 */
	public function setInnodbBufferPoolPagesFree($innodbBufferPoolPagesFree) {
		$this->innodbBufferPoolPagesFree = $innodbBufferPoolPagesFree;
	}

	/**
	 * Returns the innodbBufferPoolPagesMisc
	 *
	 * @return int $innodbBufferPoolPagesMisc
	 */
	public function getInnodbBufferPoolPagesMisc() {
		return $this->innodbBufferPoolPagesMisc;
	}

	/**
	 * Sets the innodbBufferPoolPagesMisc
	 *
	 * @param int $innodbBufferPoolPagesMisc
	 * @return void
	 */
	public function setInnodbBufferPoolPagesMisc($innodbBufferPoolPagesMisc) {
		$this->innodbBufferPoolPagesMisc = $innodbBufferPoolPagesMisc;
	}

	/**
	 * Returns the innodbBufferPoolPagesTotal
	 *
	 * @return int $innodbBufferPoolPagesTotal
	 */
	public function getInnodbBufferPoolPagesTotal() {
		return $this->innodbBufferPoolPagesTotal;
	}

	/**
	 * Sets the innodbBufferPoolPagesTotal
	 *
	 * @param int $innodbBufferPoolPagesTotal
	 * @return void
	 */
	public function setInnodbBufferPoolPagesTotal($innodbBufferPoolPagesTotal) {
		$this->innodbBufferPoolPagesTotal = $innodbBufferPoolPagesTotal;
	}

	/**
	 * Getter for Innodb_buffer_pool_read_requests
	 *
	 * @return int
	 */
	public function getInnodbBufferPoolReadRequests() {
		return $this->innodbBufferPoolReadRequests;
	}

	/**
	 * Setter for Innodb_buffer_pool_read_requests
	 *
	 * @param int $innodbBufferPoolReadRequests
	 * @return void
	 */
	public function setInnodbBufferPoolReadRequests($innodbBufferPoolReadRequests) {
		$this->innodbBufferPoolReadRequests = $innodbBufferPoolReadRequests;
	}

	/**
	 * Getter for Innodb_buffer_pool_reads
	 *
	 * @return int
	 */
	public function getInnodbBufferPoolReads() {
		return $this->innodbBufferPoolReads;
	}

	/**
	 * Setter for Innodb_buffer_pool_reads
	 *
	 * @param int $innodbBufferPoolReads
	 * @return void
	 */
	public function setInnodbBufferPoolReads($innodbBufferPoolReads) {
		$this->innodbBufferPoolReads = $innodbBufferPoolReads;
	}

	/**
	 * Returns the innodbBufferPoolWriteRequests
	 *
	 * @return int $innodbBufferPoolWriteRequests
	 */
	public function getInnodbBufferPoolWriteRequests() {
		return $this->innodbBufferPoolWriteRequests;
	}

	/**
	 * Sets the innodbBufferPoolWriteRequests
	 *
	 * @param int $innodbBufferPoolWriteRequests
	 * @return void
	 */
	public function setInnodbBufferPoolWriteRequests($innodbBufferPoolWriteRequests) {
		$this->innodbBufferPoolWriteRequests = $innodbBufferPoolWriteRequests;
	}

	/**
	 * Returns the innodbPageSize
	 *
	 * @return int $innodbPageSize
	 */
	public function getInnodbPageSize() {
		return $this->innodbPageSize;
	}

	/**
	 * Sets the innodbPageSize
	 *
	 * @param int $innodbPageSize
	 * @return void
	 */
	public function setInnodbPageSize($innodbPageSize) {
		$this->innodbPageSize = $innodbPageSize;
	}

	/**
	 * Getter for Key_blocks_unused
	 *
	 * @return int
	 */
	public function getKeyBlocksUnused() {
		return $this->keyBlocksUnused;
	}

	/**
	 * Setter for Key_blocks_unused
	 *
	 * @param int $keyBlocksUnused
	 * @return void
	 */
	public function setKeyBlocksUnused($keyBlocksUnused) {
		$this->keyBlocksUnused = $keyBlocksUnused;
	}

	/**
	 * Getter for Key_read_requests
	 *
	 * @return int
	 */
	public function getKeyReadRequests() {
		return $this->keyReadRequests;
	}

	/**
	 * Setter for Key_read_requests
	 *
	 * @param int $keyReadRequests
	 * @return void
	 */
	public function setKeyReadRequests($keyReadRequests) {
		$this->keyReadRequests = $keyReadRequests;
	}

	/**
	 * Getter for Key_reads
	 *
	 * @return int
	 */
	public function getKeyReads() {
		return $this->keyReads;
	}

	/**
	 * Setter for Key_reads
	 *
	 * @param int $keyReads
	 * @return void
	 */
	public function setKeyReads($keyReads) {
		$this->keyReads = $keyReads;
	}

	/**
	 * Getter for Open_table_definitions
	 *
	 * @return int
	 */
	public function getOpenTableDefinitions() {
		return $this->openTableDefinitions;
	}

	/**
	 * Setter for Open_table_definitions
	 *
	 * @param int $openTableDefinitions
	 * @return void
	 */
	public function setOpenTableDefinitions($openTableDefinitions) {
		$this->openTableDefinitions = $openTableDefinitions;
	}

	/**
	 * Getter for Open_tables
	 *
	 * @return int
	 */
	public function getOpenTables() {
		return $this->openTables;
	}

	/**
	 * Setter for Open_tables
	 *
	 * @param int $openTables
	 * @return void
	 */
	public function setOpenTables($openTables) {
		$this->openTables = $openTables;
	}

	/**
	 * Getter for Opened_table_definitions
	 *
	 * @return int
	 */
	public function getOpenedTableDefinitions() {
		return $this->openedTableDefinitions;
	}

	/**
	 * Setter for Opened_table_definitions
	 *
	 * @param int $openedTableDefinitions
	 * @return void
	 */
	public function setOpenedTableDefinitions($openedTableDefinitions) {
		$this->openedTableDefinitions = $openedTableDefinitions;
	}

	/**
	 * Getter for Opened_tables
	 *
	 * @return int
	 */
	public function getOpenedTables() {
		return $this->openedTables;
	}

	/**
	 * Setter for Opened_tables
	 *
	 * @param int $openedTables
	 * @return void
	 */
	public function setOpenedTables($openedTables) {
		$this->openedTables = $openedTables;
	}

	/**
	 * Returns the qcacheFreeBlocks
	 *
	 * @return int $qcacheFreeBlocks
	 */
	public function getQcacheFreeBlocks() {
		return $this->qcacheFreeBlocks;
	}

	/**
	 * Sets the qcacheFreeBlocks
	 *
	 * @param int $qcacheFreeBlocks
	 * @return void
	 */
	public function setQcacheFreeBlocks($qcacheFreeBlocks) {
		$this->qcacheFreeBlocks = $qcacheFreeBlocks;
	}

	/**
	 * Returns the qcacheFreeMemory
	 *
	 * @return int $qcacheFreeMemory
	 */
	public function getQcacheFreeMemory() {
		return $this->qcacheFreeMemory;
	}

	/**
	 * Sets the qcacheFreeMemory
	 *
	 * @param int $qcacheFreeMemory
	 * @return void
	 */
	public function setQcacheFreeMemory($qcacheFreeMemory) {
		$this->qcacheFreeMemory = $qcacheFreeMemory;
	}

	/**
	 * Returns the qcacheHits
	 *
	 * @return int $qcacheHits
	 */
	public function getQcacheHits() {
		return $this->qcacheHits;
	}

	/**
	 * Sets the qcacheHits
	 *
	 * @param int $qcacheHits
	 * @return void
	 */
	public function setQcacheHits($qcacheHits) {
		$this->qcacheHits = $qcacheHits;
	}

	/**
	 * Returns the qcacheInserts
	 *
	 * @return int $qcacheInserts
	 */
	public function getQcacheInserts() {
		return $this->qcacheInserts;
	}

	/**
	 * Sets the qcacheInserts
	 *
	 * @param int $qcacheInserts
	 * @return void
	 */
	public function setQcacheInserts($qcacheInserts) {
		$this->qcacheInserts = $qcacheInserts;
	}

	/**
	 * Returns the qcacheLowmemPrunes
	 *
	 * @return int $qcacheLowmemPrunes
	 */
	public function getQcacheLowmemPrunes() {
		return $this->qcacheLowmemPrunes;
	}

	/**
	 * Sets the qcacheLowmemPrunes
	 *
	 * @param int $qcacheLowmemPrunes
	 * @return void
	 */
	public function setQcacheLowmemPrunes($qcacheLowmemPrunes) {
		$this->qcacheLowmemPrunes = $qcacheLowmemPrunes;
	}

	/**
	 * Returns the qcacheNotCached
	 *
	 * @return int $qcacheNotCached
	 */
	public function getQcacheNotCached() {
		return $this->qcacheNotCached;
	}

	/**
	 * Sets the qcacheNotCached
	 *
	 * @param int $qcacheNotCached
	 * @return void
	 */
	public function setQcacheNotCached($qcacheNotCached) {
		$this->qcacheNotCached = $qcacheNotCached;
	}

	/**
	 * Returns the qcacheQueriesInCache
	 *
	 * @return int $qcacheQueriesInCache
	 */
	public function getQcacheQueriesInCache() {
		return $this->qcacheQueriesInCache;
	}

	/**
	 * Sets the qcacheQueriesInCache
	 *
	 * @param int $qcacheQueriesInCache
	 * @return void
	 */
	public function setQcacheQueriesInCache($qcacheQueriesInCache) {
		$this->qcacheQueriesInCache = $qcacheQueriesInCache;
	}

	/**
	 * Returns the qcacheTotalBlocks
	 *
	 * @return int $qcacheTotalBlocks
	 */
	public function getQcacheTotalBlocks() {
		return $this->qcacheTotalBlocks;
	}

	/**
	 * Sets the qcacheTotalBlocks
	 *
	 * @param int $qcacheTotalBlocks
	 * @return void
	 */
	public function setQcacheTotalBlocks($qcacheTotalBlocks) {
		$this->qcacheTotalBlocks = $qcacheTotalBlocks;
	}

	/**
	 * Returns the slaveRunning
	 *
	 * @return string $slaveRunning
	 */
	public function getSlaveRunning() {
		return $this->slaveRunning;
	}

	/**
	 * Sets the slaveRunning
	 *
	 * @param string $slaveRunning
	 * @return void
	 */
	public function setSlaveRunning($slaveRunning) {
		$this->slaveRunning = $slaveRunning;
	}

	/**
	 * Getter for Threads_connected
	 *
	 * @return int
	 */
	public function getThreadsConnected() {
		return $this->threadsConnected;
	}

	/**
	 * Setter for Threads_connected
	 *
	 * @param int $threadsConnected
	 * @return void
	 */
	public function setThreadsConnected($threadsConnected) {
		$this->threadsConnected = $threadsConnected;
	}

	/**
	 * Getter for Threads_created
	 *
	 * @return int
	 */
	public function getThreadsCreated() {
		return $this->threadsCreated;
	}

	/**
	 * Setter for Threads_connected
	 *
	 * @param int $threadsCreated
	 * @return void
	 */
	public function setThreadsCreated($threadsCreated) {
		$this->threadsCreated = $threadsCreated;
	}

	/**
	 * Getter for Uptime
	 *
	 * @return int
	 */
	public function getUptime() {
		return $this->uptime;
	}

	/**
	 * Setter for Uptime
	 *
	 * @param int $uptime
	 * @return void
	 */
	public function setUptime($uptime) {
		$this->uptime = $uptime;
	}

	/**
	 * Returns the uptimeSinceFlushStatus
	 *
	 * @return int $uptimeSinceFlushStatus
	 */
	public function getUptimeSinceFlushStatus() {
		return $this->uptimeSinceFlushStatus;
	}

	/**
	 * Sets the uptimeSinceFlushStatus
	 *
	 * @param int $uptimeSinceFlushStatus
	 * @return void
	 */
	public function setUptimeSinceFlushStatus($uptimeSinceFlushStatus) {
		$this->uptimeSinceFlushStatus = $uptimeSinceFlushStatus;
	}

}