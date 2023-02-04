<?php
	class PaginationsAjax
	{
		public $perpage;
		
		function __construct()
		{
			$this->perpage = 1;
		}
		
		function getAllPageLinks($count,$href,$elShow,$page)
		{
			$output = '';

			if(!isset($_GET["p"])) $_GET["p"] = 1;

			if($this->perpage != 0)
				$pages = ceil($count/$this->perpage);

			if($pages>1)
			{
				$output = $output . "<ul class='pagination justify-content-center mb-0'>";
				$output = $output . "<li class='page-item d-none d-sm-block'><a class='page-link'>Page {$page} / {$pages}</a></li>";

				if($_GET["p"] == 1){
					
					//$output = $output . '<a class="first disabled">First</a><a class="disabled">Prev</a>';
				} 	
				else{	
					$output = $output . '<li class="page-item d-none d-sm-block"><a class="page-link" href="javascript:void(0)" onclick="loadPagingAjax(\'' . $href . (1) . '\',\''.$elShow.'\',0,'.$this->perpage.')" >First</a></li>';
					$output = $output . '<li class="page-item d-none d-sm-block"><a class="page-link" onclick="loadPagingAjax(\'' . $href . ($_GET["p"]-1) . '\',\''.$elShow.'\',0,'.$this->perpage.')" href="javascript:void(0)">Prev</a></li>';
				}
				if(($_GET["p"]-3)>0)
				{
					if($_GET["p"] == 1)
						$output = $output . '<li class="page-item active"><a id=1 href="javascript:void(0)" class="page-link">1</a></li>';
					else				
						$output = $output . '<li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="loadPagingAjax(\'' . $href . '1\',\''.$elShow.'\',0,'.$this->perpage.')" >1</a></li>';
				}
				if(($_GET["p"]-3)>1)
				{
					$output = $output . '<li class="page-item"><a class="page-link dot">...</a></li>';
				}
				
				for($i=($_GET["p"]-2); $i<=($_GET["p"]+2); $i++)
				{
					if($i<1) continue;
					if($i>$pages) break;
					if($_GET["p"] == $i)
						$output = $output . '<li class="page-item active"><a href="javascript:void(0)" class="page-link" id='.$i.' class="current">'.$i.'</a></li>';
					else				
						$output = $output . '<li class="page-item"><a href="javascript:void(0)" class="page-link" onclick="loadPagingAjax(\'' . $href . $i . '\',\''.$elShow.'\',0,'.$this->perpage.')" >'.$i.'</a></li>';
				}
				
				if(($pages-($_GET["p"]+2))>1)
				{
					$output = $output . '<li class="page-item"><a class="page-link dot">...</a></li>';
				}
				if(($pages-($_GET["p"]+2))>0)
				{
					if($_GET["p"] == $pages)
						$output = $output . '<li class="page-item active"><a href="javascript:void(0)" class="page-link" id=' . ($pages) .' class="current">' . ($pages) .'</a></li>';
					else				
						$output = $output . '<li class="page-item"><a href="javascript:void(0)" class="page-link" onclick="loadPagingAjax(\'' . $href .  ($pages) .'\',\''.$elShow.'\',0,'.$this->perpage.')" >' . ($pages) .'</a></li>';
				}
				
				if($_GET["p"] < $pages)
					$output = $output . '<li class="page-item d-none d-sm-block"><a href="javascript:void(0)" class="page-link" onclick="loadPagingAjax(\'' . $href . ($_GET["p"]+1) . '\',\''.$elShow.'\',0,'.$this->perpage.')" >Next</a></li><li class="page-item d-none d-sm-block"><a href="javascript:void(0)" class="page-link" onclick="loadPagingAjax(\'' . $href . ($pages) . '\',\''.$elShow.'\',0,'.$this->perpage.')" >Last</a></li>';
				else{				
					//$output = $output . '<a class="disabled">Next</a><a class="disabled">Last</a>';
				}
				$output = $output .= "</ul>";

			}

			return $output;
		}

		function getPrevNext($count,$href,$elShow)
		{
			$output = '';

			if(!isset($_GET["p"])) $_GET["p"] = 1;

			if($this->perpage != 0)
				$pages  = ceil($count/$this->perpage);

			if($pages>1)
			{
				if($_GET["p"] == 1) 
					$output = $output . '<a class="disabled first">Prev</a>';
				else	
					$output = $output . '<a class="first" onclick="loadPagingAjax(\'' . $href . ($_GET["p"]-1) . '\',\''.$elShow.'\',0,'.$this->perpage.')" >Prev</a>';			
			
				if($_GET["p"] < $pages)
					$output = $output . '<a onclick="loadPagingAjax(\'' . $href . ($_GET["p"]+1) . '\',\''.$elShow.'\',0,'.$this->perpage.')" >Next</a>';
				else				
					$output = $output . '<a class="disabled">Next</a>';
			}

			return $output;
		}
	}
?>