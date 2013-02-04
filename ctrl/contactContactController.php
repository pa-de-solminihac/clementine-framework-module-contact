<?php

/**
 * contactContactController 
 * 
 * @uses contactContactController
 * @uses _Parent
 * @package 
 * @version $id$
 * @copyright 
 * @author Pierre-Alexis <pa@quai13.com> 
 * @license 
 */
class contactContactController extends contactContactController_Parent
{
    /**
     * indexAction : controleur de la page contact du site
     * 
     * @access public
     * @return void
     */
    public function indexAction()
    {
        $conf = $this->getModuleConfig();
        if (!$conf) {
            $conf = Clementine::$config['module_contact'];
        }
        $class = strtolower(substr(get_class($this), 0, -10));
        // charge les infos sur l'utilisateur si necessaire
        if ($this->canGetModel('users')) {
            $auth = $this->getModel('users')->getAuth();
            $adresse = array();
            if ($auth) {
                if ($this->canGetModel('adresse')) {
                    $adresse = $this->getModel('adresse')->getAdresseByUserId($auth['id']);
                }
            }
            $this->data['user'] = array();
            if ($auth) {
                $this->data['user'] = array_merge($this->data['user'], $auth);
                if ($adresse) {
                    $this->data['user'] = array_merge($this->data['user'], $adresse);
                }
            }
        }
        $this->data['class']   = $class;
        $this->data['config_module_contact'] = $conf;
        if ($conf['recaptcha']) {
            if ($conf['recaptcha_publickey']) {
                echo 'configuration incomplete : [contact]recaptcha_publickey<br />';
            }
            if ($conf['recaptcha_privatekey']) {
                echo 'configuration incomplete : [contact]recaptcha_privatekey<br />';
            }
        }
    }

    /**
     * postAction : controleur d'envoi la page contact du site
     * 
     * @access public
     * @return void
     */
    public function postAction($params = null)
    {
        $class = strtolower(substr(get_class($this), 0, -10));
        $conf = $this->getModuleConfig();
        if (!$conf) {
            $conf = Clementine::$config['module_' . $class];
        }
        $this->data['class']   = $class;
        $this->data['config_module_contact'] = $conf;
        if ($conf['recaptcha']) {
            if ($conf['recaptcha_publickey']) {
                echo 'configuration incomplete : [contact]recaptcha_publickey<br />';
            }
            if ($conf['recaptcha_privatekey']) {
                echo 'configuration incomplete : [contact]recaptcha_privatekey<br />';
            }
        }
        if (isset($params['email_prod'])) {
            $conf['email_prod'] = $params['email_prod'];
        } else {
            if (!isset($conf['email_prod'])) {
                $conf['email_prod'] = Clementine::$config['clementine_global']['email_prod'];
            }
        }
        $ns = $this->getModel('fonctions');
        if (!empty($_POST)) {
            // récupération des données postées
            $donnees = array();
            foreach ($conf as $key => $val) {
                if ((substr($key, 0, 6) == 'champ_') && (substr($key, -9) != '_required') && $key != 'champ_required') {
                    if ($val) {
                        $donnees[$key] = trim($ns->strip_tags($ns->ifPost('string', $key)));
                    }
                }
            }
            $donnees = $this->sanitize($donnees);
            $errors = $this->validate($donnees, $conf);
            $tout_valide = !count($errors);
            // Traitement si tout est valide
            $nberrors = 0;
            if (!$tout_valide) {
                $error = 1;
                $ns->redirect(__WWW__ . '/contact?message=' . $error);
            } else {
                $data = array('donnees' => $donnees, 'conf' => $conf, 'class' => $class);
                $contenu = $this->getBlockHtml($class . '/mail_to_site', $data);
                $destinataires = $data['conf']['email_prod'];
                $error = $this->sendmails($contenu, $destinataires, $data);
                $ns->redirect(__WWW__ . '/contact?message=' . $error);
            }
        }
    }

    public function sanitize($donnees)
    {
        $ns = $this->getModel('fonctions');
        $donnees_propres = array();
        foreach ($donnees as $key => $val) {
            $donnees_propres[$key] = trim($ns->strip_tags($val));
        }
        if (isset($donnees_propres['champ_message'])) {
            $donnees_propres['champ_message'] = nl2br($donnees_propres['champ_message']);
        }
        return $donnees_propres;
    }

    public function validate($donnees, $conf = null)
    {
        $ns = $this->getModel('fonctions');
        if (!$conf) {
            $conf = $this->getModuleConfig();
            if (!$conf) {
                $conf = Clementine::$config['module_' . $class];
            }
        }
        $errors = array();
        // validation minimale pour tous les champs requis
        foreach ($conf as $key => $val) {
            if ((substr($key, 0, 6) == 'champ_') && (substr($key, -9) == '_required') && $key != 'champ_required') {
                if ($val) {
                    if (!strlen($donnees['champ_nom'])) {
                        $errors[] = $key;
                    }
                }
            }
        }
        // validation specifique
        if ($conf['champ_nom_required']) {
            if (!(strlen($donnees['champ_nom']) >= 2)) {
                $errors[] = 'nom';
            }
        }
        if ($conf['champ_prenom_required']) {
            if (!(strlen($donnees['champ_prenom']) >= 2)) {
                $errors[] = 'prenom';
            }
        }
        if ($conf['champ_societe_required']) {
            if (!(strlen($donnees['champ_societe']) >= 2)) {
                $errors[] = 'société';
            }
        }
        if ($conf['champ_activite_required']) {
            if (!(strlen($donnees['champ_activite']) >= 2)) {
                $errors[] = 'activité';
            }
        }
        if ($conf['champ_adresse_required']) {
            if (!(strlen($donnees['champ_adresse']) >= 2)) {
                $errors[] = 'adresse';
            }
        }
        if ($conf['champ_ville_required']) {
            if (!(strlen($donnees['champ_ville']) >= 2)) {
                $errors[] = 'ville';
            }
        }
        if ($conf['champ_cp_required']) {
            if (!(strlen($donnees['champ_cp']) >= 2)) {
                $errors[] = 'code postal';
            }
        }
        if ($conf['champ_tel_required']) {
            if (!(strlen($donnees['champ_telephone']) >= 2)) {
                $errors[] = 'tél';
            }
        }
        if ($conf['champ_mobile_required']) {
            if (!(strlen($donnees['champ_mobile']) >= 2)) {
                $errors[] = 'mobile';
            }
        }
        if ($conf['champ_fax_required']) {
            if (!(strlen($donnees['champ_fax']) >= 2)) {
                $errors[] = 'fax';
            }
        }
        if ($conf['champ_email_required']) {
            if (!$ns->est_email($donnees['champ_email'])) {
                $errors[] = 'e-mail';
            }
        }
        if ($conf['champ_message_required']) {
            if (!(strlen($donnees['champ_message']) >= 2)) {
                $errors[] = 'message';
            }
        }
        if ($conf['recaptcha']) {
            require_once(__FILES_ROOT_CONTACT__ . '/lib/recaptchalib.php');
            $privatekey = $conf['recaptcha_privatekey'];
            $resp = recaptcha_check_answer($privatekey,
                                            $_SERVER["REMOTE_ADDR"],
                                            $_POST["recaptcha_challenge_field"],
                                            $_POST["recaptcha_response_field"]);
            if (!$resp->is_valid) {
                $errors[] = 'captcha';
            }
        }
        return array_unique($errors);
    }

    public function sendmails($contenu, $destinataires, $params, $titre = null, $titre_confirmation = null)
    {
        $ns = $this->getModel('fonctions');
        $destinataires = explode(',', $destinataires);
        // si au moins un mail est parti, on considere que le mail est bien parti : error = 2
        $error = 1;
        $nom    = $ns->html_entity_decode($params['donnees']['champ_nom'], ENT_QUOTES);
        $prenom = $ns->html_entity_decode($params['donnees']['champ_prenom'], ENT_QUOTES);
        if ($titre === null) {
            $titre = Clementine::$config['clementine_global']['site_name'] . ' : demande de contact';
        }
        foreach ($destinataires as $destinataire) {
            if ($ns->envoie_mail($destinataire,
                                 $params['donnees']['champ_email'], $nom . ' ' . $prenom,
                                 $titre,
                                 $ns->strip_tags($contenu),
                                 $contenu)) {
                $error = 2;
            }
        }
        // envoie du mail de confirmation si le message a bien été envoyé
        if ($error == 2 && $params['conf']['envoyer_confirmation']) {
            if ($titre_confirmation === null) {
                $titre_confirmation = Clementine::$config['clementine_global']['site_name'] . ' : confirmation de contact';
            }
            $class = strtolower(substr(get_class($this), 0, -10));
            $contenu_confirmation = $this->getBlockHtml($class . '/mail_confirmation');
            if ($params['conf']['email_confirmation']) {
                $ns->envoie_mail($params['donnees']['champ_email'],
                                 $params['conf']['email_confirmation'], Clementine::$config['clementine_global']['site_name'],
                                 $titre_confirmation,
                                 $ns->strip_tags($contenu_confirmation),
                                 $contenu_confirmation);
            }
        }
        return $error;
    }

}
?>
