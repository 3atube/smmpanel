@if(1==2)
<?php
$m_shop = '1667344001';
$m_orderid = Auth::user()->id;
$m_amount = number_format(1, 2, '.', '');
$m_curr = 'USD';
$m_desc = base64_encode('Add funds (' . Auth::user()->name . ')');
$m_key = 'Anhtuan@8010';

$arHash = array(
	$m_shop,
	$m_orderid,
	$m_amount,
	$m_curr,
	$m_desc
);
$arHash[] = $m_key;

$sign = strtoupper(hash('sha256', implode(':', $arHash)));
?>
<div class="div-pm div-10">
	<form method="get" action="https://payeer.com/merchant/">
		<input type="hidden" name="m_shop" value="<?= $m_shop ?>">
		<input type="hidden" name="m_orderid" value="<?= $m_orderid ?>">

		<input type="hidden" name="m_curr" value="<?= $m_curr ?>">
		<input type="hidden" name="m_desc" value="<?= $m_desc ?>">
		<input type="hidden" name="m_sign" value="<?= $sign ?>">
		<div class="mb-5">
			<label class="required form-label">Enter amount to deposit</label>
			<input type="text" name="m_amount" value="1" class="form-control">
		</div>
		<input type="submit" class="btn btn-primary w-100" value="Pay Now!">

	</form>
</div>
@endif
@php $method_extras = json_decode($info->method_extras); @endphp
<div class="div-pm div-10">
	<div class="mb-5">

		<label class="required form-label">Enter amount to deposit</label>
		<input type="text" id="m_amount" name="m_amount" min="{{!empty($method_extras->min) ? $method_extras->min : 10 }}" value="{{!empty($method_extras->min) ? $method_extras->min : 10 }}" class="form-control">
	</div>
	<input type="submit" id="payeer-method" class="btn btn-primary w-100" value="Pay Now!">
</div>