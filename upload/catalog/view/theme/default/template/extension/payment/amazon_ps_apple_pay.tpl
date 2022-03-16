<div class="buttons apple_pay_option hide-me">
  <div class="pull-right">
    <button type="button" value="<?php echo $button_confirm; ?>" id="applePay" class="<?php echo $apple_pay_button_class; ?>"></button>
  </div>
</div>
<script type="text/javascript"><!--
	var apple_vars = JSON.parse('<?php echo $apple_vars; ?>');
  var amazon_ps_apple_order = JSON.parse('<?php echo $amazon_ps_apple_order; ?>');
//--></script> 
<script type="text/javascript" src="catalog/view/javascript/amazon_ps/amazon_ps_apple_pay.js"/>
<style type="text/css">
/* Apple pay CSS */

#applePay {
	width: 150px !important;
	height: 50px !important;
	border: 0px !important;
	border-radius: 5px !important;
	margin-left: auto !important;
	margin-right: auto !important;
	margin-top: 20px !important;
	-webkit-appearance: -apple-pay-button;
	background-position: 50% 50% !important;
	background-color: black !important;
	background-size: 60% !important;
	background-repeat: no-repeat !important;
	z-index: 999;
}
.apple-pay-buy {
	-apple-pay-button-type: buy;
}
.apple-pay-donate {
	-apple-pay-button-type: donate;
}
.apple-pay-plain {
	-apple-pay-button-type: plain;
}
.apple-pay-set-up {
	-apple-pay-button-type: set-up;
}
.apple-pay-book {
	-apple-pay-button-type: book;
}
.apple-pay-check-out {
	-apple-pay-button-type: check-out;
}
.apple-pay-subscribe {
	-apple-pay-button-type: subscribe;
}
.apple-pay-add-money {
	-apple-pay-button-type: add-money;
}
.apple-pay-contribute {
	-apple-pay-button-type: contribute;
}
.apple-pay-order {
	-apple-pay-button-type: order;
}
.apple-pay-reload {
	-apple-pay-button-type: reload;
}
.apple-pay-rent {
	-apple-pay-button-type: rent;
}
.apple-pay-support {
	-apple-pay-button-type: support ;
}
.apple-pay-tip {
	-apple-pay-button-type: tip;
}
.apple-pay-top-up {
	-apple-pay-button-type: top-up;
}
.hide-me {
	display: none !important;
}

</style>