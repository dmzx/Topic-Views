<?php
/**
* @package Topic Views Extension
* @copyright (c) 2015 dmzx - http://dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*/

namespace dmzx\topicviews\event;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	protected $template;

	protected $user;

	public function __construct(\phpbb\template\template $template, \phpbb\user $user)
	{
		$this->template = $template;
		$this->user = $user;
	}

	static public function getSubscribedEvents()
	{

		return array(
			'core.viewtopic_assign_template_vars_before' => 'viewtopic_assign_template_vars_before',
		);
	}

	public function viewtopic_assign_template_vars_before($event)
	{
		$this->user->add_lang_ext('dmzx/topicviews', 'common');

		$topic_data = $event['topic_data'];
		$this->template->assign_var('TOPIC_VIEWS',$topic_data['topic_views']);
	}
}
