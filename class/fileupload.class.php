<?php
/**
 * 文件上传类
 * @author hetao
 *
 */
class FileUpload{
	
	private $path = "./uploads";
	private $allowType = array('jpg','gif','png');
	private $maxSize = 1000000;
	private $isRandName = true;
	private $originName ;
	private $tempFileName ;
	private $fileType ;
	private $fileSize;
	private $newFileName;
	private $errorNum = 0;
	private $errorMsg = "";
	
	/**
	 * 设置成员属性的方法
	 * @param string $key 成员属性名
	 * @param mixed $val 成员属性要设置的值
	 * @return FileUpload 返回自己对象，用于连贯操作
	 */
	function set($key, $val){
		
		if(array_key_exists($key, get_class_vars(get_class($this)))){
			$this->setOption($key, $val);
		}
		return $this;
	}
	
	/**
	 * 获取成员属性的方法
	 * @param string $key 成员属性名
	 * @return Object 返回成员属性的值
	 */
	function get($key){
		if(array_key_exists($key, get_class_vars(get_class($this)))){
			return $this->$key;
		}
		return null;
	}
	
	/**
	 * 文件上传方法
	 * @param string $formFileName 文件表单中的name属性名
	 * @return boolean 返回一个表明操作是否成功的boolean变量
	 */
	function upload($formFileName){
	
		$return = true;
		if(!$this->checkFilePath()){
			$this->errorMsg = $this->getError();
			return false;
		}
		
		if(isset($_FILES[$formFileName])){
			$name = $_FILES[$formFileName]['name'];
			$tmp_name = $_FILES[$formFileName]['tmp_name'];
			$size = $_FILES[$formFileName]['size'];
			$error = $_FILES[$formFileName]['error'];
			
			if(is_array($name)){
				$errors = array();
			
				for($i = 0; $i < count($name); $i++){
					if($this->setFiles($name[$i], $tmp_name[$i], $size[$i], $error[$i])){
						if(!$this->checkFileSize() || !$this->checkFileType()){
							$errors[] = $this->getError();
							$return = false;
						}
					}
					else {
						$errors[] = $this->getError();
						$return = false;
					}
			
					if(!$return){
						$this->setFiles();
					}
				}
			
				if($return){
					$fileNames = array();
					for($i = 0; $i < count($name); $i++){
						if($this->setFiles($name[$i], $tmp_name[$i], $size[$i], $error[$i])){
							$this->setNewFileName();
							if(!$this->copyFile()){
								$errors[] = $this->getError();
								$return = false;
							}
							$fileNames[] = $this->newFileName;
						}
					}
			
					$this->newFileName = $fileNames;
				}
			
				$this->errorMsg = $errors;
				return $return;
			}
			else{
				if($this->setFiles($name, $tmp_name, $size, $error)){
					if($this->checkFileSize() && $this->checkFileType()){
						$this->setNewFileName();
						if($this->copyFile()){
							return true;
						}
						else{
							$return = false;
						}
					}
					else{
						$return = false;
					}
				}
				else {
					$return = false;
				}
			
				if(!$return){
					$this->errorMsg = $this->getError();
				}
			
				return $return;
			}
		}
		else{
			$this->setOption('errorNum', 4);
			$this->errorMsg = $this->getError();
			return false;
		}
		
	}
	
	/**
	 * 获取上传后文件的名字
	 * @return mixed 返回文件名字
	 */
	function getFileName(){
		return $this->newFileName;
	}
	
	/**
	 * 获取文件上传出错信息
	 * @return string 返回错误信息
	 */
	function getErrorMsg(){
		return $this->errorMsg;
	}
	
	
	
	//为单个成员属性设置值
	private function setOption($key, $val){
		$this->$key = $val;
	}
	
	//检查文件路径
	private function checkFilePath(){
		if(empty($this->path)){
			$this->setOption('errorNum', -5);
			return false;
		}
		
		if(!file_exists($this->path) || !is_writeable($this->path)){
			if(!mkdir($this->path, 0755)){
				$this->setOption('errorNum', -4);
				return false;
			}
		}
		
		return true;
	}
	
	//获取错误信息
	private function getError(){
		$str = "上传文件<font color='red'>{$this->originName}</font>时出错：";
		switch ($this->errorNum){
			case 4: $str .= "没有文件被上传";break;
			case 3: $str .= "文件只有部分被上传";break;
			case 2: $str .= "上传文件大小超过了表单中规定大小";break;
			case 1: $str .= "上传文件大小超过了php.ini中规定的大小";break;
			case -1: $str .= "未允许类型";break;
			case -2: $str .= "文件过大，上传文件不能超过{$this->maxSize}个字节";break;
			case -3: $str .= "上传失败";break;
			case -4: $str .= "建立上传目录失败";break;
			case -5: $str .= "必须指定上传文件路径";break;
			default:$str .= "未知错误";
		}
		return $str.'<br/>';
	}
	
	//设置文件属性
	private function setFiles($name="", $tmp_name = "", $size = 0, $error = 0){
		$this->setOption('errorNum', $error);
		if($error){
			return false;
		}
		$this->setOption('originName', $name);
		$this->setOption('tempFileName', $tmp_name);
		$aryStr = explode(".", $name);
		$this->setOption('fileType', strtolower($aryStr[count($aryStr)-1]));
		$this->setOption('fileSize', $size);
		
		return true;
	}
	
	//检查文件大小
	private function checkFileSize(){
		if($this->fileSize > $this->maxSize){
			$this->setOption('errorNum', -2);
			return false;
		}
		else {
			return true;
		}
	}
	
	//检查文件类型
	private function checkFileType(){
		if(in_array(strtolower($this->fileType), $this->allowType)){
			return true;
		}
		else{
			$this->setOption('errorNum', -1);
			return false;
		}
	}
	
	//设置新的文件名
	private function setNewFileName(){
		if($this->isRandName){
			$this->setOption('newFileName', $this->proRandName());
		}
		else{
			$this->setOption('newFileName', $this->originName);
		}
	}
	
	//根据系统时间产生随机名字
	private function proRandName(){
		$fileName = date('YmdHis')."_".rand(100,999);
		return $fileName.".".$this->fileType;
	}
	
	//将上传文件转移到上传文件目录
	private function copyFile(){
		if(!$this->errorNum){
			$path = rtrim($this->path, '/').'/';
			$path .= $this->newFileName;
			
			if(@move_uploaded_file($this->tempFileName, $path)){
				return true;
			}
			else{
				$this->setOption('errorNum', -3);
				return false;
			}
		}
		else{
			return false;
		}
	}

}