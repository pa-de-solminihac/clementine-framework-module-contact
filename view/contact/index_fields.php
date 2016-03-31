<?php
$conf = $data['conf'];
$user = array();
if (isset($data['user'])) {
    $user = $data['user'];
    // complete user avec son adresse
    if (!empty($user['adresse']) && is_array($user['adresse'])) {
        foreach ($user['adresse'] as $field => $val) {
            if (empty($user[$field]) && !empty($user['adresse'][$field])) {
                $user[$field] = $val;
            }
        }
    }
}
if (!empty($data['more_infos'])) {
?>
    <input type="hidden" name="champ_more_infos" id="champ_more_infos" value="<?php
    echo $data['more_infos'];
    ?>" />
<?php
}
if ($conf['champ_nom']) {
?>
<div class="form-group">
    <label class="col-sm-2"><span class="label_text" id="label_nom">Nom</span>
<?php
    if ($conf['champ_nom_required']) {
?>
        <span class="required red">*</span>
<?php
    }
?>
    </label>
    <div class="col-sm-10">
        <input
            class="form-control text-input"
            placeholder="Nom"
            type="text"
            name="champ_nom"
            id="champ_nom"
            value="<?php
    if (isset($user['nom'])) {
        echo $user['nom'];
    }
    ?>" <?php
    if ($conf['champ_nom_required']) {
?>
            required="required"
<?php
    }
?> />
    </div>
</div>
<?php
}
if ($conf['champ_prenom']) {
?>
<div class="form-group">
    <label class="col-sm-2"><span class="label_text" id="label_prenom">Prénom</span>
<?php
    if ($conf['champ_prenom_required']) {
?>
        <span class="required red">*</span>
<?php
    }
?>
    </label>
    <div class="col-sm-10">
        <input
            class="form-control text-input"
            placeholder="Prénom"
            type="text"
            name="champ_prenom"
            id="champ_prenom"
            value="<?php
    if (isset($user['prenom'])) {
        echo $user['prenom'];
    }
    ?>" <?php
    if ($conf['champ_prenom_required']) {
?>
            required="required"
<?php
    }
?> />
    </div>
</div>
<?php
}
if ($conf['champ_societe']) {
?>
<div class="form-group">
    <label class="col-sm-2"><span class="label_text" id="label_societe">Société</span>
<?php
    if ($conf['champ_societe_required']) {
?>
        <span class="required red">*</span>
<?php
    }
?>
    </label>
    <div class="col-sm-10">
        <input
            class="form-control text-input"
            placeholder="Société"
            type="text"
            name="champ_societe"
            id="champ_societe"
            value="<?php
    if (isset($user['societe'])) {
        echo $user['societe'];
    }
    ?>" <?php
    if ($conf['champ_societe_required']) {
?>
            required="required"
<?php
    }
?> />
    </div>
</div>
<?php
}
if ($conf['champ_activite']) {
?>
<div class="form-group">
    <label class="col-sm-2"><span class="label_text" id="label_">Activité</span>
<?php
    if ($conf['champ_activite_required']) {
?>
        <span class="required red">*</span>
<?php
    }
?>
    </label>
    <div class="col-sm-10">
        <input
            class="form-control text-input"
            placeholder="Activité"
            type="text"
            name="champ_activite"
            id="champ_activite"
            value="<?php
    if (isset($user['activite'])) {
        echo $user['activite'];
    }
    ?>" <?php
    if ($conf['champ_activite_required']) {
?>
            required="required"
<?php
    }
?> />
    </div>
</div>
<?php
}
if ($conf['champ_adresse']) {
?>
<div class="form-group">
    <label class="col-sm-2"><span class="label_text" id="label_activite">Adresse</span>
<?php
    if ($conf['champ_adresse_required']) {
?>
        <span class="required red">*</span>
<?php
    }
?>
    </label>
    <div class="col-sm-10">
        <textarea
            class="form-control text-input"
            placeholder="Adresse"
            name="champ_adresse"
            id="champ_adresse" <?php
        if ($conf['champ_adresse_required']) {
    ?>
            required="required"
    <?php
        }
    ?>><?php
        if (isset($user['adresse'])) {
            echo $user['adresse'];
        }
        if (isset($user['adresse2'])) {
            echo "\n" . $user['adresse2'];
        }
        ?></textarea>
    </div>
</div>
<?php
}
if ($conf['champ_cp']) {
?>
<div class="form-group">
    <label class="col-sm-2"><span class="label_text" id="label_cp">Code postal</span>
<?php
    if ($conf['champ_cp_required']) {
?>
        <span class="required red">*</span>
<?php
    }
?>
    </label>
    <div class="col-sm-10">
        <input
            class="form-control text-input"
            placeholder="Code postal"
            type="text"
            name="champ_cp"
            id="champ_cp"
            value="<?php
    if (isset($user['code_postal'])) {
        echo $user['code_postal'];
    }
    ?>" <?php
    if ($conf['champ_cp_required']) {
?>
            required="required"
<?php
    }
?> />
    </div>
</div>
<?php
}
if ($conf['champ_ville']) {
?>
<div class="form-group">
    <label class="col-sm-2"><span class="label_text" id="label_ville">Ville</span>
<?php
    if ($conf['champ_ville_required']) {
?>
        <span class="required red">*</span>
<?php
    }
?>
    </label>
    <div class="col-sm-10">
        <input
            class="form-control text-input"
            placeholder="Ville"
            type="text"
            name="champ_ville"
            id="champ_ville"
            value="<?php
    if (isset($user['ville'])) {
        echo $user['ville'];
    }
    ?>" <?php
    if ($conf['champ_ville_required']) {
?>
            required="required"
<?php
    }
?> />
    </div>
</div>
<?php
}
if ($conf['champ_tel']) {
?>
<div class="form-group">
    <label class="col-sm-2"><span class="label_text" id="label_tel">Tél</span>
<?php
    if ($conf['champ_tel_required']) {
?>
        <span class="required red">*</span>
<?php
    }
?>
    </label>
    <div class="col-sm-10">
        <input
            class="form-control text-input"
            placeholder="Tél"
            type="tel"
            name="champ_tel"
            id="champ_tel"
            value="<?php
    if (isset($user['telephone_fixe'])) {
        echo $user['telephone_fixe'];
    }
    ?>" <?php
    if ($conf['champ_tel_required']) {
?>
            required="required"
<?php
    }
?> />
    </div>
</div>
<?php
}
if ($conf['champ_mobile']) {
?>
<div class="form-group">
    <label class="col-sm-2"><span class="label_text" id="label_mobile">Mobile</span>
<?php
    if ($conf['champ_mobile_required']) {
?>
        <span class="required red">*</span>
<?php
    }
?>
    </label>
    <div class="col-sm-10">
        <input
            class="form-control text-input"
            placeholder="Mobile"
            type="tel"
            name="champ_mobile"
            id="champ_mobile"
            value="<?php
    if (isset($user['telephone_mobile'])) {
        echo $user['telephone_mobile'];
    }
    ?>" <?php
    if ($conf['champ_mobile_required']) {
?>
            required="required"
<?php
    }
?> />
    </div>
</div>
<?php
}
if ($conf['champ_fax']) {
?>
<div class="form-group">
    <label class="col-sm-2"><span class="label_text" id="label_fax">Fax</span>
<?php
    if ($conf['champ_fax_required']) {
?>
        <span class="required red">*</span>
<?php
    }
?>
    </label>
    <div class="col-sm-10">
        <input
            class="form-control text-input"
            placeholder="Fax"
            type="tel"
            name="champ_fax"
            id="champ_fax"
            value="<?php
    if (isset($user['fax'])) {
        echo $user['fax'];
    }
    ?>" <?php
    if ($conf['champ_fax_required']) {
?>
            required="required"
<?php
    }
?> />
    </div>
</div>
<?php
}
if ($conf['champ_email']) {
?>
<div class="form-group">
    <label class="col-sm-2"><span class="label_text" id="label_email">E-mail</span>
<?php
    if ($conf['champ_email_required']) {
?>
        <span class="required red">*</span>
<?php
    }
?>
    </label>
    <div class="col-sm-10">
        <input
            class="form-control text-input"
            placeholder="E-mail"
            type="email"
            name="champ_email"
            id="champ_email"
            value="<?php
    if (isset($user['login'])) {
        echo $user['login'];
    }
    ?>" <?php
    if ($conf['champ_email_required']) {
?>
            required="required"
<?php
    }
?> />
    </div>
</div>
<?php
}
if ($conf['champ_message']) {
?>
<div class="form-group">
    <label class="col-sm-2"><span class="label_text" id="label_message">Message</span>
<?php
    if ($conf['champ_message_required']) {
?>
        <span class="required red">*</span>
<?php
    }
?>
    </label>
    <div class="col-sm-10">
        <textarea
            class="form-control text-input"
            placeholder="Message"
            name="champ_message"
            id="champ_message"
            rows="6" <?php
    if ($conf['champ_message_required']) {
?>
            required="required"
<?php
    }
    ?>><?php
    if (isset($data['base_message'])) {
        echo str_replace('\n', "\n", $data['base_message']);
    }
?></textarea>
    </div>
</div>
<?php
}
