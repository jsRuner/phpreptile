<?php 

include 'utils.php';
// for ($i=1; $i < 11; $i++) { 
// 	# code...
// 	// $data = file_get_contents('http://email.91dizhi.at.gmail.com.7h5.space/v.php?next=watch&page='.$i);
// 	$post_data = array(
// 		'session_language'=>'cn_CN'
// 		);
// 	$data = send_post('http://email.91dizhi.at.gmail.com.7h5.space/v.php?next=watch&page='.$i,$post_data);
// 	file_put_contents('listpages/'.$i.'.html', $data);
// 	sleep(3);
// 	echo "抓取第".$i.'页';
// 	echo "\r\n";
// }

//分析其中一个文件。产生结果
$html = file_get_contents('listpages/1.html');

$patter = '/<a\s+target=blank href="(.*?)">\s+<img\s+src="(.*?)"\s+width="120"\s+title="(.*?)"/';
// $patter = '/src="(.*?)"\s+width="120"\s+title="(.*?)"/';

preg_match_all($patter,$html,$matches);

var_dump($matches);

//写入到文件。
$content = '';
for ($i=0; $i < count($matches[0]); $i++) { 
	# code...
	$content .= "\r\n标题".$matches[3][$i];
	$content .= "\r\n封面".$matches[2][$i];
	$content .= "\r\n地址".$matches[1][$i];
	$content .= "\r\n-----------------------";
}

file_put_contents('result.txt', $content);

 ?>