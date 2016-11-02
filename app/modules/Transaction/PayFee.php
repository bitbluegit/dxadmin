<?php

namespace Dextro\Modules\Transaction;

use Framework\Request;
use Framework\Response;
use Framework\Controller;
use Dextro\Domains\TransactionModel;

class PayFee extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index($params)
	{
		$this->data['fee_id'] = $params[0];
		$this->view = ['fee'];
		
		if(!(new Request)->isAjax()) {
			(new Response)->json(['key' => '90abc45sr#@t%gh9'])->code(307)->send();
		} else {
			(new Response)->html($this->output())->send();
		}
		
		//echo $this->output();
	}
	
	public function testModel()
	{
		$model = new TransactionModel();
		(new Response)->json($model->getUsers())->send();
	}
}