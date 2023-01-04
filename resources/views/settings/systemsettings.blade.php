<form action="{{ route('settings.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="form-row">
        <div class="form-group col-md-6 col-sm-12">
          <label for="title">Company Name</label>
          <input type="text" name="company_name" class="form-control"  placeholder="Company Name" value="{{ $settings->company_name ?? 'My Company' }}">
        </div>

        <div class="form-group col-md-6 col-sm-12">
            <label for="title">Company Email</label>
            <input type="email" name="company_email" class="form-control"  placeholder="Company Contact Email" value="{{ $settings->company_email ?? 'My Contact Number' }}">
        </div>
        
    </div>


    <div class="form-row">
        <div class="form-group col-md-6 col-sm-12">
            <label for="title">Company Phone Number</label>
            <input type="text" name="company_pnum" class="form-control"  placeholder="Company Contact Number" value="{{ $settings->company_contact ?? '0000' }}">
        </div>

        <div class="form-group col-md-6 col-sm-12">
            <label for="title">Company Address</label>
            <input type="text" name="company_address" class="form-control"  placeholder="Company Address" value="{{ $settings->company_address ?? 'My Contact Number' }}">
        </div>
        

       
    </div>

    <div class="form-row">
        <div class="form-group col-md-6 col-sm-12">
            <label for="title">Company Logo</label>
            <input type="file" name="image" class="form-control"  placeholder="Company Contact Details">
            
        </div>
    </div>

    <button class="btn submit">save</button>
</form>