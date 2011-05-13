<?php

class ITunes {

	public $affiliateLink = "http://click.linksynergy.com/fs-bin/stat?id=Je3s7qkVWfQ&offerid=146261&type=3&subid=0&tmpid=1826&RD_PARM1=";
	public $itunesSearchURL = "http://ax.phobos.apple.com.edgesuite.net/WebObjects/MZStoreServices.woa/wa/wsSearch?entity=musicTrack&term=";

	public function getTrack($artist, $track) {
		$term = urlencode($artist . ' ' . $track);
		
		$response = file_get_contents($this->itunesSearchURL . $term);
		$responseOBJ = json_decode($response);

		if($responseOBJ->resultCount == 0) {
			return false;
		} else {
			$song = $responseOBJ->results[0];
			$song->trackViewUrl = $this->makeAffiliatedLink($song->trackViewUrl);
			$song->collectionViewUrl = $this->makeAffiliatedLink($song->collectionViewUrl);
			$song->artistViewUrl = $this->makeAffiliatedLink($song->artistViewUrl);
			
			return $song;
		}
	}

	public function makeAffiliatedLink($link) {
		if(strpos($link, '?')) {
			$link .= '&';
		} else {
			$link .= '?';
		}

		$link .= 'partnerId=30';
		$link = urlencode(urlencode($link));
		$link = $this->affiliateLink . $link;

		return $link;
	}

}
