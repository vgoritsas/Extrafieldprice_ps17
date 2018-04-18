<?php


class Product extends ProductCore {

    public $store_price;
	
	
	public function __construct($id_product = null, $full = false, $id_lang = null, $id_shop = null, Context $context = null){
	 
			self::$definition['fields']['store_price'] = [
	            'type' => self::TYPE_STRING,
	            'required' => false
	        ];
	      

	        parent::__construct($id_product, $full, $id_lang, $id_shop, $context);
	}
	
	
}

?>