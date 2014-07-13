<?php
  # define script parameters
  $BLOGURLS   = array("http://medcitynews.com/feed/", "http://mobihealthnews.com/feed");
  $NUMITEMS   = 5;
  $TIMEFORMAT = "j F Y, g:ia";
  $CACHEFILE  = "/home/rhv/tmp/" . md5(implode("|",$BLOGURLS));
  $CACHETIME  = 4; # hours

	function checkCache() {
		global $CACHEFILE, $CACHETIME, $BLOGURLS;
		# download the feed iff a cached version is missing or too old
		if(!file_exists($CACHEFILE) || ((time() - filemtime($CACHEFILE)) > 3600 * $CACHETIME)) {
			if (file_exists($CACHEFILE)) {
				unlink($CACHEFILE);
			}

			shuffle($BLOGURLS);
			$url = $BLOGURLS[0];
			if($feed_contents = @file_get_contents($url)) {
				$fp = fopen($CACHEFILE, 'a+');
				fwrite($fp, $feed_contents);
				fclose($fp);
			}
		}
	}

  include "php_lib/class.myrssparser.php";
	checkCache();
  $rss_parser = new myRSSParser($CACHEFILE);

  # read feed data from cache file
  $feeddata = $rss_parser->getRawOutput();
  extract($feeddata['RSS']['CHANNEL'][0], EXTR_PREFIX_ALL, 'rss');

  # display feed items
  $count = 0;
	foreach($rss_ITEM as $itemdata) {
		echo '<a href="'.$itemdata['LINK'].'" target="_blank">';
		echo '<h5>'.htmlspecialchars(stripslashes($itemdata['TITLE'])).'</h5>';
		echo '<span class="timestamp">' . $rss_DESCRIPTION . ' ' . date($TIMEFORMAT, strtotime($itemdata['PUBDATE'])) . '</span>';
		echo '</a> <p>'.$itemdata['DESCRIPTION'].'</p>';
		echo '<h6 class="read-more"><a href="'.$itemdata['LINK'].'">Read More...</a></h6>';
		if(++$count >= $NUMITEMS) {
			break;
		}
	}
