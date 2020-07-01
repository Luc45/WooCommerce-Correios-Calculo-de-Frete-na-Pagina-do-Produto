<?php
/**
 * @var array $dump_settings Settings for the dumper.
 * @var array $pdo_settings Settings for the PDO that the Dumper uses.
 * @var Ifsnop\Mysqldump\Mysqldump $dumper A Dumper instance for further control. Check everything
 *                                          you can do in the link bellow.
 *
 * @link https://github.com/ifsnop/mysqldump-php You can find more info about $dumper, $dump_settings and $pdo_settings in this link.
 *
 * @example $dumper->setTableLimits( [ 'users' => 300,'logs' => 50, 'posts' => 10 ] );
 *
 * @return array You should not change the generated return.
 */

$dumper->setTransformTableRowHook( function ( $tableName, array $cols ) {
	if ( $tableName !== "wp_options" ) {
		return $cols;
	}

	$next_is_transient = false;
	foreach ( $cols as $k => $v ) {
		if ( $k === 'option_name' &&
		     strpos( $v, 'transient' ) !== false ||
		     strpos( $v, 'woocommerce_marketplace_suggestions' ) !== false
		) {
			$next_is_transient = true;
			continue;
		}

		if ( $next_is_transient === true ) {
			$cols[ $k ] = '';
		}

		$next_is_transient = false;
	}

	return $cols;
} );

$dump_settings = [
	'include-tables'             => [],
	'exclude-tables'             => [],
	'include-views'              => [],
	'compress'                   => 'None',
	'init_commands'              => [
		'SET NAMES utf8',
		'SET TIME_ZONE=\'+00:00\'',
	],
	'no-data'                    => [],
	'reset-auto-increment'       => false,
	'add-drop-database'          => false,
	'add-drop-table'             => false,
	'add-drop-trigger'           => true,
	'add-locks'                  => true,
	'complete-insert'            => false,
	'databases'                  => false,
	'default-character-set'      => 'utf8',
	'disable-keys'               => true,
	'extended-insert'            => true,
	'events'                     => false,
	'hex-blob'                   => true,
	'insert-ignore'              => false,
	'net_buffer_length'          => 1000000,
	'no-autocommit'              => true,
	'no-create-info'             => false,
	'lock-tables'                => true,
	'routines'                   => false,
	'single-transaction'         => true,
	'skip-triggers'              => false,
	'skip-tz-utc'                => false,
	'skip-comments'              => false,
	'skip-dump-date'             => false,
	'skip-definer'               => false,
	'where'                      => '',
	'disable-foreign-keys-check' => true,
];

$pdo_settings = [
	12   => true,
	3    => 2,
	1000 => false,
];

// Do not change the return.
return [ $dumper, $dump_settings, $pdo_settings ];
