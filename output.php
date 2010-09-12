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

$fileName = $api->getFileName();
$ext = "html";

if($ops['outputParams']['download'] == 'download') {
	header("Content-type: application/xml");
	header("Content-Disposition: attachment; filename=$fileName.$ext");
}


?>

<html>
	<head>
		<title><?php $api->getProjectTitle(true); ?></title>
	</head>
<body>


<h1 class="anth-project-title"><?php echo $api->getProjectTitle(); ?></h1>


<?php for($i = 0; $i < $api->getSectionPartCount('body');  $i++): ?>
	<div class="anth-part" id="<?php echo $api->getSectionPartId('body', $i); ?>">
		<h2><?php echo $api->getSectionPartTitle('body', $i); ?></h2>
		<?php for($j = 0; $j < $api->getSectionPartItemCount('body', $i); $j++): ?>
			<div class="anth-item" id="<?php echo $api->getSectionPartItemId('body', $i, $j); ?>">
				<h3><?php echo $api->getSectionPartItemTitle('body', $i, $j); ?></h3>
				<p>By: <?php echo $api->getSectionPartItemAnthAuthor('body', $i, $j); ?></p>
				<p>Added to collection by: <?php echo $api->getSectionPartItemCreator('body', $i, $j); ?></p>
				<div class="anth-item-content">
					<?php echo $api->getSectionPartItemContent('body', $i, $j); ?>
				</div>
			</div>
		<?php endfor; ?>
	</div>
<?php endfor; ?>



<h2>Author index</h2>


<?php echo $api->indexAuthorsSimple(); ?>

</body>

</html>



<?php die(); ?>