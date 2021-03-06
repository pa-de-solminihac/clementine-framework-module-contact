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

    public function __construct($request, $params = null)
    {
        $class = strtolower(substr(get_class($this), 0, -10));
        $this->data['class']   = $class;
        $conf = $this->getModuleConfig();
        if (!$conf) {
            $conf = Clementine::$config['module_' . $class];
        }
        if ($conf['recaptcha']) {
            $this->getModel('cssjs')->register_js('recaptcha', array('src' => 'https://www.google.com/recaptcha/api.js'));
            if (!$conf['recaptcha_publickey']) {
                $this->trigger_error('configuration incomplete : [contact]recaptcha_publickey', E_USER_WARNING);
            }
            if (!$conf['recaptcha_privatekey']) {
                $this->trigger_error('configuration incomplete : [contact]recaptcha_privatekey', E_USER_WARNING);
            }
        }
        $this->data['config_module_contact'] = $conf;
    }

    /**
     * indexAction : controleur de la page contact du site
     * 
     * @access public
     * @return void
     */
    public function indexAction($request)
    {
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
        $ns = $this->getModel('fonctions');
        $this->data['more_infos'] = '';
        if (isset($request->GET['more_infos'])) {
            $this->data['more_infos'] = $ns->htmlentities($request->GET['more_infos']);
        }
        $this->data['base_message'] = '';
        if (isset($request->GET['base_message'])) {
            $this->data['base_message'] = $ns->htmlentities($request->GET['base_message']);
        }
    }

    /**
     * postAction : controleur d'envoi la page contact du site
     * 
     * @access public
     * @return void
     */
    public function postAction($request, $params = null)
    {
        $conf = $this->data['config_module_contact'];
        if (isset($params['email_prod'])) {
            $conf['email_prod'] = $params['email_prod'];
        } else {
            if (!isset($conf['email_prod'])) {
                $conf['email_prod'] = Clementine::$config['clementine_global']['email_prod'];
            }
        }
        $ns = $this->getModel('fonctions');
        if (!empty($request->POST)) {
            // récupération des données postées : seulement si le champ est autorise
            $donnees = array();
            foreach ($conf as $key => $val) {
                if ((substr($key, 0, 6) == 'champ_') && (substr($key, -9) != '_required') && $key != 'champ_required') {
                    if ($val) {
                        $donnees[$key] = trim($ns->strip_tags($ns->ifPost('string', $key)));
                    }
                }
            }
            $donnees = $this->sanitize($donnees, $conf, $request);
            $errors = $this->validate($donnees, $conf, $request);
            $tout_valide = !count($errors);
            // Traitement si tout est valide
            $nberrors = 0;
            $url_retour = __WWW__ . '/' . $this->data['class'];
            if (!empty($params['url_retour'])) {
                $url_retour = $params['url_retour'];
            }
            if (!$tout_valide) {
                $error = 1;
                $url_retour .= '?message=' . $error;
                if ($request->AJAX) {
                    echo '1';
                    echo json_encode($errors, JSON_FORCE_OBJECT);
                    // pas un dontGetBlock ici car on ne veut pas que du code s'exécute après
                    die();
                } else {
                    $ns->redirect($url_retour);
                }
            } else {
                $data = array('donnees' => $donnees, 'conf' => $conf, 'class' => $this->data['class']);
                $contenu = $this->getBlockHtml($this->data['class'] . '/mail_to_site', $data);
                $destinataires = $data['conf']['email_prod'];
                $error = $this->sendmails($contenu, $destinataires, $data);
                $url_retour .= '?message=' . $error;
                if ($request->AJAX) {
                    echo '2';
                    echo $url_retour;
                    // pas un dontGetBlock ici car on ne veut pas que du code s'exécute après
                    die();
                } else {
                    $ns->redirect($url_retour);
                }
            }
        }
    }

    public function sanitize($donnees, $conf = null, $request = null)
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

    public function validate($donnees, $conf = null, $request = null)
    {
        $ns = $this->getModel('fonctions');
        $conf = $this->data['config_module_contact'];
        $errors = array();
        // validation minimale pour tous les champs requis
        foreach ($conf as $key => $val) {
            $nom_champ = substr($key, 6, -9);
            if ((substr($key, 0, 6) == 'champ_') && (substr($key, -9) == '_required') && strlen($nom_champ)) {
                if ($val) {
                    if (!strlen($donnees['champ_' . $nom_champ])) {
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
            if (!(strlen($donnees['champ_tel']) >= 2)) {
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
            $privatekey = $conf['recaptcha_privatekey'];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, array(
                'secret' => $privatekey,
                'remoteip' => $request->SERVER['REMOTE_ADDR'],
                'response' => $request->POST['g-recaptcha-response'],
            ));
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
            $response = curl_exec($ch);
            $resp = json_decode($response);
            if (!$resp->success) {
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
            $contenu_confirmation = $this->getBlockHtml($this->data['class'] . '/mail_confirmation');
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
