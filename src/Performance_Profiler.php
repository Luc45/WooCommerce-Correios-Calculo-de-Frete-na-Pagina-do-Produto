<?php

namespace CFPP;

/**
 * Class Performance_Profiler
 *
 * While logged in as a user with capabilities to manage_woocommerce,
 * such as an administrator, add the cookie "profile_cfpp" to the request
 * and see the XHR response to get a detailed breakdown of the inner timings
 * of CFPP.
 *
 * @package CFPP
 */
class Performance_Profiler {
	// Singleton instance
	public static $instance;

	private $timings = [];

	private function __construct() {
		self::$instance      = $this;
	}

	// Singleton pattern
	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * @param string $event
	 */
	public function log( $event ) {
		$log_entry = [
			'time'  => timer_stop(),
			'event' => $event,
		];

		$this->timings[] = $log_entry;
	}

	/**
	 * @return array
	 */
	public function get_timings() {
		return $this->timings;
	}
}
