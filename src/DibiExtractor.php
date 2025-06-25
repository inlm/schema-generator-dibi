<?php

	declare(strict_types=1);

	namespace Inlm\SchemaGenerator\DibiBridge;

	use CzProject\SqlSchema;
	use Inlm\SchemaGenerator\IExtractor;


	class DibiExtractor implements IExtractor
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
		 * @return SqlSchema\Schema
		 */
		public function generateSchema(array $options = [], array $customTypes = [], $databaseType = NULL)
		{
			$dibiDriver = $this->connection->getDriver();

			if (Dibi::isMysqlDriver($dibiDriver)) {
				$generator = new DibiMysql($this->connection);
				return $generator->generateSchema($this->ignoredTables);
			}

			throw new UnsupportedException('Driver ' . get_class($dibiDriver) . ' is not supported.');
		}
	}
