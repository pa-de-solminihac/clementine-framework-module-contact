<?php
$conf = '';
if (isset($data['config_module_contact'])) {
    $conf = $data['config_module_contact'];
}
// par défaut
if (!$conf) {
    $conf = Clementine::$config['module_contact'];
}
$user = array();
if (isset($data['user'])) {
    $user = $data['user'];
}
if ($conf['champ_nom']) {
?>
<div>
    <label><span class="label_text" id="label_nom">Nom</span>
<?php
    if ($conf['champ_nom_required']) {
?>
        <span class="required red">*</span>
<?php
    }
?>
    </label>
    <input type="text" name="champ_nom" id="champ_nom" value="<?php
    if (isset($user['nom'])) {
        echo $user['nom'];
    }
    ?>" />
</div>
<?php
}
?>
<?php
if ($conf['champ_prenom']) {
?>
<div>
    <label><span class="label_text" id="label_prenom">Prénom</span>
<?php
    if ($conf['champ_prenom_required']) {
?>
        <span class="required red">*</span>
<?php
    }
?>
    </label>
    <input type="text" name="champ_prenom" id="champ_prenom" value="<?php
    if (isset($user['prenom'])) {
        echo $user['prenom'];
    }
    ?>" />
</div>
<?php
}
?>
<?php
if ($conf['champ_societe']) {
?>
<div>
    <label><span class="label_text" id="label_societe">Société</span>
<?php
    if ($conf['champ_societe_required']) {
?>
        <span class="required red">*</span>
<?php
    }
?>
    </label>
    <input type="text" name="champ_societe" id="champ_societe" value="<?php
    if (isset($user['societe'])) {
        echo $user['societe'];
    }
    ?>" />
</div>
<?php
}
?>
<?php
if ($conf['champ_activite']) {
?>
<div>
    <label><span class="label_text" id="label_">Activité</span>
<?php
    if ($conf['champ_activite_required']) {
?>
        <span class="required red">*</span>
<?php
    }
?>
    </label>
    <input type="text" name="champ_activite" id="champ_activite" value="<?php
    if (isset($user['activite'])) {
        echo $user['activite'];
    }
    ?>" />
</div>
<?php
}
?>
<?php
if ($conf['champ_adresse']) {
?>
<div>
    <label><span class="label_text" id="label_activite">Adresse</span>
<?php
    if ($conf['champ_adresse_required']) {
?>
        <span class="required red">*</span>
<?php
    }
?>
    </label>
    <textarea name="champ_adresse" id="champ_adresse"><?php
    if (isset($user['adresse'])) {
        echo $user['adresse'];
    }
    if (isset($user['adresse2'])) {
        echo "\n" . $user['adresse2'];
    }
    ?></textarea>
</div>
<?php
}
?>
<?php
if ($conf['champ_cp']) {
?>
<div>
    <label><span class="label_text" id="label_cp">Code postal</span>
<?php
    if ($conf['champ_cp_required']) {
?>
        <span class="required red">*</span>
<?php
    }
?>
    </label>
    <input type="text" name="champ_cp" id="champ_cp" value="<?php
    if (isset($user['code_postal'])) {
        echo $user['code_postal'];
    }
    ?>" />
</div>
<?php
}
?>
<?php
if ($conf['champ_ville']) {
?>
<div>
    <label><span class="label_text" id="label_ville">Ville</span>
<?php
    if ($conf['champ_ville_required']) {
?>
        <span class="required red">*</span>
<?php
    }
?>
    </label>
    <input type="text" name="champ_ville" id="champ_ville" value="<?php
    if (isset($user['ville'])) {
        echo $user['ville'];
    }
    ?>" />
</div>
<?php
}
?>
<?php
if ($conf['champ_tel']) {
?>
<div>
    <label><span class="label_text" id="label_tel">Tél</span>
<?php
    if ($conf['champ_tel_required']) {
?>
        <span class="required red">*</span>
<?php
    }
?>
    </label>
    <input type="text" name="champ_tel" id="champ_tel" value="<?php
    if (isset($user['telephone_fixe'])) {
        echo $user['telephone_fixe'];
    }
    ?>" />
</div>
<?php
}
?>
<?php
if ($conf['champ_mobile']) {
?>
<div>
    <label><span class="label_text" id="label_mobile">Mobile</span>
<?php
    if ($conf['champ_mobile_required']) {
?>
        <span class="required red">*</span>
<?php
    }
?>
    </label>
    <input type="text" name="champ_mobile" id="champ_mobile" value="<?php
    if (isset($user['telephone_mobile'])) {
        echo $user['telephone_mobile'];
    }
    ?>" />
</div>
<?php
}
?>
<?php
if ($conf['champ_fax']) {
?>
<div>
    <label><span class="label_text" id="label_fax">Fax</span>
<?php
    if ($conf['champ_fax_required']) {
?>
        <span class="required red">*</span>
<?php
    }
?>
    </label>
    <input type="text" name="champ_fax" id="champ_fax" value="<?php
    if (isset($user['fax'])) {
        echo $user['fax'];
    }
    ?>" />
</div>
<?php
}
?>
<?php
if ($conf['champ_email']) {
?>
<div>
    <label><span class="label_text" id="label_email">E-mail</span>
<?php
    if ($conf['champ_email_required']) {
?>
        <span class="required red">*</span>
<?php
    }
?>
    </label>
    <input type="text" name="champ_email" id="champ_email" value="<?php
    if (isset($user['login'])) {
        echo $user['login'];
    }
    ?>" />
</div>
<?php
}
?>
<?php
if ($conf['champ_message']) {
?>
<div>
    <label><span class="label_text" id="label_message">Message</span>
<?php
    if ($conf['champ_message_required']) {
?>
        <span class="required red">*</span>
<?php
    }
?>
    </label>
    <textarea name="champ_message" id="champ_message" rows="6"></textarea>
</div>
<?php
}
?>
<?php
if ($conf['recaptcha']) {
?>
<div>
    <script type="text/javascript">
    var RecaptchaOptions = {
        lang : '<?php echo $request['LANG']; ?>',
            theme : 'white'
    };
    </script>
<?php
    require_once(__FILES_ROOT_CONTACT__ . '/lib/recaptchalib.php');
    $publickey = $conf['recaptcha_publickey']; // you got this from the signup page
    echo recaptcha_get_html($publickey);
?>
</div>
<?php
}
?>
<div>
    <label>&nbsp;</label>
    <input type="submit" value="Envoyer" class="bt_envoyer_form" />
</div>
<?php
if ($conf['legende_champs_obligatoires']) {
    echo $conf['legende_champs_obligatoires'];
}
?>
