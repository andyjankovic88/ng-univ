<?php

$config = array(

	// This is a authentication source which handles admin authentication.
	'admin' => array(
		// The default is to use core:AdminPassword, but it can be replaced with any authentication source.
		'core:AdminPassword',
	),

	// An authentication source which can authenticate against both SAML 2.0 and Shibboleth 1.3 IdPs.
	'default-sp' => array(
		'saml:SP',
    'privatekey' => 'saml.pem',
    'certificate' => 'saml.crt',

		// The entity ID of this SP.
		// Can be NULL/unset, in which case an entity ID is generated based on the metadata URL.
		'entityID' => NULL,

		// The entity ID of the IdP this should SP should contact.
		// Can be NULL/unset, in which case the user will be shown a list of available IdPs.
		'idp' => null,

		// The URL to the discovery service.
		// Can be NULL/unset, in which case a builtin discovery service will be used.
		'discoURL' => null //'https://ds.test.aaf.edu.au/discovery/DS',
	),

	'test-idp' => array(
		'saml:SP',
		'entityid' => 'http://idp-eddi.sucroo.com/saml2/idp/metadata.php',
		'idp' => 'http://idp-eddi.sucroo.com/saml2/idp/metadata.php',
		'discoURL' => null,
		'ssoPortalUrl' => 'http://idp-eddi.sucroo.com/saml2/idp/SSOService.php'
	),

	/*
	'example-userpass' => [
		'exampleauth:UserPass',
		'student:studentpass' => [
			'uid' => ['student'],
			'eduPersonAffiliation' => ['member', 'student']
		]
	]
	*/
);
