<?php
class brainfuck
{
	var $pointer=0;
	var $stack=array();
	var $loops=array();
	private $output;
	
	function __construct($memsize = 30000){
		$this->stack = array_fill(0,$memsize);
	}
	
	function parse($code=''){
		$codeLength = strlen($code);
		for($i=0; $i<$codeLength; $i++){
			switch($code[$i]){
				case '>':
					++$this->pointer;
					if($this->pointer<0) $this->pointer = 255;
					if($this->pointer>255) $this->pointer = 1;
				break;
				case '<':
					--$this->pointer;
					if($this->pointer<0) $this->pointer = 255;
					if($this->pointer>255) $this->pointer = 1;
				break;
				case '+':
					++$this->stack[$this->pointer];
				break;
				case '-':
					--$this->stack[$this->pointer];
				break;
				case '.':
					$this->output .= chr($this->stack[$this->pointer]);
				break;
				case ',':
					$this->stack[$this->pointer] = chr($this->stack[$this->pointer]);
				break;
				case '[':
					$this->loops[] = $i;
				break;
				case ']':
					if($this->stack[$this->pointer] == 0){
						array_pop($this->loops);
					} else{
						$i = $this->loops[count($this->loops)-1];
					}
				break;
				default:
					// Ignore non-syntax chars	
				break;
			}
		}
		return $this->output;
	}
}
?>
