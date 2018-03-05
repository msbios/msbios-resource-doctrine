<?php
/**
 * @access protected
 * @author Judzhin Miles <judzhin[at]gns-it.com>
 */
namespace MSBios\Resource\Doctrine;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait OptionableAwareTrait
 * @package MSBios\Resource\Doctrine
 */
trait OptionableAwareTrait
{
    /**
     * @var array
     *
     * @ORM\Column(name="options", type="json_array", nullable=true)
     */
    private $options = [
        // 'image' => [
        //     'name' => 'file.doc',
        //     'description' => 'Описание',
        //     'type' => 'image/jpg',
        //     'tmp_name' => 'path/to/file',
        //     'error' => 0,
        //     'size' => 0
        // ],
        // 'video' => [
        //     'type' => 'youtube', // vimeo
        //     'src' => 'http://examples',
        // ]
    ];

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param $options
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }
}
