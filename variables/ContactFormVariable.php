<?php
namespace Craft;

class ContactFormVariable
{
	public function getReCaptchaInput()
	{
		$settings = craft()->plugins->getPlugin('contactform')->getSettings();
		craft()->templates->includeJsFile('https://www.google.com/recaptcha/api.js');
		return "<div class=\"g-recaptcha\" data-sitekey=\"{$settings->reCaptchaSiteKey}\"></div>";
	}
}
