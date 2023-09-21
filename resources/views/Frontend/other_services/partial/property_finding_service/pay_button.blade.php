<form id="propertyFindingPaymentForm" method="GET" action="{{ route('propertyFindingPayment') }}">
    @csrf
    <input type="hidden" name="product_id" value="5">
    <input type="hidden" name="product_name" value="Studio Flat Regular">
    <input type="hidden" name="bill" value="{{ $studio_flat_service_charge }}">

    @if ($service_id !== null)
        <input type="hidden" name="service_id" value="{{ $service_id }}">
        <input type="hidden" name="child_category_id_from_backend" value="{{ $child_category_id }}">
    @endif

    <td class="bg-green">
        <button type="submit" class="btn" style="color: white">PAY</button>
    </td>
</form>
