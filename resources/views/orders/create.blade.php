@extends('layouts.master')
@section('main')
    <div class="d-flex justify-content-between align-items-center mt-2 mb-4">

        <h1 class="h2">New Order</h1>

        <a class="btn btn-primary px-5" href="{{ route('orders.index') }}">Return Back</a>
    </div>
    <form action="{{ route('orders.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Order Type</label>
        {{-- <label><input type="radio" name="order_type" > In Resturant</label><br>
        <label><input type="radio" name="order_type" value="Out"> Delivery</label> --}}

        <div class="form-check">
            <input class="form-check-input" type="radio" value="In" name="order_type" id="In" checked>
            <label class="form-check-label" for="In">In Resturant</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" value="Out" name="order_type" id="Out">
            <label class="form-check-label" for="Out">Delivery</label>
          </div>

    </div>

    <div class="mb-3">
        <label>Deliver To</label>
        <input type="number" id="deliver_to" max="20" class="form-control" name="deliver_to" placeholder="Deliver To" />
    </div>

    <div class="mb-3 d-none" id="user_select">
        <label>User</label>
        <select class="form-control" name="user_id">
            <option value="" selected disabled>Choose User</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>

    <hr>

    <h3>Meals</h3>

    <ul class="list-group mb-4">
    @foreach ($meals as $meal)
        <li class="list-group-item d-flex align-items-center">
            <label style="width: 150px" ><input class="meals" type="checkbox" name="meals[{{ $meal->id }}]" value=""> {{ $meal->name }} - {{ $meal->price }}$</label>
            <input style="width: 100px" disabled placeholder="Quantity" class="form-control form-control-sm mx-4 quantity" type="number">
        </li>
    @endforeach
    </ul>

    <button class="btn btn-success">Save</button>
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
