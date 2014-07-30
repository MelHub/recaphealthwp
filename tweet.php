<?php include 'php_lib/TweetPHP.php'; 

$tweet = new TweetPHP(array(
          'consumer_key'          => 'ZFtxyDjABIsWrni5G4Qu72Wfr',
          'consumer_secret'       => '1epBIP4j1xW5NEkzUDVCBNuTeSOqH4mwLPz2rNN5HAhMtcAqEI',
          'access_token'          => '2463516210-1L5qntrOplJ81kVhyhJynHtXNTTvDR2jWOdhlcH',
          'access_token_secret'   => 'fHFAKn1oPd8PnL6lsKfCCH2W4Z8y2lAleax7u3uCbPpEb',
          'twitter_screen_name'   => 'recaphealth'
				));

echo $tweet->get_tweet_list();
