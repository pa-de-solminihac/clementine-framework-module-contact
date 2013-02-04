<script type="text/javascript" >
function submitThisForm(){
    var msg = "";
    var contact = document.getElementById("contact");
<?php
if (Clementine::$config['module_contact']['nom_required']) {
?>
    if( document.getElementById("nom").value == "" ){
        msg += "Veuillez remplir le champ Nom.\n";
    }
<?php
}
?>
<?php
if (Clementine::$config['module_contact']['prenom_required']) {
?>
    if( document.getElementById("prenom").value == "" ){
        msg += "Veuillez remplir le champ Prénom.\n";
    }
<?php
}
?>
<?php
if (Clementine::$config['module_contact']['societe_required']) {
?>
    if( document.getElementById("societe").value == "" ){
        msg += "Veuillez remplir le champ Société.\n";
    }
<?php
}
?>
<?php
if (Clementine::$config['module_contact']['activite_required']) {
?>
    if( document.getElementById("activite").value == "" ){
        msg += "Veuillez remplir le champ Activité.\n";
    }
<?php
}
?>
<?php
if (Clementine::$config['module_contact']['adresse_required']) {
?>
    if( document.getElementById("adresse").value == "" ){
        msg += "Veuillez remplir le champ Adresse.\n";
    }
<?php
}
?>
<?php
if (Clementine::$config['module_contact']['cp_required']) {
?>
    if( document.getElementById("cp").value == "" ){
        msg += "Veuillez remplir le champ Code postal.\n";
    }
<?php
}
?>
<?php
if (Clementine::$config['module_contact']['ville_required']) {
?>
    if( document.getElementById("ville").value == "" ){
        msg += "Veuillez remplir le champ Ville.\n";
    }
<?php
}
?>
<?php
if (Clementine::$config['module_contact']['tel_required']) {
?>
    if( document.getElementById("tel").value == "" ){
        msg += "Veuillez remplir le champ Tél.\n";
    }
<?php
}
?>
<?php
if (Clementine::$config['module_contact']['mobile_required']) {
?>
    if( document.getElementById("mobile").value == "" ){
        msg += "Veuillez remplir le champ Mobile.\n";
    }
<?php
}
?>
<?php
if (Clementine::$config['module_contact']['fax_required']) {
?>
    if( document.getElementById("fax").value == "" ){
        msg += "Veuillez remplir le champ Fax.\n";
    }
<?php
}
?>
<?php
if (Clementine::$config['module_contact']['email_required']) {
?>
    if( document.getElementById("email").value == "" ){
        msg += "Veuillez remplir le champ Email.\n";
    } else {
        var reg = new RegExp('^[a-z0-9]+([_|\.|+-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]­{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
        if(!reg.test(document.getElementById("email").value)) {
            msg += "Veuillez rentrer une adresse mail valide.\n";
        }
    }
<?php
}
?>
<?php
if (Clementine::$config['module_contact']['message_required']) {
?>
    if( document.getElementById("message").value == "" ){
        msg += "Veuillez remplir le champ Message.\n";
    }
<?php
}
if (Clementine::$config['module_contact']['recaptcha']) {
?>
    if( document.getElementById("recaptcha_response_field").value == "" ){
        msg += "Veuillez remplir le champ Recaptcha.\n";
    }
<?php
}
?>
    if( msg != "" ){
        alert( msg );
        return false;
    }
    else {
        return true;
    }
}
</script>
<?php
    $ns = $this->getModel('fonctions');
    if ($ns->ifSet('message', 'get')) {
?>
<div class="error"><strong>
<?php
        $err = $ns->ifGet('int', 'message');
        $message = '';
        switch ($err) {
            case 1 :
                $message = "Le message n'a pas été envoyé";
                break;
            case 2 :
                $message = "Le message a bien été envoyé";
                break;
            default :
                $message = "Le message n'a pu être envoyé";
                break;
        }
        echo $message;
?>
    <br /></strong><br />
</div>
<?php
    }
?>
<form id="form_contact" name="form_contact" class="form_contact" action="<?php echo __WWW__; ?>/contact/post" method="post" onsubmit="return submitThisForm();" >
<?php
if (Clementine::$config['module_contact']['nom']) {
?>
    <div>
        <label>Nom
<?php
if (Clementine::$config['module_contact']['nom_required']) {
?>
            <span class="red">*</span>
<?php
}
?>
        </label>
        <input type="text" name="nom" id="nom" value="" />
    </div>
<?php
}
?>
<?php
if (Clementine::$config['module_contact']['prenom']) {
?>
    <div>
        <label>Prénom
<?php
if (Clementine::$config['module_contact']['prenom_required']) {
?>
            <span class="red">*</span>
<?php
}
?>
        </label>
        <input type="text" name="prenom" id="prenom" value="" />
    </div>
<?php
}
?>
<?php
if (Clementine::$config['module_contact']['societe']) {
?>
    <div>
        <label>Société
<?php
if (Clementine::$config['module_contact']['societe_required']) {
?>
            <span class="red">*</span>
<?php
}
?>
        </label>
        <input type="text" name="societe" id="societe" value="" />
    </div>
<?php
}
?>
<?php
if (Clementine::$config['module_contact']['activite']) {
?>
    <div>
        <label>Activité
<?php
if (Clementine::$config['module_contact']['activite_required']) {
?>
            <span class="red">*</span>
<?php
}
?>
        </label>
        <input type="text" name="activite" id="activite" value="" />
    </div>
<?php
}
?>
<?php
if (Clementine::$config['module_contact']['adresse']) {
?>
    <div>
        <label>Adresse
<?php
if (Clementine::$config['module_contact']['adresse_required']) {
?>
            <span class="red">*</span>
<?php
}
?>
        </label>
        <textarea name="adresse" id="adresse"></textarea>
    </div>
<?php
}
?>
<?php
if (Clementine::$config['module_contact']['cp']) {
?>
    <div>
        <label>Code postal
<?php
if (Clementine::$config['module_contact']['cp_required']) {
?>
            <span class="red">*</span>
<?php
}
?>
        </label>
        <input type="text" name="cp" id="cp" value="" />
    </div>
<?php
}
?>
<?php
if (Clementine::$config['module_contact']['ville']) {
?>
    <div>
        <label>Ville
<?php
if (Clementine::$config['module_contact']['ville_required']) {
?>
            <span class="red">*</span>
<?php
}
?>
        </label>
        <input type="text" name="ville" id="ville" value="" />
    </div>
<?php
}
?>
<?php
if (Clementine::$config['module_contact']['tel']) {
?>
    <div>
        <label>Tél
<?php
if (Clementine::$config['module_contact']['tel_required']) {
?>
            <span class="red">*</span>
<?php
}
?>
        </label>
        <input type="text" name="tel" id="tel" value="" />
    </div>
<?php
}
?>
<?php
if (Clementine::$config['module_contact']['mobile']) {
?>
    <div>
        <label>Mobile
<?php
if (Clementine::$config['module_contact']['mobile_required']) {
?>
            <span class="red">*</span>
<?php
}
?>
        </label>
        <input type="text" name="mobile" id="mobile" value="" />
    </div>
<?php
}
?>
<?php
if (Clementine::$config['module_contact']['fax']) {
?>
    <div>
        <label>Fax
<?php
if (Clementine::$config['module_contact']['fax_required']) {
?>
            <span class="red">*</span>
<?php
}
?>
        </label>
        <input type="text" name="fax" id="fax" value="" />
    </div>
<?php
}
?>
<?php
if (Clementine::$config['module_contact']['email']) {
?>
    <div>
        <label>Email
<?php
if (Clementine::$config['module_contact']['email_required']) {
?>
            <span class="red">*</span>
<?php
}
?>
        </label>
        <input type="text" name="email" id="email" value="" />
    </div>
<?php
}
?>
<?php
if (Clementine::$config['module_contact']['message']) {
?>
    <div>
        <label>Message
<?php
if (Clementine::$config['module_contact']['message_required']) {
?>
            <span class="red">*</span>
<?php
}
?>
        </label>
        <textarea name="message" id="message" rows="6"></textarea>
    </div>
<?php
}
?>
<?php
if (Clementine::$config['module_contact']['recaptcha']) {
    $request = $this->getRequest();
?>
    <div>
    <script type="text/javascript">
    var RecaptchaOptions = {
        lang : '<?php echo $request['LANG']; ?>',
        theme : 'white'
    };
    </script>
<?php
    require_once(__FILES_ROOT__ . '/app/contact/lib/recaptchalib.php');
    $publickey = Clementine::$config['module_contact']['recaptcha_publickey']; // you got this from the signup page
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
if (Clementine::$config['module_contact']['legende_champs_obligatoires']) {
    echo Clementine::$config['module_contact']['legende_champs_obligatoires'];
}
?>
</form>
