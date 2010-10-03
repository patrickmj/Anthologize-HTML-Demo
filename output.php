<?php

include_once(ANTHOLOGIZE_TEIDOM_PATH);
include_once(ANTHOLOGIZE_TEIDOMAPI_PATH);
require_once(WP_PLUGIN_DIR. '/anthologize/includes/theming-functions.php');
global $api;


//TODO: simplify and condense these options

$ops = array('includeStructuredSubjects' => false, //Include structured data about tags and categories
		'includeItemSubjects' => false, // Include basic data about tags and categories
		'includeCreatorData' => true, // Include basic data about creators
		'includeStructuredCreatorData' => true, //include structured data about creators
		'includeOriginalPostData' => true, //include data about the original post (true to use tags and categories and creator data)
		'checkImgSrcs' => true, //whether to check availability of image sources
		'linkToEmbeddedObjects' => false,
		'indexSubjects' => false,
		'indexCategories' => false,
		'indexTags' => false,
		'indexAuthors' => false,
		'indexImages' => false,
		);


$ops['outputParams'] = $_SESSION['outputParams'];

$tei = new TeiDom($_SESSION, $ops);
$api = new TeiApi($tei);


$fileName = $api->getFileName();
$ext = "html";

if( isset($ops['outputParams']['download']) ) {
	header("Content-type: application/xml");
	header("Content-Disposition: attachment; filename=$fileName.$ext");
}


?>

<html>
	<head>
		<title><?php anth_project_title(true); ?></title>
	</head>

	<body>
	<h1><?php anth_project_title(); ?></h1>

	<?php

	anth_the_section('body');
	while ( anth_parts() ) {

		anth_the_part();

		if ( anth_part_has_items() ) { // Anthologize assumes part_id from context

			?>

			<h2><?php anth_the_title(); ?></h2>
			<?php

			while( anth_part_items() ) {
				anth_the_item();

				?>
				<h3><?php anth_the_title() ?></h3>
				<div class="item-meta">

					<img class="gravatar" src="<?php anth_author_gravatar(); ?>" />
					<span class="item-author">By <?php anth_the_author() ?></span>

				</div>
				<div class="item-content">
					<?php anth_item_content() ?>
				</div>

				<?php
			}
		}
	}
	?>

	</body>

</html>
<?php die(); ?>