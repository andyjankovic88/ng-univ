<?php
/**
 * SAML 2.0 remote IdP metadata for simpleSAMLphp.
 *
 * Remember to remove the IdPs you don't use from this file.
 *
 * See: https://rnd.feide.no/content/idp-remote-metadata-reference
 */

if($_SERVER['HTTP_HOST'] != 'www.ucroo.com.au') {
	$metadata['https://vho.test.aaf.edu.au/idp/shibboleth'] = array(
		'name' => array(
			'en' => "AAF test SP",
		),
		'description'          => "AAF test SP",
		'SingleSignOnService'  => 'https://vho.test.aaf.edu.au/idp/profile/SAML2/Redirect/SSO',
		//'SingleLogoutService'  => 'https://vho.test.aaf.edu.au/idp/profile/SAML2/Redirect/Noservice',
		'certFingerprint'      => '252a2a12acefa04f3e2f089d5ec8aebc588d01d5'
	);
}

$metadata['https://idp.cdu.edu.au/idp/shibboleth'] = array(
	'name' => array(
		'en' => "Charles Darwin University - Staff",
	),
	'description'          => "Charles Darwin University - Staff",
	'SingleSignOnService'  => 'https://idp.cdu.edu.au/idp/profile/SAML2/Redirect/SSO',
	// 'SingleLogoutService'  => 'https://idp.cdu.edu.au/idp/profile/SAML2/Redirect/Noservice',
	'certFingerprint'      => '5978699928f73ebefdb200792bf132c3137fc244',
);

$metadata['https://signon.deakin.edu.au/idp/shibboleth'] = array(
	'name' => array(
		'en' => "Deakin University",
	),
	'description'          => "Deakin University Identity Provider",
	'SingleSignOnService'  => 'https://signon.deakin.edu.au/idp/profile/SAML2/Redirect/SSO',
	// 'SingleLogoutService'  => 'https://signon.deakin.edu.au/idp/profile/SAML2/Redirect/Noservice',
	'certFingerprint'      => '1a125a62723e03ddfc9c24d9714347cc93acd1b6',
);

$metadata['urn:mace:federation.org.au:testfed:mq.edu.au'] = array(
	'name' => array(
		'en' => "Macquarie University",
	),
	'description'          => "Macquarie University",
	'SingleSignOnService'  => 'https://idp.mq.edu.au/idp/profile/SAML2/Redirect/SSO',
	//'SingleLogoutService'  => 'https://idp.mq.edu.au/Shibboleth.sso/SLO/POST',
	'certFingerprint'      => '7c74c40f2f5de56b6e7cafd34de98915fcbf7e0e',
);

$metadata['https://idp.monash.edu.au/idp/shibboleth'] = array(
	'name' => array(
		'en' => "Monash University",
	),
	'description'          => "Monash University IdP",
	'SingleSignOnService'  => 'https://idp.monash.edu.au/idp/profile/SAML2/Redirect/SSO',
	// 'SingleLogoutService'  => 'https://idp.monash.edu.au/idp/profile/SAML2/Redirect/Noservice',
 	// 'certFingerprint'      => '3833fffde8352646cc9f3ee8831492c0082b0684',
	'certFingerprint'      => '0a20fc33d70d5d3e9d58f809c1370ce8bfb6e3d2'
);


$metadata['https://idp.qut.edu.au/idp/shibboleth'] = array(
	'name' => array(
		'en' => "Queensland University of Technology",
	),
	'description'          => "Queensland University of Technology",
	'SingleSignOnService'  => 'https://idp.qut.edu.au/idp/profile/SAML2/Redirect/SSO',
	// 'SingleLogoutService'  => 'https://idp.cdu.edu.au/idp/profile/SAML2/Redirect/Noservice',
	'certFingerprint'      => 'f756fe19d6293672aaef29ae32e8030e73b4d6b0',
);

$metadata['https://sso-shibboleth.rmit.edu.au/idp/shibboleth'] = array(
	'name' => array(
		'en' => "RMIT University",
	),
	'description'          => "RMIT production IdP",
	'SingleSignOnService'  => 'https://sso-shibboleth.rmit.edu.au/idp/profile/SAML2/Redirect/SSO',
	// 'SingleLogoutService'  => 'https://sso-shibboleth.rmit.edu.au/idp/profile/SAML2/Redirect/Noservice',
	'certFingerprint'      => 'b4aa94fda11e0ad3ad2fa8861e4206a55a298780',
);

$metadata['https://idp.cc.swin.edu.au/idp/shibboleth'] = array(
	'name' => array(
					'en' => "Swinburne University of Technology",
	),
	'description'          => "Swinburne University of Technology IDP",
	'SingleSignOnService'  => 'https://idp.cc.swin.edu.au/idp/profile/SAML2/Redirect/SSO',
	//'SingleLogoutService'  => 'https://idp.cc.swin.edu.au/idp/profile/SAML2/Redirect/Noservice',
	// 'certFingerprint'      => 'FB:14:D6:20:AA:10:88:D2:AE:CF:27:1A:18:43:1B:B2', //md5
	// 'certFingerprint'      => 'E0:E0:1E:EB:8C:86:AF:A5:C2:F2:A5:1B:87:57:6C:BD:23:D2:B5:76', //sha1
	'certFingerprint'      => '60f49295e3303095d7800285216001ff804fcddb',
	// 'certData' =>'MIIDMzCCAhugAwIBAgIUflcZNZ0oyYdpPd4BApHl5YM2sr8wDQYJKoZIhvcNAQEF
	// BQAwHTEbMBkGA1UEAxMSaWRwLmNjLnN3aW4uZWR1LmF1MB4XDTExMDUyNDA0Mzgy
	// M1oXDTMxMDUyNDA0MzgyM1owHTEbMBkGA1UEAxMSaWRwLmNjLnN3aW4uZWR1LmF1
	// MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA31mHFOZ5unMd/gvguL6q
	// auwwjl182r3wSTP5/dvfb8KuqMKKDlp5JsdJu9XkjY/WpGFL5O3vw3NLBI0NV+e2
	// Swta4Z+MbkdNrvAzpqFhJrYBVW/yG4DDnVgOQok0gQS1RmFGA1oXEWmBuOFGmPl7
	// xjtkuJQBHwi/KPIzE+5G3c9ioy1sPp6k/Wfo/IEPdgsfJIcDRsxWSjLdmif+mH1s
	// S8mdR2M1CSfPISq3sGlZ7nG7Jw3CA/gUooTzn7iUPVLZPgo8ADsjBVGur8TpblVI
	// OiM5jbAGVTpFxy1rh0kd+jh1cJ578mUoQ/H/DkZbYSSYo0ax+NtXiOmHpMcc/pT0
	// NQIDAQABo2swaTBIBgNVHREEQTA/ghJpZHAuY2Muc3dpbi5lZHUuYXWGKWh0dHBz
	// Oi8vaWRwLmNjLnN3aW4uZWR1LmF1L2lkcC9zaGliYm9sZXRoMB0GA1UdDgQWBBTg
	// kZqRx4+wfSAsNfRa/XeqMx2u0TANBgkqhkiG9w0BAQUFAAOCAQEAgak6LJP3nYAh
	// no57Mnsr0XfHSV9k5ZIAdkiWnj8U3IBlI+qHBYwm3+jE+Z1RLQ5B511FDTFC33lI
	// 3pQBB5q0W0s9Y+4UCZoGyNjmuIHLhUyKAXdPhS7z57DneyiZzmBO9Dt2EgqYa/mt
	// NZYM/wTC6l2IVrdlG7iHxFnt7K3YfNfLgmZ2/QgAUzIvUTtPBAz4O7Nmm5JaHDdL
	// ax7bPHBEqzTWMmor6ztm9ug/UNLS5VvjO/9bTcrKqxT2kxkfhOZuU442na1w3xgr
	// XpYGzKSE4N3wZEyYJgNKp1GIyvYof90glMHox/RK0tBiVS8u9oswrpCtLtaUXfRj
	// KCtn1yGMRg=='
);

$metadata['https://idp.ballarat.edu.au/idp/shibboleth'] = array(
	'name' => array(
		'en' => "Federation University Australia",
	),
	'description'          => "Federation University Australia",
	'SingleSignOnService'  => 'https://idp.ballarat.edu.au/idp/profile/SAML2/Redirect/SSO',
	'certFingerprint'      => 'Federation',
);

$metadata['https://idp.unimelb.edu.au/idp/shibboleth'] = array(
	'name' => array(
		'en' => "University of Melbourne",
	),
	'description'          => "IdP of The University of Melbourne",
	'SingleSignOnService'  => 'https://idp.unimelb.edu.au/idp/profile/SAML2/Redirect/SSO',
	// 'SingleLogoutService'  => 'https://idp.unimelb.edu.au/idp/profile/SAML2/Redirect/Noservice',
	'certFingerprint'      => 'cbda6ee11d86d0e44bf9901ec7ea43349a904b4b',
);

$metadata['https://aaf.latrobe.edu.au/idp/shibboleth'] = array(
	'name' => array(
		'en' => "La Trobe University",
	),
	'description'          => "La Trobe University",
	'SingleSignOnService'  => 'https://aaf.latrobe.edu.au/idp/profile/SAML2/Redirect/SSO',
	'certFingerprint'      => '6b560cf520ec23420aefec5d40591d3e54ee0304',
);

$metadata['https://aaf-login.uts.edu.au/idp/shibboleth'] = array(
	'name' => array(
		'en' => "University of Technology, Sydney",
	),
	'description'          => "IdP of: uts.edu.au",
	'SingleSignOnService'  => 'https://aaf-login.uts.edu.au/idp/profile/SAML2/Redirect/SSO',
	'certFingerprint'      => 'f1a4bfca41fb33d2c73884875c040c6e8b8cd707',
);

// AAF Entry opening for Central Queensland University (CQU)
$metadata['https://idp.cqu.edu.au/idp/shibboleth'] = array(
	'name' => array(
		'en' => "CQUniversity",
	),
	'description'          => "IdP of: Central Queensland University IdP",
	'SingleSignOnService'  => 'https://idp.cqu.edu.au/idp/profile/SAML2/Redirect/SSO',
	'certFingerprint'      => '8d972a2cae1599ddb3c1e00734de3272a7449e34',
);


// AAF Entry opening for Charles Sturt University (CSU)
$metadata['https://idp.csu.edu.au/idp/shibboleth'] = array(
	'name' => array(
		'en' => "Charles Sturt University (CSU)",
	),
	'description'          => "IdP of: Charles Sturt University IdP",
	'SingleSignOnService'  => 'https://idp.csu.edu.au/idp/profile/SAML2/Redirect/SSO',
	'certFingerprint'      => '9987e123ce0f5b05697221ee4c25fe00a68f37f0',
);

// CQU dev IdP
$metadata['https://identity-dev.cqu.edu.au:443/openam'] = array (
	'entityid' => 'https://identity-dev.cqu.edu.au:443/openam',
	'contacts' =>	array (),
	'metadata-set' => 'saml20-idp-remote',
	'SingleSignOnService' =>
	array (
		0 =>
		array (
			'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
			'Location' => 'https://identity-dev.cqu.edu.au:443/openam/SSORedirect/metaAlias/idp',
		),
		1 =>
		array (
			'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
			'Location' => 'https://identity-dev.cqu.edu.au:443/openam/SSOPOST/metaAlias/idp',
		),
		2 =>
		array (
			'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:SOAP',
			'Location' => 'https://identity-dev.cqu.edu.au:443/openam/SSOSoap/metaAlias/idp',
		),
	),
	'SingleLogoutService' =>
	array (
		0 =>
		array (
			'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
			'Location' => 'https://identity-dev.cqu.edu.au:443/openam/IDPSloRedirect/metaAlias/idp',
			'ResponseLocation' => 'https://identity-dev.cqu.edu.au:443/openam/IDPSloRedirect/metaAlias/idp',
		),
		1 =>
		array (
			'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
			'Location' => 'https://identity-dev.cqu.edu.au:443/openam/IDPSloPOST/metaAlias/idp',
			'ResponseLocation' => 'https://identity-dev.cqu.edu.au:443/openam/IDPSloPOST/metaAlias/idp',
		),
		2 =>
		array (
			'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:SOAP',
			'Location' => 'https://identity-dev.cqu.edu.au:443/openam/IDPSloSoap/metaAlias/idp',
		),
	),
	'ArtifactResolutionService' =>
	array (
		0 =>
		array (
			'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:SOAP',
			'Location' => 'https://identity-dev.cqu.edu.au:443/openam/ArtifactResolver/metaAlias/idp',
			'index' => 0,
			'isDefault' => true,
		),
	),
	'keys' =>
	array (
		0 =>
		array (
			'encryption' => false,
			'signing' => true,
			'type' => 'X509Certificate',
			'X509Certificate' => '
MIICQDCCAakCBEeNB0swDQYJKoZIhvcNAQEEBQAwZzELMAkGA1UEBhMCVVMxEzARBgNVBAgTCkNh
bGlmb3JuaWExFDASBgNVBAcTC1NhbnRhIENsYXJhMQwwCgYDVQQKEwNTdW4xEDAOBgNVBAsTB09w
ZW5TU08xDTALBgNVBAMTBHRlc3QwHhcNMDgwMTE1MTkxOTM5WhcNMTgwMTEyMTkxOTM5WjBnMQsw
CQYDVQQGEwJVUzETMBEGA1UECBMKQ2FsaWZvcm5pYTEUMBIGA1UEBxMLU2FudGEgQ2xhcmExDDAK
BgNVBAoTA1N1bjEQMA4GA1UECxMHT3BlblNTTzENMAsGA1UEAxMEdGVzdDCBnzANBgkqhkiG9w0B
AQEFAAOBjQAwgYkCgYEArSQc/U75GB2AtKhbGS5piiLkmJzqEsp64rDxbMJ+xDrye0EN/q1U5Of+
RkDsaN/igkAvV1cuXEgTL6RlafFPcUX7QxDhZBhsYF9pbwtMzi4A4su9hnxIhURebGEmxKW9qJNY
Js0Vo5+IgjxuEWnjnnVgHTs1+mq5QYTA7E6ZyL8CAwEAATANBgkqhkiG9w0BAQQFAAOBgQB3Pw/U
QzPKTPTYi9upbFXlrAKMwtFf2OW4yvGWWvlcwcNSZJmTJ8ARvVYOMEVNbsT4OFcfu2/PeYoAdiDA
cGy/F2Zuj8XJJpuQRSE6PtQqBuDEHjjmOQJ0rV/r8mO1ZCtHRhpZ5zYRjhRC9eCbjx9VrFax0JDC
/FfwWigmrW0Y0Q==
										',
		),
	),
);
