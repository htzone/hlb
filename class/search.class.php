<?php
/**
 * 搜索类
 * 
 */
class Search {
	public static function search_postbar($default_text="输入贴吧名...") {
		echo "<div id='head_other'>
                <form action='search.process.php' method='post'>
                    <input name='search_text' id='search_text' type='text' placeholder='{$default_text}'/>&nbsp;&nbsp;
                    <input name='search_button' id='search_button' type='submit' value='进入贴吧' />
                </form>
            </div>";
	}
	public static function search_creat_postbar($default_text="输入贴吧名...") {
		echo "<div id='search'>
            	<form action='search.process.php' method='post'>
                    <input name='search_text' id='search_text' type='text' placeholder='{$default_text}'/>&nbsp;&nbsp;
                    <input name='search_button' id='search_button' type='submit' value='进入贴吧' />
                    <a id='create_button' href='tieba_create.php'>创建贴吧</a>
                </form>
            </div>";
	}
}