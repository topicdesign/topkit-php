<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Image
 *
 * @package     CodeIgniter
 * @subpackage  Models
 * @author      Topic Deisgn
 * @license     http://creativecommons.org/licenses/BSD/
 */
class Image extends ActiveRecord\Model {

    # explicit table name
    static $table_name = 'images';
    static $after_destroy = array('delete_files');

    # explicit pk
    //static $primary_key = '';

    # explicit connection name
    //static $connection = '';

    # explicit database name
    //static $db = '';

    public $base_dir = '';
    public $cache_dir = '';

    private $config = array();

    private $sizes = array();

    // --------------------------------------------------------------------

    public function __construct($attributes=array(), $guard_attributes=TRUE, $instantiating_via_find=FALSE, $new_record=TRUE)
    {
        parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);

        $ci = get_instance();
        $ci->config->load('images', TRUE);
        $this->config = $ci->config->item('images');
        $this->base_dir = $this->config['base_dir'];
        $this->cache_dir = $this->config['cache_dir'];
    }

    // --------------------------------------------------------------------

    /**
     * delete files associated with images
     *
     * @access public 
     * 
     * @return void
     **/
    public function delete_files()
    {
        $path = sprintf('assets/images/%s/%s/%s*',$this->resource_type,$this->resource_id,$this->hash);
        array_map('unlink',glob($path));
    }

    // --------------------------------------------------------------------

    static public function for_resource($resource)
    {
        $attr = array(
            'resource_type' => strtolower(get_class($resource)),
            'resource_id'   => $resource->id,
        );
        $image = new Image($attr);
        return $image;
    }

    // --------------------------------------------------------------------
    // Getters/Setters
    // --------------------------------------------------------------------

    public function set_hash($hash)
    {
        if ($hash == $this->hash) 
        {
           return; 
        }
        // ensure unique
        $cond = array('hash = ?', $hash);
        if (self::exists(array('conditions'=>$cond)))
        {
            $hash = md5($hash . microtime());
            return $this->set_hash($hash);
        }
        $this->assign_attribute('hash', $hash);
    }

    // --------------------------------------------------------------------
    // Validations
    // --------------------------------------------------------------------

    // --------------------------------------------------------------------
    // Public Methods
    // --------------------------------------------------------------------

    public function size($size)
    {
        if ( ! isset($this->sizes[$size]))
        {
            // get resource specific sizes
            if ( ! isset($this->config['sizes'][$this->resource_type])
              || ! isset($this->config['sizes'][$this->resource_type][$size])
            ) {
                $this->sizes[$size] = array();
            }
            else
            {
                $src = sprintf('%s%s/%s/%s_%s%s',
                    $this->base_dir,
                    $this->resource_type,
                    $this->resource_id,
                    $this->hash,
                    $size,
                    $this->file_ext
                );
                $s = $this->config['sizes'][$this->resource_type][$size];
                $this->sizes[$size] = array(
                    'width'  => $s['width'],
                    'height' => $s['height'],
                    'src'    => $src
                );
            }
        }
        return $this->sizes[$size];
    }

    // --------------------------------------------------------------------
}

/* End of file image.php */
/* Location: ./application/models/image.php */
