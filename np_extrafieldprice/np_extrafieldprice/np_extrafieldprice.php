<?php
/*
 * @author Evanggelos L. Goritsas <vgoritsas@gmail.com> Nextpointer Team.
 * @copyright  2018
 */

 class Np_ExtraFieldPrice extends Module{
 
	public function __construct() {
		$this->name = 'np_extrafieldprice';
        $this->tab = 'administration';
        $this->author = 'Evanggelos L. Goritsas';
        $this->version = '1.0';
        $this->need_instance = 0;
        $this->bootstrap = true;
 
        parent::__construct();
 
        $this->displayName = $this->l('Store Price');
        $this->description = $this->l('Display store price');
        $this->ps_versions_compliancy = array('min' => '1.7.1', 'max' => _PS_VERSION_);
    }
	
	
	public function install() {
        if (!parent::install() || !$this->_installSql()
                || ! $this->registerHook('displayStorePrice')
                || ! $this->registerHook('displayAdminProductsMainStepLeftColumnMiddle')       
        ) {
            return false;
        }
 
        return true;
    }
	
	
	public function uninstall() {
        return parent::uninstall() && $this->_unInstallSql();
    }
	
	
	
	protected function _installSql() {
        $sqlInstall = "ALTER TABLE " . _DB_PREFIX_ . "product "
                . "ADD store_price decimal(20,6) NULL";
		$returnSql = Db::getInstance()->execute($sqlInstall);
        return $returnSql;
    }
	
	 protected function _unInstallSql() {
        $sqlInstall = "ALTER TABLE " . _DB_PREFIX_ . "product "
                . "DROP store_price";
        
        $returnSql = Db::getInstance()->execute($sqlInstall);
        return $returnSql;
    }
	
	
	public function HookDisplayStorePrice($params)
    {

        $product = new Product($params['product']['id_product']);

        $this->context->smarty->assign(array(
                'store_price' => $product->store_price,
            )
        );
        return $this->display(__FILE__, 'views/templates/hook/hook.tpl');



    }
	
	
	public function hookDisplayAdminProductsMainStepLeftColumnMiddle($params) {


		$product = new Product($params['id_product']);

        $this->context->smarty->assign(array(
                'store_price' => $product->store_price,
            )
        );
        return $this->display(__FILE__, 'views/templates/hook/np_extrafieldprice.tpl');
    }
	
	
	
	
 
 }