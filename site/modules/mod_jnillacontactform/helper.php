<?php
/**
 * @copyright   Copyright (C) 2013 jnilla.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */


defined('_JEXEC') or die;

/**
 * Helper for mod_jnillacontactform
 *
 */
class ModJnillaContactFormHelper
{
	/**
	 * handle the operation if a form is submitted
	 *
	 */
	public static function controller($module, $params)
	{
		// declarations
		$app = JFactory::getApplication();
		$input = $app->input;
		$mid = $module->id;
		$prefix = "jnilla-contact-form-$mid";
		$sitename = $app->get('sitename');

		// data submitted from this module ?
		if($input->get('jnilla-contact-form-id') !== $mid) return;
		// check token
		JSession::checkToken() or die( 'Invalid Token' );
		// get form data
		$data = $input->post->get($prefix, array(), 'array');
		// reCaptcha challenge ?
		if($params->get('enable_recaptcha'))
		{
			$remoteIp = JFactory::getApplication()->input->server->get('REMOTE_ADDR');
			$siteKey = $params->get('recaptcha_site_key');
			$secretKey = $params->get('recaptcha_secret_key');
			require_once ("recaptchalib.php");
			$reCaptcha = new ReCaptcha($secretKey);
			$reCatpchaData = JFactory::getApplication()->input->post->get('g-recaptcha-response');
			if (!$reCatpchaData)
			{
				$app->redirect(
					JFactory::getURI()->toString(),
					JText::_('MOD_JNILLACONTACTFORM_ERROR_RECAPTCHA_CHALLENGE_FAILED'), 'error');
				return;
			}
			$reCatpchaRest = $reCaptcha->verifyResponse($remoteIp, $reCatpchaData);
			if(!$reCatpchaRest->success)
			{
				$app->redirect(
						JFactory::getURI()->toString(),
						JText::_('MOD_JNILLACONTACTFORM_ERROR_RECAPTCHA_CHALLENGE_FAILED'), 'error');
				return;
			}
		}
		// list labels
		$labels = $input->post->get("$prefix-label", array(), 'array');
		// list form fields
		foreach($_POST[$prefix] as $key => $value) $fields[] = $key;
		// list recipients
		$recipients = explode("\n", trim($params->get('recipients')));
		// subject
		$subject = trim($params->get('subject'));
		if($subject == "") $subject = JText::sprintf('MOD_JNILLACONTACTFORM_NEW_MESSAGE_FROM', $sitename);
		// compose and send the mail
		$sent = self::_sendEmail($data, $fields, $labels, $recipients, $subject);
		if (!($sent instanceof Exception))
		{
			$app->redirect(
				JFactory::getURI()->toString(),
				JText::_('MOD_JNILLACONTACTFORM_MESSAGE_SEND_SUCCESS'), 'info');
			return;
		}
		else
		{
			$app->redirect(
				JFactory::getURI()->toString(),
				$sent->getMessage(), 'error');
			return;
		}
	}


	/**
	 * compose the mail content and send it.
	 *
	 */
	private function _sendEmail($data, $fields, $labels, $recipients, $subject)
	{
		// declarations
		$app = JFactory::getApplication();
		$mailfrom = $app->get('mailfrom');
		$fromname = $app->get('fromname');
		// send copy ?
		if(in_array('copy', $fields) && isset($data['email']) && !empty($data['email']))
		{
			unset($fields[array_search('copy', $fields)]);
			$recipients[]= $data['email'];
		}
		// compose mail body
		$body = array();
		foreach($fields as $field)
		{
			$body[] = $labels[$field].": ".trim($data[$field]);
			if(strlen($data[$field]) > 50) $body[] = "--------------------------------------------------";
			$body[] = "\n";
		}
		$body = implode("\n", $body);
		// send mail to recipients
		foreach($recipients as $recipient)
		{
			if(trim($recipient) == "") continue;
			unset($mail);
			$mail = JFactory::getMailer();
			$mail->addRecipient($recipient);
			$mail->setSender(array($mailfrom, $fromname));
			$mail->setSubject($subject);
			$mail->setBody($body);
			$sent = $mail->Send();
			if(!$sent) return $sent;
		}
		return $sent;
	}
}



