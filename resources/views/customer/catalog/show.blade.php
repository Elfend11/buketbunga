@extends('layouts.app')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>{{ $product->name }}</h1>
        <p>{{ $product->category->name }}</p>
    </div>
</section>
<section class="container" style="padding-top:32px">
    <p>{{ $product->description }}</p>
    <p><strong>Harga dasar: Rp {{ number_format((float) $product->price, 0, ',', '.') }}</strong></p>

    <form data-estimator-form action="{{ route('catalog.estimate', $product->slug }}" method="POST">
        @csrf
        <div class="form-grid">
            @foreach($product->personalizationOptions as $option)
                <fieldset>
                    <legend>{{ $option->name }}{{ $option->is_required ? ' (wajib)' : '' }}</legend>
                    @foreach($option->values as $value)
                        <label>
                            <input type="{{ $option->type === 'select' ? 'radio' : 'checkbox' }}"
                                   name="{{ $option->type === 'select' ? 'option_value_ids[]' : 'option_value_ids[]' }}"
                                   value="{{ $value->id }}">
                            {{ $value->value_name }}
                            @if((float) $value->additional_price > 0)
                                (+Rp {{ number_format((float) $value->additional_price, 0, ',', '.') }})
                            @endif
                        </label>
                    @endforeach
                </fieldset>
            @endforeach

            @foreach($product->addOns as $addOn)
                <label>
                    <input type="checkbox" name="add_on_ids[]" value="{{ $addOn->id }}">
                    {{ $addOn->name }} (+Rp {{ number_format((float) $addOn->price, 0, ',', '.') }})
                </label>
            @endforeach

            <div>
                <strong>Estimasi harga: <span data-estimated-total>Rp {{ number_format((float) $product->price, 0, ',', '.') }}</span></strong>
                <p>Harga akhir dikonfirmasi pemilik melalui WhatsApp.</p>
            </div>
        </div>
    </form>
</section>
@endsection
