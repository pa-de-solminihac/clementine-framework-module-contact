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
        $cconf = Clementine::$config['module_contact'];
        if ($cconf['recaptcha']) {
            if ($cconf['recaptcha_publickey']) {
                echo 'configuration incomplete : [contact]recaptcha_publickey<br />';
            }
            if ($cconf['recaptcha_privatekey']) {
                echo 'configuration incomplete : [contact]recaptcha_privatekey<br />';
            }
        }
        if (!isset($cconf['email_prod'])) {
            $cconf['email_prod'] = Clementine::$config['clementine_global']['email_prod'];
        }
        $ns = $this->getModel('fonctions');
        if (!empty($_POST)) {
            //Récuppération des données postées
            if ($cconf['nom']) {
                $nom        = trim($ns->strip_tags($ns->ifPost('string', 'nom')));
            }
            if ($cconf['prenom']) {
                $prenom        = trim($ns->strip_tags($ns->ifPost('string', 'prenom')));
            }
            if ($cconf['societe']) {
                $societe    = trim($ns->strip_tags($ns->ifPost('string', 'societe')));
            }
            if ($cconf['activite']) {
                $activite   = trim($ns->strip_tags($ns->ifPost('string', 'activite')));
            }
            if ($cconf['adresse']) {
                $adresse    = trim($ns->strip_tags($ns->ifPost('string', 'adresse')));
            }
            if ($cconf['cp']) {
                $cp         = trim($ns->strip_tags($ns->ifPost('string', 'cp')));
            }
            if ($cconf['ville']) {
                $ville      = trim($ns->strip_tags($ns->ifPost('string', 'ville')));
            }
            if ($cconf['tel']) {
                $telephone  = trim($ns->strip_tags($ns->ifPost('string', 'tel')));
            }
            if ($cconf['mobile']) {
                $mobile  = trim($ns->strip_tags($ns->ifPost('string', 'mobile')));
            }
            if ($cconf['fax']) {
                $fax        = trim($ns->strip_tags($ns->ifPost('string', 'fax')));
            }
            if ($cconf['email']) {
                $email      = trim($ns->strip_tags($ns->ifPost('string', 'email')));
            }
            if ($cconf['message']) {
                $message    = trim($ns->strip_tags($ns->ifPost('string', 'message')));
                $message    = nl2br($message);
            }
            // validation des informations saisies
            $errors = array();
            if ($cconf['nom_required']) {
                if (!(strlen($nom) >= 2)) {
                    $errors[] = 'nom';
                }
            }
            if ($cconf['prenom_required']) {
                if (!(strlen($prenom) >= 2)) {
                    $errors[] = 'prenom';
                }
            }
            if ($cconf['societe_required']) {
                if (!(strlen($societe) >= 2)) {
                    $errors[] = 'société';
                }
            }
            if ($cconf['activite_required']) {
                if (!(strlen($activite) >= 2)) {
                    $errors[] = 'activité';
                }
            }
            if ($cconf['adresse_required']) {
                if (!(strlen($adresse) >= 2)) {
                    $errors[] = 'adresse';
                }
            }
            if ($cconf['ville_required']) {
                if (!(strlen($ville) >= 2)) {
                    $errors[] = 'ville';
                }
            }
            if ($cconf['cp_required']) {
                if (!(strlen($cp) >= 2)) {
                    $errors[] = 'code postal';
                }
            }
            if ($cconf['tel_required']) {
                if (!(strlen($telephone) >= 2)) {
                    $errors[] = 'tél';
                }
            }
            if ($cconf['mobile_required']) {
                if (!(strlen($mobile) >= 2)) {
                    $errors[] = 'mobile';
                }
            }
            if ($cconf['fax_required']) {
                if (!(strlen($fax) >= 2)) {
                    $errors[] = 'fax';
                }
            }
            if ($cconf['email_required']) {
                if (!$ns->est_email($email)) {
                    $errors[] = 'email';
                }
            }
            if ($cconf['message_required']) {
                if (!(strlen($message) >= 2)) {
                    $errors[] = 'message';
                }
            }
            if ($cconf['recaptcha']) {
                require_once(__FILES_ROOT__ . '/app/contact/lib/recaptchalib.php');
                $privatekey = $cconf['recaptcha_privatekey'];
                $resp = recaptcha_check_answer($privatekey,
                                               $_SERVER["REMOTE_ADDR"],
                                               $_POST["recaptcha_challenge_field"],
                                               $_POST["recaptcha_response_field"]);
                if (!$resp->is_valid) {
                    $errors[] = 'captcha';
                }
            }
            $tout_valide = !count($errors);
            // Traitement si tout est valide
            $nberrors = 0;
            if (!$tout_valide) {
                $error = 1;
                $ns->redirect(__WWW__ . '/contact?message=' . $error);
            } else {
                $contenu = '<html><head><title>Demande de contact (site ' . Clementine::$config['clementine_global']['site_name'] . ')</title></head><body>';
                if ($cconf['nom']) {
                    $contenu .= '<br>Nom : ' . $nom;
                }
                if ($cconf['prenom']) {
                    $contenu .= '<br>Prénom : ' . $prenom;
                }
                if ($cconf['societe']) {
                    $contenu .= '<br>Société : ' . $societe;
                }
                if ($cconf['activite']) {
                    $contenu .= '<br>Activité : ' . $activite;
                }
                if ($cconf['adresse']) {
                    $contenu .= '<br>Adresse : ' . $adresse;
                }
                if ($cconf['cp']) {
                    $contenu .= '<br>Code Postal : ' . $cp;
                }
                if ($cconf['ville']) {
                    $contenu .= '<br>Ville : ' . $ville;
                }
                if ($cconf['tel']) {
                    $contenu .= '<br>Téléphone : ' . $telephone;
                }
                if ($cconf['mobile']) {
                    $contenu .= '<br>Mobile : ' . $mobile;
                }
                if ($cconf['fax']) {
                    $contenu .= '<br>Fax : ' . $fax;
                }
                if ($cconf['email']) {
                    $contenu .= '<br>Email : ' . $email;
                }
                if ($cconf['message']) {
                    $contenu .= '<br>Message : ' . $message;
                }
                $contenu .= '</body></html>';
                $titre = 'Demande de contact (site ' . Clementine::$config['clementine_global']['site_name'] . ')';
                $destinataires = explode(',', $cconf['email_prod']);
                // si au moins un mail est parti, on considere que le mail est bien parti
                $error = 1;
                foreach ($destinataires as $destinataire) {
                    if ($ns->envoie_mail($destinataire, $email, $ns->html_entity_decode($nom) . ' ' . $ns->html_entity_decode($prenom), $titre, $ns->strip_tags($contenu), $contenu)) {
                        $error = 2;
                    }
                }
                $ns->redirect(__WWW__ . '/contact?message=' . $error);
            }
        }
    }
}
?>
