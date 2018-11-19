<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Resource\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;
use MSBios\Resource\Doctrine\Entity;
use MSBios\Resource\Doctrine\RowStatusableAwareInterface;
use MSBios\Resource\Doctrine\RowStatusableAwareTrait;
use MSBios\Resource\Doctrine\TitlebleAwareInterface;
use MSBios\Resource\Doctrine\TitlebleAwareTrait;

/**
 * Class Setting
 * @package MSBios\Resource\Doctrine\Entity
 *
 * @ORM\Entity(repositoryClass="MSBios\Resource\Doctrine\Repository\SettingRepository")
 * @ORM\Table(name="sys_t_settings")
 */
class Setting extends Entity implements
    TitlebleAwareInterface,
    RowStatusableAwareInterface
{
    use TitlebleAwareTrait;
    use RowStatusableAwareTrait;

    /**
     * @var string
     *
     * @ORM\Column(name="identifier", type="string", length=100, nullable=false)
     */
    private $identifier;

    /**
     * @var string
     *
     * @ORM\Column(name="base_url", type="string", length=255, nullable=false)
     */
    private $baseUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="ssl_base_url", type="string", length=255, nullable=false)
     */
    private $sslBaseUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="cdn_url", type="string", length=255, nullable=false)
     */
    private $cdnUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="ssl_cdn_url", type="string", length=255, nullable=false)
     */
    private $sslCdnUrl;

    /**
     * @var boolean
     *
     * @ORM\Column(name="forcessl", type="smallint", nullable=false)
     */
    private $forcessl = false;

    /**
     * @var string
     *
     * @ORM\Column(name="locale", type="string", length=20, nullable=false)
     */
    private $locale = 'en_US';

    /**
     * @var string
     *
     * @ORM\Column(name="timezone", type="string", length=50, nullable=false)
     */
    private $timezone = "America/New_York";

    /**
     * @var string
     *
     * @ORM\Column(name="options", type="json_array", nullable=false)
     */
    private $options = [];

    /**
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @param string $identifier
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @param string $baseUrl
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return string
     */
    public function getSslBaseUrl()
    {
        return $this->sslBaseUrl;
    }

    /**
     * @param string $sslBaseUrl
     */
    public function setSslBaseUrl($sslBaseUrl)
    {
        $this->sslBaseUrl = $sslBaseUrl;
    }

    /**
     * @return string
     */
    public function getCdnUrl()
    {
        return $this->cdnUrl;
    }

    /**
     * @param string $cdnUrl
     */
    public function setCdnUrl($cdnUrl)
    {
        $this->cdnUrl = $cdnUrl;
    }

    /**
     * @return string
     */
    public function getSslCdnUrl()
    {
        return $this->sslCdnUrl;
    }

    /**
     * @param string $sslCdnUrl
     */
    public function setSslCdnUrl($sslCdnUrl)
    {
        $this->sslCdnUrl = $sslCdnUrl;
    }

    /**
     * @return bool
     */
    public function isForcessl()
    {
        return $this->forcessl;
    }

    /**
     * @param bool $forcessl
     */
    public function setForcessl($forcessl)
    {
        $this->forcessl = $forcessl;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * @param string $timezone
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
    }

    /**
     * @return string
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param string $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }
}
