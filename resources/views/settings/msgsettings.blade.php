<form action="{{ route('msg-store') }}" method="post" enctype="multipart/form-data">
    @csrf

    

    <div class="form-row">
        <div class="form-group col-md-12 col-sm-12">
          <label for="title">Message For Vehicle out of GeoFence</label>
          <input type="text" name="msg" class="form-control"  placeholder="Message For Vehicle out of GeoFence" value="{{ $msgSettings->message ?? 'Vehicle out of GeoFence' }}">
        </div>

        
        
    </div>



    
    <button class="btn submit">save</button>
</form>