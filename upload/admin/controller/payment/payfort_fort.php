<?php

class ControllerPaymentPayfortFort extends Controller {

    private $error = array();

    public function index() {
        $this->language->load('payment/payfort_fort');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('payfort_fort', $this->request->post);
            
            $sadad_post = $this->fixPostData($this->request->post, 'sadad');
            $this->model_setting_setting->editSetting('payfort_fort_sadad', $sadad_post);
            
            $qpay_post = $this->fixPostData($this->request->post, 'qpay');
            $this->model_setting_setting->editSetting('payfort_fort_qpay', $qpay_post);
            
            
            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_sha1'] = $this->language->get('text_sha1');
        $data['text_sha256'] = $this->language->get('text_sha256');
        $data['text_sha512'] = $this->language->get('text_sha512');
        $data['text_en'] = $this->language->get('text_en');
        $data['text_ar'] = $this->language->get('text_ar');
        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['text_authorization'] = $this->language->get('text_authorization');
        $data['text_purchase'] = $this->language->get('text_purchase');
        $data['entry_hash_algorithm'] = $this->language->get('entry_hash_algorithm');

        $data['entry_merchant_identifier'] = $this->language->get('entry_merchant_identifier');
        $data['entry_access_code'] = $this->language->get('entry_access_code');
        $data['entry_request_sha_phrase'] = $this->language->get('entry_request_sha_phrase');
        $data['entry_response_sha_phrase'] = $this->language->get('entry_response_sha_phrase');

        $data['entry_sandbox'] = $this->language->get('entry_sandbox');
        $data['entry_language'] = $this->language->get('entry_language');
        $data['entry_command'] = $this->language->get('entry_command');
        $data['entry_total'] = $this->language->get('entry_total');
        $data['entry_order_status'] = $this->language->get('entry_order_status');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $data['entry_sadad'] = $this->language->get('entry_sadad');
        $data['entry_naps'] = $this->language->get('entry_naps');
        $data['entry_credit_card'] = $this->language->get('entry_credit_card');
        $data['entry_cc_integration_type'] = $this->language->get('entry_cc_integration_type');
        $data['help_cc_integration_type'] = $this->language->get('help_cc_integration_type');
        $data['text_merchant_page'] = $this->language->get('text_merchant_page');
        $data['text_merchant_page2'] = $this->language->get('text_merchant_page2');
        $data['text_redirection'] = $this->language->get('text_redirection');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['entry_debug'] = $this->language->get('entry_debug');
        $data['help_debug'] = $this->language->get('help_debug');
        $data['entry_gateway_currency'] = $this->language->get('entry_gateway_currency');
        $data['text_base_currency'] = $this->language->get('text_base_currency');
        $data['text_front_currency'] = $this->language->get('text_front_currency');
        $data['help_gateway_currency'] = $this->language->get('help_gateway_currency');
        $data['text_store_language'] = $this->language->get('text_store_language');
                
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        
        $data['tab_general'] = $this->language->get('tab_general');
        $data['tab_credit_card'] = $this->language->get('tab_credit_card');
        $data['tab_sadad'] = $this->language->get('tab_sadad');
        $data['tab_naps'] = $this->language->get('tab_naps');
        
        $data['entry_order_placement'] = $this->language->get('entry_order_placement');
        $data['help_order_placement'] = $this->language->get('help_order_placement');
        $data['text_on_success'] = $this->language->get('text_on_success');
        $data['text_always'] = $this->language->get('text_always');
        
        $url = new Url(HTTP_CATALOG, $this->config->get('config_secure') ? HTTPS_CATALOG : HTTP_CATALOG);
        $host_to_host_url = $url->link('payment/payfort_fort/response', '', 'SSL');
        $data['host_to_host_url'] = $host_to_host_url;
        
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['payfort_fort_entry_merchant_identifier'])) {
            $data['error_payfort_fort_entry_merchant_identifier'] = $this->error['payfort_fort_entry_merchant_identifier'];
        } else {
            $data['error_payfort_fort_entry_merchant_identifier'] = '';
        }
 
        if (isset($this->error['payfort_fort_entry_access_code'])) {
            $data['error_payfort_fort_entry_access_code'] = $this->error['payfort_fort_entry_access_code'];
        } else {
            $data['error_payfort_fort_entry_access_code'] = '';
        }
        
        if (isset($this->error['payfort_fort_entry_request_sha_phrase'])) {
            $data['error_payfort_fort_entry_request_sha_phrase'] = $this->error['payfort_fort_entry_request_sha_phrase'];
        } else {
            $data['error_payfort_fort_entry_request_sha_phrase'] = '';
        }
        
        if (isset($this->error['payfort_fort_entry_response_sha_phrase'])) {
            $data['error_payfort_fort_entry_response_sha_phrase'] = $this->error['payfort_fort_entry_response_sha_phrase'];
        } else {
            $data['error_payfort_fort_entry_response_sha_phrase'] = '';
        }
        
        if (isset($this->error['payfort_fort_payment_method_required'])) {
            $data['payfort_fort_payment_method_required'] = $this->error['payfort_fort_payment_method_required'];
        } else {
            $data['payfort_fort_payment_method_required'] = '';
        }
 
 

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_payment'),
            'href' => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('payment/payfort_fort', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $data['action'] = $this->url->link('payment/payfort_fort', 'token=' . $this->session->data['token'], 'SSL');

        $data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

        if (isset($this->request->post['payfort_fort_entry_merchant_identifier'])) {
            $data['payfort_fort_entry_merchant_identifier'] = $this->request->post['payfort_fort_entry_merchant_identifier'];
        } else {
            $data['payfort_fort_entry_merchant_identifier'] = $this->config->get('payfort_fort_entry_merchant_identifier');
        }
        
        if (isset($this->request->post['payfort_fort_entry_access_code'])) {
            $data['payfort_fort_entry_access_code'] = $this->request->post['payfort_fort_entry_access_code'];
        } else {
            $data['payfort_fort_entry_access_code'] = $this->config->get('payfort_fort_entry_access_code');
        }
        
        if (isset($this->request->post['payfort_fort_entry_command'])) {
            $data['payfort_fort_entry_command'] = $this->request->post['payfort_fort_entry_command'];
        } else {
            $data['payfort_fort_entry_command'] = $this->config->get('payfort_fort_entry_command');
        }
        
        if (isset($this->request->post['payfort_fort_entry_sandbox_mode'])) {
            $data['payfort_fort_entry_sandbox_mode'] = $this->request->post['payfort_fort_entry_sandbox_mode'];
        } else {
            $data['payfort_fort_entry_sandbox_mode'] = $this->config->get('payfort_fort_entry_sandbox_mode');
        }
        
        if (isset($this->request->post['payfort_fort_entry_request_sha_phrase'])) {
            $data['payfort_fort_entry_request_sha_phrase'] = $this->request->post['payfort_fort_entry_request_sha_phrase'];
        } else {
            $data['payfort_fort_entry_request_sha_phrase'] = $this->config->get('payfort_fort_entry_request_sha_phrase');
        }
        
        if (isset($this->request->post['payfort_fort_entry_response_sha_phrase'])) {
            $data['payfort_fort_entry_response_sha_phrase'] = $this->request->post['payfort_fort_entry_response_sha_phrase'];
        } else {
            $data['payfort_fort_entry_response_sha_phrase'] = $this->config->get('payfort_fort_entry_response_sha_phrase');
        }
        
        if (isset($this->request->post['payfort_fort_entry_language'])) {
            $data['payfort_fort_entry_language'] = $this->request->post['payfort_fort_entry_language'];
        } else {
            $data['payfort_fort_entry_language'] = $this->config->get('payfort_fort_entry_language');
        }
        
        if (isset($this->request->post['payfort_fort_entry_hash_algorithm'])) {
            $data['payfort_fort_entry_hash_algorithm'] = $this->request->post['payfort_fort_entry_hash_algorithm'];
        } else {
            $data['payfort_fort_entry_hash_algorithm'] = $this->config->get('payfort_fort_entry_hash_algorithm');
        }

        if (isset($this->request->post['payfort_fort_order_status_id'])) {
            $data['payfort_fort_order_status_id'] = $this->request->post['payfort_fort_order_status_id'];
        } else {
            $data['payfort_fort_order_status_id'] = $this->config->get('payfort_fort_order_status_id');
        }
        
        if (isset($this->request->post['payfort_fort_entry_gateway_currency'])) {
            $data['payfort_fort_entry_gateway_currency'] = $this->request->post['payfort_fort_entry_gateway_currency'];
        } else {
            $data['payfort_fort_entry_gateway_currency'] = $this->config->get('payfort_fort_entry_gateway_currency');
        }
        
        if (isset($this->request->post['payfort_fort_debug'])) {
                $data['payfort_fort_debug'] = $this->request->post['payfort_fort_debug'];
        } else {
                $data['payfort_fort_debug'] = $this->config->get('payfort_fort_debug');
        }

        if (isset($this->request->post['payfort_fort_order_placement'])) {
            $data['payfort_fort_order_placement'] = $this->request->post['payfort_fort_order_placement'];
        } else {
            $data['payfort_fort_order_placement'] = $this->config->get('payfort_fort_order_placement');
        }
        
        $this->load->model('localisation/order_status');

        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
        
        if (isset($this->request->post['payfort_fort_sadad'])) {
            $data['payfort_fort_sadad'] = $this->request->post['payfort_fort_sadad'];
        } else {
            $data['payfort_fort_sadad'] = $this->config->get('payfort_fort_sadad');
        }
        
        if (isset($this->request->post['payfort_fort_naps'])) {
            $data['payfort_fort_naps'] = $this->request->post['payfort_fort_naps'];
        } else {
            $data['payfort_fort_naps'] = $this->config->get('payfort_fort_naps');
        }
        
        if (isset($this->request->post['payfort_fort_credit_card'])) {
            $data['payfort_fort_credit_card'] = $this->request->post['payfort_fort_credit_card'];
        } else {
            $data['payfort_fort_credit_card'] = $this->config->get('payfort_fort_credit_card');
        }

        if (isset($this->request->post['payfort_fort_cc_integration_type'])) {
            $data['payfort_fort_cc_integration_type'] = $this->request->post['payfort_fort_cc_integration_type'];
        } else {
            $data['payfort_fort_cc_integration_type'] = $this->config->get('payfort_fort_cc_integration_type');
        }
        
        if (isset($this->request->post['payfort_fort_status'])) {
            $data['payfort_fort_status'] = $this->request->post['payfort_fort_status'];
        } else {
            $data['payfort_fort_status'] = $this->config->get('payfort_fort_status');
        }

        if (isset($this->request->post['payfort_fort_sort_order'])) {
            $data['payfort_fort_sort_order'] = $this->request->post['payfort_fort_sort_order'];
        } else {
            $data['payfort_fort_sort_order'] = $this->config->get('payfort_fort_sort_order');
        }
        
        
        if (isset($this->request->post['payfort_fort_sadad_sort_order'])) {
            $data['payfort_fort_sadad_sort_order'] = $this->request->post['payfort_fort_sadad_sort_order'];
        } else {
            $data['payfort_fort_sadad_sort_order'] = $this->config->get('payfort_fort_sadad_sort_order');
        }
        
        if (isset($this->request->post['payfort_fort_qpay_sort_order'])) {
            $data['payfort_fort_qpay_sort_order'] = $this->request->post['payfort_fort_qpay_sort_order'];
        } else {
            $data['payfort_fort_qpay_sort_order'] = $this->config->get('payfort_fort_qpay_sort_order');
        }
        
        $this->template = 'payment/payfort_fort.tpl';
        
        $data['header'] = $this->load->controller('common/header');
        $data['footer'] = $this->load->controller('common/footer');
        $data['column_left'] = $this->load->controller('common/column_left');
        
        $this->response->setOutput($this->load->view('payment/payfort_fort.tpl', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'payment/payfort_fort')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->request->post['payfort_fort_entry_merchant_identifier']) {
            $this->error['payfort_fort_entry_merchant_identifier'] = $this->language->get('error_payfort_fort_entry_merchant_identifier');
        }
        
        if (!$this->request->post['payfort_fort_entry_access_code']) {
            $this->error['payfort_fort_entry_access_code'] = $this->language->get('error_payfort_fort_entry_access_code');
        }
        
        if (!$this->request->post['payfort_fort_entry_request_sha_phrase']) {
            $this->error['payfort_fort_entry_request_sha_phrase'] = $this->language->get('error_payfort_fort_entry_request_sha_phrase');
        }
        
        if (!$this->request->post['payfort_fort_entry_response_sha_phrase']) {
            $this->error['payfort_fort_entry_response_sha_phrase'] = $this->language->get('error_payfort_fort_entry_response_sha_phrase');
        }
        
        if (!$this->request->post['payfort_fort_credit_card'] && !$this->request->post['payfort_fort_sadad'] && !$this->request->post['payfort_fort_naps'] && $this->request->post['payfort_fort_status']) {
            $this->error['payfort_fort_payment_method_required'] = $this->language->get('payfort_fort_payment_method_required');
        }
        
        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    public function install() {
            $this->load->model('extension/extension');
            $this->model_extension_extension->install('payment', 'payfort_fort_sadad');
            $this->model_extension_extension->install('payment', 'payfort_fort_qpay');
    }

    public function uninstall() {
            $this->load->model('extension/extension');
            $this->model_extension_extension->uninstall('payment', 'payfort_fort_sadad');
            $this->model_extension_extension->uninstall('payment', 'payfort_fort_qpay');
            
            $this->load->model('setting/setting');
            $this->model_setting_setting->deleteSetting('payfort_fort_sadad');
            $this->model_setting_setting->deleteSetting('payfort_fort_qpay');
    }

    private function fixPostData($post, $code) {
            $newPost = array();
            foreach($post as $key => $value) {
                $newstr = substr_replace($key, '_'.$code, strlen('payfort_fort'), 0);
                if(isset($this->request->post[$newstr])) {
                    $newPost[$newstr] = $this->request->post[$newstr]; 
                }
                else{
                    $newPost[$newstr] = $value; 
                }
            }
            return $newPost;
    }
}

?>