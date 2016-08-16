<?php
namespace Craft;

class ContactFormModel extends BaseModel
{
	public $reCaptchaSecret;

	public function rules()
	{
		return \CMap::mergeArray(parent::rules(), array(
			array('reCaptchaResponse', 'validateReCaptcha')
		));
	}

	public function validateReCaptcha($attribute)
	{
		$recaptcha = new \ReCaptcha\ReCaptcha($this->reCaptchaSecret);
		$resp = $recaptcha->verify($this->$attribute, $_SERVER['REMOTE_ADDR']);
		if (!$resp->isSuccess()) {
			$this->addError($attribute, join(', ', $resp->getErrorCodes()));
		}
	}

	protected function defineAttributes()
	{
		return array(
			'reCaptchaResponse' => array(AttributeType::String, 'required' => true, 'label' => 'reCAPTCHA response'),
			'fromName'          => array(AttributeType::String, 'label' => 'Your Name'),
			'fromEmail'         => array(AttributeType::Email,  'required' => true, 'label' => 'Your Email'),
			'message'           => array(AttributeType::String, 'required' => true, 'label' => 'Message'),
			'htmlMessage'       => array(AttributeType::String),
			'messageFields'     => array(AttributeType::Mixed),
			'subject'           => array(AttributeType::String, 'label' => 'Subject'),
			'attachment'        => AttributeType::Mixed,
		);
	}
}
