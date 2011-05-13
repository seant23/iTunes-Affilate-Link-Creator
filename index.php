<?php

$artist = 'Gym Class Heroes';
$trackQuery = 'Queen and I';

if(isset($_POST['artist'])) {
	$artist = $_POST['artist'];
}

if(isset($_POST['track'])) {
	$trackQuery = $_POST['track'];
}

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

$i = new ITunes();
$track = $i->getTrack($artist, $trackQuery);

?>

<h1>Make Call</h1>
<form method="POST">
	<table>
		<tr>
			<td>Artist Name:</td>
			<td><input type='text' name='artist' value='<?php echo $artist; ?>' /></td>
		</tr>	
		<tr>
			<td>Track Name:</td>
			<td><input type='text' name='track' value='<?php echo $trackQuery; ?>' /></td>
		</tr>	
	</table>
<input type='submit' />
</form>

<hr />

<h1>Example Code</h1>
<pre>
$i = new ITunes();
$track = $i->getTrack('<?php echo $artist; ?>', '<?php echo $trackQuery; ?>');
</pre>
<br />

<h1>Track Object</h1>
<pre><?php print_r($track); ?></pre>

<h1>Parsed Results</h1>
<table width="600" cellpadding="10" cellspacing="10">
	<tr>
		<td>Artist</td>
		<td><?php echo $track->artistName; ?></td>
	</tr>
	<tr>
		<td>Album</td>
		<td><?php echo $track->collectionName; ?></td>
	</tr>
	<tr>
		<td>Track</td>
		<td><?php echo $track->trackName; ?></td>
	</tr>
	<tr>
		<td>Album Price</td>
		<td>$<?php echo $track->collectionPrice; ?></td>
	</tr>
	<tr>
		<td>Track Price</td>
		<td>$<?php echo $track->trackPrice; ?></td>
	</tr>
	<tr>
		<td>60x60 Image</td>
		<td><img src="<?php echo $track->artworkUrl60; ?>" /></td>
	</tr>
	<tr>
		<td>100x100 Image</td>
		<td><img src="<?php echo $track->artworkUrl100; ?>" /></td>
	</tr>
	<tr>
		<td>Artist iTunes Page</td>
		<td><a href="<?php echo $track->artistViewUrl; ?>" />Click Here To Visit</a></td>
	</tr>
	<tr>
		<td>Album iTunes Page</td>
		<td><a href="<?php echo $track->collectionViewUrl; ?>" />Click Here To Visit</a></td>
	</tr>
	<tr>
		<td>Track iTunes Page</td>
		<td><a href="<?php echo $track->trackViewUrl; ?>" />Click Here To Visit</a></td>
	</tr>
	<tr>
		<td>30 Second Audio Sample</td>
		<td><a href="<?php echo $track->previewUrl; ?>" />Click Here To Visit</a></td>
	</tr>
</table

