<?php
if ($data['conf']['recaptcha']) {
?>
<div>
    <script type="text/javascript">
    var RecaptchaOptions = {
        lang : '<?php echo $request->LANG; ?>',
            theme : 'white'
    };
    </script>
<?php
    require_once(__FILES_ROOT_CONTACT__ . '/lib/recaptchalib.php');
    $publickey = $data['conf']['recaptcha_publickey']; // you got this from the signup page
    echo recaptcha_get_html($publickey);
?>
</div>
<?php
}
?>
