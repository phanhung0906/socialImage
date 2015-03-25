<?php

/**
 * Class Common
 *
 * Popular function or method using in project
 */
class Common
{
    
    public static function datediff($date1, $date2) {
        $from =  is_int($date1) ? strtotime(date('Y-m-d', $date1)) : strtotime($date1);
        $to = is_int($date2) ? strtotime(date('Y-m-d', $date2)) : strtotime($date2);
        
        $difference = $from - $to;
        return floor($difference / (60 * 60 * 24));
    }
    /**
     * Debug
     *
     * Simple formatted debug function
     */
    public static function debug($var)
    {
        echo '<pre style="text-align: left;font-size: 14px;">';
        $trace = debug_backtrace();
        echo 'Line: ' . $trace[0]['line'] . '<br>';
        print_r($var);
        echo '</pre>';
    }

    /**
     * Debug then die
     *
     * Stop where you call the function
     */
    public static function debugdie($var)
    {
        echo '<pre style="text-align: left;font-size: 14px;">';
        $trace = debug_backtrace();
        echo 'Line: ' . $trace[0]['line'] . '<br>';
        print_r($var);
        echo '</pre>';
        die();
    }

    /*
    * generator token auto login
    */
    public static function genTokenLogin($userId) {
        return md5($userId.'kgfoerlsdfl3hhg90f1');
    }

    /*
    * Generator url login
    */

    public static function genLoginUrl($userId = null) {
        return isset($userId) ? Yii::app()->getBaseUrl(true).'/user/autologin?id='.$userId.'&token='.self::genTokenLogin($userId) : Yii::app()->getBaseUrl(true);
    }

    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    /**
     * generate password
     * string $pass
     */
    public static function genPassword($password)
    {
        for ($i=1; $i<=5; $i++){
            $password = self::generateRandomString($i%2+1) . base64_encode($password);
        }
        return $password;
    }
    
    /**
     * generate password backend
     * string $pass
     */
    public static function genPasswordAdmin($password)
    {
        return md5($password.'fdjr26y9klo') ;
    }
    

    /**
     * decode password
     * string $pass
     */
    public static function decodePassword($password)
    {
        for ($i=5; $i>=1; $i--){
            $password = substr($password, $i%2+1);
            $password = base64_decode($password);
        }
        return $password;
    }
    
    /**
     * Check current controler/action
     */
    public static function checkActive($controller,$action) {
        static $currentControler;
        static $currentAction;

        if(!isset($currentControler))
            $currentControler = Yii::app()->controller->id;
        
        if(!isset($currentAction))
            $currentAction = Yii::app()->controller->action->id;

        if (in_array($currentControler, (array)$controller) && in_array($currentAction, (array)$action)) {
            return 'actived';
        }
        
        return ''; 
    }
    
    public static function getVar($param,$default=''){
        return Yii::app()->request->getParam($param,$default);
        
    }
    
    /**
     * method use : baseUrl('admin/use') ,instead use Yii::app()->baseUrl.'admin/use'
    */
    
    public static function getBaseUrl($baseUrl){
        return Yii::app()->getBaseUrl(true).'/'.$baseUrl;
    }
    
    
    /**
     * Generate html code flash success or dont success
     */ 
    public static function getflashSuccess(){
        $success = Yii::app()->user->hasFlash('alert-success');
        $error = Yii::app()->user->hasFlash('alert-danger');
    
        $alert = '';
        if($success)
            $alert = 'alert-success';
        elseif($error)
        $alert = 'alert-danger';
    
        $str = '';
        if($alert)
            $str = '<div class="alert '.$alert.' alert-dismissable">'.
            '<i class="fa fa-check"></i>'.
            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>'.
            Yii::app()->user->getFlash($alert).
            '</div>';
        return $str;
    }

    
    /**
     * 
     * @param unknown $str
     * @param unknown $length
     * @param number $minword
     * @return string
     */
    public static function cutString($str, $length=100)
    {
        $sub = '';
        $len = 0;
        $str = strip_tags($str);
        $pattern = "/\s+/";
        $str = preg_replace($pattern, ' ', $str);
        foreach (explode(' ', $str) as $word)
        {
            $part = (($sub != '') ? ' ' : '') . $word;
            $sub .= $part;
            $len += strlen($part);
            if (strlen($sub) >= $length)
            {
                break;
            }
        }
        return $sub . (($len < strlen($str)) ? ' ... ' : '');
    }

    /**
     * check date null or not
     */
    public static function checkDate($date = null)
    {
        if ($date == '0000-00-00') return '';
        return $date;
    }

    /**
     * Generate an random token
     */
    public static function genToken()
    {
        return uniqid('token_');
    }

    /**
     * Send mail using PHPMailer
     */
    public static function sendMail($emailAdd, $subject, $content, $from = null, $attachments = null)
    {
        //Sent mail login info
        Yii::import('application.extensions.phpmailer.JPhpMailer');

        $mail = new JPhpMailer();

        //Config setting
        $mail->Host = Constant::HOST;
        $mail->SMTPSecure = Constant::SMTPSECURE;
        $mail->Username = Constant::EMAIL_SEND;
        $mail->Port = Constant::PORT;
        $mail->Password = Constant::PASSWORD;
        $mail->Mailer = Constant::MAILER;
        $mail->CharSet = Constant::CHARSET;
        $mail->SMTPAuth = true;
        $mail->SMTPKeepAlive = true;
        $mail->IsSMTP();

        //Setting default sender
        $from == null ? $mail->SetFrom(Constant::EMAIL_SEND, 'KabuEC | Administrator')
            : $mail->SetFrom($from['mail_account'], $from['mail_name']);

        $mail->Subject = $subject;

        $mail->MsgHTML($content);

        if (!is_array($attachments)) {
            $attachments = array($attachments);
        }
        foreach ($attachments as $attachment) {
            $path = isset($attachment['path']) ? $attachment['path'] : null;
            $name = isset($attachment['name']) ? $attachment['name'] : '';
            $encoding = isset($attachment['encoding']) ? $attachment['encoding'] : 'base64';
            $type = isset($attachment['type']) ? $attachment['type'] : 'application/octet-stream';
            if ($path) {
                $mail->AddAttachment($path, $name, $encoding, $type);
            }
        }

        if (is_array($emailAdd)) {
            if (isset($emailAdd['mail'])) {
                foreach ((array)$emailAdd['mail'] as $to) {
                    if ($to != null) {
                        $mail->AddAddress($to);
                    }
                }
            }

            if (isset($emailAdd['CC'])) {
                foreach ((array)$emailAdd['CC'] as $cc) {
                    if ($cc != null) {
                        $mail->AddCC($cc);
                    }
                }
            }
            if (isset($emailAdd['BCC'])) {
                foreach ((array)$emailAdd['BCC'] as $bcc) {
                    if ($bcc != null) {
                        $mail->AddBCC($bcc);
                    }
                }
            }
            if (!isset($emailAdd['mail'])) {
                foreach ($emailAdd as $add) {
                    if ($add != null) {
                        $mail->AddAddress($add);
                    }
                }
            }

        } else {
            $mail->AddAddress($emailAdd);
        }

        if ($mail->Send()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Read a CSV and convert to array data
     * @param $filePath
     * @param array $arrKeyMap
     * @return array|bool
     */
    public static function csv2arr($filePath, $arrKeyMap = array()){
        if (($handle = fopen($filePath, "r")) === FALSE || !is_file($filePath))
            return false;
        $i = 0;
        $result = array();
        $arrkeyNew = array();
        while (($rows = fgetcsv($handle)) !== FALSE) {
            if($i==0){
                if(!empty($arrKeyMap))
                    $arrkeyNew = self::_mapKeyCSV($rows, $arrKeyMap);
                else
                    $arrkeyNew = $rows;
            }else{
                if(count($arrkeyNew) > count($rows)){
                    $count=count($arrkeyNew) - count($rows);
                    for($i=0;$i<$count;$i++){
                        $rows[]='';
                    }
                }
                $result[] = array_combine($arrkeyNew, $rows);
            }

            $i++;
        }
        fclose($handle);
        if($result)
            return $result;
        else
            return false;

    }

    /**
     * map key of csv
     *
     * @param $header array
     * @param $arraySrc array convert
     * @return array
     */
    public static function _mapKeyCSV($header, $arraySrc) {
        $headerName = array();
        foreach ((array)$header as $title) {
            $title = mb_convert_encoding($title, "UTF-8", "SJIS");
            $headerName[] = $arraySrc[trim($title)];
        }
        return $headerName;
    }
    
    public static function sendAutomail($email, $name = null, $data = array()) {
        $template = AutomailTemplate::model()->findByAttributes(array('name' => $name));

        if($template) {
            $content = stripslashes($template->content);
            $title = $template->title;
            if(!empty($data)) {
                $content = strtr($content, $data);
                $title = strtr($title, $data);
                //$keys = array_keys($data);
                //$values = array_values($data);
                //$content = str_replace($keys, $values, $content);
            }

            // Register mail to cron mail
            MailSender::register(
                Constant::ADMIN_EMAIL,
                $template->id,
                $email,
                $title,
                $content, 
                array(), 
                time(), 
                Constant::ADMIN_TITLE
            );
        }
    }

    public static function sendMailMagazine($email, $title, $content, $data = array(), $fileAttach) {
        $newContent = stripslashes($content);
        if(!empty($data)) {
            $newContent = strtr($newContent, $data);
        }

        // Register mail to cron mail
        MailSender::register(
            Constant::ADMIN_EMAIL,
            MailSender::TYPE_MAIL_MAGAZINE,
            $email,
            $title,
            $newContent,
            array(),
            time(),
            Constant::ADMIN_TITLE,
            $finished = 1
        );

        return self::sendMail($email, $title, $newContent, null, $fileAttach);
    }
	
	public static function php_file_tree($directory, $return_link, $extensions = array()) {
		// Generates a valid XHTML list of all directories, sub-directories, and files in $directory
		// Remove trailing slash
		$code = '';
		if(substr($directory, -1) == "/") $directory = substr($directory, 0, strlen($directory) - 1);
			$code .= Common::php_file_tree_dir($directory, $return_link, $extensions);
		return $code;
	}

	public static function php_file_tree_dir($directory, $return_link, $extensions = array(), $first_call = true) {
		// Recursive function called by php_file_tree() to list directories/files
		// Get and sort directories/files
		$file = (function_exists("scandir")) ? scandir($directory) : Common::php4_scandir($directory);
		natcasesort($file);
		// Make directories first
		$files = $dirs = array();
		foreach($file as $this_file) {
			$files[] = (is_dir("$directory/$this_file")) ? $this_file : $this_file;
		}
		$file = array_merge($dirs, $files);

		// Filter unwanted extensions
		if(!empty($extensions)) {
			foreach(array_keys($file) as $key) {
				if(!is_dir("$directory/$file[$key]")) {
					$ext = substr($file[$key], strrpos($file[$key], ".") + 1); 
					if(!in_array($ext, $extensions)) unset($file[$key]);
				}
			}
		}
		$php_file_tree = '';
		if(count($file) > 2) { // Use 2 instead of 0 to account for . and .. "directories"
			$php_file_tree = "<ul";
			if($first_call) { 
				$php_file_tree .= " class=\"php-file-tree\""; 
				$first_call = false; 			
			}
			$php_file_tree .= ">";
			foreach($file as $this_file) {
				if($this_file != "." && $this_file != "..") {
					if(is_dir("$directory/$this_file")) {
						// Directory
						$php_file_tree .= "<li class=\"pft-directory\"><a href=\"#\">" . htmlspecialchars($this_file) . "</a>";
						$php_file_tree .= Common::php_file_tree_dir("$directory/$this_file", $return_link ,$extensions, false);
						$php_file_tree .= "</li>";
					} else {					
						// Get extension (prepend 'ext-' to prevent invalid classes from extensions that begin with numbers)
						$ext = "ext-" . substr($this_file, strrpos($this_file, ".") + 1); 
						$link = str_replace("[link]", "$directory/" . urlencode($this_file), $return_link);
						$php_file_tree .= "<li class=\"pft-file " . strtolower($ext) . "\"><a href=\"$link\">" . htmlspecialchars($this_file) . "</a></li>";
					}
				}
			}
			$php_file_tree .= "</ul>";
		}
		return $php_file_tree;
	}

	// For PHP4 compatibility
	public static function php4_scandir($dir) {
		$dh  = opendir($dir);
		while( false !== ($filename = readdir($dh)) ) {
			$files[] = $filename;
		}
		sort($files);
		return($files);
	}
	
	public static function listFile($dir) {
		$result = array();
		if (is_dir($dir)) {
			$iterator = new RecursiveDirectoryIterator($dir);
			$i = 0;
			foreach (new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::CHILD_FIRST) as $file) {                    
				if($file->isFile()) {
					$result[$i]['path'] = str_replace("\\","/",$file->getPath());
					$result[$i]['filename'] = $file->getFilename();
				}
				$i++;
			}
		}
		$result = array_values($result);
		return $result;
	}
    
    public static function formatDate($date) {
        if (is_string($date)) {
            $time = strtotime($date);
        }
        elseif (is_int($date)) {
            $time = $date;
        }
        else {
            throw new Exception('Cannot convert date to timstamp');
        }
        
        return Yii::t('app', '{year}年{month}月{day}日', array('{year}' => date('Y', $time), '{month}' => date('m', $time), '{day}' => date('d', $time)));
    }
    
    public static function formatCurrency($amount) {
        return Yii::t('app', '{amount}円', array('{amount}' => number_format($amount, 0)));
    }
    
    public static function formatDays($period) {
        //{period}日
        return Yii::t('app', '{period} days', array('{period}' => $period));
    }

    public static function checkFreeMember($amount){
        if(is_null($amount) || $amount == 0){
            return Yii::t('app', '無料');
        } else {
            return Common::formatCurrency($amount);
        }
    }

    public static function convertToUtf8($headerString){
        return @mb_convert_encoding($headerString, 'UTF-8', 'Shift_JIS, eucJP-win, ISO-2022-JP, UTF-7, ASCII, EUC-JP, '.mb_internal_encoding() . ', SJIS, Shift_JIS, SJIS-win, JIS');
    }

    public static function listCountryCode($key='') {
        static $data;
        if (!$data) {
            $data = array(
                93 => 'Afghanistan (93)'
            , 355 => 'Albania (355)'
            , 213 => 'Algeria (213)'
            , 684 => 'Samoa (684)'
            , 376 => 'Andorra (376)'
            , 244 => 'Angola (244)'
            , '1-264' => 'Anguilla (1-264)'
            , 672 => 'Norfolk Island (672)'
            , '1-268' => 'Antigua and Barbuda (1-268)'
            , 54 => 'Argentina (54)'
            , 374 => 'Armenia (374)'
            , 297 => 'Aruba (297)'
            , 61 => 'Cocos (Keeling) Islands (61)'
            , 43 => 'Austria (43)'
            , 994 => 'Azerbaijan (994)'
            , '1-242' => 'Bahamas (1-242)'
            , 973 => 'Bahrain (973)'
            , 880 => 'Bangladesh (880)'
            , '1-246' => 'Barbados (1-246)'
            , 375 => 'Belarus (375)'
            , 32 => 'Belgium (32)'
            , 501 => 'Belize (501)'
            , 229 => 'Benin (229)'
            , '1-441' => 'Bermuda (1-441)'
            , 975 => 'Bhutan (975)'
            , 591 => 'Bolivia (591)'
            , 387 => 'Bosnia-Herzegovina (387)'
            , 267 => 'Botswana (267)'
            , 55 => 'Brazil (55)'
            , 673 => 'Brunei Darussalam (673)'
            , 359 => 'Bulgaria (359)'
            , 226 => 'Burkina Faso (226)'
            , 257 => 'Burundi (257)'
            , 855 => 'Cambodia (855)'
            , 237 => 'Cameroon (237)'
            , 1 => 'USA (1)'
            , 238 => 'Cape Verde (238)'
            , '1-345' => 'Cayman Islands (1-345)'
            , 236 => 'Central African Republic (236)'
            , 235 => 'Chad (235)'
            , 56 => 'Chile (56)'
            , 86 => 'China (86)'
            , 1 => 'Canada (1)'
            , 57 => 'Colombia (57)'
            , 269 => 'Mayotte (269)'
            , 242 => 'Congo (242)'
            , 243 => 'Congo, Dem. Republic (243)'
            , 682 => 'Cook Islands (682)'
            , 506 => 'Costa Rica (506)'
            , 385 => 'Croatia (385)'
            , 53 => 'Cuba (53)'
            , 357 => 'Cyprus (357)'
            , 420 => 'Czech Rep. (420)'
            , 45 => 'Denmark (45)'
            , 253 => 'Djibouti (253)'
            , '1-767' => 'Dominica (1-767)'
            , 809 => 'Dominican Republic (809)'
            , 593 => 'Ecuador (593)'
            , 20 => 'Egypt (20)'
            , 503 => 'El Salvador (503)'
            , 240 => 'Equatorial Guinea (240)'
            , 291 => 'Eritrea (291)'
            , 372 => 'Estonia (372)'
            , 251 => 'Ethiopia (251)'
            , 500 => 'Falkland Islands (Malvinas) (500)'
            , 298 => 'Faroe Islands (298)'
            , 679 => 'Fiji (679)'
            , 358 => 'Finland (358)'
            , 33 => 'France (33)'
            , 594 => 'French Guiana (594)'
            , 241 => 'Gabon (241)'
            , 220 => 'Gambia (220)'
            , 995 => 'Georgia (995)'
            , 49 => 'Germany (49)'
            , 233 => 'Ghana (233)'
            , 350 => 'Gibraltar (350)'
            , 44 => 'U.K. (44)'
            , 30 => 'Greece (30)'
            , 299 => 'Greenland (299)'
            , '1-473' => 'Grenada (1-473)'
            , 590 => 'Guadeloupe (French) (590)'
            , '1-671' => 'Guam (USA) (1-671)'
            , 502 => 'Guatemala (502)'
            , 224 => 'Guinea (224)'
            , 245 => 'Guinea Bissau (245)'
            , 592 => 'Guyana (592)'
            , 509 => 'Haiti (509)'
            , 504 => 'Honduras (504)'
            , 852 => 'Hong Kong (852)'
            , 36 => 'Hungary (36)'
            , 354 => 'Iceland (354)'
            , 91 => 'India (91)'
            , 62 => 'Indonesia (62)'
            , 98 => 'Iran (98)'
            , 964 => 'Iraq (964)'
            , 353 => 'Ireland (353)'
            , 972 => 'Israel (972)'
            , 39 => 'Vatican (39)'
            , 225 => 'Ivory Coast (225)'
            , '1-876' => 'Jamaica (1-876)'
            , 81 => 'Japan (81)'
            , 962 => 'Jordan (962)'
            , 7 => 'Russia (7)'
            , 254 => 'Kenya (254)'
            , 686 => 'Kiribati (686)'
            , 850 => 'Korea-North (850)'
            , 82 => 'Korea-South (82)'
            , 965 => 'Kuwait (965)'
            , 996 => 'Kyrgyzstan (996)'
            , 856 => 'Laos (856)'
            , 371 => 'Latvia (371)'
            , 961 => 'Lebanon (961)'
            , 266 => 'Lesotho (266)'
            , 231 => 'Liberia (231)'
            , 218 => 'Libya (218)'
            , 423 => 'Liechtenstein (423)'
            , 370 => 'Lithuania (370)'
            , 352 => 'Luxembourg (352)'
            , 853 => 'Macau (853)'
            , 389 => 'Macedonia (389)'
            , 261 => 'Madagascar (261)'
            , 265 => 'Malawi (265)'
            , 60 => 'Malaysia (60)'
            , 960 => 'Maldives (960)'
            , 223 => 'Mali (223)'
            , 356 => 'Malta (356)'
            , 692 => 'Marshall Islands (692)'
            , 596 => 'Martinique (French) (596)'
            , 222 => 'Mauritania (222)'
            , 230 => 'Mauritius (230)'
            , 52 => 'Mexico (52)'
            , 691 => 'Micronesia (691)'
            , 373 => 'Moldova (373)'
            , 377 => 'Monaco (377)'
            , 976 => 'Mongolia (976)'
            , 382 => 'Montenegro (382)'
            , '1-664' => 'Montserrat (1-664)'
            , 212 => 'Morocco (212)'
            , 258 => 'Mozambique (258)'
            , 95 => 'Myanmar (95)'
            , 264 => 'Namibia (264)'
            , 674 => 'Nauru (674)'
            , 977 => 'Nepal (977)'
            , 31 => 'Netherlands (31)'
            , 599 => 'Netherlands Antilles (599)'
            , 687 => 'New Caledonia (French) (687)'
            , 64 => 'New Zealand (64)'
            , 505 => 'Nicaragua (505)'
            , 227 => 'Niger (227)'
            , 234 => 'Nigeria (234)'
            , 683 => 'Niue (683)'
            , 670 => 'Northern Mariana Islands (670)'
            , 47 => 'Norway (47)'
            , 968 => 'Oman (968)'
            , 92 => 'Pakistan (92)'
            , 680 => 'Palau (680)'
            , 507 => 'Panama (507)'
            , 675 => 'Papua New Guinea (675)'
            , 595 => 'Paraguay (595)'
            , 51 => 'Peru (51)'
            , 63 => 'Philippines (63)'
            , 48 => 'Poland (48)'
            , 689 => 'Polynesia (French) (689)'
            , 351 => 'Portugal (351)'
            , '1-787' => 'Puerto Rico (1-787)'
            , 974 => 'Qatar (974)'
            , 262 => 'Reunion (French) (262)'
            , 40 => 'Romania (40)'
            , 250 => 'Rwanda (250)'
            , 290 => 'Saint Helena (290)'
            , '1-869' => 'Saint Kitts & Nevis Anguilla (1-869)'
            , '1-758' => 'Saint Lucia (1-758)'
            , 508 => 'Saint Pierre and Miquelon (508)'
            , '1-784' => 'Saint Vincent & Grenadines (1-784)'
            , 378 => 'San Marino (378)'
            , 239 => 'Sao Tome and Principe (239)'
            , 966 => 'Saudi Arabia (966)'
            , 221 => 'Senegal (221)'
            , 381 => 'Serbia (381)'
            , 248 => 'Seychelles (248)'
            , 232 => 'Sierra Leone (232)'
            , 65 => 'Singapore (65)'
            , 421 => 'Slovakia (421)'
            , 386 => 'Slovenia (386)'
            , 677 => 'Solomon Islands (677)'
            , 252 => 'Somalia (252)'
            , 27 => 'South Africa (27)'
            , 34 => 'Spain (34)'
            , 94 => 'Sri Lanka (94)'
            , 249 => 'Sudan (249)'
            , 597 => 'Suriname (597)'
            , 268 => 'Swaziland (268)'
            , 46 => 'Sweden (46)'
            , 41 => 'Switzerland (41)'
            , 963 => 'Syria (963)'
            , 886 => 'Taiwan (886)'
            , 992 => 'Tajikistan (992)'
            , 255 => 'Tanzania (255)'
            , 66 => 'Thailand (66)'
            , 228 => 'Togo (228)'
            , 690 => 'Tokelau (690)'
            , 676 => 'Tonga (676)'
            , '1-868' => 'Trinidad and Tobago (1-868)'
            , 216 => 'Tunisia (216)'
            , 90 => 'Turkey (90)'
            , 993 => 'Turkmenistan (993)'
            , '1-649' => 'Turks and Caicos Islands (1-649)'
            , 688 => 'Tuvalu (688)'
            , 256 => 'Uganda (256)'
            , 380 => 'Ukraine (380)'
            , 971 => 'United Arab Emirates (971)'
            , 598 => 'Uruguay (598)'
            , 998 => 'Uzbekistan (998)'
            , 678 => 'Vanuatu (678)'
            , 58 => 'Venezuela (58)'
            , 84 => 'Vietnam (84)'
            , '1-284' => 'Virgin Islands (British) (1-284)'
            , '1-340' => 'Virgin Islands (USA) (1-340)'
            , 681 => 'Wallis and Futuna Islands (681)'
            , 967 => 'Yemen (967)'
            , 260 => 'Zambia (260)'
            , 263 => 'Zimbabwe (263)'
            );
        }
        return $key !== '' ? (isset($data[$key]) ? $data[$key] : null) : $data;
    }

}