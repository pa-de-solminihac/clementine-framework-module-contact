<?php
$conf = '';
if (isset($data['config_module_contact'])) {
    $conf = $data['config_module_contact'];
}
// par défaut
if (!$conf) {
    $conf = Clementine::$config['module_contact'];
}
?>
<script type="text/javascript">
    // si jQuery est chargé
    if (typeof(jQuery) != "undefined") {
        jQuery('#form_contact').bind('submit', function() {
            var msg = "";
            jQuery(this).find('label > span.required').each(function() {
                // console.log(jQuery(this).parent().children('span.label_text').text());
                var champ = jQuery(this).parent().children('span.label_text');
                var idchamp = champ.attr('id').substring(6);
                var nomchamp = champ.text();
                if (idchamp) {
                    if (jQuery('#champ_' + idchamp).val() == '') {
                        msg += "Veuillez remplir le champ " + nomchamp + ".\n";
                    }
                }
            });
            if( msg != "" ){
                alert( msg );
                return false;
            } else {
                return true;
            }
        });
    }
</script>
