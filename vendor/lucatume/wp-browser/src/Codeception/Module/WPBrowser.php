<?php

namespace Codeception\Module;

use Symfony\Component\BrowserKit\Cookie;
use function tad\WPBrowser\requireCodeceptionModules;

//phpcs:disable
requireCodeceptionModules('WPBrowser', [ 'PhpBrowser' ]);
//phpcs:enable

/**
 * A Codeception module offering specific WordPress browsing methods.
 */
class WPBrowser extends PhpBrowser
{
    use WPBrowserMethods;

    /**
     * The module required fields, to be set in the suite .yml configuration file.
     *
     * @var array
     */
    protected $requiredFields = ['adminUsername', 'adminPassword', 'adminPath'];

    /**
     * Returns all the cookies whose name matches a regex pattern.
     *
     * @example
     * ```php
     * $I->loginAs('customer','password');
     * $I->amOnPage('/shop');
     * $cartCookies = $I->grabCookiesWithPattern("#^shop_cart\\.*#");
     * ```
     *
     * @param string $cookiePattern The regular expression pattern to use for the matching.
     *
     * @return array|null An array of cookies matching the pattern.
     */
    public function grabCookiesWithPattern($cookiePattern)
    {
        /**
         * @var Cookie[]
         */
        $cookies = $this->client->getCookieJar()->all();

        if (!$cookies) {
            return null;
        }
        $matchingCookies = array_filter($cookies, static function (Cookie $cookie) use ($cookiePattern) {
            return preg_match($cookiePattern, $cookie->getName());
        });
        $cookieList = array_map(static function (Cookie $cookie) {
            return sprintf('{"%s": "%s"}', $cookie->getName(), $cookie->getValue());
        }, $matchingCookies);

        $this->debug('Cookies matching pattern ' . $cookiePattern . ' : ' . implode(', ', $cookieList));

        return count($matchingCookies) ? $matchingCookies : null;
    }

    /**
     * In the plugin administration screen activates a plugin clicking the "Activate" link.
     *
     * The method will **not** handle authentication to the admin area.
     *
     * @example
     * ```php
     * // Activate a plugin.
     * $I->loginAsAdmin();
     * $I->amOnPluginsPage();
     * $I->activatePlugin('hello-dolly');
     * // Activate a list of plugins.
     * $I->loginAsAdmin();
     * $I->amOnPluginsPage();
     * $I->activatePlugin(['hello-dolly','another-plugin']);
     * ```
     *
     * @param  string|array $pluginSlug The plugin slug, like "hello-dolly" or a list of plugin slugs.
     */
    public function activatePlugin($pluginSlug)
    {
        foreach ((array)$pluginSlug as $plugin) {
            $this->checkOption('//*[@data-slug="' . $plugin . '"]/th/input');
        }
        $this->selectOption('action', 'activate-selected');
        $this->click("#doaction");
    }

    /**
     * In the plugin administration screen deactivate a plugin clicking the "Deactivate" link.
     *
     * The method will **not** handle authentication and navigation to the plugins administration page.
     *
     * @example
     * ```php
     * // Deactivate one plugin.
     * $I->loginAsAdmin();
     * $I->amOnPluginsPage();
     * $I->deactivatePlugin('hello-dolly');
     * // Deactivate a list of plugins.
     * $I->loginAsAdmin();
     * $I->amOnPluginsPage();
     * $I->deactivatePlugin(['hello-dolly', 'my-plugin']);
     * ```
     *
     * @param  string|array $pluginSlug The plugin slug, like "hello-dolly", or a list of plugin slugs.
     */
    public function deactivatePlugin($pluginSlug)
    {
        foreach ((array) $pluginSlug as $plugin) {
            $this->checkOption('//*[@data-slug="' . $plugin . '"]/th/input');
        }
        $this->selectOption('action', 'deactivate-selected');
        $this->click('#doaction');
    }

    protected function validateConfig()
    {
        $this->configBackCompat();

        parent::validateConfig();
    }
}
