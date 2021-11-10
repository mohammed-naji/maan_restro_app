@extends('layouts.master')
@section('main')
    <div class="d-flex justify-content-between align-items-center mt-2 mb-4">

        <h1 class="h2">Edit Order</h1>

        <a class="btn btn-primary px-5" href="{{ route('orders.index') }}">Return Back</a>
    </div>
    <form action="{{ route('orders.edit', $order->id) }}" method="POST">
    @csrf
    @method('put')
    <div class="mb-3">
        <label>Order Type</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" value="In" name="order_type" id="In" {{ $order->order_type == 'In' ? 'checked' : '' }}>
            <label class="form-check-label" for="In">In Resturant</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" value="Out" name="order_type" id="Out" {{ $order->order_type == 'Out' ? 'checked' : '' }}>
            <label class="form-check-label" for="Out">Delivery</label>
          </div>

    </div>

    <div class="mb-3">
        <label>Deliver To</label>
        <input type="{{ is_int($order->deliver_to) ? 'number' : 'text' }}" id="deliver_to" max="20" class="form-control" name="deliver_to" placeholder="Deliver To" value="{{ $order->deliver_to }}" />
    </div>

    <div class="mb-3 {{ $order->user_id ? '' : 'd-none' }}" id="user_select">
        <label>User</label>
        <select class="form-control" name="user_id">
            <option value="" selected disabled>Choose User</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ $order->user_id == $user->id ? 'selected' : '' }} >{{ $user->name }}</option>
            @endforeach
        </select>
    </div>

    <hr>

    <h3>Meals</h3>

    @php
    $items = $order->meals()->pluck('meals.id')->toArray();
    $quantity = $order->meals()->pluck('meal_order.quantity')->toArray();

    $items_quantity = [];
    $i = 0;
    foreach ($items as $item) {
        $items_quantity[$item] = $quantity[$i];
        $i++;
    }

    // dump($items_quantity);
    @endphp

    <ul class="list-group mb-4">
    @foreach ($meals as $meal)
        <li class="list-group-item d-flex align-items-center">
            <label style="width: 150px" ><input class="meals" {{ in_array($meal->id, $items) ? 'checked' : '' }} type="checkbox" name="meals[{{ $meal->id }}]" value=""> {{ $meal->name }} - {{ $meal->price }}$</label>
            @php
                $has_qyt = false;
            @endphp
            @foreach ($items_quantity as $m => $qyt)
                @if ($meal->id == $m)
                    @php
                        $has_qyt = true;
                    @endphp
                    <input style="width: 100px" value="{{ $qyt }}" placeholder="Quantity" class="form-control form-control-sm mx-4 quantity" type="number">
                @endif
            @endforeach
            @if (!$has_qyt)
            <input style="width: 100px" disabled placeholder="Quantity" class="form-control form-control-sm mx-4 quantity" type="number">
            @endif

        </li>
    @endforeach
    </ul>

    <button class="btn btn-success">Edit</button>
    </form>
@stop

@section('scripts')
<script>

    $('.meals').click(function() {
        // $(this).parents('li').find('.quantity').attr('disabled', false);
        // $(this).parents('li').find('.quantity').prop('disabled', false);

        if($(this).is(':checked')) {
            $(this).parents('li').find('.quantity').prop('disabled', false);
            $(this).parents('li').find('.quantity').val(1);
            $(this).val(1)
        }else {
            $(this).parents('li').find('.quantity').prop('disabled', true);
            $(this).parents('li').find('.quantity').val('')
            $(this).val('')
        }

    })

    $('.quantity').keyup(function() {
        let val = parseInt( $(this).val() );
        $(this).parent().find('.meals').val( val );
    })

    $('#deliver_to').keyup(function() {
        let max = parseInt( $(this).attr('max') );
        let val = parseInt( $(this).val() );
        // console.log(typeof max, typeof val);
        if(val > max) {
            $(this).val(max)
        }
        // console.log(this.value);
    });

    $('input[name="order_type"]').change(function() {
        let type = $('input[name="order_type"]:checked').val();
        if(type == 'Out'){
            $('#deliver_to').attr('type', 'text');
            $('#user_select').removeClass('d-none');
        }else {
            $('#deliver_to').attr('type', 'number');
            $('#user_select').addClass('d-none');
        }
    })


</script>
@stop
