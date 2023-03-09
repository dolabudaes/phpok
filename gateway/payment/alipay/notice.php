<?php
/*****************************************************************************************
	文件： payment/alipay/notice.php
	备注： 支付通知页
	版本： 4.x
	网站： www.phpok.com
	作者： qinggan <qinggan@188.com>
	时间： 2014年5月3日
*****************************************************************************************/
if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");}
class alipay_notice
{
	private $paydir;
	private $order;
	private $payment;
	private $alipay;
	public function __construct($order,$param)
	{
		global $app;
		$this->param = $param;
		$this->order = $order;
		$this->paydir = $app->dir_root.'gateway/payment/alipay/';
		$this->baseurl = $app->url;
		$this->alipay = $GLOBALS['app']->lib('alipay');
	}

	//获取订单信息
	public function submit()
	{
		global $app;
		//如果异步通知已通验证，同步通知就不需要再次验收
		if($this->order['status']){
			return true;
		}
		if(!$this->param['param']['prikey'] || !$this->param['param']['pubkey']){
			$app->error('未配置证书');
		}
		$this->alipay->gateway_url("https://openapi.alipay.com/gateway.do");
		$this->alipay->app_id($this->param['param']['pid']);
		$this->alipay->private_key($this->param['param']['prikey']);
		$this->alipay->public_key($this->param['param']['pubkey']);
		$result = $this->alipay->query($this->order['sn'].'-'.$this->order['id']);
		$responseNode = "alipay_trade_query_response";
		$resultCode = $result->$responseNode->code;
		if(!$resultCode || $resultCode != 10000){
			$msg = $result->$responseNode->msg;
			if($result->$responseNode->sub_msg){
				$msg .= ' '.$result->$responseNode->sub_msg;
			}
			$app->error($msg);
		}
		$data = (array) $result->$responseNode;
		$tmp = array('WAIT_SELLER_SEND_GOODS','WAIT_BUYER_CONFIRM_GOODS','TRADE_FINISHED','TRADE_SUCCESS');
		if($data && in_array($data['trade_status'],$tmp)){
			$alipay = ($this->order['ext'] && is_string($this->order['ext'])) ? unserialize($this->order['ext']) : ($this->order['ext'] ? $this->order['ext'] : array());
			foreach($data as $key=>$value){
				$alipay[$key] = $value;
			}
			$array = array('status'=>1,'ext'=>serialize($alipay));
			if(!$this->order['status']){
				$array = array('status'=>1,'ext'=>serialize($alipay));
				$app->model('payment')->log_update($array,$this->order['id']);
			}
			if($this->order['type'] == 'order'){
				$order = $app->model('order')->get_one_from_sn($this->order['sn']);
				if($order){
					$alipay['log_id'] = $this->order['id'];
					$payment_data = array();
					$payment_data['order_id'] = $order['id'];
					$payment_data['payment_id'] = $this->param['id'];
					$payment_data['title'] = $this->param['title'];
					$payment_data['price'] = $this->order['price']; //登记实付金额
					$payment_data['currency_id'] = $this->param['currency']['id']; //登记实付货币
					$payment_data['currency_rate'] = $this->param['currency']['val']; //登记的汇率
					$payment_data['startdate'] = $app->time; //登记时间
					$payment_data['dateline'] = $app->time; //付款时间
					$payment_data['ext'] = serialize($alipay);
					$app->model('order')->save_payment($payment_data);
					$app->model('order')->update_order_status($order['id'],'paid');
					$note = P_Lang('订单支付完成，编号：{sn}',array('sn'=>$order['sn']));
					$log = array('order_id'=>$order['id'],'addtime'=>$app->time,'who'=>$app->user['user'],'note'=>$note);
					$app->model('order')->log_save($log);
				}
			}
			if($this->order['type'] == 'recharge'){
				$app->model('wealth')->recharge($this->order['id']);
			}
			$GLOBALS['app']->plugin('payment-notice',$this->order['id']);
			return true;
		}
		$app->error(P_Lang('暂无订单'));
	}
}