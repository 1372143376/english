<?php

/**
 * 遍历某个目录下的所有文件(递归实现)
 * 将目录中的，txt \ .jpeg \ .xlsx  结尾的文本复制到一个新的目录下 //  F:\英语周报\wp
 * @param string $dir  // 源文件夹的绝对路径
 * @param string $new_dir  // 复制到的新目录的绝对路劲（可自动创建根目录）
 */
function scanAll2($dir = 'F:\英语周报\高三牛津综合OJS 魏鹏12.08',$new_dir = 'F:\英语周报\wp')
{
	@mkdir($new_dir);
	//获取文件的后缀
	$ext = get_extension($dir);
	if (in_array($ext,['txt','jpeg','jpg','png','xlsx','xls']))
	{
		//$create_dir不同的目录下
		if ($ext == 'txt')
		{
			$create_dir = $new_dir.'\文本\\';
		}
		else
		{
			$create_dir = $new_dir.'\\';
		}
		$file = explode('/', $dir);
		@mkdir($new_dir.'\文本');
		if (!copy($dir, $create_dir . end($file)))
		{
			echo 'failure...';
		}
		else
		{
			echo $dir . "<br />";
		}
	}
	//递归所有目录
	if (is_dir($dir))
	{
		$children = scandir($dir);
		foreach ($children as $child)
		{
			if ($child !== '.' && $child !== '..')
			{
				scanAll2($dir . '/' . $child);
			}
		}
	}
}
//获取文件后缀
function get_extension($file)
{
	return pathinfo($file, PATHINFO_EXTENSION);
}
//执行
var_dump(scanAll2());