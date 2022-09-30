<?php
/**
 * Json'd plugin for Craft CMS 4.x
 * 
 * Updated by Chris Dekker (DNCO)
 *
 * Adds Twig filters for working with json.
 *
 * @link      https://www.theindigoviking.com
 * @copyright Copyright (c) 2018 The Indigo Viking
 * 
 */

namespace indigoviking\jsond\twigextensions;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * @author    The Indigo Viking
 * @package   Jsond
 * @since     1
 */
class JsondTwigExtension extends AbstractExtension
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'Jsond';
    }

    /**
     * @inheritdoc
     */
    public function getFilters()
    {
        return [
            new TwigFilter('json_decoded', [$this, 'jsondecoded']),
            new TwigFilter('json_last_error_msg', [$this, 'jsonErrorMessage']),
            new TwigFilter('json_last_error', [$this, 'jsonError']),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return [
            new TwigFilter('json_decoded', [$this, 'jsondecoded']),
            new TwigFilter('json_last_error_msg', [$this, 'jsonErrorMessage']),
            new TwigFilter('json_last_error', [$this, 'jsonError']),
        ];
    }

    /**
     * @param null $text
     *
     * @return string
     */
    public function jsondecoded($json, $type = false, $depth = 512, $options = null)
    {
	    if ($options != null)
	    {
		    $decoded = json_decode($json, $type, $depth, $options);
	    }
	    else {
		    $decoded = json_decode($json, $type, $depth);
	    }

        return $decoded;
    }
    
    public function jsonErrorMessage($json, $type = 'decode')
    {
        $error = '';
	    
	    if ($type == 'encode')
	    {
		    json_encode($json);
		    $error = json_last_error_msg();
	    }
	    else
	    {
		    json_decode($json);
		    $error = json_last_error_msg();
	    }

        return $error;
    }
    
    public function jsonError($json, $type = 'decode')
    {
	    $error = '';
	    
	    if ($type == 'encode')
	    {
		    json_encode($json);
		    $error = json_last_error();
	    }
	    else
	    {
		    json_decode($json);
		    $error = json_last_error();
	    }

        return $error;
    }
}
