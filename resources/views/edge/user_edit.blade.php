<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-md-between">
                <div>
                    <h4 class="mb-3 header-title">Edit User</h4>
                </div>
                <div>
                    <button type="button" onclick="window.location='{{ route('edge.user.list.view') }}'"
                        class="btn btn-primary float-right">
                        User List
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="card-title">

            </div>
            <form class=""  method="post" action="{{ route('user.update.data') }}">
                @csrf
                <div class="d-flex justify-content-between">
                    <div class="col-md-8">
                        <div class="form-group row mb-3">
                            <label class="col-md-4 col-form-label">{{__('Status')}}</label>
                            <div class="col-md-6">
                                <select class="form-control" name="status" required>
                                    <option value="">{{__('Select')}}</option>
                                    <option value="{{ACTIVE}}"  {{!empty($user_data_by_id['users']->status) && $user_data_by_id['users']->status== ACTIVE ? 'selected' :''}} >{{__('Active')}}</option>
                                    <option value="{{INACTIVE}}" {{!empty($user_data_by_id['users']->status) && $user_data_by_id['users']->status== INACTIVE ? 'selected' :''}}>{{__('Inactive')}}</option>
                                </select>
                            </div>
                        </div>                        

                        <input type="hidden" name="id" value="{{ $user->id ?? '' }}" id="id">
                        <button type="submit"
                            class="btn btn-primary waves-effect waves-light">Edit</button>
                    </div>

                </div>

        </div>
        </form>
    </div> <!-- end col -->

</div> <!-- end card-->

</div>
