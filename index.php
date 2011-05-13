<?php

include 'itunes.php';

$artist = 'Gym Class Heroes';
$trackQuery = 'Queen and I';

if(isset($_POST['artist'])) {
	$artist = $_POST['artist'];
}

if(isset($_POST['track'])) {
	$trackQuery = $_POST['track'];
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

