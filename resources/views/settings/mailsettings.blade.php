<form action="{{ route('email_store') }}" method="post" >
    @csrf

    
    <div class="form-row">
        <div class="form-group col-md-6 col-sm-12">
          <label for="title">Senders Name</label>
          <input type="text" name="name" class="form-control"  placeholder="Senders Name" value="{{ $emailSettings->name ?? 'Please provide name of sender' }}">
        </div>

        <div class="form-group col-md-6 col-sm-12">
            <label for="title">Senders Email</label>
            <input type="email" name="email" class="form-control"  placeholder="Senders Email" value="{{ $emailSettings->email ?? 'example@mail.com' }}">
        </div>
        
    </div>
    



    
    <button class="btn submit">save</button>
</form>