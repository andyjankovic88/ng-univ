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
{
	$context = stream_context_create(array(
	'http' => array(
			'header'  => "Authorization: Basic " . base64_encode("ucroo:students")
	)
	));
} else if($_SERVER['HTTP_HOST'] == 'demo.ucroo.com.au'){
	$context = stream_context_create(array(
	'http' => array(
			'header'  => "Authorization: Basic " . base64_encode("demo:demo")
	)
	));
}
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

 		<div id="progress-bar">
          <ol id="progress-steps">
            <li class="progress-step">
              <span class="step-with-disable left current-step"></span>
              <span class="steps-description left active">Step 1<em>Select your university</em></span>
            </li>
            <li class="progress-step">
              <span class="step-with-disable middle"></span>
              <span class="steps-description middle">Step 2<em>Connect with Facebook</em></span>
            </li>
            <li class="progress-step">
              <span class="step-with-disable right"></span>
              <span class="steps-description right">Step 3 <em>Finish creating your account</em></span>
            </li>
          </ol>
        </div>


        <form method="get" action="<?php echo $this->data['urlpattern']; ?>" name="VerifyAAF" id="VerifyAAF" class="style-form" onsubmit="return csu_redirect()">
        	<div class="signup-box">
        		<div class="select-univ">
        			<label>Select your university</label>
        			<span class="custom-select">

        				<input type="hidden" name="entityID" value="<?php echo htmlspecialchars($this->data['entityID']); ?>" />
        				<input type="hidden" name="return" value="<?php echo htmlspecialchars($this->data['return']); ?>" />
        				<input type="hidden" name="returnIDParam" value="<?php echo htmlspecialchars($this->data['returnIDParam']); ?>" />

        				<?php
        				$idps = $this->data['idplist'];

                        /*
                         * 21/09/15 - #5334 - Jaymit - Step 1 Universities are listed in same order that is on Homepage & on Login page.
        				function sortBySubkey(&$array, $subkey, $sortType = SORT_ASC) {
        					foreach ($array as $subarray) {
        						$keys[] = $subarray[$subkey]['en'];
        					}
        					array_multisort($keys, $sortType, $array);
        				}
        				sortBySubkey($idps, 'name');
                         * 
                         */

        				?>
        				<select id="dropdownlist" name="idpentityid">
        					<option value="">Please select</option>
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
        					<option value="prince">Prince Patrick University - Student</option>
                                                <?php echo $cduStaffOption; //Charles Darwin University - Staff Option ?>
                                                <option value="cdu">Charles Darwin University - Student</option>
        				</select>
        			</span>
        		</div>
        	</div>
        	<div class="sign-in-univ">
        		<button onclick="checkAaf()" type="button" class="button btn-blue button-blue-effect sign-up-btn">Sign in to my university account <span class="icon-arrow-right5"></span></button>
        		<em>Confirm you are a student or staff member by signing in to your university account</em>
        	</div>
        </form>

        <script type="text/javascript">
          function checkAaf () {
            if (document.getElementById("dropdownlist").value=='cdu') {
               location.href='<?=$base_url?>user/signup_connect/5';
            }else if (document.getElementById("dropdownlist").value=='prince') {
                location.href='<?=$base_url?>user/signup_connect/39';
            } else {
              $('#VerifyAAF').submit();
            }
          }

          function open_mp(){
            mixpanel.track("Sign Up Step 2");
            document.VerifyAAF.submit();
          }

          function csu_redirect() {
            var dropdownlist = document.getElementById('dropdownlist');

            if(dropdownlist.value == 'https://idp.csu.edu.au/idp/shibboleth' || dropdownlist.value == 'https://idpqa.csu.edu.au/idp/shibboleth') {
              document.location = '<?= $base_url?>csu_sso';
              return false;
            }

            return true;
          }
        </script>


<?php /* Simple SAML hack to force specific university login*/ ?>
<script type="text/javascript">
  $(document).ready(function() {

    <?php if(isset($_COOKIE['web_signup']) && $_COOKIE['web_signup']!=''){?>
      $("#dropdownlist option:contains('<?php echo urldecode($_COOKIE['web_signup']);?>')").attr('selected', true);
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
<?php
$http_footer = file_get_contents($base_url.'user/signup_aaf_style/footer', false, $context);
echo str_replace('http://', 'https://', $http_footer);
//$this->includeAtTemplateBase('includes/footer.php');
?>