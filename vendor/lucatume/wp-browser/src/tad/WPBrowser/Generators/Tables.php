<?php
/**
 * Provides informations about WordPress tables.
 *
 * @package tad\WPBrowser\Generators
 */

namespace tad\WPBrowser\Generators;

use function tad\WPBrowser\renderString;

/**
 * Class Tables
 *
 * @package tad\WPBrowser\Generators
 */
class Tables
{
    /**
     * The absolute path to the the templates directory.
     *
     * @var string
     */
    protected $templatesDir;

    /**
     * Tables constructor.
     */
    public function __construct()
    {
        $this->templatesDir = __DIR__ . '/templates';
    }

    /**
     * Returns a list of default table names for a single site WordPress installation.
     *
     * @param string $table_prefix The table prefix to prepend to each blog table name.
     * @param int $blog_id The ID of the blog to return the table names for.
     *
     * @return array The list of tables, not prefixed with the table prefix.
     */
    public static function blogTables($table_prefix = '', $blog_id = 1)
    {
        $blog_id = (int)$blog_id < 2 ? '' : $blog_id . '_';
        return array_map(static function ($table) use ($table_prefix, $blog_id) {
            return sprintf('%s%s%s', $table_prefix, $blog_id, $table);
        }, [
            'commentmeta',
            'comments',
            'links',
            'options',
            'postmeta',
            'posts',
            'term_relationships',
            'term_taxonomy',
            'termmeta',
            'terms'
        ]);
    }

    public function getAlterTableQuery($table, $prefix)
    {
        $data = ['operation' => 'ALTER TABLE', 'prefix' => $prefix];
        return in_array($table, $this->alterableTables(), true) ? $this->renderQuery($table, $data) : '';
    }

    private function alterableTables()
    {
        return [
            'users'
        ];
    }

    /**
     * Renders a SQL query for a WordPress table operation.
     *
     * @param string $table The name of the table to render the query for, e.g. `blogs` or `posts`.
     * @param array<string,mixed> $data The data that should be used to render the query.
     *
     * @return string The rendered SQL query.
     */
    protected function renderQuery($table, $data)
    {
        if (! in_array($table, $this->tables(), true)) {
            throw new \InvalidArgumentException('Table ' . $table . ' is not a multisite table name');
        }

        $template = $this->templates($table);

        return renderString($template, $data);
    }

    private function tables()
    {
        return array_merge([], self::multisiteTables());
    }

    /**
     * Returns a list of additional table names that will be created in default multi-site installation.
     *
     * This list does not include single site installation tables.
     *
     * @param string $table_prefix The table prefix to prepend to each table name.
     *
     * @return array The list of tables, not prefixed with the table prefix.
     *
     * @see Tables::blogTables()
     */
    public static function multisiteTables($table_prefix = '')
    {
        return array_map(static function ($table) use ($table_prefix) {
            return $table_prefix . $table;
        }, [
            'blogs',
            'sitemeta',
            'site',
            'signups',
            'registration_log'
        ]);
    }

    private function templates($table)
    {
        $map = [
            'blogs' => function () {
                return file_get_contents($this->templatesDir . DIRECTORY_SEPARATOR . ('blogs.handlebars'));
            },
            'drop-blog-tables' => function () {
                return file_get_contents($this->templatesDir . DIRECTORY_SEPARATOR . ('drop-blog-tables.handlebars'));
            },
            'blog_versions' => function () {
                return file_get_contents($this->templatesDir . DIRECTORY_SEPARATOR . ('blog_versions.handlebars'));
            },
            'registration_log' => function () {
                return file_get_contents($this->templatesDir . DIRECTORY_SEPARATOR . ('registration_log.handlebars'));
            },
            'signups' => function () {
                return file_get_contents($this->templatesDir . DIRECTORY_SEPARATOR . ('signups.handlebars'));
            },
            'site' => function () {
                return file_get_contents($this->templatesDir . DIRECTORY_SEPARATOR . ('site.handlebars'));
            },
            'sitemeta' => function () {
                return file_get_contents($this->templatesDir . DIRECTORY_SEPARATOR . ('site_meta.handlebars'));
            },
            'users' => function () {
                return file_get_contents($this->templatesDir . DIRECTORY_SEPARATOR . ('users.handlebars'));
            },
            'new-blog' => function () {
                return file_get_contents($this->templatesDir . DIRECTORY_SEPARATOR . ('new-blog.handlebars'));
            }
        ];

        return $map[$table]();
    }

    public function getCreateTableQuery($table, $prefix)
    {
        $data = ['operation' => 'CREATE TABLE IF NOT EXISTS', 'prefix' => $prefix];
        return $this->renderQuery($table, $data);
    }

    public function getBlogScaffoldQuery($prefix, $blogId, array $data)
    {
        $template = $this->templates('new-blog');
        $data = array_merge([
            'prefix' => $prefix,
            'blog_id' => $blogId,
            'scheme' => 'http'
        ], $data);

        return renderString($template, $data);
    }

    public function getBlogDropQuery($tablePrefix, $blogId)
    {
        $template = $this->templates('drop-blog-tables');
        $data = [
            'prefix' => $tablePrefix,
            'blog_id' => $blogId
        ];

        return renderString($template, $data);
    }
}
