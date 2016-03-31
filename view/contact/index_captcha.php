<?php
if ($data['conf']['recaptcha']) {
?>
<div class="form-group">
    <script type="text/javascript">
    var RecaptchaOptions = {
        lang : '<?php echo $request->LANG; ?>',
            theme : 'white'
    };
    </script>
</div>
<div class="form-group g-recaptcha" data-sitekey="<?php echo $data['conf']['recaptcha_publickey']; ?>" style="height: 78px"></div>
<?php
}
