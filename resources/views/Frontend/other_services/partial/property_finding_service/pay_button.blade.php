<form id="propertyFindingPaymentForm" method="GET" action="{{ route('propertyFindingPayment') }}">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product_id }}">
    <input type="hidden" name="product_name" value="{{ $product_name }}">
    <input type="hidden" name="plan" value="{{ $plan }}">
    <input type="hidden" name="bill" value="{{ $bill }}">
    <input type="hidden" name="child_category_id_from_backend" value="{{ $child_category_id_from_backend ?? null }}">
    <input type="hidden" name="service_charge_id" value="{{ $service_charge_id }}">

    <button type="submit" class="btn" style="color: white">PAY</button>
</form>
