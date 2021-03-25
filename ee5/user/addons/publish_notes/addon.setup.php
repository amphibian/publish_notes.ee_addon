<?php

include(PATH_THIRD.'/publish_notes/config.php');
return array(
	'author' => 'Amphibian',
	'author_url' => 'http://amphibian.info',
	'description' => 'Add highlighted notes to the publish screen using fields and field instructions.',
	'docs_url' => 'https://github.com/amphibian/publish_notes.ee_addon',
	'fieldtypes' => array(
		'publish_notes' => array(
			'name' => 'Publish Notes',
			'compatibility' => 'text'
		)
	),
	'name' => 'Publish Notes',
	'namespace' => 'Amphibian\PublishNotes',
	'version' => PUBLISH_NOTES_VERSION
);