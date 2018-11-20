<?php
namespace Sellastica\StopWatch;

/**
 * Stopwatch for microtime measuring
 */
class StopWatch
{
	/** @var int */
	private static $startMicrotime;
	/** @var int */
	private static $endMicrotime;


	public static function start(): void
	{
		self::clear();
		self::$startMicrotime = microtime(true);
	}

	public static function end(): void
	{
		self::$endMicrotime = microtime(true);
	}

	public static function clear(): void
	{
		self::$startMicrotime = null;
		self::$endMicrotime = null;
	}

	/**
	 * @return float
	 * @throws \LogicException
	 */
	public static function get(): float
	{
		if (is_null(self::$endMicrotime)) {
			self::end();
		}

		if (is_null(self::$startMicrotime)) {
			throw new \LogicException('Start time is not set');
		}

		return round(self::$endMicrotime - self::$startMicrotime, 4);
	}

	/**
	 * @param bool $die
	 */
	public static function dump($die = true): void
	{
		f(sprintf('%s seconds (%s miliseconds)', self::get(), self::get() * 1000), 'Stopwatch');
		if ($die) {
			die('Program has been terminated.');
		}
	}
}