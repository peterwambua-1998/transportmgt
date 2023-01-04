<form action="{{ route('paygate-store') }}" method="post" enctype="multipart/form-data">
    @csrf

    

    <div class="form-row">
        <div class="form-group col-md-6 col-sm-12">
          <label for="title">Stripe Public Key</label>
          <input type="text" name="stripe_public" class="form-control"  placeholder="Stripe Public Key" value="{{ $paySettings->public_key ?? 'Please provide Stripe Public Key' }}">
        </div>

        <div class="form-group col-md-6 col-sm-12">
            <label for="title">Stripe Private Key</label>
            <input type="text" name="stripe_private" class="form-control"  placeholder="Stripe Private Key" value="{{ $paySettings->private_key ?? 'Please provide Stripe Private Key' }}">
        </div>
        
    </div>



    
    <button class="btn submit">save</button>
</form>