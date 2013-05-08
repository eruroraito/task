<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//public
define('LIST_DEFAULT_START', 0);
define('LIST_DEFAULT_LIMIT', 20);
define('SQL_EXECUTE_RETAIN_CONDITION', false);
//define('PERMISSION_DISABLE', true);

define('WORD', 0);
define('PICTURE', 1);
define('FILL', 2);
define('TOUCH', 3);


define('TYPE_TOTAL', 20);

//search
define('SEARCH_ALL', 9999);
define('SEARCH_UPDATE_TIME', 1);
define('SEARCH_QUESTION_ID', 2);
define('SEARCH_ASC', 1);
define('SEARCH_DESC', 2);
define('SEARCH_SUPER_ALL', 'all');

//admin
define('SALT', '3f372a845cb88d5bf8423edbff66809b');
define('DEFAULT_PASSWORD', '888888');
date_default_timezone_set('PRC');
define('NOW',date('Y-m-d H:i:s'));
define('TODAY', date('Y-m-d'));

//URL
define('SITE_BASE_URL', config_item('base_url').'/');
define('PIC_UPLOAD_URL', SITE_BASE_URL.'uploads/pic/');

//PATH
define('PIC_UPLOAD_PATH', 'uploads/pic/');

//status
define('STATUS_ACTIVE', 1);
define('STATUS_DISABLE', 0);
define('STATUS_PENDING', -1);
define('STATUS_DELETE', -2);

//response code
define('RESPONSE_CODE_UNAUTHORIZED', 401);

/* End of file application_config.php */
/* Location: ./application/config/application_config.php */
