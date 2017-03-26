<?php
	drupal_add_js(drupal_get_path('module', 'weixin_payment') . '/qrcode.js');
	include(drupal_get_path('module', 'weixin_payment') .'/includes/WxPayPubHelper.inc');
	include(drupal_get_path('module', 'weixin_payment') .'/includes/WxPay.pub.config.inc');
//	include_once('./include/WxPayPubHelper.php');
	$unifiedOrder = new UnifiedOrder_pub();
	$unifiedOrder->setParameter("body","test");//商品描述
	//自定义订单号，此处仅作举例
	$timeStamp = time();
	$out_trade_no = variable_get('weixin_appid')."$timeStamp";
	$unifiedOrder->setParameter("out_trade_no","$out_trade_no");//商户订单号 
	$unifiedOrder->setParameter("total_fee","1");//总金额
	$unifiedOrder->setParameter("notify_url",WxPayConf_pub::NOTIFY_URL);//通知地址 
	$unifiedOrder->setParameter("trade_type","NATIVE");//交易类型
	//非必填参数，商户可根据实际情况选填
	//$unifiedOrder->setParameter("sub_mch_id","XXXX");//子商户号  
	//$unifiedOrder->setParameter("device_info","XXXX");//设备号 
	//$unifiedOrder->setParameter("attach","XXXX");//附加数据 
	//$unifiedOrder->setParameter("time_start","XXXX");//交易起始时间
	//$unifiedOrder->setParameter("time_expire","XXXX");//交易结束时间 
	//$unifiedOrder->setParameter("goods_tag","XXXX");//商品标记 
	//$unifiedOrder->setParameter("openid","XXXX");//用户标识
	//$unifiedOrder->setParameter("product_id","XXXX");//商品ID

	dpm($unifiedOrder);
	$unifiedOrderResult = $unifiedOrder->getResult();
	dpm($unifiedOrderResult);
	/*
	$testdata = 'drupal';
	$product_url = createNativeUrl($testdata);
	dpm($product_url);
	 */
?>

<body>
	<?php echo drupal_render(drupal_get_form('weixin_payment_qr_configure_form')); ?>
        <div align="center" id="qrcode">
                <p >扫我，扫我</p>
        </div>
</body>
	
<script>
	var url = "<?php echo $unifiedOrderResult['code_url'];?>";
	//参数1表示图像大小，取值范围1-10；参数2表示质量，取值范围'L','M','Q','H'
	var qr = qrcode(10, 'M');
	qr.addData(url);
	qr.make();
	var dom=document.createElement('DIV');
	dom.innerHTML = qr.createImgTag();
	var element=document.getElementById("qrcode");
	element.appendChild(dom);
</script>
