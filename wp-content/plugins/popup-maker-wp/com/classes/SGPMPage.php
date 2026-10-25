<?php

class SGPMPage
{
	/**
	 * Reference to base plugin class.
	 *
	 * @var SGPMBase
	 */
	protected $base;

	public function __construct()
	{
		$this->set();
	}

	/**
	 * Sets our object instance and base class instance.
	 *
	 * @since 1.0.0
	 */
	public function set()
	{
		$this->base = SGPMBase::getInstance();
	}

	public function optionsSave()
	{
		//CSRF check
		if (!check_admin_referer('sgpm_options_save', 'wp-nonce-token-options-save')) {
			wp_die('Security check fail');
		}

		if (!SGPMHelper::currentUserCanManagePlugin()) {
			wp_die(esc_html__('You do not have permission to perform this action.', 'popup-maker-api'), 403);
		}

		$diplayTarget = $this->getTargetData();

		$popupId = $this->sanitize('sgpm-popup-id');
		$options = get_option('sgpm_popup_maker_api_option');

		if ($popupId === '' || !isset($options['popups'][$popupId])) {
			wp_die(esc_html__('Invalid popup.', 'popup-maker-api'), 400);
		}

		$options['popupsSettings'][$popupId]['displayTarget'] = $diplayTarget;
		update_option('sgpm_popup_maker_api_option', $options);

		wp_redirect(SGPM_ADMIN_URL."admin.php?page=popup-maker-api-settings&popupId=".rawurlencode($popupId));
		exit();
	}

	public function generalSettingsSave()
	{
		//CSRF check
		if (!check_admin_referer('sgpm_general_settings_save', 'wp-nonce-token-general_settings-save')) {
			wp_die('Security check fail');
		}

		if (!current_user_can('manage_options')) {
			wp_die(esc_html__('You do not have permission to perform this action.', 'popup-maker-api'), 403);
		}

		$selectedUserRoles = isset($_POST['sgpm-selected-user-roles']) ? array_map( 'sanitize_text_field', $_POST['sgpm-selected-user-roles'] ) : array();
		$selectedUserRoles = array_values(array_diff($selectedUserRoles, SGPMHelper::getDisallowedManageRoles()));
		update_option('sgpm_popup_maker_user_roles', $selectedUserRoles);

		// Save custom allowed tags
		$customAllowedTags = isset($_POST['sgpm-custom-allowed-tags']) ? sanitize_textarea_field($_POST['sgpm-custom-allowed-tags']) : '';
		update_option('sgpm_popup_maker_custom_allowed_tags', $customAllowedTags);

		// Save custom allowed attributes
		$customAllowedAttrs = isset($_POST['sgpm-custom-allowed-attrs']) ? sanitize_textarea_field($_POST['sgpm-custom-allowed-attrs']) : '';
		update_option('sgpm_popup_maker_custom_allowed_attrs', $customAllowedAttrs);

		wp_redirect(SGPM_ADMIN_URL."admin.php?page=popup-maker-api-settings");
		exit();
	}

	public function changePopupStatus()
	{
		// AJAX check
		check_ajax_referer(SGPM_AJAX_NONCE, 'nonce_ajax');

		if (!SGPMHelper::currentUserCanManagePlugin()) {
			wp_send_json_error(array('message' => 'Forbidden'), 403);
		}
		global $SGPM_DATA_CONFIG_ARRAY;
		$popupId = $this->sanitize('popupId');
		$popupStatus = $this->sanitize('popupStatus');
		if (!in_array($popupStatus, array('enabled', 'disabled'), true)) {
			wp_send_json_error(array('message' => 'Invalid status'), 400);
		}

		$options = get_option('sgpm_popup_maker_api_option');
		if (!isset($options['popups'][$popupId])) {
			wp_send_json_error(array('message' => 'Invalid popup'), 400);
		}

		$options['popupsSettings'][$popupId]['status'] = $popupStatus;
		if ($popupStatus == 'enabled' && !isset($options['popupsSettings'][$popupId]['displayTarget'])) {
			$options['popupsSettings'][$popupId]['displayTarget'] = $SGPM_DATA_CONFIG_ARRAY['displayTarget']['initialData'];
		}

		update_option('sgpm_popup_maker_api_option', $options);
		exit();
	}

	public function init()
	{
		$this->render();
	}

	public function render()
	{
		$options = get_option('sgpm_popup_maker_api_option');
		if (isset($_GET['popupId'])) {
			$popupId = sanitize_text_field(wp_unslash($_GET['popupId']));
			if (!isset($options['popups'][$popupId])) {
				require_once(SGPM_VIEW.'sgpm_page_content.php');
				return;
			}
			$popup = $options['popups'][$popupId];
			$popupSettings = isset($options['popupsSettings'][$popupId]) ? $options['popupsSettings'][$popupId] : array();
			require_once(SGPM_VIEW.'sgpm_popup_edit_content.php');
			return;
		}

		require_once(SGPM_VIEW.'sgpm_page_content.php');
	}

	public function sanitize($optionsKey)
	{
		if (!isset($_POST[$optionsKey])) {
			return '';
		}

		return sanitize_text_field(wp_unslash($_POST[$optionsKey]));
	}

	public function select2SearchData()
	{
		check_ajax_referer(SGPM_AJAX_NONCE, 'nonce_ajax');

		if (!SGPMHelper::currentUserCanManagePlugin()) {
			wp_send_json_error(array('message' => 'Forbidden'), 403);
		}

		$results = array('items' => array());
		$objectKey = isset($_POST['objectKey']) ? sanitize_text_field(wp_unslash($_POST['objectKey'])) : '';
		$searchType = isset($_POST['searchType']) ? sanitize_text_field(wp_unslash($_POST['searchType'])) : '';
		$search = isset($_POST['searchTerm']) ? sanitize_text_field(wp_unslash($_POST['searchTerm'])) : '';
		$page = isset($_REQUEST['page']) ? absint(wp_unslash($_REQUEST['page'])) : 0;

		$include = array();
		if (isset($_REQUEST['include'])) {
			$rawInclude = wp_unslash($_REQUEST['include']);
			if (is_array($rawInclude)) {
				$include = array_map('intval', $rawInclude);
			} elseif (is_string($rawInclude) && $rawInclude !== '') {
				$include = array_map('intval', explode(',', $rawInclude));
			}
		}

		if ($searchType == 'category') {
			$allowedTaxonomies = get_taxonomies(array('public' => true), 'names');
			$taxonomy = $objectKey !== '' ? $objectKey : 'category';
			if (!in_array($taxonomy, $allowedTaxonomies, true)) {
				wp_send_json_error(array('message' => 'Forbidden'), 403);
			}

			$args = array(
				'search'  => $search,
				'include' => !empty($include) ? $include : null,
				'page'    => $page ? $page : null,
				'number'  => 10,
			);

			$query = SGPMHelper::taxonomySelectlist($taxonomy, $args, true);

			foreach ($query['items'] as $name => $id) {
				$results['items'][] = array(
					'id'   => $id,
					'text' => $name,
				);
			}
		}
		else {
			if ($objectKey === '') {
				$objectKey = 'post';
			}

			$allowedPostTypes = get_post_types(array('public' => true), 'names');
			if (!in_array($objectKey, $allowedPostTypes, true)) {
				wp_send_json_error(array('message' => 'Forbidden'), 403);
			}

			$args = array(
				's'              => $search,
				'post__in'       => !empty($include) ? $include : null,
				'page'           => $page ? $page : null,
				'posts_per_page' => 10,
				'post_type'      => $objectKey
			);

			$searchResults = SGPMHelper::getPostTypeData($args);

			foreach ($searchResults as $id => $name) {
				$results['items'][] = array(
					'id'   => $id,
					'text' => $name
				);
			}
		}

		echo wp_json_encode($results);
		wp_die();
	}

	public function addConditionRuleRow()
	{
		// AJAX check
		check_ajax_referer(SGPM_AJAX_NONCE, 'nonce_ajax');

		if (!SGPMHelper::currentUserCanManagePlugin()) {
			wp_send_json_error(array('message' => 'Forbidden'), 403);
		}

		$data = '';
		global $SGPM_DATA_CONFIG_ARRAY;
		$targetType = $this->sanitize('conditionName');
		if (!SGPMHelper::isAllowedConditionType($targetType) || empty($SGPM_DATA_CONFIG_ARRAY[$targetType]['initialData'][0])) {
			wp_send_json_error(array('message' => 'Forbidden'), 403);
		}
		$ruleId = (int)$this->sanitize('ruleId');
		$conditionRule = $SGPM_DATA_CONFIG_ARRAY[$targetType]['initialData'][0];
		$data .= SGPMCondition::createConditionRuleRow($conditionRule, $ruleId);

		$allowed_html = $this->allowed_html_tags();
		echo wp_kses($data, $allowed_html);

		wp_die();
	}

	public function allowed_html_tags()
	{
		$allowedposttags = array();
		$allowedposttags = wp_kses_allowed_html( 'post' );
		$allowed_atts = array(
			'align'      => array(),
			'class'      => array(),
			'type'       => array(),
			'id'         => array(),
			'dir'        => array(),
			'lang'       => array(),
			'style'      => array(),
			'xml:lang'   => array(),
			'src'        => array(),
			'alt'        => array(),
			'href'       => array(),
			'rel'        => array(),
			'rev'        => array(),
			'target'     => array(),
			'novalidate' => array(),
			'type'       => array(),
			'value'      => array(),
			'name'       => array(),
			'tabindex'   => array(),
			'action'     => array(),
			'method'     => array(),
			'for'        => array(),
			'width'      => array(),
			'height'     => array(),
			'data-*'       => true,
			'title'      => array(),
			'attr'		=> array(),
			'label'		=> array(),
			'selected' => array(),
			'multiple' => array()
		);

		// Tags de base
		$base_tags = array(
			'select', 'optgroup', 'option', 'form', 'label', 'input', 'textarea',
			'strong', 'small', 'table', 'span',
			'abbr', 'code', 'pre', 'div', 'img', 'h1', 'h2', 'h3', 'h4', 'h5',
			'h6', 'ol', 'ul', 'li', 'em', 'hr', 'br', 'tr', 'td', 'p', 'a', 'b', 'i'
		);

		// Appliquer les tags de base
		foreach ($base_tags as $tag) {
			$allowedposttags[$tag] = $allowed_atts;
		}

		// Get and validate custom allowed tags
		$customAllowedTags = get_option('sgpm_popup_maker_custom_allowed_tags', '');
		$customAllowedAttrs = get_option('sgpm_popup_maker_custom_allowed_attrs', '');

		$validCustomTags = SGPMHelper::validateCustomTags($customAllowedTags);
		$validCustomAttrs = SGPMHelper::validateCustomAttrs($customAllowedAttrs);

		// Apply validated custom tags
		foreach ($validCustomTags as $tag) {
			$allowedposttags[$tag] = $allowed_atts;
		}

		// Apply validated custom attributes
		if (!empty($validCustomAttrs)) {
			$customAttrsArray = array();
			foreach ($validCustomAttrs as $attr) {
				$customAttrsArray[$attr] = array();
			}
			
			// Apply custom attributes to all tags
			foreach ($allowedposttags as $tag => $attrs) {
				$allowedposttags[$tag] = array_merge($attrs, $customAttrsArray);
			}
		}

		return $allowedposttags;
	}

	public function changeConditionRuleRow()
	{
		// AJAX check
		check_ajax_referer(SGPM_AJAX_NONCE, 'nonce_ajax');

		if (!SGPMHelper::currentUserCanManagePlugin()) {
			wp_send_json_error(array('message' => 'Forbidden'), 403);
		}

		$data = '';
		global $SGPM_DATA_CONFIG_ARRAY;

		$targetType = $this->sanitize('conditionName');
		if (!SGPMHelper::isAllowedConditionType($targetType) || empty($SGPM_DATA_CONFIG_ARRAY[$targetType])) {
			wp_send_json_error(array('message' => 'Forbidden'), 403);
		}
		$conditionConfig = $SGPM_DATA_CONFIG_ARRAY[$targetType];
		$ruleId = $this->sanitize('ruleId');
		$paramName = isset($_POST['paramName']) ? sanitize_text_field(wp_unslash($_POST['paramName'])) : '';
		if (!in_array($paramName, SGPMHelper::getAllowedDisplayTargetParams(), true)) {
			wp_send_json_error(array('message' => 'Forbidden'), 403);
		}
		$savedData = array(
			'param' => 	$paramName
		);

		if ($targetType == 'displayTarget' || $targetType == 'conditions') {
			$savedData['operator'] = '==';
		}

		$savedData['value'] = $conditionConfig['paramsData'][$paramName];
		$data .= SGPMCondition::createConditionRuleRow($savedData, $ruleId);

		$allowed_html = $this->allowed_html_tags();
		echo wp_kses($data, $allowed_html);

		wp_die();
	}

	private function getTargetData()
	{
		if (!isset($_POST['sgpm-display-target']) || !is_array($_POST['sgpm-display-target'])) {
			return array();
		}

		$conditionType = isset($_POST['sgpm-condition-type']) ? sanitize_text_field(wp_unslash($_POST['sgpm-condition-type'])) : '';
		$targetData = wp_unslash($_POST['sgpm-display-target']);
		$allowedParams = SGPMHelper::getAllowedDisplayTargetParams();
		global $SGPM_DATA_CONFIG_ARRAY;
		$targetConfig = $SGPM_DATA_CONFIG_ARRAY['displayTarget'];
		$paramsData = $targetConfig['paramsData'];
		$attrs = $targetConfig['attrs'];

		foreach ($targetData as $ruleId => $ruleData) {
			if (!is_array($ruleData) || empty($ruleData['param']) || !in_array($ruleData['param'], $allowedParams, true)) {
				unset($targetData[$ruleId]);
				continue;
			}

			$targetData[$ruleId]['param'] = sanitize_text_field($ruleData['param']);

			if (empty($ruleData['value']) && isset($paramsData[$ruleData['param']]) && !is_null($paramsData[$ruleData['param']])) {
				$targetData[$ruleId]['value'] = '';
			}

			if (isset($ruleData['value']) && is_array($ruleData['value'])) {

				$valueAttrs = isset($attrs[$ruleData['param']]) ? $attrs[$ruleData['param']] : array();
				$postType = isset($valueAttrs['data-value-param']) ? sanitize_text_field($valueAttrs['data-value-param']) : '';
				$isNotPostType = !empty($valueAttrs['isNotPostType']);
				$objectType = isset($valueAttrs['data-value-type']) ? sanitize_text_field($valueAttrs['data-value-type']) : '';

				if ($objectType == 'category') {
					$searchResults = array();
					foreach ($ruleData['value'] as $catId) {
						$catId = (int) $catId;
						if ($catId <= 0) {
							continue;
						}
						$cat = get_term_by('id', $catId, $postType);
						if ($cat && !is_wp_error($cat)) {
							$searchResults[$catId] = $cat->name;
						}
					}
					$targetData[$ruleId]['value'] = $searchResults;
				}
				else if (!$isNotPostType) {
					$postIds = array_values(array_filter(array_map('intval', $ruleData['value'])));
					$args = array(
						'post__in' => $postIds,
						'posts_per_page' => 10,
						'post_type'      => $postType
					);
					$searchResults = !empty($postIds) ? SGPMHelper::getPostTypeData($args) : array();
					$targetData[$ruleId]['value'] = $searchResults;
				}
			}
		}

		if ($conditionType === 'everywhere') {
			$targetData[] = array(
				'condition_type' => 'everywhere'
			);
		}

		foreach ($targetData as $ruleId => $ruleData) {
			if (!is_array($ruleData)) {
				continue;
			}

			if (isset($ruleData['condition_type'])) {
				if ($ruleData['condition_type'] !== 'everywhere') {
					unset($targetData[$ruleId]);
				}
				continue;
			}

			if (isset($ruleData['operator']) && !in_array($ruleData['operator'], array('==', '!='), true)) {
				$targetData[$ruleId]['operator'] = '==';
			}

			if (isset($ruleData['param']) && $ruleData['param'] === 'page_type') {
				$rawValue = isset($ruleData['value']) ? $ruleData['value'] : array();
				$targetData[$ruleId]['value'] = SGPMHelper::sanitizePageTypeValues($rawValue);
			}
		}

		return $targetData;
	}
}
