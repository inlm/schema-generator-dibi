<?php

	namespace Inlm\SchemaGenerator\DibiBridge;

	use CzProject\SqlGenerator;


	class DibiDumper extends \Inlm\SchemaGenerator\Dumpers\AbstractSqlDumper
	{
		/** @var \Dibi\Connection */
		private $connection;


		public function __construct(\Dibi\Connection $connection)
		{
			$this->connection = $connection;
		}


		/**
		 * @return void
		 */
		public function end()
		{
			$this->checkIfStarted();

			if (!$this->sqlDocument->isEmpty()) {
				$dibiDriver = $this->connection->getDriver();
				$sqlDriver = $this->prepareDriver($dibiDriver);

				foreach ($this->getHeader() as $query) {
					$dibiDriver->query($query);
				}

				$queries = $this->sqlDocument->getSqlQueries($sqlDriver);

				foreach ($queries as $query) {
					$dibiDriver->query($query);
				}
			}

			$this->stop();
		}


		/**
		 * @param  \Dibi\Driver $dibiDriver
		 * @return SqlGenerator\IDriver
		 */
		protected function prepareDriver($dibiDriver)
		{
			if (Dibi::isMysqlDriver($dibiDriver)) {
				return new SqlGenerator\Drivers\MysqlDriver;
			}

			throw new UnsupportedException('Driver ' . get_class($dibiDriver) . ' is not supported.');
		}
	}
