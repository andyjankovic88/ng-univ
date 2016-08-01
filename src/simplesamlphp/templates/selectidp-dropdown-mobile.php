<?php


if(!array_key_exists('header', $this->data)) {
	$this->data['header'] = 'selectidp';
}
$this->data['header'] = $this->t($this->data['header']);

$this->data['autofocus'] = 'dropdownlist';

//$this->includeAtTemplateBase('includes/header.php');

//var_dump($_SERVER);

/*
 * Acqurie header and footer from codeigniter
 */
$context = stream_context_create();
if($_SERVER['HTTP_HOST'] == 'www.sucroo.com' || $_SERVER['HTTP_HOST'] == 'preprod.sucroo.com' || $_SERVER['HTTP_HOST'] == 'dev.sucroo.com' || $_SERVER['HTTP_HOST'] == 'university.ucroo.com.au')
	$context = stream_context_create(array(
	'http' => array(
			'header'  => "Authorization: Basic " . base64_encode("ucroo:students")
	)
	));

$base_url = "http://".$_SERVER['HTTP_HOST'].'/';
$http_header = file_get_contents($base_url.'user/signup_aaf_style', false, $context);
echo str_replace('http://', 'https://', $http_header);



foreach ($this->data['idplist'] AS $idpentry) {
	if (isset($idpentry['name'])) {
		$this->includeInlineTranslation('idpname_' . $idpentry['entityid'], $idpentry['name']);
	} elseif (isset($idpentry['OrganizationDisplayName'])) {
		$this->includeInlineTranslation('idpname_' . $idpentry['entityid'], $idpentry['OrganizationDisplayName']);
	}
	if (isset($idpentry['description']))
		$this->includeInlineTranslation('idpdesc_' . $idpentry['entityid'], $idpentry['description']);
}


?>

  <div id="signup">
    <h1 class="noupper signup_aaf_heading" style="margin-bottom: .3em">Please wait redirecting to the SSO</h1>
		<br>
		<!-- <p><?php echo $this->data['header']; ?>:</p> -->

		<!-- <p><?php echo $this->t('selectidp_full'); ?></p> -->

		<form method="get" action="<?php echo $this->data['urlpattern']; ?>" class="style-form" id="idpuniselection" style="display:none;">
		<input type="hidden" name="entityID" value="<?php echo htmlspecialchars($this->data['entityID']); ?>" />
		<input type="hidden" name="return" value="<?php echo htmlspecialchars($this->data['return']); ?>" />
		<input type="hidden" name="returnIDParam" value="<?php echo htmlspecialchars($this->data['returnIDParam']); ?>" />

		<?php
		$idps = $this->data['idplist'];

        /*
         * 21/09/15 - #5334 - Jaymit - done related order changes here as well, I think this was for mobile view but now this is not used yet all, Step 1 Universities are listed in same order that is on Homepage & on Login page.
		function sortBySubkey(&$array, $subkey, $sortType = SORT_ASC) {
				foreach ($array as $subarray) {
					$keys[] = $subarray[$subkey]['en'];
				}
				array_multisort($keys, $sortType, $array);
		}
		sortBySubkey($idps, 'name');
         * 
         */

		//echo '<pre>'; var_dump($idps); exit;
		?>
		<select id="dropdownlist" name="idpentityid" onchange="checkAaf()">
      <option value="">Please select</option>
      <option value="cdu">Charles Darwin University - Student</option>
      <?php
      foreach ($idps AS $idpentry) {
          if (!isset($idpentry['name']) || $idpentry['name']['en'] == 'CQUniversity Portal') {
              continue;
          }

          $selectOption = '';
          $selectOption .= '<option value="' . htmlspecialchars($idpentry['entityid']) . '"';
          if (isset($this->data['preferredidp']) && $idpentry['entityid'] == $this->data['preferredidp']) {
            $selectOption .= ' selected="selected"';
          }
          $selectOption .= '>' . htmlspecialchars($this->t('idpname_' . $idpentry['entityid'])) . '</option>';
          if ($idpentry['name']['en'] == 'Charles Darwin University - Staff') {
              $cduStaffOption = $selectOption;
              continue;
          }
          echo $selectOption;
      }
      ?>
      <?php echo $cduStaffOption; //Charles Darwin University - Staff Option ?>
		</select>
		<br><br>

    <p>

    <ol>
      <li>Select your university and click blue 'Verify' button below</li>
      <li>Confirm yourself as a student or staff member by entering your university Username/ID & Password.
        <em>(This is the university Username/ID and Password you use to log in to other university systems such as email, LMS, timetable, etc)</em>
      </li>
      <li>Complete the UCROO Sign Up Process</li>
    </ol>

    </p>

    <br><br>
		<br>

		<img class="signup_aaf_image" src="/assets/images/signup/aaf_signup_steps2.png">

		<br><br><br><br>
		<input class="btn-call_to_action" type="submit" value="Verify"/>
		<?php
//		if($this->data['rememberenabled']) {
//			echo('<br/><input type="checkbox" name="remember" value="1" />' . $this->t('remember'));
//		}
		?>
		</form>
  </div> <!-- signup -->


<?php

$http_footer = file_get_contents($base_url.'user/signup_aaf_style/footer', false, $context);
echo str_replace('http://', 'https://', $http_footer);

//$this->includeAtTemplateBase('includes/footer.php'); ?>

    <script type="text/javascript">
        function checkAaf ()
        {
          if (document.getElementById("dropdownlist").value=='cdu') {
            location.href='<?=$base_url?>user/signup_connect/5'
          }
        }
    </script>


<?php /* Simple SAML hack to force specific university login*/ ?>

<style>
#login{display: none;}
#accountexists{display: none;}
</style>
<script type="text/javascript">
  $(document).ready(function(){

  	<?php if(isset($_COOKIE['from_app']) && $_COOKIE['from_app']!=''){?>
  		$("#dropdownlist option:contains(<?php echo $_COOKIE['from_app'];?>)").attr('selected', true);
  		$("#idpuniselection").submit()
  	<?php } ?>

    <?php if(isset($_COOKIE['web_signup']) && $_COOKIE['web_signup']!=''){?>
      $("#dropdownlist option:contains(<?php echo $_COOKIE['web_signup'];?>)").attr('selected', true);
      $("#idpuniselection").submit()
    <?php } ?>

    <? if(strpos($_SERVER['REQUEST_URI'], 'latrobe') !== FALSE) : ?>
      $('#signup').fadeIn('slow');
      $('#dropdownlist').val('https://aaf.latrobe.edu.au/idp/shibboleth');
//      $('.style-form').submit();
    <? endif;?>

    <? if(strpos($_SERVER['REQUEST_URI'], 'aaflogin') !== FALSE) : ?>
      $('#signup').fadeIn('slow');
      $('#dropdownlist').val('https://vho.test.aaf.edu.au/idp/shibboleth');
//      $('.style-form').submit();
    <? endif;?>

  });

</script>

