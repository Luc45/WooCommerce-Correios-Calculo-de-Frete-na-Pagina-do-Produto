<?php
/**
 * @var array $dump_settings     Settings for the dumper.
 * @var array $pdo_settings      Settings for the PDO that the Dumper uses.
 * @var PDO   $handler           A PDO handler to the database from which the Dumps are being generated.
 *                               Any query that you run against this PDO will affect the database
 *                               from which you are generating the dumps permanently, use it wisely.
 * @var MySqlDumpPhp\Mysqldump $dumper A Dumper instance for further control. Check everything
 *                               you can do in the link bellow.
 *
 * @link https://github.com/luc45/mysqldump-php You can find more info about $dumper, $dump_settings and $pdo_settings in this link.
 *
 * @example $dumper->setTableLimits( [ 'users' => 300,'logs' => 50, 'posts' => 10 ] );
 *
 * @return array You should not change the generated return.
 */

#$handler->exec("DELETE FROM `wp_options` WHERE `option_name` LIKE ('%\_transient\_%');");
#$handler->exec("DELETE FROM `wp_options` WHERE `option_name` = 'woocommerce_marketplace_suggestions';");

$dump_settings = [
    'include-tables' => [],
    'exclude-tables' => [],
    'include-views' => [],
    'compress' => 'None',
    'init_commands' => [],
    'no-data' => [],
    'reset-auto-increment' => false,
    'add-drop-database' => false,
    'add-drop-table' => true,
    'add-drop-trigger' => true,
    'add-locks' => true,
    'complete-insert' => false,
    'databases' => false,
    'default-character-set' => 'utf8',
    'disable-keys' => true,
    'extended-insert' => false,
    'events' => false,
    'hex-blob' => true,
    'insert-ignore' => false,
    'net_buffer_length' => 1000000,
    'no-autocommit' => true,
    'no-create-info' => false,
    'lock-tables' => true,
    'routines' => false,
    'single-transaction' => false,
    'skip-triggers' => false,
    'skip-tz-utc' => false,
    'skip-comments' => false,
    'skip-dump-date' => false,
    'skip-definer' => false,
    'where' => '',
    'disable-foreign-keys-check' => true,
];

$pdo_settings  = [
    12 => true,
    3 => 2,
    1000 => false,
];

// Do not change the return.
return [ $dumper, $dump_settings, $pdo_settings ];
