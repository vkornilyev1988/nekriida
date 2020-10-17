<?php


namespace Nekrida\Core;

/**
 * Class Locale
 * @package Nekrida\Core
 */
class Locale
{
	/**
	 * @var array loaded locale file
	 */
	protected static $lang;

	/** @var string current locale*/
	protected static $locale;

	/**
	 * Returns the locale file
	 * @param Request $request
	 * @return array|false
	 */
	public static function getLangPack(Request $request) {
		if (!is_null(self::$locale)) {
			static::$lang = self::loadLangPack(self::$locale);
			if (static::$lang)
				return static::$lang;
		}

		//Check session for the locale name
		$session = $request->session(Config::get('locales/sources/session'));
		if ($session) {
			static::$lang = self::loadLangPack($session);
			if (static::$lang)
				return static::$lang;
		}

		//Else Check cookies for the locale name
		$cookie = $request->cookie(Config::get('locales/sources/cookie'));
		if ($cookie) {
			static::$lang = self::loadLangPack($cookie);
			if (static::$lang)
				return static::$lang;
		}

		//Else check clients headers
		$langList = static::detectClientLanguage($request->server('HTTP_ACCEPT_LANGUAGE'));
		if (!empty($langList))
			foreach ($langList as $key => $value) {
				static::$lang = self::loadLangPack($key);
				if (static::$lang)
					return static::$lang;
			}

		//If we still can't get a locale, return default one
		return self::loadLangPack(Config::get('locales/default') ?: 'en');
	}

	/**
	 * Clears the locale cache
	 */
	public static function resetLocale() {
		static::$locale = null;
		static::$lang = null;
	}

	/**
	 * Returns LangPack by requested locale
	 * @param $locale
	 * @return array|false LangPack
	 */
	protected static function loadLangPack($locale) {
		$lang = @include(str_replace(
			['{locale}','{root}'],
			[$locale, Config::root()],
			Config::get('locales/nameTemplates')
		));
		return $lang;
	}

	/**
	 * @param $languagesHeader array
	 * @return array|false
	 */
	protected static function detectClientLanguage($languagesHeader) {
		if (!is_null($languagesHeader)) {
			// break up string into pieces (languages and q factors)
			preg_match_all('/([a-z]{1,8}(-[a-z]{1,8})?)\s*(;\s*q\s*=\s*(1|0\.[0-9]+))?/i', $languagesHeader, $lang_parse);
			if (count($lang_parse[1])) {
				// create a list like "en" => 0.8
				$languages = array_combine($lang_parse[1], $lang_parse[4]);
				// set default to 1 for any without q factor
				foreach ($languages as $lang => $val)
					if ($val === '') $languages[$lang] = 1;
				// sort list based on value
				arsort($languages, SORT_NUMERIC);
				return $languages;
			}
		}
		return [];
	}
}