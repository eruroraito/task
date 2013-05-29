<?php
	require_once 'cmddef.php';
	require_once 'config.php';
	/**
	 * send gm cmd to central server
	 * @author lqt
	 *
	 */
	class GsServer {
		public $h;
		static $buf;
		/**
		 * @return unknown_type
		 */
		function connect(){
			if (!$this->h){
				$errstr = $errno =null;
				$this->h = fsockopen($GLOBALS['centralServer'],$GLOBALS['port'], $errno, $errstr, 5);
				stream_set_timeout( $this->h ,5) ; 
				if (!$this->h) throw new ErrorException("connect failed ($errno)\n");
			}
			return true;
		}	
		/**
		 * close link
		 * @return unknown_type
		 */
		function disconnect(){
			if ($this->h)return fclose($this->h);
			return true;
		}	
		/**
		 * transfer to charset
		 * @param $buf
		 * @param $size
		 * @return unknown_type
		 */
		function _2hex($buf, $size=2){
			$s = current(unpack("H*",$buf));
			$buf2 = '';
			$max = strlen($s);
			for($i=0;$i<$max;$i+=$size){
				$buf2 .= substr($s,$i,2)." ";
			}
			return $buf2;
		}	
		
		/**
		 * socket read
		 * @param $expire
		 * @return unknown_type
		 */
		function read($expire = 3){
			self::$buf = '';
			$lenleft = null;
			$this->connect();
			$cur = microtime(true);
	
			while(is_null($lenleft) || $lenleft>0){
				if (!is_null($lenleft)){
					if ($lenleft>8192)
						$tmp = fread($this->h,8192);
					else 
						$tmp = fread($this->h,$lenleft);					
				}
				else {
					$tmp = fread($this->h,8192);
					$status = stream_get_meta_data($this->h) ;
			        if( $status['timed_out'] ){
			           fclose($this->h);
			           return 9999;
			        }				
					if (!empty($tmp)){
						$len = current(unpack('v',substr($tmp,1,2))) + 2;
					}
				}
				if (!empty($tmp)){
					self::$buf .= $tmp;
					$lenleft = $len - strlen(self::$buf);
				}
	
				if (microtime(true)-$cur>$expire) break;
			}
			if (strlen(self::$buf)>=$len){
			    self::$buf = substr(self::$buf,5,$len-6);
			}
			
		}
	
		function write($str){
			$this->connect();
			return fwrite($this->h,$str);
		}		
		
		/**
		 * generate send to centralserver pack
		 * @param $param_v
		 * @param $cmdcode
		 * @return unknown_type
		 */
		public function genPack($param_nv,$cmdcode){
			global $def	;
			$wHead 	    = 0;        //4byte
			$wLen       = 0;        //2byte
			$packstr    = "";
			$strs ="";
			$paramdef   = $def[$cmdcode]['params'];
			if($cmdcode == 'qlist')
			    $wCmd 		= 0x0001;   //2byte
			else
			    $wCmd 		= 0x0002;   //2byte
			foreach($param_nv as $n=>$v){
				$type = $paramdef[$n]['type'];
				switch ($type){
					case 'int':
					{						
						$packstr .= pack('V',$v);$strs.= $v;
						break;
					}
					case 'short':
					{
						$packstr .= pack('v',$v);$strs.= $v;
						break;
					}
					case 'char':
					{
						$packstr .= $v;$strs.= $v;
						break;
					}	
					case 'byte':
					{
						$packstr .= pack('c',$v);$strs.= $v;
						break;
					}	
					case 'array':
					{
						$packstr .= pack('v',E_QUESTIN_MAX);$strs.= E_QUESTIN_MAX;
						foreach($v as $key=>$value){
							$num = $value['option']['option_num'];
							$prop = $value['prop'];
							$detail = $value['option']['option_detail'];
							$packstr .= pack('v',$num);$strs.= $num;
							$tem_d ="";
							for($i=0;$i<$num;$i++)
							{
								$tem_d.= $detail[$i];
							}
							$packstr .= pack('C',$tem_d);$strs.= $tem_d;
							$packstr .= pack('v',$prop);$strs.= $prop;
						}	
					}

				}			
			}
			$packstr = pack('v',$wCmd).$packstr;		
			$packstr = pack('v',strlen($packstr)+2).$packstr;	
			$packstr = "(".$packstr.")";
			return $packstr;
		}
		
	    public function getQuestion(&$voteall,$aqid,$num,$name,&$begpos){
            for($i =0;$i < $num;$i++){
    	        $tmp_titleid  = current(unpack('V',substr(self::$buf,$begpos,4)));  //题号 4字节
    	        $begpos = $begpos+4;         
	            $tmp_ques_len = current(unpack('v',substr(self::$buf,$begpos,2)));   //题目名称长度 2字节	            
	            $begpos = $begpos+2;
	            $tmp_qus      = substr(self::$buf,$begpos,$tmp_ques_len);            //题目名称  x字节
	            $begpos = $begpos+$tmp_ques_len;
	            $tmp_time = current(unpack('C',substr(self::$buf,$begpos,1)));       //答题时间 1字节
	            $begpos = $begpos+1;
	            $tmp_type = current(unpack('C',substr(self::$buf,$begpos,1)));       //题目类型1字节
	            $begpos = $begpos+1;
	            $tmp_pic_serial = current(unpack('v',substr(self::$buf,$begpos,2))); //图标编号
	            $begpos = $begpos+2;
	            $tmp_fill_num = current(unpack('C',substr(self::$buf,$begpos,1)));  //填空个数
	            $begpos = $begpos+1;
	            $voteall[$name][$i] = array(
	                    'qid'=>$aqid,
        	            'titleid'=>$tmp_titleid,
        	            'ques'=>$tmp_qus,
        	            'ptime'=>$tmp_time,
       	           		'type'  =>$tmp_type,  
	            		'pic_serial'  =>$tmp_pic_serial,    
        	            'fill_num'=>$tmp_fill_num,
 	                    'answer'=>'',
	                    'sellist'=>'',         
	                ); 
	            $tmp_option = array();
	            $tmp_option_lenc = current(unpack('v',substr(self::$buf,$begpos,2))); //选项个数 2字节
	            $begpos = $begpos+2;
	            for($j=1;$j<$tmp_option_lenc+1;$j++){
	                $tmp_option_len = current(unpack('v',substr(self::$buf,$begpos,2)));  //选择长度2字节
	                $begpos = $begpos+2;
	                $tmp_option_name = substr(self::$buf,$begpos,$tmp_option_len);        //选择名称x字节
	                $begpos = $begpos+$tmp_option_len;
	                $tmp_option_id   = current(unpack('C',substr(self::$buf,$begpos,1)));  //选项id 2字节
	                $begpos = $begpos+1;
	                $tmp_option[$tmp_option_id]  = $tmp_option_name;
	            }
	            $voteall[$name][$i]['sellist'] = $tmp_option;
	            //答案
	            $tmp_option_answer_num = current(unpack('v',substr(self::$buf,$begpos,2)));
	            $begpos = $begpos+2;
	            $tmp_option_answer = '';
	        	for($j=1;$j<$tmp_option_answer_num+1;$j++)
	            {
	                $tmp_option_id = current(unpack('C',substr(self::$buf,$begpos,1)));  //选择长度2字节
	                $begpos = $begpos+1;
	                $tmp_option_answer .= $tmp_option_id;	                
	            }
	            $voteall[$name][$i]['answer']  = $tmp_option_answer;
	        }
	        // 勋章数；[对手玩家基本信息]=0长度
	        $begpos = $begpos+1;
	        $begpos = $begpos+2;
       }
         /**
		 * 构建答题数组
		 * @param $recbuf
		 * @return unknown_type
		 */
	    public function buildQuest()
	    {
            //S:[i_t,      [i_t,  s_t, w_t, w_t,      [s_t, w_t],w_t ], s_t ]
            //题目列表编号，列表[2字节数组长度][题目id, 题目,答题时间(秒数)，题目类型(0-文字)，[2字节数组长度][选项文字,选项编号],答案编号]; 发起玩家名字
            //echo self::$buf;
            
            //S:[i_t, b_t, [i_t, s_t,b_t,b_t,w_t,b_t,[s_t, b_t],[b_t] ],b_t,[对手玩家基本信息],s_t,i_t,b_t,w_t  ]
			//题目列表编号， b_t=1微信协助；2微信挑战
			//列表[题目id,题目,答题时间(秒数)，题目类型(0-文字,1-图像,2-填字)，图标编号，填空个数，[选项文字,选项编号],[答案]]; 勋章数；[对手玩家基本信息],发起者名字，图标编号，答对数，答对时间"
	    	
            $voteall = array();         
            	/*
        	       0 =>array(
        	       	    'qid'=>$aqid,
        	            'titleid'=>'题目id',
        	            'ques'=>'题目',
        	            'ptime'=>'答题时间',
        	            'type'  =>'题目类型(文字)',
        	            'pic_serial'  =>'图片地址',    
        	            'fill_num'=>'答案个数',
        	            'answer'=>'答案',    	                   	            
        	            'sellist'=>array(
        	                '1' =>'第1',
        	                '2' =>'第2',
        	                '3' =>'第3',
        	                '4' =>'第4',
        	            )
        	        ),
        	        */   

            $begpos = 0;
            //1微信协助；2微信挑战
            $q_ret = current(unpack('C',substr(self::$buf,$begpos,1)));
            $begpos = $begpos + 1;
            //试卷编号
            $aqid = current(unpack('V',substr(self::$buf,$begpos,4)));
            $begpos = $begpos + 4;
            //暂时没用 
            $nouse = current(unpack('C',substr(self::$buf,$begpos,1)));
            $begpos = $begpos + 1;

            $aqcounter_recipient = current(unpack('v',substr(self::$buf,$begpos,2)));
            $begpos = $begpos + 2;
            //echo "题目个数".$aqcounter."\n";
            //echo "---------------------------------------------";
            //print_r($aqcounter);
            //if($aqcounter_recipient==0)
            //{
            //	require_once 'question.php';//本地题目，在没有获取线上题目时调用
           // }
            //print_r($voteall);
           // print_r($voteall['challenger']['q_ret']);



            $this->getQuestion($voteall,$aqid,$aqcounter_recipient,'recipient',$begpos);
            
	        //发起者名字
	        $tmp_ques_len = current(unpack('v',substr(self::$buf,$begpos,2)));
	        $begpos = $begpos+2;
	        $ques_name_challenge = substr(self::$buf,$begpos,$tmp_ques_len);
	        $begpos = $begpos+$tmp_ques_len;
	        //图标编号
	        $ques_role_icon = current(unpack('V',substr(self::$buf,$begpos,4)));
	        $begpos = $begpos+4;
            
           	//nouse
           	$begpos = $begpos + 1;
	        $aqcounter_challenger = current(unpack('v',substr(self::$buf,$begpos,2)));
            $begpos = $begpos + 2;
            
            $this->getQuestion($voteall,$aqid,$aqcounter_challenger,'challenger',$begpos);
            
	        $aqcounter_challenger_answer = current(unpack('v',substr(self::$buf,$begpos,2)));
            $begpos = $begpos + 2;
            for($i =0;$i < $aqcounter_challenger_answer;$i++)
            {
            	//select
		        $aqcounter_challenger_answer_selnum = current(unpack('v',substr(self::$buf,$begpos,2)));
	            $begpos = $begpos + 2;
	            $challenger_option = '';
	            //print_r($aqcounter_challenger_answer_selnum);
	            for($j =0;$j < $aqcounter_challenger_answer_selnum;$j++)
	            {
	            	$challenger_option .= current(unpack('C',substr(self::$buf,$begpos,1)));
	            	$begpos = $begpos + 1;
	            }
            	$voteall['challenger'][$i]['q_option'] = $challenger_option;
            	
                //item_use
		        $aqcounter_challenger_answer_itemnum = current(unpack('v',substr(self::$buf,$begpos,2)));
		        //print_r($aqcounter_challenger_answer_itemnum);
	            $begpos = $begpos + 2;
	            $challenger_prop = '';
	            for($j =0;$j < $aqcounter_challenger_answer_itemnum;$j++)
	            {
	            	$challenger_prop .= current(unpack('C',substr(self::$buf,$begpos,1)));
	            	$begpos = $begpos + 1;
	            }
            	$voteall['challenger'][$i]['q_prop'] = $challenger_prop;
            }

	        //答对数
	        $ques_role_correct_num = current(unpack('C',substr(self::$buf,$begpos,1)));
	        $begpos = $begpos+1;
	        //答对时间
	        $ques_role_cost_time = current(unpack('v',substr(self::$buf,$begpos,2)));
	        $begpos = $begpos+2;
	   		
	   		if($aqcounter_challenger != 0)
	   		{
	   			$voteall['ret']   = $q_ret;
	   			$voteall['challenger_name']   = $ques_name_challenge;
	   			$voteall['challenger_role_icon']  = $ques_role_icon;
	   			$voteall['challenger_right_number'] = $ques_role_correct_num;
	   			$voteall['challenger_cost_time']   = $ques_role_cost_time;
	   		}
			//print_r(self::$buf);
			//if(!array_key_exists('challenger',$voteall)){
			//	print_r(1111);
			//}
			//print_r($voteall);
	        return $voteall;
	        //echo self::$buf;
	        //*/
	    }
		/**
		 * 
		 * @param $param_nv
		 * @param $cmdcode
		 * @return unknown_type
		 */
		public function execGmCmd($param_nv,$cmdcode)
		{
			$packstr = $this->genPack($param_nv,$cmdcode);
		    $this->write($packstr);
      		$readrs = $this->read(2);
      		if($readrs == 9999)
      		{
      			$ret['err'] = 999;
      		}
      		else
      		{
      		    $ret = $this->buildQuest();
      		}
      		//print_r($ret);
      		return $ret;			
		}
	}
?>