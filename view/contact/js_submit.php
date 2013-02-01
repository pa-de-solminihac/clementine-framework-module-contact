<?php
if (!isset($data['class'])) {
    $data['class'] = 'contact';
}
$conf = '';
if (isset($data['config_module_' . $data['class']])) {
    $conf = $data['config_module_' . $data['class']];
}
// par défaut
if (!$conf) {
    $conf = Clementine::$config['module_' . $data['class']];
}
?>
<script type="text/javascript">
    // si jQuery est chargé
    if (typeof(jQuery) != "undefined") {
        jQuery('body').delegate('#form_<?php echo $data['class']; ?>', 'submit', function() {
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
