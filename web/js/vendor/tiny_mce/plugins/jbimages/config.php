<?php	
$config['allowed_types'] = 'gif|jpg|png';
$config['max_size']      = 0;
$config['max_width']     = 600;
$config['max_height']    = 600;
$config['allow_resize']  = true;	
$config['encrypt_name']  = true;
$config['overwrite']     = true;
$config['base_path']     = '/tiny_uploads';
$config['img_path']      = str_replace('//','/',dirname(dirname(dirname(dirname(dirname(dirname(dirname($_SERVER['SCRIPT_NAME']))))))) . $config['base_path']);
$config['upload_path']   = dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . $config['base_path'];
