<?php

	namespace Inlm\SchemaGenerator\DibiBridge;

	use Inlm\SchemaGenerator\Configuration;
	use Inlm\SchemaGenerator\IAdapter;


	class DibiAdapter implements IAdapter
	{
		/** @var \Dibi\Connection */
		private $connection;

		/** @var string[] */
		private $ignoredTables;


		/**
		 * @param  string[] $ignoredTables
		 */
		public function __construct(\Dibi\Connection $connection, array $ignoredTables = [])
		{
			$this->connection = $connection;
			$this->ignoredTables = $ignoredTables;
		}


		/**
		 * @return Configuration
		 */
		public function load()
		{
			$dibiDriver = $this->connection->getDriver();
			$schema = NULL;

			if (Dibi::isMysqlDriver($dibiDriver)) {
				$generator = new DibiMysql($this->connection);
				$schema = $generator->generateSchema($this->ignoredTables);

			} else {
				throw new UnsupportedException('Driver ' . get_class($dibiDriver) . ' is not supported.');
			}

			return new Configuration($schema);
		}


		/**
		 * @return void
		 */
		public function save(Configuration $configuration)
		{
		}
	}
