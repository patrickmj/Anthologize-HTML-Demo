<?php

include_once(ANTHOLOGIZE_TEIDOM_PATH);
include_once(ANTHOLOGIZE_TEIDOMAPI_PATH);

$ops = array('includeStructuredSubjects' => true, //Include structured data about tags and categories
		'includeItemSubjects' => true, // Include basic data about tags and categories
		'includeCreatorData' => true, // Include basic data about creators
		'includeStructuredCreatorData' => true, //include structured data about creators
		'includeOriginalPostData' => true, //include data about the original post (true to use tags and categories)
		'checkImgSrcs' => true, //whether to check availability of image sources
		);

$ops['outputParams'] = $_SESSION['html'];

$tei = new TeiDom($_SESSION, $ops);
$api = new TeiApi($tei);


//index images in advance, so that ids can be set on the images in the text body before it is displayed
$imgIndex = $api->indexImages();

$fileName = $api->getFileName();
$ext = "html";

if( isset($ops['outputParams']['download']) ) {
	header("Content-type: application/xml");
	header("Content-Disposition: attachment; filename=$fileName.$ext");
}


?>

<html>
	<head>
		<title><?php echo $api->getProjectTitle(true); ?></title>
	</head>
	<style type='text/css'>

		body {
			font-size: <?php echo $api->getProjectOutputParams('font-size'); ?>;
		}


		.anth-index-item {
			clear: both;
		}

		#anth-image-index img {
			float: left;
			margin: 10px;

		}



	</style>
<body>


<h1 class="anth-project-title"><?php echo $api->getProjectTitle(); ?></h1>
<p class="anth-project-subtitle"><?php echo $api->getProjectSubTitle(); ?></p>

<p>Anthologizer: <?php echo $api->getProjectCreator(); ?> </p>

<?php
//passing true to getProjectCreator gets an array of additional data about the creator
$curator = $api->getProjectCreator(true);
?>

<p>About the anthologizer:</p>
<img src="<?php echo $api->getPersonDetail($curator, 'gravatarUrl'); ?>" />

<?php
//getPersonDetail helps you navigate that array to the info you want
echo $api->getPersonDetail($curator, 'bio');

?>


<?php echo $api->getProjectCopyright(); ?>

<?php echo $api->getProjectEdition(); ?>

<h2><?php echo $api->getSectionPartItemTitle('front', 0, 0); ?></h2>
<?php echo $api->getSectionPartItemContent('front', 0, 0); ?>


<h2><?php echo $api->getSectionPartItemTitle('front', 0, 1); ?></h2>
<?php echo $api->getSectionPartItemContent('front', 0, 1); ?>


<?php for($i = 0; $i < $api->getSectionPartCount('body');  $i++): ?>
	<div class="anth-part" id="<?php echo $api->getSectionPartId('body', $i); ?>">
		<h2><?php echo $api->getSectionPartTitle('body', $i); ?></h2>
		<?php for($j = 0; $j < $api->getSectionPartItemCount('body', $i); $j++): ?>
			<div class="anth-item" id="<?php echo $api->getSectionPartItemId('body', $i, $j); ?>">
				<h3><?php echo $api->getSectionPartItemTitle('body', $i, $j); ?></h3>
				<?php
					$by = $api->getSectionPartItemAnthAuthor('body', $i, $j);
					if( ! $by) {
						$by = $api->getSectionPartItemOriginalCreator('body', $i, $j);
					}
				?>
				<p>By: <?php echo $by;  ?></p>
				<p>Added to "<?php echo $api->getProjectTitle() ?>" by: <?php echo $api->getSectionPartItemCreator('body', $i, $j); ?></p>
				<div class="anth-item-content">
					<?php echo $api->getSectionPartItemContent('body', $i, $j); ?>
				</div>
			</div>
		<?php endfor; ?>
	</div>
<?php endfor; ?>



<h2>Author index</h2>

	<?php echo $api->indexAuthorsSimple(); ?>

<div style='clear:both' />

<h2>Image Index</h2>

	<?php echo $imgIndex; ?>


<div style='clear:both' />

<h2>Tag/Category Index</h2>

	<?php echo $api->indexSubjects(); ?>

</body>

</html>



<?php die(); ?>