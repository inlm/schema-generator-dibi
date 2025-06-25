<?php

	declare(strict_types=1);

	namespace Inlm\SchemaGenerator\DibiBridge;

	use Inlm\SchemaGenerator\Database;


	class Dibi
	{
		/**
		 * @param  object $driver
		 * @return bool
		 */
		public static function isMysqlDriver($driver)
		{
			return $driver instanceof \Dibi\Drivers\MySqlDriver /* @phpstan-ignore-line Dibi 3.x */
				|| $driver instanceof \Dibi\Drivers\MySqliDriver;
		}


		/**
		 * @return string
		 * @throws UnsupportedException
		 */
		public static function detectDatabaseType(\Dibi\Connection $connection)
		{
			$driver = $connection->getDriver();

			if (self::isMysqlDriver($driver)) {
				return Database::MYSQL;
			}

			throw new UnsupportedException('Unsupported driver type ' . get_class($driver));
		}
	}
